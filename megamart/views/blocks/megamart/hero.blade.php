@php
    $mmImg = function ($value, $fallback) {
        return (!empty($value) && preg_match('/\.[a-z0-9]{2,5}$/i', parse_url($value, PHP_URL_PATH) ?? '')) ? $value : $fallback;
    };
    $slides = [];
    foreach ([1, 2, 3] as $n) {
        $title = ${'slide' . $n . '_title'} ?? '';
        if (empty(trim($title))) {
            continue;
        }
        $slides[] = [
            'overline' => ${'slide' . $n . '_overline'} ?? '',
            'title'    => $title,
            'subtitle' => ${'slide' . $n . '_subtitle'} ?? '',
            'link'     => ${'slide' . $n . '_link'} ?? '',
            'image'    => $mmImg(${'slide' . $n . '_image'} ?? '', themes('images/mm/hero-watch.png')),
        ];
    }
@endphp

@if (count($slides))
<section class="mm-container mm-hero-wrap">
    <div class="mm-hero {{ count($slides) > 1 ? 'js-mm-hero' : '' }}">
        @foreach ($slides as $slide)
        <div class="mm-hero__slide">
            <div class="mm-hero__inner">
                <div class="mm-hero__text">
                    @if (!empty($slide['overline']))
                    <p class="mm-hero__overline">{{ $slide['overline'] }}</p>
                    @endif
                    <h1 class="mm-hero__title">{{ $slide['title'] }}</h1>
                    @if (!empty($slide['subtitle']))
                    <p class="mm-hero__subtitle">{{ $slide['subtitle'] }}</p>
                    @endif
                    @if (!empty($slide['link']))
                    <a class="mm-btn mm-btn--light mt-4" href="{{ $slide['link'] }}">{{ __('Shop Now') }}</a>
                    @endif
                </div>
                <div class="mm-hero__media">
                    <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}">
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if (count($slides) > 1)
    <button type="button" class="mm-hero__arrow mm-hero__arrow--prev" aria-label="{{ __('Previous') }}">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 6l-6 6 6 6"/></svg>
    </button>
    <button type="button" class="mm-hero__arrow mm-hero__arrow--next" aria-label="{{ __('Next') }}">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg>
    </button>
    @endif
</section>
@endif
