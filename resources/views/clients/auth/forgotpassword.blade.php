@extends('layouts.clients')
@section('css')
@endsection
@section('content')
    @include('clients.partials.breadcrum', [
        'breadcrumbs' => [['name' => 'Quên mật khẩu', 'url' => '#']],
        'title' => 'Quên mật khẩu',
    ])

    <div class="login-section pt-120 pb-120">
        <div class="container">
            <div class="row d-flex justify-content-center g-4">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s">
                        <div class="form-title">
                            <h3>Quên mật khẩu</h3>
                        </div>
                        <form class="w-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label>Địa chỉ email *</label>
                                        <input type="email" placeholder="Địa chỉ email">
                                    </div>
                                </div>
                            </div>
                            <button class="account-btn">Xác nhận</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
