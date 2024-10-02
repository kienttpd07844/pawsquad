@extends('layouts.clients')
@section('css')
@endsection
@section('content')
    @include('clients.partials.breadcrum', [
        'breadcrumbs' => [['name' => 'Đăng nhập', 'url' => '#']],
        'title' => 'Đăng nhập',
    ])

    <div class="login-section pt-120 pb-120">
        <div class="container">
            <div class="row d-flex justify-content-center g-4">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s">
                        <div class="form-title">
                            <h3>Đăng nhập</h3>
                            <p>Bạn chưa có tài khoản? <a href="{{ route('signup') }}">Đăng ký ngay</a></p>
                        </div>
                        <form class="w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label>Địa chỉ email *</label>
                                        <input type="email" placeholder="Địa chỉ email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label>Mật khẩu *</label>
                                        <input type="password" name="password" id="password" placeholder="Mật khẩu của bạn" />
                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-agreement form-inner d-flex justify-content-between flex-wrap">
                                        <div class="form-group">
                                            <input type="checkbox" id="html">
                                            <label for="html">Nhớ tài khoản</label>
                                        </div>
                                        <a href="{{ route('forgotpassword') }}" class="forgot-pass">Quên mật khẩu</a>
                                    </div>
                                </div>
                            </div>
                            <button class="account-btn">Đăng nhập</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
