{{-- Section heading: grey prefix + blue highlight, underline, "View All" link --}}
<div class="mm-heading">
    <h2 class="mm-heading__title">
        {{ $prefix ?? '' }} <span>{{ $highlight ?? '' }}</span>
    </h2>
    @if (!empty($link))
    <a class="mm-heading__link" href="{{ $link }}">
        {{ __('View All') }}
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg>
    </a>
    @endif
</div>
