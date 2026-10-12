#!/usr/bin/env bash
# Deploy gingr.live (production): export branch from git, keep server-owned files, run Laravel steps, self-heal aaPanel config.
# The whole site is Laravel; nginx sends every path to public/index.php.
# Usage: bash /www/deploy/gingr.live.sh [--migrate]
#   --migrate   run php artisan migrate --force (after backup)
set -Eeuo pipefail

DOMAIN=gingr.live
APP_DIR=/www/wwwroot/$DOMAIN
REPO_URL=https://github.com/Dev-Zone-Local/Gingr-ecomm.git
BRANCH=main
WORK_DIR=/www/deploy/gingr-src
BACKUP_DIR=/www/backup/$DOMAIN
APP_USER=www
PHP=/www/server/php/82/bin/php
VHOST=/www/server/panel/vhost/nginx/$DOMAIN.conf
REWRITE=/www/server/panel/vhost/rewrite/$DOMAIN.conf   # aaPanel "URL rewrite" file, included by the vhost
PHP_INCLUDE=enable-php-82.conf                         # CHECK: same name as in the prod vhost
PHP_FPM=/etc/init.d/php-fpm-82                         # CHECK: aaPanel PHP 8.2 service name
LOG_DIR=/www/wwwlogs/deploy
# Paths owned by the server. Never taken from git.
KEEP_PATHS=(".env" "storage" "config/ecom.php" "public/media")
MIGRATE=0
for arg in "$@"; do
    case "$arg" in
        --migrate) MIGRATE=1 ;;
        *) echo "Unknown option: $arg"; exit 1 ;;
    esac
done

mkdir -p "$LOG_DIR"
LOG="$LOG_DIR/$DOMAIN-$(date +%Y%m%d-%H%M%S).log"
exec > >(tee -a "$LOG") 2>&1
ls -1t "$LOG_DIR"/$DOMAIN-*.log 2>/dev/null | tail -n +21 | xargs -r rm -f || true

# One deploy at a time.
exec 9>/tmp/deploy-$DOMAIN.lock
flock -n 9 || { echo "Another deploy is running. Exiting."; exit 1; }

step() { echo; echo "==> $(date +%T) $*"; }
as_app() { sudo -u "$APP_USER" env HOME=/tmp/www-home PATH=/usr/local/bin:/usr/bin:/bin "$@"; }
# error_log=/dev/null hides harmless duplicate-module startup warnings from php-cli.ini
artisan() { as_app "$PHP" -d error_log=/dev/null "$APP_DIR/artisan" --no-ansi "$@"; }
# curl the site through this server, bypassing DNS/CDN
local_curl() { curl -sk --resolve "$DOMAIN:443:127.0.0.1" "$@"; }

STAGE="$(mktemp -d)"
KEEP="$(mktemp -d)"
DEPLOYED=0
MAINTENANCE=0

# Restore server-owned paths if the deploy stops after they were moved out.
restore_keep() {
    for p in "${KEEP_PATHS[@]}"; do
        if [ -e "$KEEP/$p" ]; then
            rm -rf "$APP_DIR/$p"
            mkdir -p "$(dirname "$APP_DIR/$p")"
            mv "$KEEP/$p" "$APP_DIR/$p"
        fi
    done
}
on_exit() {
    local code=$?
    if [[ $MAINTENANCE == 1 ]]; then artisan up || true; fi
    if [[ $DEPLOYED == 0 ]]; then restore_keep; fi
    rm -rf "$STAGE"
    if [ -n "$(find "$KEEP" -type f -print -quit)" ]; then
        echo "WARNING: server files still in $KEEP, restore by hand"
    else
        rm -rf "$KEEP"
    fi
    if [[ $code != 0 ]]; then
        echo; echo "❌ Deploy FAILED (exit $code) at $(date). Log: $LOG"
    fi
}
trap 'exit 130' INT TERM HUP
trap on_exit EXIT

echo "Deploy started $(date) — $DOMAIN branch $BRANCH"

step "Preflight"
[[ -f "$APP_DIR/.env" ]] || { echo "$APP_DIR/.env missing. Create the server .env first."; exit 1; }
[[ -x "$PHP" ]] || { echo "PHP 8.2 not found at $PHP"; exit 1; }
"$PHP" -r 'exit(PHP_MAJOR_VERSION === 8 && PHP_MINOR_VERSION === 2 ? 0 : 1);' || { echo "PHP 8.2 required"; exit 1; }

step "Fetch $BRANCH"
if [[ ! -d "$WORK_DIR/.git" ]]; then
    mkdir -p "$(dirname "$WORK_DIR")"
    git clone --branch "$BRANCH" "$REPO_URL" "$WORK_DIR"
else
    git -C "$WORK_DIR" fetch --prune origin "$BRANCH"
    git -C "$WORK_DIR" checkout -q -B "$BRANCH" "origin/$BRANCH"
    git -C "$WORK_DIR" reset -q --hard "origin/$BRANCH"
