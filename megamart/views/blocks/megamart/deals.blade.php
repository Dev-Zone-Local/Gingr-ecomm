@php
    $mmLimit = max(1, (int) ($number_of_products ?? 5));
    $mmCategory = trim($category ?? '');
    if ($mmCategory !== '') {
        $mmProducts = store_products($uid)->filter(function ($p) use ($mmCategory) {
            return is_array($p->categories) && in_array($mmCategory, $p->categories);
        })->take($mmLimit);
        $mmViewAll = route('user-profile-products', ['profile' => $user->username, 'category' => $mmCategory]);
    } else {
        $mmProducts = store_products($uid, $mmLimit);
        $mmViewAll = route('user-profile-products', ['profile' => $user->username]);
    }
@endphp

@if (count($mmProducts))
<section class="mm-container mm-section">
    @include('blocks.megamart._heading', ['prefix' => $title_prefix ?? '', 'highlight' => $title_highlight ?? '', 'link' => $mmViewAll])
    <div class="mm-grid mm-grid--5">
        @foreach ($mmProducts as $product)
            @include('include.mm-product-card', ['product' => $product])
        @endforeach
    </div>
</section>
@endif
