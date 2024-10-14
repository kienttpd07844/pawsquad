@extends('layouts.clients')
@section('css')
@endsection
@section('content')
    @include('clients.partials.breadcrum', [
        'breadcrumbs' => [['name' => 'Giỏ hàng', 'url' => '']],
        'title' => 'Giỏ hàng',
    ])

    <div class="cart-section pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-wrapper">
                        <table class="eg-table table cart-table shop-details-page">
                            <thead>
                                <tr>
                                    <th>Xoá</th>
                                    <th>Ảnh</th>
                                    <th>Tên</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tbody class="cart-listing shop-details-content">
                                @include('clients.partials.cart-listing')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="coupon-area">
                        <div class="cart-coupon-input">
                            <h5 class="coupon-title">Mã giảm giá</h5>
                            <form class="coupon-input d-flex align-items-center  coupon-form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="text" name="code" class="coupon-input"
                                    placeholder="Nhập mã giảm giá nếu có"
                                    value="{{ old('code', request()->cookie('coupon_code')) }}"
                                    @if (request()->cookie('coupon_code')) disabled @endif required>
                                @if (request()->cookie('coupon_code'))
                                    <button type="submit"
                                        class="btn btn-secondary flex-shrink-0 apply-coupon-btn d-none px-4">Áp
                                        dụng</button>
                                    <button type="button" class="btn btn-secondary flex-shrink-0 clear-coupon-btn"><i
                                            class="bi bi-x"></i></button>
                                @else
                                    <button type="submit" class="btn btn-secondary flex-shrink-0 apply-coupon-btn px-4">Áp
                                        dụng</button>
                                    <button type="button"
                                        class="btn btn-secondary flex-shrink-0 clear-coupon-btn d-none"><i
                                            class="bi bi-x"></i></button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <table class="table total-table">
                        <thead>
                            <tr>
                                <th>Tổng tiền</th>
                                <th></th>
                                <th class="sub-total-price">{{ format_cash(getSubTotal($carts, false)) }}</th>
                            </tr>
                        </thead>
                        <tbody  class="coupon-discount-wrapper {{ request()->cookie('coupon_code') == '' ? 'd-none' : '' }}">

                        </tbody>
                    </table>
                    <ul class="cart-btn-group">
                        <li><a href="{{ route('product') }}" class="primary-btn2 btn-lg">Tiếp tục mua sắm</a></li>
                        <li><a href="{{ route('checkout') }}" class="primary-btn3 btn-lg">Thanh toán</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
