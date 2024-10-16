@extends('layouts.clients')
@section('css')
    <style>
        .voucher-container {
            height: 7.375rem;
            position: relative;
        }

        .voucher-card,
        .voucher-container {
            width: 28.375rem;
        }

        .voucher-card-disabled {
            opacity: .5;
            cursor: not-allowed;
        }

        .voucher-main-content {
            border: .0625rem solid #f46e30ab;
            border-left: none;
            box-shadow: .125rem .125rem .3125rem rgba(0, 0, 0, .07);
            box-sizing: border-box;
            display: flex;
            height: 100%;
            position: relative;
            transition: background 1s ease;
        }

        .voucher-disabled .voucher-info,
        .voucher-disabled .voucher-content {
            opacity: .5;
        }

        .voucher-info,
        .voucher-details {
            display: flex;
            justify-content: center;
            position: relative;
        }

        .voucher-info {
            color: white !important;
            background: #F46F30;
            align-items: center;
            border-top: .2625rem solid #F46F30;
            border-left: .2625rem dashed white;
            border-bottom: .2625rem solid #F46F30;
            box-sizing: border-box;
            flex-direction: column;
            width: 7.375rem;
            text-align: center;
        }

        .voucher-details {
            flex: 1;
            flex-direction: column;
            overflow: hidden;
            padding-left: .75rem;
        }

        .voucher-text {
            display: -webkit-box;
            white-space: normal;
            word-break: break-word;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .voucher-text,
        .voucher-truncated {
            display: -webkit-box;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-box-orient: vertical;
        }

        .voucher-hr {
            display: flex;
            margin: .3125rem 0 .25rem 0;
            min-width: 0;
            overflow: hidden;
            padding: 0;
            text-overflow: ellipsis;
            white-space: nowrap;
        }


        .voucher-expiration {
            color: rgba(0, 0, 0, .54);
            font-size: .75rem;
            line-height: .875rem;
            margin: .25rem 0 0 0;
            margin-top: .25rem;
            overflow: hidden;
            padding-right: 0;
            text-overflow: ellipsis;
            white-space: nowrap;
        }


        .voucher-flex-end,
        .voucher-flex-center {
            display: flex;
            flex-direction: column;
        }

        .voucher-flex-end {
            align-items: flex-end;
            justify-content: center;
            padding: .75rem;
            position: relative;
        }

        .voucher-flex-end,
        .voucher-flex-center {
            display: flex;
            flex-direction: column;
        }

        .voucher-disabled-button {
            background-color: #f5f5f5;
            cursor: not-allowed;
        }

        .voucher-button {
            background: white;
            align-items: center;
            border: 1px solid rgba(0, 0, 0, .14);
            border-radius: 50%;
            box-shadow: rgba(0, 0, 0, .02) 0 2px 0 0;
            box-sizing: border-box;
            cursor: pointer;
            display: flex;
            height: 1.125rem;
            justify-content: center;
            width: 1.125rem;
            fill: currentColor;
            stroke: currentColor;
        }

        .voucher-button:checked{
            accent-color: #ee4d2d!important;
            border-width: 0;
        }

        @media (min-width: 560px) {
            .voucher-label {
                font-size: .75rem;
                font-weight: 500;
                height: 1.125rem;
                width: 2.3125rem;
            }
        }

        .voucher-discount {
            align-items: center;
            background-color: #ffeaea;
            border-radius: .625rem .125rem 0 .625rem;
            color: #ee4d2d;
            font-size: .75rem;
            height: 1.125rem;
            right: -.25rem;
            top: .25rem;
            width: 2.3125rem;
        }

        .voucher-discount,
        .voucher-badge {
            display: flex;
            font-weight: 500;
            justify-content: center;
            position: absolute;
        }

        @media (min-width: 560px) {
            .voucher-arrow {
                height: .75rem;
                width: .375rem;
            }

            .voucher-discount:after {
                border-bottom: .1875rem solid transparent;
                border: .1875rem solid transparent;
                border-bottom-color: #ff9a86;
                content: "";
                height: 0;
                position: absolute;
                right: .0625rem;
                top: calc(100% + 1px);
                transform: rotate(-45deg) translate(50%, -50%);
                width: 0;
                z-index: 0;
            }
        }

        .voucher-icon {
            margin-right: .0625rem;
        }

        .voucher-footer {
            background-color: #fff;
            border: .03125rem solid rgba(0, 0, 0, .09);
            border-radius: 0 0 .125rem .125rem;
            border-top: none;
            box-shadow: 0 .0625rem .1875rem rgba(0, 0, 0, .09);
            box-sizing: border-box;
            height: .5rem;
            margin-left: .5rem;
            margin-right: .5rem;
            position: relative;
        }

        .voucher-footer-disabled {
            opacity: .3;
        }

        .voucher-bg {
            background: #fff;
            box-sizing: border-box;
            display: flex;
            height: 100%;
            opacity: .6;
            width: calc(7.375rem - .5625rem);
        }
    </style>
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
                            <button type="button" class="primary-btn2 btn-lg" data-bs-toggle="modal"
                                data-bs-target="#voucher_modal">
                                Chọn hoặc nhập giảm giá
                            </button>
                            <div class="modal fade" id="voucher_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered  shadow-0">
                                    <div class="modal-content">
                                        <div class="modal-header bg-white">
                                            <h2 class="modal-title fs-5 mb-0">Chọn mã giảm giá</h2>
                                        </div>
                                        <div class="modal-body position-relative">
                                            <form class="mb-2 coupon-input shadow d-flex align-items-center  coupon-form">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="text" name="code" class="coupon-input"
                                                    placeholder="Nhập mã giảm giá nếu có"
                                                    value="{{ old('code', request()->cookie('coupon_code')) }}"
                                                    @if (request()->cookie('coupon_code')) disabled @endif required>
                                                @if (request()->cookie('coupon_code'))
                                                    <button type="submit"
                                                        class="btn btn-secondary flex-shrink-0 apply-coupon-btn d-none px-4">Áp
                                                        dụng</button>
                                                    <button type="button"
                                                        class="btn btn-secondary flex-shrink-0 clear-coupon-btn"><i
                                                            class="bi bi-x"></i></button>
                                                @else
                                                    <button type="submit"
                                                        class="btn btn-secondary flex-shrink-0 apply-coupon-btn px-4">Áp
                                                        dụng</button>
                                                    <button type="button"
                                                        class="btn btn-secondary flex-shrink-0 clear-coupon-btn d-none"><i
                                                            class="bi bi-x"></i></button>
                                                @endif
                                            </form>
                                            <div class="voucher-card w-100 h-100 mt-4">
                                                <h6 class="fw-bold">Mã giảm giá</h6>
                                                <p>Bạn có thể chọn 1 Voucher</p>
                                                <div class="scrollbar voucher_listing"
                                                    style="max-height:200px;overflow-y: auto; overflow-x: hidden;">

                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="primary-btn3 btn-lg"
                                                data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                        <tbody class="coupon-discount-wrapper {{ request()->cookie('coupon_code') == '' ? 'd-none' : '' }}">

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
            $('#voucher_modal').on('show.bs.modal', function(e) {
                $.ajax({
                    type: "get",
                    url: "{{ route('carts.getCoupon') }}",
                    success: function(response) {
                        if (response.success == true) {
                            $('.voucher_listing').empty();
                            $('.voucher_listing').html(response.coupon);
                        }
                    }
                });
            });


        });
    </script>
    <script>
        "use strict"

        function updateCouponInput(voucherValue) {
            document.querySelector('input[name="code"].coupon-input').value = voucherValue;
        }

    </script>
@endsection
