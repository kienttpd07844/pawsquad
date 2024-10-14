@forelse ($carts as $cart)
    <tr>
        <td data-label="Xoá">
            <div class="delete-icon" onclick="handleCartItem('delete', {{ $cart->id }})">
                <i class="bi bi-x"></i>
            </div>
        </td>
        <td data-label="Hình">
            <img src="{{ getImage($cart->product_variation->product->image) }}"
                alt="{{ $cart->product_variation->product->name }}">
        </td>
        <td data-label="Tên" class="">
            <a href="{{ route('product.detail', ['slug' => $cart->product_variation->product->slug]) }}">
                {{ $cart->product_variation->product->name }}
            </a>
            @if (generateVariationOptions($cart->product_variation->combinations))
                <hr class="w-100">
                @foreach (generateVariationOptions($cart->product_variation->combinations) as $variation)
                    <span class="fs-xs">
                        {{ $variation['name'] }}:
                        @foreach ($variation['values'] as $value)
                            {{ $value['name'] }}
                        @endforeach
                        @if (!$loop->last)
                            ,
                        @endif
                    </span>
                @endforeach
            @else
                <span class="fs-xs"></span>
            @endif
        </td>
        <td data-label="Giá">{{ format_cash($cart->product_variation->price) }}</td>
        <td data-label="Số lượng">
            <div class="product-qty d-inline-flex align-items-center">
                <button class="decrese" onclick="handleCartItem('decrease',{{ $cart->id }})">-</button>
                <input type="text" readonly="" value="{{ $cart->quantity }}" name="quantity">
                <button class="increase" onclick="handleCartItem('increase',{{ $cart->id }})">+</button>
            </div>
        </td>
        <td data-label="Tổng">{{ format_cash($cart->product_variation->price * $cart->quantity) }}</td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="py-4">Không có sản phẩm nào</td>
    </tr>
@endforelse
