@php
    $mmLimit = max(1, (int) ($number_of_categories ?? 7));
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
        foreach (['mobile' => 'Mobile', 'cosmetics' => 'Cosmetics', 'electronics' => 'Electronics', 'furniture' => 'Furniture', 'watches' => 'Watches', 'decor' => 'Decor', 'accessories' => 'Accessories'] as $key => $label) {
            $mmItems[] = [
                'title' => __($label),
                'image' => themes('images/mm/cat-' . $key . '.png'),
                'url'   => route('user-profile-products', ['profile' => $user->username]),
            ];
        }
    }
@endphp

<section class="mm-container mm-section">
    @include('blocks.megamart._heading', ['prefix' => $title_prefix ?? '', 'highlight' => $title_highlight ?? '', 'link' => route('user-profile-categories', ['profile' => $user->username])])
    <div class="mm-cats">
        @foreach ($mmItems as $item)
        <a class="mm-cats__item" href="{{ $item['url'] }}">
            <span class="mm-cats__img"><img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" loading="lazy"></span>
            <span class="mm-cats__name">{{ $item['title'] }}</span>
        </a>
        @endforeach
    </div>
</section>
