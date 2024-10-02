@extends('layouts.clients')
@section('content')
    <div class="hero3 mb-90">
        <div class="background-text">
            <h2 class="marquee_text"><img src="{{ asset('assets/clients/images/icon/marque-foot.svg') }}"
                    alt="image"><span>Nhận ngay mã giảm giá</span> lên tới 50%<img
                    src="{{ asset('assets/clients/images/icon/marque-foot.svg') }}" alt="image"><span>Nhận ngay mã giảm
                    giá</span> lên tới 50%</h2>
        </div>
        <div class="swiper hero3-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="hero-wrapper">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="banner-content">
                                        <h6>Thức ăn cho chó</h6>
                                        <h1>Giảm giá tất cả thức ăn cho chó lên tới 50%</h1>
                                        <div class="btn-group">
                                            <a class="primary-btn5 btn-md" href="shop.html">Cửa hàng</a>
                                            <a class="primary-btn6" href="shop-details.html">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-end">
                                    <div class="hero-img">
                                        <img class="img-fluid banner-imgas"
                                            src="{{ asset('assets/clients/images/bg/h3-banner-img.png') }}" alt>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="hero-wrapper">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="banner-content">
                                        <h6>Thức ăn cho chó</h6>
                                        <h1>Giảm giá tất cả thức ăn cho chó lên tới 50%</h1>
                                        <div class="btn-group">
                                            <a class="primary-btn5 btn-md" href="shop.html">Cửa hàng</a>
                                            <a class="primary-btn6" href="shop-details.html">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-end">
                                    <div class="hero-img">
                                        <img class="img-fluid banner-imgas"
                                            src="{{ asset('assets/clients/images/bg/h3-banner-img.png') }}" alt>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="hero-wrapper">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="banner-content">
                                        <h6>Thức ăn cho chó</h6>
                                        <h1>Giảm giá tất cả thức ăn cho chó lên tới 50%</h1>
                                        <div class="btn-group">
                                            <a class="primary-btn5 btn-md" href="shop.html">Cửa hàng</a>
                                            <a class="primary-btn6" href="shop-details.html">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-end">
                                    <div class="hero-img">
                                        <img class="img-fluid banner-imgas"
                                            src="{{ asset('assets/clients/images/bg/h3-banner-img.png') }}" alt>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-sidebar">
            <div class="slider-pagination-area">
                <div class="h3-hero-slider-pagination"></div>
            </div>
        </div>
    </div>


    <div class="home3-categoty-area pt-120 mb-120">
        <div class="container">
            <div class="row mb-60">
                <div class="col-lg-12 d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="section-title3">
                        <h2><img src="{{ asset('assets/clients/images/icon/h3-sec-tt-vect-left.svg') }}" alt><span>
                                Danh mục</span><img src="{{ asset('assets/clients/images/icon/h3-sec-tt-vect-right.svg') }}"
                                alt></h2>
                    </div>
                    <div class="slider-btn-wrap">
                        <div class="slider-btn prev-btn-11">
                            <i class="bi bi-arrow-left"></i>
                        </div>
                        <div class="slider-btn next-btn-11">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="swiper h3-category-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="category-card">
                                    <a href="shop.html" class="category-card-inner">
                                        <div class="category-card-front">
                                            <div class="category-icon">
                                                <img src="{{ asset('assets/clients/images/icon/dog.svg') }}" alt>
                                            </div>
                                            <div class="content">
                                                <h4>Thức ăn chó</h4>
                                            </div>
                                        </div>
                                        <div class="category-card-back">
                                            <img src="{{ asset('assets/clients/images/bg/h3-category-1.png') }}" alt>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="category-card">
                                    <a href="shop.html" class="category-card-inner">
                                        <div class="category-card-front">
                                            <div class="category-icon">
                                                <img src="{{ asset('assets/clients/images/icon/cat.svg') }}" alt>
                                            </div>
                                            <div class="content">
                                                <h4>Cát mèo</h4>
                                            </div>
                                        </div>
                                        <div class="category-card-back">
                                            <img src="{{ asset('assets/clients/images/bg/h3-category-2.png') }}" alt>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="category-card">
                                    <a href="shop.html" class="category-card-inner">
                                        <div class="category-card-front">
                                            <div class="category-icon">
                                                <img src="{{ asset('assets/clients/images/icon/cat.svg') }}" alt>
                                            </div>
                                            <div class="content">
                                                <h4>Pate mèo</h4>
                                            </div>
                                        </div>
                                        <div class="category-card-back">
                                            <img src="{{ asset('assets/clients/images/bg/h3-category-2.png') }}" alt>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="category-card">
                                    <a href="shop.html" class="category-card-inner">
                                        <div class="category-card-front">
                                            <div class="category-icon">
                                                <img src="{{ asset('assets/clients/images/icon/dog.svg') }}" alt>
                                            </div>
                                            <div class="content">
                                                <h4>Thức ăn chó</h4>
                                            </div>
                                        </div>
                                        <div class="category-card-back">
                                            <img src="{{ asset('assets/clients/images/bg/h3-category-1.png') }}" alt>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="category-card">
                                    <a href="shop.html" class="category-card-inner">
                                        <div class="category-card-front">
                                            <div class="category-icon">
                                                <img src="{{ asset('assets/clients/images/icon/dog.svg') }}" alt>
                                            </div>
                                            <div class="content">
                                                <h4>Phụ kiện chó</h4>
                                            </div>
                                        </div>
                                        <div class="category-card-back">
                                            <img src="{{ asset('assets/clients/images/bg/h3-category-1.png') }}" alt>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="category-card">
                                    <a href="shop.html" class="category-card-inner">
                                        <div class="category-card-front">
                                            <div class="category-icon">
                                                <img src="{{ asset('assets/clients/images/icon/cat.svg') }}" alt>
                                            </div>
                                            <div class="content">
                                                <h4>Phụ kiện mèo</h4>
                                            </div>
                                        </div>
                                        <div class="category-card-back">
                                            <img src="{{ asset('assets/clients/images/bg/h3-category-2.png') }}" alt>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="home3-collection-area mb-120">
        <div class="container">
            <div class="row mb-60">
                <div class="col-lg-12 d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="section-title3">
                        <h2><img src="{{ asset('assets/clients/images/icon/h3-sec-tt-vect-left.svg') }}" alt><span>Sản
                                phẩm</span><img src="{{ asset('assets/clients/images/icon/h3-sec-tt-vect-right.svg') }}"
                                alt></h2>
                    </div>
                    <div class="h3-view-btn d-md-flex d-none">
                        <a href="shop.html">Xem tất cả<img
                                src="{{ asset('assets/clients/images/icon/haf-button-2.svg') }}" alt></a>
                    </div>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
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
                                            src="{{ asset('assets/clients/images/icon/Icon-cart3.svg') }}" alt></a></li>
                                <li><a href="#"><img
                                            src="{{ asset('assets/clients/images/icon/Icon-favorites3.svg') }}" alt></a>
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
                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
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
                                            src="{{ asset('assets/clients/images/icon/Icon-cart3.svg') }}" alt></a></li>
                                <li><a href="#"><img
                                            src="{{ asset('assets/clients/images/icon/Icon-favorites3.svg') }}" alt></a>
                                </li>
                            </ul>
                        </div>
                        <div class="collection-content text-center">
                            <h4 class="title-limit"><a href="shop-details.html">Thức ăn cho mèo Friskies asc</a></h4>
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
                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
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
                                            src="{{ asset('assets/clients/images/icon/Icon-cart3.svg') }}" alt></a></li>
                                <li><a href="#"><img
                                            src="{{ asset('assets/clients/images/icon/Icon-favorites3.svg') }}" alt></a>
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
                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
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
                                            src="{{ asset('assets/clients/images/icon/Icon-cart3.svg') }}" alt></a></li>
                                <li><a href="#"><img
                                            src="{{ asset('assets/clients/images/icon/Icon-favorites3.svg') }}" alt></a>
                                </li>
                            </ul>
                        </div>
                        <div class="collection-content text-center">
                            <h4 class="title-limit"><a href="shop-details.html">Đồ hộp Beyona dành cho chó</a></h4>
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
                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
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
                                            src="{{ asset('assets/clients/images/icon/Icon-cart3.svg') }}" alt></a></li>
                                <li><a href="#"><img
                                            src="{{ asset('assets/clients/images/icon/Icon-favorites3.svg') }}" alt></a>
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
                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
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
                                            src="{{ asset('assets/clients/images/icon/Icon-cart3.svg') }}" alt></a></li>
                                <li><a href="#"><img
                                            src="{{ asset('assets/clients/images/icon/Icon-favorites3.svg') }}" alt></a>
                                </li>
                            </ul>
                        </div>
                        <div class="collection-content text-center">
                            <h4 class="title-limit"><a href="shop-details.html">Thức ăn cho mèo Friskies asc</a></h4>
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
                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
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
                                            src="{{ asset('assets/clients/images/icon/Icon-cart3.svg') }}" alt></a></li>
                                <li><a href="#"><img
                                            src="{{ asset('assets/clients/images/icon/Icon-favorites3.svg') }}" alt></a>
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
                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
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
                                            src="{{ asset('assets/clients/images/icon/Icon-cart3.svg') }}" alt></a></li>
                                <li><a href="#"><img
                                            src="{{ asset('assets/clients/images/icon/Icon-favorites3.svg') }}" alt></a>
                                </li>
                            </ul>
                        </div>
                        <div class="collection-content text-center">
                            <h4 class="title-limit"><a href="shop-details.html">Đồ hộp Beyona dành cho chó</a></h4>
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
            </div>
            <div class="row d-md-none d-block pt-30">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="h3-view-btn">
                        <a href="shop.html">Xem tất cả<img
                                src="{{ asset('assets/clients/images/icon/haf-button-2.svg') }}" alt></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="h3-offer-area mb-120">
        <div class="container-fluid p-0 overflow-hidden">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="offer-left">
                        <div class="offer-content">
                            <span>Giảm giá 50%</span>
                            <h2>Nguyên liệu cho chó dạng gói.</h2>
                            <a class="primary-btn6" href="shop.html">Xem ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="offer-right">
                        <div class="slider-btn-wrap">
                            <div class="slider-btn prev-btn-15 mb-40">
                                <i class="bi bi-arrow-up"></i>
                            </div>
                            <div class="slider-btn next-btn-15">
                                <i class="bi bi-arrow-down"></i>
                            </div>
                        </div>
                        <div class="countdown-timer">
                            <ul data-countdown="2024-12-23">
                                <li data-days="00">00</li>
                                <li data-hours="00">00</li>
                                <li data-minutes="00">00</li>
                                <li data-seconds="00">00</li>
                            </ul>
                        </div>
                        <div class="row position-relative">
                            <div class="swiper h3-offer-slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="offer-right-card">
                                            <div class="offer-img">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/clients/images/bg/h3-offer-right.png') }}" alt>
                                            </div>
                                            <div class="offer-content">
                                                <span>Giới hạn</span>
                                                <h2 class="title-limit-2">Thức ăn cho chó Whiskas Gà quay</h2>
                                                <div class="price">
                                                    <h6>120.000đ</h6>
                                                    <del>200.000đ</del>
                                                </div>
                                                <a class="primary-btn6" href="shop.html">Xem ngay</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="offer-right-card">
                                            <div class="offer-img">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/clients/images/bg/h3-offer-right.png') }}" alt>
                                            </div>
                                            <div class="offer-content">
                                                <span>Giới hạn</span>
                                                <h2 class="title-limit-2">Thức ăn cho chó Whiskas Gà quay</h2>
                                                <div class="price">
                                                    <h6>120.000đ</h6>
                                                    <del>200.000đ</del>
                                                </div>
                                                <a class="primary-btn6" href="shop.html">Xem ngay</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="h2-services-area mb-120">
        <div class="services-top">
            <div class="services-section-card">
                <div class="card-vector">
                    <img class="services-card-vect-01" src="assets/images/bg/h2-services-title-rt.png" alt>
                    <img class="services-card-vect-02" src="assets/images/bg/h2-services-title-lb.png" alt>
                </div>
                <div class="services-title">
                    <h2>Tất cả <span>dịch vụ.</span></h2>
                    <a class="primary-btn2" href="contact.html">Đặt lịch ngay</a>
                </div>
            </div>
            <div class="swiper h2-services-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="services-card daycare-card d-flex flex-column h-100">
                            <div class="card-vector">
                                <img class="services-card-vect-01" src="assets/images/bg/services-card-vec.png" alt>
                                <img class="services-card-vect-02" src="assets/images/bg/services-card-vec2.png" alt>
                            </div>
                            <div class="services-icon">
                                <img src="assets/images/icon/daycare3.svg" alt>
                            </div>
                            <div class="services-content mt-auto">
                                <h3><a href="service-details.html">Lưu trú</a></h3>
                                <p>Dịch vụ lưu trú trông giữ chó mèo PawSquad tự hào là khách sạn chó mèo hiện đại, thân
                                    thiện nhất tại thành phố. Giúp bạn yên tâm cho bé nhất.</p>
                                <div class="more-btn">
                                    <a href="shop-details.html">Xem chi tiết<img src="assets/images/icon/h2-btn-arrow.svg"
                                            alt></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="services-card grooming-card d-flex flex-column h-100">
                            <div class="card-vector">
                                <img class="services-card-vect-01" src="assets/images/bg/services-card-vec.png" alt>
                                <img class="services-card-vect-02" src="assets/images/bg/services-card-vec2.png" alt>
                            </div>
                            <div class="services-icon">
                                <img src="assets/images/icon/grooming3.svg" alt>
                            </div>
                            <div class="services-content mt-auto">
                                <h3><a href="service-details.html">Cắt tỉa</a></h3>
                                <p>Dịch vụ cắt tỉa lông tạo kiểu cho chó mèo tại PawSquad chúng tôi “cân đo đong đếm” xem
                                    kiểu tóc nào đẹp và phù hợp nhất các bé nhất.</p>
                                <div class="more-btn">
                                    <a href="service-details.html">Xem chi tiết<img
                                            src="assets/images/icon/h2-btn-arrow.svg" alt></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="services-card boarding-card d-flex flex-column h-100">
                            <div class="card-vector">
                                <img class="services-card-vect-01" src="assets/images/bg/services-card-vec.png" alt>
                                <img class="services-card-vect-02" src="assets/images/bg/services-card-vec2.png" alt>
                            </div>
                            <div class="services-icon">
                                <img src="assets/images/icon/bording3.svg" alt>
                            </div>
                            <div class="services-content mt-auto">
                                <h3><a href="service-details.html">Grooming</a></h3>
                                <p>PawSquad ra đời bởi những người trẻ tuổi, hết lòng yêu thương những thú cưng nên đội ngũ
                                    của chúng tôi cũng thấm nhuần tư tưởng đó.</p>
                                <div class="more-btn">
                                    <a href="service-details.html">Xem chi tiết<img
                                            src="assets/images/icon/h2-btn-arrow.svg" alt></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" h2-contact-area row justify-content-center">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-8 ">
                        <div class="contact-wrap mx-2">
                            <div class="section-title">
                                <h2>Báo giá</h2>
                            </div>
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-inner">
                                            <input type="text" placeholder="Tên của bạn" name="name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-inner">
                                            <input type="text" placeholder="Số điện thoại" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-inner">
                                            <input type="email" placeholder="Địa chỉ email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-inner date">
                                            <input autocomplete="off" type="text" id="datepicker3"
                                                placeholder="Chọn thời gian">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <div class="form-inner service">
                                            <select id="duration2" name="service" class="w-100">
                                                <option value="" selected disabled>Chọn dịch vụ</option>
                                                <option value="luu_tru">Lưu trữ</option>
                                                <option value="cat_tia">Cắt tỉa</option>
                                                <option value="grooming">Grooming</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-inner">
                                            <textarea placeholder="Nội dung" name="content"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-inner">
                                            <button class="primary-btn3" type="submit">Đặt lịch ngay</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 d-md-block d-none">
                        <div class="contact-img mt-5">
                            <img class="img-fluid" src="{{ asset('assets/clients/images/bg/h2-contact-img.png') }}"
                                alt="contact-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="home3-blog-area mb-120">
        <div class="container">
            <div class="row mb-60">
                <div class="col-lg-12 d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="section-title3">
                        <h2><img src="{{ asset('assets/clients/images/icon/h3-sec-tt-vect-left.svg') }}" alt><span>Bài
                                viết</span><img src="{{ asset('assets/clients/images/icon/h3-sec-tt-vect-right.svg') }}"
                                alt></h2>
                    </div>
                    <div class="h3-view-btn d-md-flex d-none">
                        <a href="blog-grid.html">Xem tất cả<img
                                src="{{ asset('assets/clients/images/icon/haf-button-2.svg') }}" alt></a>
                    </div>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="blog-card3">
                        <div class="blog-img">
                            <img class="img-fluid" src="{{ asset('assets/clients/images/blog/blog7.png') }}" alt>
                        </div>
                        <div class="bolg-content">
                            <div class="cetagoty">
                                <a href="blog-grid.html">Khuyến mãi</a>
                            </div>
                            <div class="blog-meta">
                                <ul>
                                    <li><a href="blog-grid.html">Trung Kiên</a></li>
                                    <li><a href="blog-grid.html">27/09/2024</a></li>
                                </ul>
                            </div>
                            <h4><a href="blog-details.html">Khuyến mãi 50% cho tất cả dịch vụ</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="blog-card3">
                        <div class="blog-img">
                            <img class="img-fluid" src="{{ asset('assets/clients/images/blog/blog8.png') }}" alt>
                        </div>
                        <div class="bolg-content">
                            <div class="cetagoty">
                                <a href="blog-grid.html">Kinh nghiệm</a>
                            </div>
                            <div class="blog-meta">
                                <ul>
                                    <li><a href="blog-grid.html">Trung Kiên</a></li>
                                    <li><a href="blog-grid.html">28/09/2024</a></li>
                                </ul>
                            </div>
                            <h4><a href="blog-details.html">Kinh nghiệm nuôi chó Labrador</a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="blog-card3">
                        <div class="blog-img">
                            <img class="img-fluid" src="{{ asset('assets/clients/images/blog/blog9.png') }}" alt>
                        </div>
                        <div class="bolg-content">
                            <div class="cetagoty">
                                <a href="blog-grid.html">Huấn luyện</a>
                            </div>
                            <div class="blog-meta">
                                <ul>
                                    <li><a href="blog-grid.html">Trung Kiên</a></li>
                                    <li><a href="blog-grid.html">29/09/2024</a></li>
                                </ul>
                            </div>
                            <h4><a href="blog-details.html">Cách huấn luyện giúp chó vâng lời</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-md-none d-block pt-30">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="h3-view-btn">
                        <a href="shop.html">Xem tất cả bài viết<img
                                src="{{ asset('assets/clients/images/icon/haf-button-2.svg') }}" alt></a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="home3-newsletter-area">
        <div class="newsletter-img">
            <img class="img-fluid" src="{{ asset('assets/clients/images/bg/h3-newsletter-img.png') }}" alt>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="newsletter-wrap">
                        <div class="section-title3 mb-40">
                            <span>Đăng ký</span>
                            <h2>Nhận thông báo của chúng tôi</h2>
                        </div>
                        <form class="contact-form">
                            <div class="form-inner d-flex flex-column w-100">
                                <div class="border-bottom w-100">
                                    <input type="text" class="form-control border-0" placeholder="Nhập họ tên"
                                        name="fullname" required>
                                </div>
                                <div class="border-bottom w-100">
                                    <input type="email" class="form-control border-0" placeholder="Nhập địa chỉ email"
                                        name="email" required>
                                </div>
                                <button type="submit" class="btn btn-primary my-2">Đăng ký</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
