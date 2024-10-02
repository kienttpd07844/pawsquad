@extends('layouts.clients')
@section('css')
    <style>
        .single-review {
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .review-image img {
            max-width: 100%;
            height: auto;
        }

        .review-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .fancybox-button--play,
        .fancybox-button--thumbs,
        .fancybox-button--zoom {
            display: none !important;
        }

        .swiper-container {
            width: 100%;
            height: auto;
            position: relative;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #fff;
            width: 40px;
            height: 40px;
            background-color: #F46F30;
            border-radius: 50%;
            top: 43%;
            position: absolute;
            transform: translateY(-50%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10;
        }

        .swiper-button-prev:after,
        .swiper-button-next:after {
            font-size: 18px !important;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background-color: #F46F30;
        }

        .swiper-button-next {
            right: 10px;
        }

        .swiper-button-prev {
            left: 10px;
        }


        .thumbnail-slider .swiper-slide {
            cursor: pointer;
            opacity: 0.4;
        }

        .thumbnail-slider .swiper-slide-thumb-active {
            opacity: 1;
        }

        .main-slider .swiper-slide {
            height: 370px;
            overflow: hidden;
        }

        .main-slider .swiper-slide a {
            display: block;
            height: 100%;
            overflow: hidden;
            position: relative;
        }

        .main-slider .swiper-slide a img {
            width: 100%;
            height: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .main-slider .swiper-slide a:hover img {
            transform: scale(1.05);
        }

        .main-slider .swiper-slide img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .swiper-slide {
            margin-bottom: 10px;
            padding: 5px;
            background: #E1E4E5 !important;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
        }

        .swiper-slide img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .swiper-thumbnails .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-thumbnails .swiper-slide img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .swiper-slide-thumb-active {
            border: 2px solid #F46F30;
        }

        @media (max-width: 768px) {
            .swiper-container {
                width: 100%;
                height: auto;
            }

            .swiper-slide {
                margin-bottom: 8px;
                padding: 5px;
                background: #E1E4E5 !important;
            }

            .main-slider .swiper-slide {
                height: 250px;
            }

            .thumbnail-slider .swiper-slide {
                width: 80px;
                opacity: 0.6;
            }

            .thumbnail-slider .swiper-slide-thumb-active {
                opacity: 1;
            }

            .swiper-thumbnails .swiper-slide {
                margin-right: 8px;
            }

            .swiper-thumbnails .swiper-slide img {
                max-width: 60px;
                max-height: 60px;
                object-fit: contain;
                /* Đảm bảo thumbnail không bị cắt */
            }
        }

        @media (max-width: 576px) {
            .swiper-slide {
                margin-bottom: 5px;
                padding: 3px;
            }

            .main-slider .swiper-slide {
                height: 250px;
                /* Chiều cao cho ảnh chính trên thiết bị nhỏ */
            }

            .thumbnail-slider .swiper-slide {
                width: 60px;
            }

            .swiper-thumbnails .swiper-slide img {
                max-width: 80px;
                max-height: 80px;
                object-fit: contain;
                /* Đảm bảo thumbnail không bị cắt */
            }
        }
    </style>
@endsection
@section('content')
    @include('clients.partials.breadcrum', [
        'breadcrumbs' => [
            ['name' => 'Sản phẩm', 'url' => route('product')],
            ['name' => 'Sản phẩm A', 'url' => '#'],
        ],
        'title' => 'Sản phẩm A',
    ])

    <div class="shop-details-page pt-120 mb-120">
        <div class="container">
            <div class="row g-lg-4 gy-5 mb-120">
                <div class="col-lg-7">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper main-slider">
                            <div class="swiper-slide">
                                <a data-fancybox="gallery"
                                    data-thumb="{{ asset('assets/clients/images/bg/shop-big-01.png') }}"
                                    href="{{ asset('assets/clients/images/bg/shop-big-01.png') }}">
                                    <img class="img-fluid" src="{{ asset('assets/clients/images/bg/shop-big-01.png') }}"
                                        alt>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a data-fancybox="gallery"
                                    data-thumb="{{ asset('assets/clients/images/bg/shop-big-02.png') }}"
                                    href="{{ asset('assets/clients/images/bg/shop-big-02.png') }}">
                                    <img class="img-fluid" src="{{ asset('assets/clients/images/bg/shop-big-02.png') }}"
                                        alt>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a data-fancybox="gallery"
                                    data-thumb="{{ asset('assets/clients/images/bg/shop-big-03.png') }}"
                                    href="{{ asset('assets/clients/images/bg/shop-big-03.png') }}">
                                    <img class="img-fluid" src="{{ asset('assets/clients/images/bg/shop-big-03.png') }}"
                                        alt>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a data-fancybox="gallery"
                                    data-thumb="{{ asset('assets/clients/images/bg/shop-big-04.png') }}"
                                    href="{{ asset('assets/clients/images/bg/shop-big-04.png') }}">
                                    <img class="img-fluid" src="{{ asset('assets/clients/images/bg/shop-big-04.png') }}"
                                        alt>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a data-fancybox="gallery"
                                    data-thumb="{{ asset('assets/clients/images/bg/shop-big-05.png') }}"
                                    href="{{ asset('assets/clients/images/bg/shop-big-05.png') }}">
                                    <img class="img-fluid" src="{{ asset('assets/clients/images/bg/shop-big-05.png') }}"
                                        alt>
                                </a>
                            </div>
                        </div>




                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>

                        <!-- Thumbnails (Navigation) -->
                        <div class="swiper-thumbnails">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="{{ asset('assets/clients/images/bg/shop-sm-01.png') }}" alt>
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('assets/clients/images/bg/shop-sm-02.png') }}" alt>
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('assets/clients/images/bg/shop-sm-03.png') }}" alt>
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('assets/clients/images/bg/shop-sm-04.png') }}" alt>
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('assets/clients/images/bg/shop-sm-05.png') }}" alt>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="shop-details-content">
                        <h3>Thức ăn cho chó lớn dạng hạt khô Pedigree - Vị bò và rau củ 1.5kg</h3>
                        <ul class="shopuct-review2 d-flex flex-row align-items-center mb-25">
                            <li><i class="bi bi-star-fill"></i></li>
                            <li><i class="bi bi-star-fill"></i></li>
                            <li><i class="bi bi-star-fill"></i></li>
                            <li><i class="bi bi-star-fill"></i></li>
                            <li><i class="bi bi-star-fill"></i></li>
                            <li><a href="#" class="review-no">(1 đánh giá)</a></li>
                        </ul>
                        <div class="price-tag">
                            <h4>150.000đ <del>200.000đ</del></h4>
                        </div>
                        <p>Thức ăn cho chó lớn Pedigree hương bò và rau củ túi 1.5kg là sản phẩm thức ăn dạng hạt dành cho
                            chó. Thức ăn cho chó Pedigree giúp bổ sung khoáng chất và vitamin, ngoài ra còn có chất sắt và
                            kẽm đã được chứng mình là sẽ làm bộ lông của cún cưng được mềm mượt hơn.</p>
                        <div class="shop-quantity d-flex align-items-center justify-content-start mb-20">
                            <div class="quantity d-flex align-items-center">
                                <div class="quantity-nav nice-number d-flex align-items-center">
                                    <input type="number" value="1" min="1">
                                </div>
                            </div>
                        </div>
                        <div class="buy-now-btn">
                            <a href="cart.html">Thêm vào giỏ hàng</a>
                        </div>
                        <div class="compare-wishlist-area">
                            <ul>
                                <li><a href="#"><span><img
                                                src="{{ asset('assets/clients/images/icon/Icon-favorites2.svg') }}"
                                                alt></span>
                                        Thêm vào yêu thích</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-120">
                <div class="col-lg-12">
                    <div class="nav nav2 nav  nav-pills" id="v-pills-tab2" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                            aria-selected="false">Mô tả</button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                            aria-selected="true">Thông tin thêm</button>
                        <button class="nav-link" id="v-pills-common-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-common" type="button" role="tab" aria-controls="v-pills-common"
                            aria-selected="true">Đánh giá</button>
                    </div>
                    <div class="tab-content tab-content2" id="v-pills-tabContent2">
                        <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="description">
                                <p class="para-2 mb-3">
                                    Tại Pedigree ®, mọi sản phẩm đều được tạo nên bằng tình yêu với những chú cún cưng. Đó
                                    cũng là lý do tại sao các công thức của Pedigree ® được dựa trên nghiên cứu từ Trung tâm
                                    Dinh Dưỡng Vật Nuôi WALTHAM™ giúp cung cấp cho cún dưỡng chất đầy đủ nhất.
                                    <br>
                                    1) Chất chống oxy hóa với Dinh Dưỡng Toàn Diện & Cân Bằng, hỗ trợ hệ miễn dịch khỏe mạnh
                                    <br>
                                    2) 38 Dưỡng Chất Thiết Yếu cho Hệ thống Cơ thể hoạt động hiệu quả
                                    <br>
                                    3) Canxi & Phốt pho cho xương chắc khỏe
                                    <br>
                                    4) Chất xơ tự nhiên hỗ trợ hoạt động hệ tiêu hóa
                                    <br>
                                    5) Omega 6 & Kẽm đã được khoa học chứng minh giúp lớp lông bóng mượt trong 6 tuần!
                                    <br>
                                    6) Protein cao cấp cho cơ bắp rắn chắc
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">
                            <div class="addithonal-information">
                                <table class="table total-table2">
                                    <tbody>
                                        <tr>
                                            <td>Chất đạm</td>
                                            <td>25%</td>
                                        </tr>
                                        <tr>
                                            <td>Chất béo</td>
                                            <td>0.5%.</td>
                                        </tr>
                                        <tr>
                                            <td>Carbohydrates</td>
                                            <td>10%.</td>
                                        </tr>
                                        <tr>
                                            <td>Khoáng chất</td>
                                            <td>20%.</td>
                                        </tr>
                                        <tr>
                                            <td>Vitamins</td>
                                            <td>15.5%.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-common" role="tabpanel"
                            aria-labelledby="v-pills-common-tab">
                            <div class="reviews-area">
                                <div class="row g-lg-4 gy-5">
                                    <div class="col-lg-8">
                                        <div class="number-of-review">
                                            <h3>Đánh giá (02) :</h3>
                                        </div>
                                        <div class="review-list-area">
                                            <ul class="review-list">
                                                <li>
                                                    <div
                                                        class="single-review d-flex justify-content-between flex-md-nowrap flex-wrap">
                                                        <div class="review-image">
                                                            <img src="{{ asset('assets/clients/images/bg/review-img-1.png') }}"
                                                                alt="image">
                                                        </div>
                                                        <div class="review-content">
                                                            <div class="c-header d-flex align-items-center">
                                                                <div class="review-meta">
                                                                    <h5 class="mb-0"><a href="#">Trung Kiên ,</a>
                                                                    </h5>
                                                                    <div class="c-date">28/09/2024 15:23</div>
                                                                </div>
                                                                <div class="replay-btn">
                                                                    <a href="#"><i class="bi bi-reply"></i>Trả
                                                                        lời</a>
                                                                </div>
                                                            </div>
                                                            <ul class="product-review">
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                            </ul>
                                                            <div class="c-body">
                                                                <p>Sản phẩm chất lượng</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="review-form">
                                            <div class="number-of-review">
                                                <h3>Để lại đánh giá</h3>
                                            </div>
                                            <form>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-inner mb-10">
                                                            <textarea placeholder="Nội dung đánh giá..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-inner2 mb-30">
                                                            <div class="review-rate-area">
                                                                <p>Số sao</p>
                                                                <div class="rate">
                                                                    <input type="radio" id="star5" name="rate"
                                                                        value="5">
                                                                    <label for="star5" title="text">5 sao</label>
                                                                    <input type="radio" id="star4" name="rate"
                                                                        value="4">
                                                                    <label for="star4" title="text">4 sao</label>
                                                                    <input type="radio" id="star3" name="rate"
                                                                        value="3">
                                                                    <label for="star3" title="text">3 sao</label>
                                                                    <input type="radio" id="star2" name="rate"
                                                                        value="2">
                                                                    <label for="star2" title="text">2 sao</label>
                                                                    <input type="radio" id="star1" name="rate"
                                                                        value="1">
                                                                    <label for="star1" title="text">1 sao</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-inner two">
                                                            <button class="primary-btn3 btn-lg" type="submit">Gửi đánh
                                                                giá</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div
                    class="col-lg-12 d-flex flex-wrap align-items-center justify-content-md-between justify-content-start gap-2 mb-60">
                    <div class="inner-section-title">
                        <h2>Sản phẩm liên quan</h2>
                    </div>
                    <div class="swiper-btn-wrap d-flex align-items-center">
                        <div class="slider-btn prev-btn-12">
                            <i class="bi bi-arrow-left"></i>
                        </div>
                        <div class="slider-btn next-btn-12">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="swiper essential-items-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide d-flex">
                            <div class="collection-card h-100">
                                <div class="offer-card">
                                    <span>Nổi bật</span>
                                </div>
                                <div class="collection-img">
                                    <img class="img-gluid"
                                        src="{{ asset('assets/clients/images/bg/category/h3-collection-01.png') }}" alt>
                                    <div class="view-dt-btn">
                                        <div class="plus-icon">
                                            <i class="bi bi-plus"></i>
                                        </div>
                                        <a href="shop-details.html">Xem chi tiết</a>
                                    </div>
                                    <ul class="cart-icon-list">
                                        <li><a href="cart.html"><img
                                                    src="{{ asset('assets/clients/images/icon/Icon-cart3.svg') }}"
                                                    alt></a></li>
                                        <li><a href="#"><img
                                                    src="{{ asset('assets/clients/images/icon/Icon-favorites3.svg') }}"
                                                    alt></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="collection-content text-center">
                                    <h4 class="title-limit"><a href="shop-details.html">Thức ăn cho mèo Brit</a></h4>
                                    <div class="price">
                                        <h6>100.000đ</h6>
                                        <del>150.000đ</del>
                                    </div>
                                    <div class="review">
                                        <ul>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                        </ul>
                                        <span>(50)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide d-flex">
                            <div class="collection-card h-100">
                                <div class="collection-img">
                                    <img class="img-gluid"
                                        src="{{ asset('assets/clients/images/bg/category/h3-collection-02.png') }}" alt>
                                    <div class="view-dt-btn">
                                        <div class="plus-icon">
                                            <i class="bi bi-plus"></i>
                                        </div>
                                        <a href="shop-details.html">Xem chi tiết</a>
                                    </div>
                                    <ul class="cart-icon-list">
                                        <li><a href="cart.html"><img
                                                    src="{{ asset('assets/clients/images/icon/Icon-cart3.svg') }}"
                                                    alt></a></li>
                                        <li><a href="#"><img
                                                    src="{{ asset('assets/clients/images/icon/Icon-favorites3.svg') }}"
                                                    alt></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="collection-content text-center">
                                    <h4 class="title-limit"><a href="shop-details.html">Thức ăn cho mèo Friskies asc</a>
                                    </h4>
                                    <div class="price">
                                        <h6>120.000đ</h6>
                                        <del>150.000đ</del>
                                    </div>
                                    <div class="review">
                                        <ul>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                        </ul>
                                        <span>(50)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide d-flex">
                            <div class="collection-card h-100">
                                <div class="offer-card sale">
                                    <span>Mua nhiều</span>
                                </div>
                                <div class="collection-img">
                                    <img class="img-gluid"
                                        src="{{ asset('assets/clients/images/bg/category/h3-collection-03.png') }}" alt>
                                    <div class="view-dt-btn">
                                        <div class="plus-icon">
                                            <i class="bi bi-plus"></i>
                                        </div>
                                        <a href="shop-details.html">Xem chi tiết</a>
                                    </div>
                                    <ul class="cart-icon-list">
                                        <li><a href="cart.html"><img
                                                    src="{{ asset('assets/clients/images/icon/Icon-cart3.svg') }}"
                                                    alt></a></li>
                                        <li><a href="#"><img
                                                    src="{{ asset('assets/clients/images/icon/Icon-favorites3.svg') }}"
                                                    alt></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="collection-content text-center">
                                    <h4 class="title-limit"><a href="shop-details.html">Nhà bông dành cho mèo</a></h4>
                                    <div class="price">
                                        <h6>250.000đ</h6>
                                        <del>299.000đ</del>
                                    </div>
                                    <div class="review">
                                        <ul>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                        </ul>
                                        <span>(20)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide d-flex">
                            <div class="collection-card h-100">
                                <div class="offer-card sold-out">
                                    <span>Hết hàng</span>
                                </div>
                                <div class="collection-img">
                                    <img class="img-gluid"
                                        src="{{ asset('assets/clients/images/bg/category/h3-collection-04.png') }}" alt>
                                    <div class="view-dt-btn">
                                        <div class="plus-icon">
                                            <i class="bi bi-plus"></i>
                                        </div>
                                        <a href="shop-details.html">Xem chi tiết</a>
                                    </div>
                                    <ul class="cart-icon-list">
                                        <li><a href="cart.html"><img
                                                    src="{{ asset('assets/clients/images/icon/Icon-cart3.svg') }}"
                                                    alt></a></li>
                                        <li><a href="#"><img
                                                    src="{{ asset('assets/clients/images/icon/Icon-favorites3.svg') }}"
                                                    alt></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="collection-content text-center">
                                    <h4 class="title-limit"><a href="shop-details.html">Đồ hộp Beyona dành cho chó</a>
                                    </h4>
                                    <div class="price">
                                        <h6>50.000đ</h6>
                                    </div>
                                    <div class="review">
                                        <ul>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                        </ul>
                                        <span>(100)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide d-flex">
                            <div class="collection-card h-100">
                                <div class="offer-card sold-out">
                                    <span>Hết hàng</span>
                                </div>
                                <div class="collection-img">
                                    <img class="img-gluid"
                                        src="{{ asset('assets/clients/images/bg/category/h3-collection-04.png') }}" alt>
                                    <div class="view-dt-btn">
                                        <div class="plus-icon">
                                            <i class="bi bi-plus"></i>
                                        </div>
                                        <a href="shop-details.html">Xem chi tiết</a>
                                    </div>
                                    <ul class="cart-icon-list">
                                        <li><a href="cart.html"><img
                                                    src="{{ asset('assets/clients/images/icon/Icon-cart3.svg') }}"
                                                    alt></a></li>
                                        <li><a href="#"><img
                                                    src="{{ asset('assets/clients/images/icon/Icon-favorites3.svg') }}"
                                                    alt></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="collection-content text-center">
                                    <h4 class="title-limit"><a href="shop-details.html">Đồ hộp ASC Beyona dành cho chó</a>
                                    </h4>
                                    <div class="price">
                                        <h6>60.000đ</h6>
                                    </div>
                                    <div class="review">
                                        <ul>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                        </ul>
                                        <span>(200)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <script>
        $(document).ready(function() {
            // Khởi tạo Swiper trước
            var swiperThumbnails = new Swiper('.swiper-thumbnails', {
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                breakpoints: {
                    320: {
                        slidesPerView: 3
                    },
                    768: {
                        slidesPerView: 4
                    },
                    992: {
                        slidesPerView: 4
                    }
                }
            });

            var swiperMain = new Swiper('.mySwiper', {
                spaceBetween: 10,
                slidesPerView: 1,
                loop: true,
                thumbs: {
                    swiper: swiperThumbnails
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1
                    },
                    768: {
                        slidesPerView: 1
                    },
                    992: {
                        slidesPerView: 1
                    }
                }
            });

            // Khởi tạo Fancybox
            Fancybox.bind("[data-fancybox='gallery']", {
                Carousel: {
                    infinite: false, // Tắt chế độ lặp
                    autoplay: false, // Tắt autoplay
                    transition: "slide" // Kiểu chuyển tiếp
                },
                Thumbs: {
                    autoStart: true, // Bật thumbnail
                    type: "classic" // Kiểu thumbnail
                },
                Image: {
                    zoom: false // Tắt tính năng zoom
                },
                loop: false // Tắt chế độ lặp lại
            });
        });
    </script>
@endsection
