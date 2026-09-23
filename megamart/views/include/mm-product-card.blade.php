@php
    $mmPrice = (float) $product->price;
    $mmSale = ($product->salePrice !== null && $product->salePrice !== '') ? (float) $product->salePrice : null;
    $mmHasDeal = $mmSale !== null && $mmPrice > 0 && $mmSale < $mmPrice;
    $mmCurrent = $mmHasDeal ? $mmSale : ($mmSale ?? $mmPrice);
    $mmFmt = function ($v) { return fmod((float) $v, 1) == 0 ? nf($v, 0) : nf($v); };
    $mmSymbol = Currency::symbol($user->gateway['currency'] ?? '');
    $mmUrl = Linker::url(route('user-profile-single-product', ['profile' => $user->username, 'id' => $product->id]), ['ref' => $user->username]);
@endphp
<div class="mm-product">
    @if ($mmHasDeal)
    <span class="mm-product__badge">{{ round(($mmPrice - $mmSale) / $mmPrice * 100) }}%<br>{{ __('OFF') }}</span>
    @endif
    <a class="mm-product__media" href="{{ $mmUrl }}">
        <img src="{{ getfirstproductimg($product->id) }}" alt="{{ $product->title }}" loading="lazy">
    </a>
    <div class="mm-product__body">
        <a href="{{ $mmUrl }}" class="mm-product__title">{{ $product->title }}</a>
        <div class="mm-product__price">
            <strong>{!! $mmSymbol !!}{{ $mmFmt($mmCurrent) }}</strong>
            @if ($mmHasDeal)
            <del>{!! $mmSymbol !!}{{ $mmFmt($mmPrice) }}</del>
            @endif
        </div>
        <div class="mm-product__foot">
            @if ($mmHasDeal)
            <span class="mm-product__save">{{ __('Save') }} - {!! $mmSymbol !!}{{ $mmFmt($mmPrice - $mmSale) }}</span>
            @else
            <span></span>
            @endif
            <form class="mm-product__cart" id="add-to-cart" data-qty="1" data-route="{{ route('add-to-cart', ['user_id' => $user->id, 'product' => $product->id]) }}" data-id="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button class="ajax_add_to_cart" type="submit" aria-label="{{ __('Add to cart') }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/><path d="M2 3h3l2.7 12.2a2 2 0 0 0 2 1.6h8.1a2 2 0 0 0 2-1.5L22 7H6.2"/></svg>
                </button>
            </form>
        </div>
    </div>
</div>
