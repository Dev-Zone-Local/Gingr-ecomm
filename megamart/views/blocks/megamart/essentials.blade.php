@php
    $mmLimit = max(1, (int) ($number_of_categories ?? 6));
    $mmCats = store_categories($uid, $mmLimit);
    $mmItems = [];
    foreach ($mmCats as $cat) {
        $mmItems[] = [
            'title' => $cat->title,
            'image' => getcategoryImage($cat->id),
            'url'   => route('user-profile-products', ['profile' => $user->username, 'category' => $cat->slug]),
        ];
    }
    // Store has no categories yet: show the design's sample set so the page is not empty.
    if (!count($mmItems)) {
        foreach (['daily-essentials' => 'Daily Essentials', 'vegetables' => 'Vegetables', 'fruits' => 'Fruits', 'strawberry' => 'Strawberry', 'mango' => 'Mango', 'cherry' => 'Cherry'] as $key => $label) {
            $mmItems[] = [
                'title' => __($label),
                'image' => themes('images/mm/ess-' . $key . '.png'),
                'url'   => route('user-profile-products', ['profile' => $user->username]),
            ];
        }
    }
@endphp

<section class="mm-container mm-section">
    @include('blocks.megamart._heading', ['prefix' => $title_prefix ?? '', 'highlight' => $title_highlight ?? '', 'link' => route('user-profile-categories', ['profile' => $user->username])])
    <div class="mm-grid mm-grid--6">
        @foreach ($mmItems as $item)
        <a class="mm-tile" href="{{ $item['url'] }}">
            <span class="mm-tile__img"><img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" loading="lazy"></span>
            <span class="mm-tile__name">{{ $item['title'] }}</span>
            @if (!empty($offer_text))
            <span class="mm-tile__offer">{{ $offer_text }}</span>
            @endif
        </a>
        @endforeach
    </div>
</section>
