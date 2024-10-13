@forelse ($carts as $cart)

    <li class="d-flex align-items-center pb-3 @if (!$loop->first) pt-3 @endif" style="display: flex !important;">
        <div class="thumb-wrapper">
            <a href="{{ route('product.detail', ['slug' => $cart->product_variation->product->slug ]) }}" style="padding:0!important;
                background:none!important;">
                <img
                    src="{{ getImage($cart->product_variation->product->image) }}" alt="{{ $cart->product_variation->product->name }}"
                    class="img-fluid" style="width: 45px;height: 45px;"></a>
        </div>
        <div class="items-content ms-3">
            <a class="cart-name" href="{{ route('product.detail', ['slug' => $cart->product_variation->product->slug ]) }}" style="padding:0!important;
                background:none!important;">
                <h5 class="mb-0">{{ $cart->product_variation->product->name }}</h5>
            </a>

            @foreach (generateVariationOptions($cart->product_variation->combinations) as $variation)
                <span class="fs-6 text-white">
                    @foreach ($variation['values'] as $value)
                        {{ $value['name'] }}
                    @endforeach
                    @if (!$loop->last)
                        ,
                    @endif
                </span>
            @endforeach

            <div class="products_meta mt-1 d-flex align-items-center">
                <div>
                    <span
                        class="price text-orange fw-semibold" >{{ format_cash($cart->product_variation->price) }}</span>
                    <span class="count fs-semibold">x {{ $cart->quantity }}</span>
                </div>
                <button class="remove_cart_btn ms-2 text-danger" onclick="handleCartItem('delete', {{ $cart->id }})">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    </li>
@empty
    <li>
        <img src="{{ asset('assets/clients/images/pet-cart.png') }}" alt=""
            class="img-fluid">
    </li>
@endforelse
