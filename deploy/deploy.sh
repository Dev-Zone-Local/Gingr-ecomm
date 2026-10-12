#!/usr/bin/env bash
# Deploy the main branch of Gingr to the live site directory.
#
#   bash deploy/deploy.sh                  deploy origin/main to DEPLOY_DIR
#   DRY_RUN=1 bash deploy/deploy.sh        show what would change, touch nothing
#   RUN_MIGRATE=1 bash deploy/deploy.sh    also run php artisan migrate --force
#
# Server state is never taken from the repo: .env, storage/, public/media/
# and config/ecom.php stay exactly as they are on the server.
# Before every deploy a backup archive of DEPLOY_DIR is written to BACKUP_DIR.
set -euo pipefail

REPO_URL="${REPO_URL:-https://github.com/Dev-Zone-Local/Gingr-ecomm.git}"
BRANCH="${BRANCH:-main}"
DEPLOY_DIR="${DEPLOY_DIR:-/www/wwwroot/gingr.live}"
WORK_DIR="${WORK_DIR:-/www/deploy/gingr-src}"
BACKUP_DIR="${BACKUP_DIR:-/www/backup/gingr.live}"
PHP_BIN="${PHP_BIN:-/www/server/php/82/bin/php}"
WEB_USER="${WEB_USER:-www}"
DRY_RUN="${DRY_RUN:-0}"
RUN_MIGRATE="${RUN_MIGRATE:-0}"
LOCK_FILE="${LOCK_FILE:-/tmp/gingr-deploy.lock}"

# Paths owned by the server. Restored after every copy.
KEEP_PATHS=(".env" "storage" "config/ecom.php" "public/media")

log(){ echo "[deploy $(date +%H:%M:%S)] $*"; }
die() { echo "[deploy] ERROR: $*" >&2; exit 1; }

# ---- guards -----------------------------------------------------------------
[ -n "$DEPLOY_DIR" ] && [ "$DEPLOY_DIR" != "/" ] || die "DEPLOY_DIR is unsafe: '$DEPLOY_DIR'"
command -v git >/dev/null || die "git not installed"
command -v tar >/dev/null || die "tar not installed"

if [ ! -x "$PHP_BIN" ]; then
  PHP_BIN="$(command -v php8.2 || true)"
  [ -n "$PHP_BIN" ] || die "PHP 8.2 not found. Set PHP_BIN=/path/to/php8.2"
fi
"$PHP_BIN" -r 'exit(PHP_MAJOR_VERSION === 8 && PHP_MINOR_VERSION === 2 ? 0 : 1);' \
  || die "PHP 8.2 required, got: $("$PHP_BIN" -r 'echo PHP_VERSION;')"

[ -d "$DEPLOY_DIR" ] || die "DEPLOY_DIR does not exist: $DEPLOY_DIR"
[ -f "$DEPLOY_DIR/.env" ] || die "$DEPLOY_DIR/.env missing. Create the server .env before deploying."

if command -v flock >/dev/null; then
  exec 9>"$LOCK_FILE"
  flock -n 9 || die "another deploy is running ($LOCK_FILE)"
fi

# ---- source -----------------------------------------------------------------
if [ ! -d "$WORK_DIR/.git" ]; then
  mkdir -p "$(dirname "$WORK_DIR")"
  git clone --branch "$BRANCH" "$REPO_URL" "$WORK_DIR"
else
  git -C "$WORK_DIR" fetch --prune origin "$BRANCH"
  git -C "$WORK_DIR" checkout -q -B "$BRANCH" "origin/$BRANCH"
  git -C "$WORK_DIR" reset -q --hard "origin/$BRANCH"
fi
COMMIT="$(git -C "$WORK_DIR" rev-parse --short HEAD)"
log "source: $REPO_URL $BRANCH @ $COMMIT"

STAGE="$(mktemp -d)"
KEEP="$(mktemp -d)"
DEPLOYED=0

