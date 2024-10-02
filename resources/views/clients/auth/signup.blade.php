@extends('layouts.clients')
@section('css')
@endsection
@section('content')
    @include('clients.partials.breadcrum', [
        'breadcrumbs' => [['name' => 'Đăng ký', 'url' => '#']],
        'title' => 'Đăng ký',
    ])

    <div class="login-section pt-120 pb-120">
        <div class="container">
            <div class="row d-flex justify-content-center g-4">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s">
                        <div class="form-title">
                            <h3>Đăng ký</h3>
                            <p>Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
                        </div>
                        <form class="w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label>Họ và tên *</label>
                                        <input type="text" placeholder="Họ và tên">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-inner">
                                        <label>Địa chỉ email *</label>
                                        <input type="email" placeholder="Địa chỉ email">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-inner">
                                        <label>Số điện thoại *</label>
                                        <input type="phone" placeholder="Số điện thoại">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-inner">
                                        <label>Mật khẩu *</label>
                                        <input type="password" name="password" id="password" placeholder="Mật khẩu của bạn" />
                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-inner">
                                        <label>Nhập lại mật khẩu *</label>
                                        <input type="password" name="repassword" id="password" placeholder="Mật khẩu của bạn" />
                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                    </div>
                                </div>
                            </div>
                            <button class="account-btn">Đăng ký</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
