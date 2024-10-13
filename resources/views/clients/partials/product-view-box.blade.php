@if ($product)
    <div class="shop-details-page ">
        <div class="row g-lg-4 gy-5 mb-120">
            <div class="col-lg-7">
                <div class="swiper mySwiper mySwiperBox">
                    <div class="swiper-wrapper main-slider">
                        @foreach ($mergedList as $images)
                            @foreach ($images as $image)
                                <div class="swiper-slide">
                                    <a data-fancybox="gallery" data-thumb="{{ getImage($image) }}"
                                        href="{{ getImage($image) }}">
                                        <img class="img-fluid" src="{{ getImage($image) }}" alt="">
                                    </a>
                                </div>
                            @endforeach
                        @endforeach
                    </div>

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>

                    <!-- Thumbnails (Navigation) -->
                    <div class="swiper-thumbnails swiper-thumbnails-box">
                        <div class="swiper-wrapper">
                            @foreach ($mergedList as $images)
                                @foreach ($images as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ getImage($image) }}" alt="">
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-5">
                <div class="shop-details-content">
                    <h3>{{ $product->name }}</h3>
                    <ul class="shopuct-review2 d-flex flex-row align-items-center mb-25">
                        <li><i class="bi bi-star-fill"></i></li>
                        <li><i class="bi bi-star-fill"></i></li>
                        <li><i class="bi bi-star-fill"></i></li>
                        <li><i class="bi bi-star-fill"></i></li>
                        <li><i class="bi bi-star-fill"></i></li>
                        <li><a href="#" class="review-no">(1 đánh giá)</a></li>

                        <li><a href="#" class="review-no"><i class="bi bi-eye"></i> {{ $product->views }}</a></li>
                    </ul>
                    <div class="price-tag">
                        <h4>
                            @if ($product->min_price == $product->max_price)
                                {{ format_cash($product->min_price) }}
                            @else
                                {{ format_cash($product->min_price) . '-' . format_cash($product->max_price) }}
                            @endif <del>
                                @if ($product->old_price)
                                    {{ format_cash($product->old_price) }}
                                @endif
                            </del>
                        </h4>
                    </div>
                    <p>{{ limitText($product->short_description, 150) }} </p>
                    <form action="" class="add-to-cart-form">
                        @php
                            $isVariantProduct = 0;
                            $stock = 0;
                            if ($product->variations()->count() > 1) {
                                $isVariantProduct = 1;
                            } else {
                                $stock = $product->variations[0]->product_variation_stock
                                    ? $product->variations[0]->product_variation_stock->stock_qty
                                    : 0;
                            }
                        @endphp
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="product_variation_id"
                            @if (!$isVariantProduct) value="{{ $product->variations[0]->id }}" @endif>
                        <!-- Biến thể -->
                        @include('clients.partials.variations', compact('product'))
                        <!-- Biến thể -->
                        <div class="shop-quantity d-flex align-items-center justify-content-start mb-20">
                            <div class="quantity d-flex align-items-center">
                                <div class="quantity-nav nice-number d-flex align-items-center">
                                    <input type="number" readonly value="1" min="1"
                                        @if (!$isVariantProduct) max="{{ $stock }}" @endif>
                                </div>
                            </div>
                        </div>
                        <div class="buy-now-btn">
                            <button class="w-100 add-to-cart-btn" style="background:linear-gradient(90deg, #F86CA7 0%, #FF7F18 100%)"
                                @if (!$isVariantProduct && $stock < 1) disabled @endif>
                                <span class="me-2">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </span>
                                <span class="add-to-cart-text">
                                    @if (!$isVariantProduct && $stock < 1)
                                        Hết hàng
                                    @else
                                        Thêm vào giỏ hàng
                                    @endif
                                </span>
                            </button>
                        </div>
                        <div class="compare-wishlist-area">
                            <ul>
                                <li><a href="#"><span><img
                                                src="{{ asset('assets/clients/images/icon/Icon-favorites2.svg') }}"
                                                alt></span>
                                        Thêm vào yêu thích</a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <p class="text-center">Sản phẩm không tồn tại</p>
@endif
