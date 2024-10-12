@extends('layouts.clients')
@section('css')
    <style>
        .accordion-button {
            background-color: #F46F30;
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }

        .accordion-button strong {
            color: white !important;
        }

        .accordion-button:hover {
            background-color: #e05a28;
        }

        .accordion-button:not(.collapsed) {
            background-color: #d85524;
        }

        .accordion-body {
            background-color: #f9f9f9;
            color: #333;
            padding: 15px;
        }

        .containerss {
            display: block;
            margin-bottom: 10px;
        }

        .containerss input[type="checkbox"] {
            margin-right: 10px;
        }

        .checkmark {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #F46F30;
            border-radius: 4px;
            position: relative;
        }

        .containerss input[type="checkbox"]:checked+.checkmark {
            background-color: #F46F30;
        }

        .containerss input[type="checkbox"]:checked+.checkmark::after {
            content: "";
            position: absolute;
            left: 6px;
            top: 2px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
    </style>
@endsection
@section('content')
    @include('clients.partials.breadcrum', [
        'breadcrumbs' => [['name' => 'Danh mục' . ' ' . $category->name, 'url' => '']],
        'title' => 'Danh mục' . ' ' . $category->name,
    ])


    <div class="shop-page pt-120 mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop-sidebar">
                        <div class="shop-widget">
                            <h5 class="shop-widget-title">Giá</h5>
                            <div class="range-widget">
                                <div id="slider-range" class="price-filter-range"></div>
                                <div class="mt-25 d-flex justify-content-between gap-4">
                                    <input type="number" min="1000" max="9999999"
                                        oninput="validity.valid||(value='1000');" id="min_price"
                                        class="price-range-field" />
                                    <input type="number" min="1000-" max="10000000"
                                        oninput="validity.valid||(value='10000000');" id="max_price"
                                        class="price-range-field" />
                                </div>
                            </div>
                        </div>
                        @if (isset($childCategories) && $childCategories->isNotEmpty())
                            <div class="shop-widget">
                                <div class="check-box-item">
                                    <h5 class="shop-widget-title">{{ $category->name }}</h5>
                                    <div class="checkbox-container">
                                        @foreach ($childCategories as $child)
                                            <label class="containerss">{{ $child->name }}
                                                <input type="checkbox" class="category-filter" value="{{ $child->slug }}">
                                                <span class="checkmark"></span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (isset($brands) && $brands->isNotEmpty())
                            <div class="shop-widget">
                                <div class="check-box-item">
                                    <h5 class="shop-widget-title">Nhãn hàng</h5>
                                    <div class="checkbox-container">
                                        @foreach ($brands as $brand)
                                            <label class="containerss">{{ $brand->name }}
                                                <input type="checkbox" class="brand-filter" value="{{ $brand->slug }}">
                                                <span class="checkmark"></span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row mb-50">
                        <div class="col-lg-12">
                            <div class="multiselect-bar">
                                <h6>Sản phẩm</h6>
                                <div class="multiselect-area">
                                    <div class="single-select">
                                        <span>Hiển thị</span>
                                        <select class="defult-select-drowpown" id="color-dropdown">
                                            <option selected value="0">12</option>
                                            <option value="1">15</option>
                                            <option value="2">18</option>
                                            <option value="3">21</option>
                                            <option value="4">25</option>
                                        </select>
                                    </div>
                                    <div class="single-select two">
                                        <select class="defult-select-drowpown" id="eyes-dropdown">
                                            <option selected value="0">Sắp xếp theo</option>
                                            <option value="1">Giá từ cao xuống thấp</option>
                                            <option value="2">Giá từ thấp lên cao</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 justify-content-center">
                        <div class="col-lg-4 col-md-4 col-6">
                            <div class="collection-card h-100">
                                <div class="offer-card">
                                    <span>Nổi bật</span>
                                </div>
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
                                                    src="{{ asset('assets/clients/images/icon/Icon-cart3.svg') }}" alt></a>
                                        </li>
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
                        <div class="col-lg-4 col-md-4 col-6">
                            <div class="collection-card">
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
                                                    src="{{ asset('assets/clients/images/icon/Icon-cart3.svg') }}" alt></a>
                                        </li>
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
                        <div class="col-lg-4 col-md-4 col-6">
                            <div class="collection-card">
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
                                                    alt></a>
                                        </li>
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

                        <div class="col-lg-4 col-md-4 col-6">
                            <div class="collection-card h-100">
                                <div class="offer-card">
                                    <span>Nổi bật</span>
                                </div>
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
                                                    alt></a>
                                        </li>
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
                        <div class="col-lg-4 col-md-4 col-6">
                            <div class="collection-card">
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
                                                    alt></a>
                                        </li>
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
                        <div class="col-lg-4 col-md-4 col-6">
                            <div class="collection-card">
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
                                                    alt></a>
                                        </li>
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
                        <div class="col-lg-4 col-md-4 col-6">
                            <div class="collection-card h-100">
                                <div class="offer-card">
                                    <span>Nổi bật</span>
                                </div>
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
                                                    alt></a>
                                        </li>
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
                        <div class="col-lg-4 col-md-4 col-6">
                            <div class="collection-card">
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
                                                    alt></a>
                                        </li>
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
                        <div class="col-lg-4 col-md-4 col-6">
                            <div class="collection-card">
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
                                                    alt></a>
                                        </li>
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
                        <div class="col-lg-4 col-md-4 col-6">
                            <div class="collection-card h-100">
                                <div class="offer-card">
                                    <span>Nổi bật</span>
                                </div>
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
                                                    alt></a>
                                        </li>
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
                        <div class="col-lg-4 col-md-4 col-6">
                            <div class="collection-card">
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
                                                    alt></a>
                                        </li>
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
                        <div class="col-lg-4 col-md-4 col-6">
                            <div class="collection-card">
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
                                                    alt></a>
                                        </li>
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
                    </div>
                    <div class="row pt-70">
                        <div class="col-lg-12 d-flex justify-content-center">
                            <div class="paginations-area">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="#"><i
                                                    class="bi bi-arrow-left-short"></i></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                        <li class="page-item"><a class="page-link" href="#">02</a></li>
                                        <li class="page-item"><a class="page-link" href="#">03</a></li>
                                        <li class="page-item"><a class="page-link" href="#"><i
                                                    class="bi bi-arrow-right-short"></i></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.querySelectorAll('.accordion-button').forEach(button => {
            button.addEventListener('click', () => {
                const accordionItem = button.parentElement;
                accordionItem.classList.toggle('active');
            });
        });
        $(function() {
            // Khởi tạo slider
            var min_price_range = parseInt($("#min_price").val(), 10) || 1000; // Giá trị mặc định là 1000
            var max_price_range = parseInt($("#max_price").val(), 10) || 10000000; // Giá trị mặc định là 10000000

            $("#slider-range").slider({
                range: true,
                orientation: "horizontal",
                min: 1000, // Giá trị tối thiểu
                max: 10000000, // Giá trị tối đa
                values: [min_price_range, max_price_range],
                step: 1000,
                slide: function(event, ui) {
                    if (ui.values[0] == ui.values[1]) {
                        return false;
                    }
                    $("#min_price").val(ui.values[0]);
                    $("#max_price").val(ui.values[1]);
                }
            });

            $("#min_price").val($("#slider-range").slider("values", 0));
            $("#max_price").val($("#slider-range").slider("values", 1));

            // Xử lý sự kiện khi nhập
            $("#min_price, #max_price").on("paste keyup", function() {
                $('#price-range-submit').show();
                var min_price_range = parseInt($("#min_price").val(), 10) || 1000;
                var max_price_range = parseInt($("#max_price").val(), 10) || 10000000;

                if (min_price_range == max_price_range) {
                    max_price_range = min_price_range + 100; // Đảm bảo max lớn hơn min
                    $("#max_price").val(max_price_range);
                }

                // Cập nhật giá trị cho slider
                $("#slider-range").slider({
                    values: [min_price_range, max_price_range]
                });
            });
        });

        // Xử lý sự kiện cho nút tìm kiếm
        $("#slider-range, #price-range-submit").on('click', function() {
            var min_price = $('#min_price').val();
            var max_price = $('#max_price').val();
            $("#searchResults").text("Here List of products will be shown which are cost between " + min_price +
                " and " + max_price + ".");
        });
    </script>
@endsection
