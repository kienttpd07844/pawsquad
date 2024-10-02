@extends('layouts.clients')
@section('css')
@endsection
@section('content')
    @include('clients.partials.breadcrum', [
        'breadcrumbs' => [['name' => 'Thanh toán', 'url' => '']],
        'title' => 'Thanh toán',
    ])
    <div class="checkout-section pt-120 pb-120">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="form-wrap box--shadow mb-30">
                        <h4 class="title-25 mb-20">Thông tin </h4>
                        <form>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-inner">
                                        <label>Họ và tên</label>
                                        <input type="text" name="name" placeholder="Họ và tên">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-inner">
                                        <label>Tỉnh/Thành phố</label>
                                        <select id="duration2" name="province" class="w-100">
                                            <option value="" selected disabled>Chọn Tỉnh/Thành phố</option>
                                            <option value="luu_tru">Đồng Nai</option>
                                            <option value="cat_tia">Cắt tỉa</option>
                                            <option value="grooming">Grooming</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-inner">
                                        <label>Quận/Huyện</label>
                                        <select id="duration2" name="district" class="w-100">
                                            <option value="" selected disabled>Chọn Quận/Huyện</option>
                                            <option value="luu_tru">Đồng Nai</option>
                                            <option value="cat_tia">Cắt tỉa</option>
                                            <option value="grooming">Grooming</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-inner">
                                        <label>Phường/Xã</label>
                                        <select id="duration2" name="ward" class="w-100">
                                            <option value="" selected disabled>Chọn Phường/Xã</option>
                                            <option value="luu_tru">Đồng Nai</option>
                                            <option value="cat_tia">Cắt tỉa</option>
                                            <option value="grooming">Grooming</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-inner">
                                        <label>Số nhà/đường</label>
                                        <input type="text" name="address" placeholder="Nhập số nhà/đường">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label>Số điện thoại</label>
                                        <input type="text" name="phone" placeholder="Nhập số điện thoại">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-inner">
                                        <textarea name="message" placeholder="Ghi chú cho Shop (nếu có)" rows="6"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="form-wrap box--shadow">
                        <h4 class="title-25 mb-20">Ví Địa Chỉ</h4>
                        <form>
                            <div class="row">
                                <div class="col-12 mb-3 form-inner">
                                    <label for="addressWallet">Chọn Địa Chỉ Lưu</label>
                                    <select id="duration2" name="address_wallet">
                                        <option value="" disabled selected>Chọn Địa Chỉ Đã Lưu</option>
                                        <option value="home">Nhà riêng - 123 Đường ABC, Thành phố XYZ</option>
                                        <option value="office">Công ty - Tòa nhà DEF, Thành phố ABC</option>
                                        <option value="rental">Nhà trọ - Số 10, Phố GHI, Quận JKL</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <aside class="col-lg-5">
                    <div class="added-product-summary mb-30">
                        <h5 class="title-25 checkout-title">
                            Tóm tắt đơn hàng
                        </h5>
                        <ul class="added-products">
                            <li class="single-product d-flex justify-content-start">
                                <div class="product-img">
                                    <img src="{{ asset('assets/clients/images/bg/check-out-01.png') }}" alt>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-title"><a href="#">Lồng ngủ cho mèo</a></h5>
                                    <div class="product-total d-flex align-items-center">
                                        <div class="quantity">
                                            <div class="quantity d-flex align-items-center">
                                                <div class="quantity-nav nice-number d-flex align-items-center">
                                                    <input type="number" value="1" min="1">
                                                </div>
                                            </div>
                                        </div>
                                        <strong> <i class="bi bi-x-lg px-2"></i>
                                            <span class="product-price">200.000đ</span>
                                        </strong>
                                    </div>
                                </div>
                                <div class="delete-btn">
                                    <i class="bi bi-x-lg"></i>
                                </div>
                            </li>
                            <li class="single-product d-flex justify-content-start">
                                <div class="product-img">
                                    <img src="{{ asset('assets/clients/images/bg/check-out-02.png') }}" alt>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-title"><a href="#">Thức ăn đóng hộp cá ngừ cho mèo.</a></h5>
                                    <div class="product-total d-flex align-items-center">
                                        <div class="quantity">
                                            <div class="quantity d-flex align-items-center">
                                                <div class="quantity-nav nice-number d-flex align-items-center">
                                                    <input type="number" value="2" min="1">
                                                </div>
                                            </div>
                                        </div>
                                        <strong> <i class="bi bi-x-lg px-2"></i>
                                            <span class="product-price">100.000đ</span>
                                        </strong>
                                    </div>
                                </div>
                                <div class="delete-btn">
                                    <i class="bi bi-x-lg"></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="summery-card cost-summery mb-30">
                        <table class="table cost-summery-table">
                            <thead>
                                <tr>
                                    <th>Tổng</th>
                                    <th>300.000đ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="tax">Mã giảm giá</td>
                                    <td>- 20.000đ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="summery-card total-cost mb-30">
                        <table class="table cost-summery-table total-cost">
                            <thead>
                                <tr>
                                    <th>Thành tiền</th>
                                    <th>280.000đ</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <form class="payment-form">
                        <div class="payment-methods mb-50">
                            <div class="form-check payment-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="vnpay" checked>
                                <label class="form-check-label" for="vnpay">
                                    Thanh toán qua ngân hàng
                                </label>
                                <p class="para">Sử dụng VNPAY</p>
                            </div>
                            <div class="form-check payment-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="cod">
                                <label class="form-check-label" for="cod">
                                    Thanh toán khi nhận hàng
                                </label>
                                <p class="para">Thanh toán bằng tiền mặt khi giao hàng.</p>
                            </div>

                        </div>
                        <div class="place-order-btn">
                            <button type="submit" class="primary-btn1 lg-btn">Thanh toán</button>
                        </div>
                    </form>
                </aside>
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
