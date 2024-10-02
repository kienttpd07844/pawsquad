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
                        <table class="eg-table table cart-table">
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
                            <tbody>
                                <tr>
                                    <td data-label="Xoá">
                                        <div class="delete-icon">
                                            <i class="bi bi-x"></i>
                                        </div>
                                    </td>
                                    <td data-label="Hình">
                                        <img src="{{asset('assets/clients/images/bg/cart-01.png')}}" alt>
                                    </td>
                                    <td data-label="Tên"><a href="shop-details.html">Lồng ngủ cho mèo</a></td>
                                    <td data-label="Giá">200.000đ</td>
                                    <td data-label="Số lượng">
                                        <div class="quantity d-flex align-items-center">
                                            <div class="quantity-nav nice-number d-flex align-items-center">
                                                <input type="number" value="1" min="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Tổng">200.000đ</td>
                                </tr>
                                <tr>
                                    <td data-label="Xoá">
                                        <div class="delete-icon">
                                            <i class="bi bi-x"></i>
                                        </div>
                                    </td>
                                    <td data-label="Hình">
                                        <img src="{{asset('assets/clients/images/bg/cart-02.png')}}" alt>
                                    </td>
                                    <td data-label="Tên"><a href="shop-details.html">Thức ăn cá hồi đóng hộp cho mèo.</a></td>
                                    <td data-label="Giá">50.000đ</td>
                                    <td data-label="Số lượng">
                                        <div class="quantity d-flex align-items-center">
                                            <div class="quantity-nav nice-number d-flex align-items-center">
                                                <input type="number" value="2" min="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Tổng">100.000đ</td>
                                </tr>
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
                            <form class="coupon-input d-flex align-items-center">
                                <input type="text" placeholder="Nhập mã giảm giá nếu có">
                                <button type="submit">Áp dụng</button>
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
                                <th>300.000đ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Giảm giá</td>
                                <td>
                                    <ul class="cost-list text-start">
                                        <li>Mã giảm</li>
                                        <li>Tổng giá trị</li>
                                    </ul>
                                </td>
                                <td>
                                    <ul class="single-cost text-center">
                                        <li>DISCOUNT2</li>
                                        <li>20.000đ
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Thành tiền</td>
                                <td></td>
                                <td>280.000đ</td>
                            </tr>
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
