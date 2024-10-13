@if (count(generateVariationOptions($product->without_variation_combinations)) > 0)
    @foreach (generateVariationOptions($product->without_variation_combinations) as $variation)
        <input type="hidden" name="variation_id[]" value="{{ $variation['id'] }}" class="variation-for-cart">
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <div class="d-flex align-items-center justify-content-between">
            <div class="fs-sm">
                <span class="heading-font fw-medium me-1">{{ $variation['name'] }}
            </div>
        </div>

        <ul
            class="product-radio-btn mt-1 mb-3 d-flex align-items-center gap-2 p-0 @if ($loop->last) mb-6 @endif">
            @foreach ($variation['values'] as $value)
                <li>
                    <input type="radio" name="variation_value_for_variation_{{ $variation['id'] }}"
                        value="{{ $value['id'] }}" id="val-{{ $value['id'] }}">
                    <label for="val-{{ $value['id'] }}">{{ $value['name'] }}</label>
                </li>
            @endforeach
        </ul>
    @endforeach
@endif
