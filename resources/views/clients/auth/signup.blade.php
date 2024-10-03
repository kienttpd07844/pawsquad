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
            width:20px;
            background:none;
        }
    </style>
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
                        <form class="w-100" id="signup-form" method="post" action="{{ route('postSignup') }}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label>Họ và tên *</label>
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Họ và tên">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-inner">
                                        <label>Địa chỉ email *</label>
                                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Địa chỉ email">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-inner">
                                        <label>Số điện thoại *</label>
                                        <input type="phone" name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại">
                                    </div>
                                </div>
                                <div class="col-12 mb-3 relative">
                                    <label for="password"
                                        class="mb-1 block font-display text-sm text-jacarta-700 dark:text-white">
                                        Mật khẩu <span class="text-red"> *</span>
                                    </label>
                                    <div class="input-wrapper-password">

                                        <input name="password" id="password"
                                            class="contact-form-input w-full rounded-lg border-jacarta-100 py-3 pr-12 hover:ring-2 hover:ring-accent/10 focus:ring-accent dark:border-jacarta-600 dark:bg-jacarta-700 dark:text-white dark:placeholder:text-jacarta-300"
                                            type="password" value="{{ old('password') }}">
                                        <button type="button" id="toggle-password" class="flex items-center">
                                            <!-- Eye Icon (Show Password) -->
                                            <svg id="eye-icon" class="h-5 w-5 text-jacarta-700 dark:text-white"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3 14C3 9.02944 7.02944 5 12 5C16.9706 5 21 9.02944 21 14M17 14C17 16.7614 14.7614 19 12 19C9.23858 19 7 16.7614 7 14C7 11.2386 9.23858 9 12 9C14.7614 9 17 11.2386 17 14Z"
                                                    stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                            <!-- Eye Slash Icon (Hide Password) -->
                                            <svg id="eye-slash-icon" class="h-5 w-5 text-jacarta-700 dark:text-white hidden"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5"
                                                    stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            @csrf
                            <button class="account-btn">Đăng ký</button>
                        </form>
                        <div class="alternate-signup-box">
                            <h6>hoặc</h6>
                            <div class="btn-group gap-4">
                                <a href="{{ route('login.google',['provider' => 'google']) }}" class="eg-btn google-btn d-flex align-items-center"><i
                                        class="bx bxl-google"></i><span>Đăng ký bằng Google</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    {!! JsValidator::formRequest('App\Http\Requests\Auth\SignupFormRequest') !!}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.onTurnstileSuccess = function(code) {
                document.querySelector('form button[type="submit"]').disabled = false;
            }
            const passwordInput = document.getElementById('password');
            const togglePasswordButton = document.getElementById('toggle-password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeSlashIcon = document.getElementById('eye-slash-icon');

            function togglePassword() {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                eyeIcon.style.display = isPassword ? 'none' : 'block';
                eyeSlashIcon.style.display = isPassword ? 'block' : 'none';
            }
            eyeSlashIcon.style.display = 'none';
            togglePasswordButton.addEventListener('click', togglePassword);
        });
    </script>
@endsection