# Restore server-owned paths if anything fails after they were moved out.
on_error() {
  if [ "$DEPLOYED" -eq 0 ]; then
    log "failed; restoring server-owned paths"
    for p in "${KEEP_PATHS[@]}"; do
      if [ -e "$KEEP/$p" ]; then
        rm -rf "$DEPLOY_DIR/$p"
        mkdir -p "$(dirname "$DEPLOY_DIR/$p")"
        mv "$KEEP/$p" "$DEPLOY_DIR/$p"
      fi
    done
  fi
}
cleanup() {
  # Runs on every exit path. Server state is restored unless the deploy finished.
  if [ "$DEPLOYED" -eq 0 ]; then on_error; fi
  rm -rf "$STAGE"
  if [ -n "$(find "$KEEP" -type f -print -quit)" ]; then
    log "WARNING: server files still in $KEEP, restore by hand"
  else
    rm -rf "$KEEP"
  fi
}
# Interrupts (SSH drop, Ctrl-C, kill) exit through EXIT, so cleanup restores server state.
trap 'exit 130' INT TERM HUP
trap cleanup EXIT

git -C "$WORK_DIR" archive "origin/$BRANCH" | tar -x -C "$STAGE"

if [ "$DRY_RUN" = "1" ]; then
  log "dry run: files that differ (server-owned paths excluded)"
  diff -rq \
    --exclude=.env --exclude=storage --exclude=ecom.php --exclude=media \
    "$STAGE" "$DEPLOY_DIR" || true
  exit 0
fi

# ---- backup -----------------------------------------------------------------
mkdir -p "$BACKUP_DIR"
BACKUP="$BACKUP_DIR/gingr-$(date +%Y%m%d-%H%M%S)-before-$COMMIT.tar.gz"
tar czf "$BACKUP" --exclude=./vendor -C "$DEPLOY_DIR" .
log "backup: $BACKUP"

# ---- move server-owned paths aside ------------------------------------------
for p in "${KEEP_PATHS[@]}"; do
  if [ -e "$DEPLOY_DIR/$p" ]; then
    mkdir -p "$KEEP/$(dirname "$p")"
    mv "$DEPLOY_DIR/$p" "$KEEP/$p"
  fi
done

# ---- copy repo code over the live directory ---------------------------------
while IFS= read -r item; do
  # Immutable server files (aaPanel locks public/.user.ini) cannot be removed. Overwrite past them.
  rm -rf "$DEPLOY_DIR/$(basename "$item")" \
    || log "WARNING: could not fully remove $(basename "$item") (immutable file?), overwriting"
done < <(find "$STAGE" -mindepth 1 -maxdepth 1)
cp -a "$STAGE/." "$DEPLOY_DIR/"

# ---- put server-owned paths back --------------------------------------------
for p in "${KEEP_PATHS[@]}"; do
  if [ -e "$KEEP/$p" ]; then
    rm -rf "$DEPLOY_DIR/$p"
    mkdir -p "$(dirname "$DEPLOY_DIR/$p")"
    mv "$KEEP/$p" "$DEPLOY_DIR/$p"
  fi
done
DEPLOYED=1

# New default media from the repo are added; existing uploads are not touched.
if [ -d "$STAGE/public/media" ]; then
  mkdir -p "$DEPLOY_DIR/public/media"
  cp -rn "$STAGE/public/media/." "$DEPLOY_DIR/public/media/"
fi
log "code copied"

# ---- app steps --------------------------------------------------------------
cd "$DEPLOY_DIR"
# config/view.php realpath()s these; a missing dir makes artisan fail on a fresh server.
mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions storage/logs bootstrap/cache
"$PHP_BIN" artisan view:clear
"$PHP_BIN" artisan config:clear
"$PHP_BIN" artisan route:clear
"$PHP_BIN" artisan cache:clear
if [ "$RUN_MIGRATE" = "1" ]; then
  "$PHP_BIN" artisan migrate --force
fi

if [ "$(id -u)" = "0" ] && id "$WEB_USER" >/dev/null 2>&1; then
  chown -R "$WEB_USER:$WEB_USER" storage bootstrap/cache public/media
  chmod -R ug+rwX storage bootstrap/cache
fi

echo "$COMMIT $(date -Iseconds)" > "$DEPLOY_DIR/.deployed_commit"
log "deployed $BRANCH @ $COMMIT to $DEPLOY_DIR"
log "rollback: tar xzf $BACKUP -C $DEPLOY_DIR"
