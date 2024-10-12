@extends('layouts.clients')
@section('css')
    <style>
        input[type="password"]::-webkit-inner-spin-button,
        input[type="password"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="password"] {
            -webkit-appearance: none;
            appearance: none;
            background: none;
            background-color: #fff;
        }

        input::-ms-reveal,
        input::-ms-clear {
            display: none;
        }

        .input-wrapper-password {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        #password {
            flex: 1;
            padding-right: 3rem;
        }

        #toggle-password {
            position: absolute;
            right: 1rem;
            top: 15px;
            display: flex;
            align-items: center;
            cursor: pointer;
            z-index: 1;
            width: 20px;
            background: none;
        }
    </style>
@endsection
@section('content')
    @include('clients.partials.breadcrum', [
        'breadcrumbs' => [['name' => 'Xác minh email', 'url' => '#']],
        'title' => 'Xác minh email',
    ])

    <div class="login-section pt-120 pb-120">
        <div class="container">
            <div class="row d-flex justify-content-center g-4">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s">
                        <div class="form-title">
                            <h3>Xác minh email</h3>
                        </div>
                        @if (session('message'))
                            @if (session('alert-type') != 'success')
                                <div class="alert alert-danger text-center">
                                    {{ session('message') }}
                                </div>
                            @endif
                            @if (session('alert-type') == 'success')
                                <div class="alert alert-success text-center">
                                    Đã gửi thành công đường dẫn xác thực tài khoản về mail của bạn.<br>
                                    Vui lòng kiểm tra thư đến hoặc thư rác.
                                </div>
                            @endif
                        @endif
                        @if (!auth()->user()->email_verified && !auth()->user()->email_verified_at)
                            <form method="POST" action="{{ route('postVerify') }}">
                                @csrf
                                <button class="account-btn" type="submit">Gửi mail xác minh</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
