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

                        <form class="w-100" method="POST" action="{{ route('postForgotPassword') }}">
                            @if (session('message'))
                                @if (session('alert-type') == 'success')
                                    <div class="alert alert-{{ session('alert-type') }} text-center">
                                        Liên kết đặt lại mật khẩu đã được gửi đến email của bạn. Vui lòng kiểm tra Inbox
                                        hoặc
                                        Spam.
                                    </div>
                                @else
                                    <div class="alert alert-danger text-center">
                                        Có lỗi xảy ra. Vui lòng thử lại hoặc liên hệ với admin.
                                    </div>
                                @endif
                            @endif
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label>Địa chỉ email *</label>
                                        <input type="email" name="email" placeholder="Địa chỉ email">
                                    </div>
                                </div>
                            </div>
                            @csrf
                            <button class="account-btn">Xác nhận</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    {!! JsValidator::formRequest('App\Http\Requests\Auth\ForgotPasswordFormRequest') !!}
@endsection
