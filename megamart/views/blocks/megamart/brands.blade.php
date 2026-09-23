@php
    $mmImg = function ($value, $fallback) {
        return (!empty($value) && preg_match('/\.[a-z0-9]{2,5}$/i', parse_url($value, PHP_URL_PATH) ?? '')) ? $value : $fallback;
    };
    $mmDefaults = [
        1 => ['logo' => 'logo-apple.png', 'image' => 'brand-iphone.png', 'style' => 'dark'],
        2 => ['logo' => 'logo-realme.png', 'image' => 'brand-realme.png', 'style' => 'yellow'],
        3 => ['logo' => 'logo-mi.png', 'image' => 'brand-xiaomi.png', 'style' => 'peach'],
    ];
    $mmCards = [];
    foreach ($mmDefaults as $n => $def) {
        $tag = ${'brand' . $n . '_tag'} ?? '';
        $offer = ${'brand' . $n . '_offer'} ?? '';
        if (empty(trim($tag)) && empty(trim($offer))) {
            continue;
        }
        $link = ${'brand' . $n . '_link'} ?? '';
        $mmCards[] = [
            'tag'   => $tag,
            'offer' => $offer,
            'link'  => !empty($link) ? $link : route('user-profile-products', ['profile' => $user->username]),
            'logo'  => $mmImg(${'brand' . $n . '_logo'} ?? '', themes('images/mm/' . $def['logo'])),
            'image' => $mmImg(${'brand' . $n . '_image'} ?? '', themes('images/mm/' . $def['image'])),
            'style' => $def['style'],
        ];
    }
@endphp

@if (count($mmCards))
<section class="mm-container mm-section">
    @include('blocks.megamart._heading', ['prefix' => $title_prefix ?? '', 'highlight' => $title_highlight ?? '', 'link' => route('user-profile-products', ['profile' => $user->username])])
    <div class="mm-brands">
        @foreach ($mmCards as $card)
        <a class="mm-brand mm-brand--{{ $card['style'] }}" href="{{ $card['link'] }}">
            <div class="mm-brand__text">
                @if (!empty($card['tag']))
                <span class="mm-brand__tag">{{ $card['tag'] }}</span>
                @endif
                <img class="mm-brand__logo" src="{{ $card['logo'] }}" alt="{{ $card['tag'] }}">
                <span class="mm-brand__offer">{{ $card['offer'] }}</span>
            </div>
            <img class="mm-brand__image" src="{{ $card['image'] }}" alt="" loading="lazy">
        </a>
        @endforeach
    </div>
</section>
@endif