fi
COMMIT="$(git -C "$WORK_DIR" rev-parse --short HEAD)"
echo "commit: $COMMIT"

step "Backup"
mkdir -p "$BACKUP_DIR"
BACKUP="$BACKUP_DIR/$DOMAIN-$(date +%Y%m%d-%H%M%S)-before-$COMMIT.tar.gz"
tar czf "$BACKUP" --exclude=./vendor -C "$APP_DIR" .
echo "backup: $BACKUP"

step "Export $BRANCH"
git -C "$WORK_DIR" archive "origin/$BRANCH" | tar -x -C "$STAGE"

step "Move server-owned paths aside"
for p in "${KEEP_PATHS[@]}"; do
    if [[ -e "$APP_DIR/$p" ]]; then
        mkdir -p "$KEEP/$(dirname "$p")"
        mv "$APP_DIR/$p" "$KEEP/$p"
    fi
done

step "Copy code"
while IFS= read -r item; do
    # Immutable server files (aaPanel locks public/.user.ini) cannot be removed. Overwrite past them.
    rm -rf "$APP_DIR/$(basename "$item")" \
        || echo "WARNING: could not fully remove $(basename "$item") (immutable file?), overwriting"
done < <(find "$STAGE" -mindepth 1 -maxdepth 1)
cp -a "$STAGE/." "$APP_DIR/"

step "Restore server-owned paths"
restore_keep
DEPLOYED=1
if [[ -d "$STAGE/public/media" ]]; then
    mkdir -p "$APP_DIR/public/media"
    cp -rn "$STAGE/public/media/." "$APP_DIR/public/media/"
fi
echo "$COMMIT $(date -Iseconds)" > "$APP_DIR/.deployed_commit"

step "Ownership and framework dirs"
# config/view.php realpath()s these; a missing dir makes artisan fail on a fresh server.
mkdir -p "$APP_DIR/storage/framework/views" "$APP_DIR/storage/framework/cache" \
    "$APP_DIR/storage/framework/sessions" "$APP_DIR/storage/logs" "$APP_DIR/bootstrap/cache"
chown -R "$APP_USER:$APP_USER" "$APP_DIR/storage" "$APP_DIR/bootstrap/cache" "$APP_DIR/public/media"
chmod -R ug+rwX "$APP_DIR/storage" "$APP_DIR/bootstrap/cache"

step "Laravel steps"
artisan view:clear
artisan config:clear
artisan route:clear
artisan cache:clear
if [[ $MIGRATE == 1 ]]; then
    artisan down --retry=15
    MAINTENANCE=1
    artisan migrate --force
    artisan up
    MAINTENANCE=0
fi

step "Self-heal aaPanel config"
NGINX_CHANGED=0
if ! grep -q "include $PHP_INCLUDE;" "$VHOST"; then
    sed -i -E "s#include enable-php-[0-9]+\.conf;#include $PHP_INCLUDE;#" "$VHOST"
    echo "Restored $PHP_INCLUDE in vhost"; NGINX_CHANGED=1
fi
if ! grep -qE "^\s*root $APP_DIR/public/?;" "$VHOST"; then
    sed -i -E "s#^(\s*)root [^;]+;#\1root $APP_DIR/public;#" "$VHOST"
    echo "Restored web root to public/"; NGINX_CHANGED=1
fi
# Laravel front controller: real files are served directly, everything else goes to index.php.
LARAVEL_REWRITE='location / {
    try_files $uri $uri/ /index.php?$query_string;
}'
if [[ "$(cat "$REWRITE" 2>/dev/null)" != "$LARAVEL_REWRITE" ]]; then
    [[ -f "$REWRITE" ]] && cp "$REWRITE" "$REWRITE.bak-$(date +%Y%m%d%H%M%S)"
    printf '%s\n' "$LARAVEL_REWRITE" > "$REWRITE"
    echo "Set Laravel rewrite rule in $REWRITE"; NGINX_CHANGED=1
fi
if [[ $NGINX_CHANGED == 1 ]]; then nginx -t && nginx -s reload; fi

step "Reload PHP-FPM (clears OPcache)"
"$PHP_FPM" reload

step "Health check"
sleep 2
FAIL=0
# path expected-status
while read -r path want; do
    code=$(local_curl -o /dev/null -w '%{http_code}' "https://$DOMAIN$path")
    echo "$path $code (want $want)"
    [[ $code == "$want" ]] || FAIL=1
done <<'EOF'
/ 200
/login 200
/pricing 200
/faq 200
/dashboard 302
/install 404
EOF
local_curl "https://$DOMAIN/" | grep -q 'Gingr' || { echo "Homepage does not mention Gingr"; FAIL=1; }
[[ $FAIL == 0 ]] || { echo "Health check failed"; exit 1; }

echo
echo "🚀 Application deployed! $DOMAIN $BRANCH @ $COMMIT"
echo "Deploy Completed $(date)"
