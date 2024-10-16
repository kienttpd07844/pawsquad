<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.egenslab.com/html/scooby/preview/index3.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Sep 2024 00:32:50 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawsquad</title>
    <link rel="icon" href="{{ asset('assets/clients/images/sm-logo.svg') }}" type="image/gif" sizes="20x20">

    <link rel="stylesheet" href="{{ asset('assets/clients/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/clients/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/clients/css/boxicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/clients/css/bootstrap-icons.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/clients/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/clients/css/swiper-bundle.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/clients/css/nice-select.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/clients/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/clients/css/jquery.fancybox.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/clients/css/odometer.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/clients/css/datepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/clients/css/uiicss.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/clients/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/custom.css') }}?v=0.1">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"
        integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplebar/6.0.0/simplebar.min.css"
        integrity="sha512-iQBsppXZIltfj3yN99ljZ/JqWSXOMMArhR6paziJaU42nMPfTuDkXF+yE/PBqbF9guEczGppZctiZ32ZCYssXw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .toast {
            background-size: auto !important;
        }

        .toast {
            position: fixed;
            top: 25px;
            right: 25px;
            width: 100% !important;
            background: #fff;
            padding: 0.5em 0.35em;
            border-left: 4px solid #b7b7b7;
            border-radius: 4px;
            box-shadow: -1px 1px 10px #00000057;
            z-index: 1023;
            animation: leftToRight .5s ease-in-out forwards;
            transform: translateX(110%);
        }

        @media only screen and (max-width: 768px) {
            .toast {
                right: 0;
            }
        }

        .toast.closing {
            animation: RightToLeft .5s ease-in-out forwards;
        }

        .toast-progress {
            position: absolute;
            display: block;
            bottom: 0;
            left: 0;
            height: 4px;
            width: 100%;
            background: #b7b7b7;
            animation: Toastprogress 3s ease-in-out forwards;
        }

        @keyframes leftToRight {
            0% {
                transform: translateX(110%);
            }

            75% {
                transform: translateX(-10%);
            }

            100% {
                transform: translateX(0%);
            }
        }

        @keyframes RightToLeft {
            0% {
                transform: translateX(0%);
            }

            25% {
                transform: translateX(-10%);
            }

            100% {
                transform: translateX(110%);
            }
        }

        @keyframes Toastprogress {
            0% {
                width: 100%;
            }

            100% {
                width: 0%;
            }
        }

        button.toast-close-button {
            outline: none;
            background: none;
            border: none;
            float: right;
            cursor: pointer;
        }

        button.toast-close-button>span,
        button.toast-close-button>i,
        .toast-close-button {
            font-size: 1.2rem;
            color: #747474 !important;
            font-weight: 500;
            right: 7px !important;
            position: absolute !important;
            top: 5px !important;
        }

        button.toast-close-button:hover>span,
        button.toast-close-button:hover>i {
            color: #585858 !important;
        }

        .toast-content-wrapper {
            display: flex;
            justify-content: space-evenly;
            align-items: start;
        }

        .toast-icon {
            padding: 0.35rem 0.5rem;
        }

        .toast-message {
            font-size: .9rem;
            color: #424242;
            padding: 0.15rem 0.5rem;
        }

        /* success toast */
        .toast.toast-success {
            border-color: #03e05f;
        }

        .toast.toast-success .toast-progress {
            background-color: #088d3f;
        }

        .toast.toast-success .toast-icon>span,
        .toast.toast-success .toast-icon>i {
            color: #26c468;
        }

        /* danger toast */
        .toast.toast-danger {
            border-color: #ff3f3f;
        }

        .toast.toast-danger .toast-progress {
            background-color: #d63030;
        }

        .toast.toast-danger .toast-icon>span,
        .toast.toast-danger .toast-icon>i {
            color: #ff3f3f;
        }

        /* info toast */
        .toast.toast-info {
            border-color: #5fbdfc;
        }

        .toast.toast-info .toast-progress {
            background-color: #4b9fd8;
        }

        .toast.toast-info .toast-icon>span,
        .toast.toast-info .toast-icon>i {
            color: #5fbdfc;
        }

        /* warning toast */
        .toast.toast-warning {
            border-color: #c99e25;
        }

        .toast.toast-warning .toast-progress {
            background-color: #bb9223;
        }

        .toast.toast-warning .toast-icon>span,
        .toast.toast-warning .toast-icon>i {
            color: #c99e25;
        }

        #toast-container>.toast-success {
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAYAAAByDd+UAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAKLSURBVHgBzZZNbtpAFMffjMFRQY28hFKpzg1gGZFKWGkqdZX2BHVOUHIC4AQ0J6g5QZVVpDTUqC10V3GDelGqSF3UG1cqgZm+GYIVbPAHoCp/CWY89sxP78289wbgP4tAShW+XugwyeiiP6Xc/VV9PkwzPxao2e+1fHbXBEqOgfEyztDCq5AecN4ZVQ+tuPUigY8H9hvOWHMpZLkc/LWiwEuBwqqcqrUJMBPWk+WN6alrGG4sULpQfWjjqzJsJDL0xsQIQmnws7y6294cJsTLeZW1g6MLwFK/a2JjwvZkFgfd+kogqgFbFuXQ0GxbCwFvrdNhHXHew3+Lz05pUNqD7MQMAYGT17AebTg6eGZMx+PWqhijVDme9zP+KOE1SItCixhVXom+oqp4sld4iHP/EEoLS/3LcsSqrnQVtsFXaFHret9wHvXtBkRvh1b81n3iA6eMrM4kBNw/Y1qZKrSyuEf8TGSUwucPNUwQTYiR4rE9HxgjPb/DGsISytiJRCHYyynNgn2hK5S+gxSaATMZJ/IrDvXip6uXP54e9QjjZ4xSw60YLu5bnCt9/cXKIlr/YGFY/MYmKkm7eBIr18YLRzzIxM7ZW0godL9k3Q2LuLqmKTs70n3ClbKKJBWRcQqLQJiex07kvFYafLRlCCQvWcKYjs+ed3RMPzcq+w6QYqEkLDxgP6uHe/Nn30JHlBEOLdiyRKwGnhdV+nJl4ZVhzTQXkoWH5eTuQCgOszdKXRRP2Fh86OXoaXA0BBSuzWKlFpciWJvFO5gYZKwGX0VeokTJwk1vkKRlS+Zb1hodHK2Mz0T3UlkrRflaVlEkhOMWkHMvT61lVqUGLsIvy+Q22WcyE8fZn2Wee6t/lXrvcWjggekAAAAASUVORK5CYII=') !important;
        }

        #toast-container>.toast-info {
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAYAAAByDd+UAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAJaSURBVHgBvVZNbtNQEJ55idd4hSphKnOCkhM0PQHpCUhuADsWLTgkQuwQJyCcoOEEpSfAnKBW6cK0m6wb+U1nXu04bdLkTRT1kxLnOR5/b/7eNwge2Dn61ybEN4agbRFiBAjlPgFM+HfK1xSJfuXDl7/XvQtXEh1fdvnyiT8xeAEzgKKfD3ZHjz6xlOjDeYzN4IQQXsNGYOLpzUH+9VX28B+zQPbx8i0FwZ/NyQQUI7/j+dFFZ2Er8wt5wKA5gW0CoZt/jn7WyxISRvGsKojt8cGEptNWFd46pEFw6kfG+SE6KBrQ4kW27mmu4FDqoVo7wrIaY/AB2Z6U/3USpZbsey8Troed44vujBDuSt8LSDgrJs63IvwNx4HS1IB46msmObEAfUR8RkTvVDnnVDTZoEPgD5cTgG9svPrUWG7babLZntJowl8Ze5hKv/Gttr817htdg+MIucT/D6NWPnjR4/PzLyhg+Bw2ur6jLrfPj9lKH53QgBI07xVqwnkH43KiACKlcnXVrYRUuOHvTGNUFMYRsj6qD3fRTWMsnfkayA6vv0RpudoHJSQdEtKxtwHvsGZ3LaECb3hsyrEg8zGoCiZMzkMkrV5iJlxVlfa9TCym9W5xLB/wRuE4HGE+iEZ8AKRrbRpl3ibirf1OQJ5esnflnFMLcMICXGxfgN1k12ABTh4IsNxA8NM3FaHoZ1IPU/dOGnGbRfVQexgsJXLvsL2r4e69PC8fEzm8UASikTFsAK7glJrTw3nPVhLOiJ9qEF4gllGfxZPbYE/kbH7UF23kX2fS1D6j/i3BTfaqkKQ1ngAAAABJRU5ErkJggg==') !important;
        }

        #toast-container>.toast-warning {
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAYAAAByDd+UAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAHbSURBVHgBxZZPTsJAFMa/NxDEjYJE1/UGcgOP4BEwARNXeAP0BMSVCzWNJxBPIDfQG8COhSSwJBH7fFNbaKV/ZsA/vwVppzPz5Zt58zHAH0OwZOCisjNHgxWmBYVe9RRTm/FWgiMXzpZHz/LoBE1DUly3EVWwoOSpTkRM43hzXMACY4eBu0HCp6m4PDR1aeywzOSmfKrYuDQSHN9LkTCOFw3Mr/I7DF9JUXt0E1vqzQQVqBN5ne41UdfFop+DtkqppDpmc+Wg3SFeKL5IsGeLfSNw4+02sgrrCn5zl0mhkN83U3DiqjZgtjc+ss95LlMF9TFgj63OmCbPZapgGZbuQsRlsO/mguu6W05KnYlkbvK3BIII24TUyFsR1O50iWNDdBgkuVwR/AF3IYmRFwtvXdIF5f/9ZOGH9UwmlDB/0RPn9Y0Ge8yhiLnIp8IiZCDm9/U81Y02LBzqUpbqMhG0Zv7B9YMz6MBfOrSJMDkyV8z8YNq/WKTuUgeJAZ2hxk+1Fi5rTTSIuWc2Zhl5Sh8DG3dQtLuYh+jIdFgYeTS+w4kieoQdQ3wVTF7RxNhmdopSNlaDAhyswexd8kDfLRG5LvwWUmTX1XO5VoYNemmJYbwnNnhAf7+FPv6DT2e/n0VFnPgUAAAAAElFTkSuQmCC') !important;
        }

        #toast-container>.toast-error {
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAYAAAByDd+UAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAIlSURBVHgB3VbBbtNAEH2zTugFFIPgwAlzA4mK8AdrvgC+APiSKl/S9AvoH8SfEEQP3PCNAwjcA6IQeYcdYxtvbK/jNr30SVG86519npk3swvcdNCuC7880dF0Ck1QzxVMKHMGKmOYD5sNkoefknSXfQYJvz7TekJ0xIAe2CjJwSf3PybLgXXd+BzpcHZHHQP8CiPAoOWfjVn0edxJKOE7mNLKPka4HNLfG467SOkayGpSCvjF3XWSNSfV9qpbU3W0BzJBxLmkxIXj4bdD/VaBjrFH5Mzxg7MkqcaOhwHwBuOR+V4GVuHNcU0oubMK032GNh+P5Wdjsq4nGet6vh/619OXj1qEUtQeI/EiswJISXFckArZhGMRxcUFvPhJJm4REmPusQnZ0OrHXIdCIKQVmdTrwYTee2xBStV7T/7PIvQZWY/mJWlcSb1oDrdtCZH3Y6HIzOpnjIFxh2E4eofGcvarrZkz8awZXkdIXd/J6rxFyH6jzJK9rsgkjNs5hac8mMy6RRgESDyEECU6OStzKuVk30lwezXQ3NvpNN8Pte2h/bVYeuEX1zYYyb2zVbssBDljMWA+jszCEJ80xw7hv57Hp9gTCLzcPpBboqYA7+xfiqsjtc25FbEWYaG6oFBdiiuQyR7SCgcJS9LCgOHGfxfYMJ6WB2/a/X4AxRnJ9tgir3oLNdpL1KJ59l2KsIIt8ijP7TWRixqcldbn0jDGXBNvPv4C3QjuTqveJGAAAAAASUVORK5CYII=') !important;
        }
    </style>
    <style>
        .product-qty {
            max-width: 136px
        }

        .product-qty input {
            width: 52px;
            height: 48px;
            padding: 12px 3px;
            text-align: center;
            background: #fff;
            color: black;
            border: 1px solid #e9e9e9;
            border-left: 0;
            border-right: 0;
            font-weight: 700;
            margin-right: 0px;
            border-radius: 0;
        }

        .product-qty button {
            width: 40px;
            height: 48px;
            background: #fff;
            border: 1px solid #e9e9e9;
            border-radius: 4px 0 0 4px;
            font-weight: 700;
            -webkit-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
        }

        .product-qty button.increase {
            border-radius: 0 4px 4px 0
        }

        .product-qty button:hover {
            background-color: rgba(233, 233, 233, .5)
        }
    </style>

    @yield('css')

</head>

<body class="home-pages-2">

    @include('clients.blocks.header')

    @yield('content')
    @if (Route::is('home') || Route::is('product') || Route::is('product.detail') || Route::is('category'))
        <!-- Quickview -->
        <div class="modal fade" id="quickview_modal">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content min-h-400">
                    <div class="modal-header bg-white">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-white">
                        <div class="data-preloader-wrapper d-flex align-items-center justify-content-center min-h-400">
                            <div class="" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>

                        <div class="product-info">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quickview -->
    @endif
    @include('clients.blocks.footer')

    <script src="{{ asset('assets/clients/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/clients/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/clients/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/clients/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/clients/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/clients/js/jquery.nice-select.js') }}"></script>
    <script src="{{ asset('assets/clients/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/clients/js/morphext.min.js') }}"></script>
    <script src="{{ asset('assets/clients/js/odometer.min.js') }}"></script>
    <script src="{{ asset('assets/clients/js/jquery.marquee.min.js') }}"></script>
    <script src="{{ asset('assets/clients/js/viewport.jquery.js') }}"></script>
    <script src="{{ asset('assets/clients/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/clients/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('assets/clients/js/jquery.nice-number.min.js') }}"></script>
    <script src="{{ asset('assets/clients/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/clients/js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/clients/js/main.js') }}"></script>
    <script src="{{ asset('assets/clients/js/simplebar.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
    </script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function notifyMe(level, message) {
            if (level == 'danger') {
                level = 'error';
            }

            // Check if the toastr method corresponding to the level exists
            if (typeof toastr[level] == 'function') {
                toastr.options = {
                    "timeOut": "5000",
                    "closeButton": true,
                    "positionClass": "toast-top-right",
                };
                toastr[level](message);
            } else {
                console.error('Invalid toastr level:', level);
            }
        }
        @if ($errors->all())
            @foreach ($errors->all() as $error)
                notifyMe('danger', '{{ $error }}')
            @endforeach
        @endif
        @if (session('message'))
            notifyMe('{{ session('alert-type') }}', '{{ session('message') }}')
        @endif

        @if (session()->has('flash_notification'))
            @foreach (session('flash_notification', collect())->toArray() as $message)
                notifyMe("{{ $message['level'] }}", "{{ $message['message'] }}");
            @endforeach
            {{ session()->forget('flash_notification') }}
        @endif
    </script>
    @yield('js')
    <script>
        $(document).ready(function() {
            $.datetimepicker.setLocale('vi');
            var today = new Date();
            var maxDate = new Date();
            maxDate.setMonth(today.getMonth() + 1);

            $('#datepicker3').datetimepicker({
                format: 'd/m/Y H:i',
                defaultDate: today,
                step: 15,
                minDate: 0,
                maxDate: maxDate,
                minTime: '07:15',
                maxTime: '18:45'
            });

        });
    </script>
    <script>
        "use strict"
        // tooltip
        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });



        function showProductDetailsModal(productId) {
            $('#quickview_modal .product-info').html(null);
            $('.data-preloader-wrapper>div').addClass('spinner-border');
            $('.data-preloader-wrapper').addClass('min-h-400');
            $('#quickview_modal').modal('show');

            $.post('{{ route('showInfo.product') }}', {
                _token: '{{ csrf_token() }}',
                id: productId
            }, function(data) {
                setTimeout(() => {
                    $('.data-preloader-wrapper>div').removeClass('spinner-border');
                    $('.data-preloader-wrapper').removeClass('min-h-400');
                    $('#quickview_modal .product-info').html(data);
                    var modalBody = $('#quickview_modal .modal-body');
                    var productInfoHeight = $('#quickview_modal .product-info').outerHeight();

                    // Điều chỉnh chiều cao của modal-body dựa vào chiều cao nội dung thực tế
                    modalBody.css('height', productInfoHeight + 'px');
                    ProductInfo();
                    cartFunc();
                }, 200);
            });
        }

        $('#quickview_modal').on('hide.bs.modal', function(e) {
            $('#quickview_modal .product-info').html(null);
        });

        function ProductInfo() {
            // Khởi tạo Swiper trước
            var swiperThumbnails = new Swiper('.swiper-thumbnails-box', {
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                breakpoints: {
                    320: {
                        slidesPerView: 3
                    },
                    768: {
                        slidesPerView: 4
                    },
                    992: {
                        slidesPerView: 4
                    }
                }
            });

            var swiperMain = new Swiper('.mySwiperBox', {
                spaceBetween: 10,
                slidesPerView: 1,
                loop: true,
                thumbs: {
                    swiper: swiperThumbnails
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1
                    },
                    768: {
                        slidesPerView: 1
                    },
                    992: {
                        slidesPerView: 1
                    }
                }
            });

            // Khởi tạo Fancybox
            Fancybox.bind("[data-fancybox='gallery']", {
                Carousel: {
                    infinite: false,
                    autoplay: false,
                    transition: "slide"
                },
                Thumbs: {
                    autoStart: true,
                    type: "classic"
                },
                Image: {
                    zoom: false
                },
                loop: false
            });

            // Khởi tạo NiceNumber Input
            if ($('input[type="number').length) {
                $('input[type="number"]').niceNumber({
                    buttonDecrement: '<i class="bi bi-dash"></i>',
                    buttonIncrement: '<i class="bi bi-plus"></i>',
                });
            }
        }
        // Lấy thông  tin biến thể
        function getVariationInfo() {
            if ($('.add-to-cart-form input[name=quantity]').val() > 0 && isValidForAddingToCart()) {
                let data = $('.add-to-cart-form').serializeArray();
                $.ajax({
                    type: "POST",
                    url: "{{ route('showVariationInfo.product') }}",
                    data: data,
                    success: function(response) {
                        $('.all-pricing').addClass('d-none');
                        $('.variation-pricing').removeClass('d-none');
                        $('.variation-pricing').html(response.data.price);

                        $('.add-to-cart-form input[name=product_variation_id]').val(response.data
                            .id);
                        $('.add-to-cart-form input[name=quantity]').prop('max', response.data.stock);

                        if (response.data.stock < 1) {
                            $('.add-to-cart-btn').prop('disabled', true);
                            $('.add-to-cart-btn .add-to-cart-text').html('Hết hàng');
                        } else {
                            $('.add-to-cart-btn').prop('disabled', false);
                            $('.add-to-cart-btn .add-to-cart-text').html('Thêm vào giỏ hàng');
                            $('.qty-increase-decrease input[name=quantity]').val(1);
                        }
                    }
                });
            }
        }

        // Kiểm tra có thể thêm vào giỏ hàng không
        function isValidForAddingToCart() {
            var count = 0;
            $('.variation-for-cart').each(function() {
                // bao nhiêu biến thể
                count++;
            });
            if ($('.product-radio-btn input:radio:checked').length == count) {
                return true;
            }
            return false;
        }

        // giỏ hàng
        function cartFunc() {
            // Chọn biến thể
            $('.product-radio-btn input').on('change', function() {
                getVariationInfo();
            });

            // tăng số lượng
            $('.qty-increase-decrease .increase').on('click', function() {
                var prevValue = $('.product-qty input[name=quantity]').val();
                var maxValue = $('.product-qty input[name=quantity]').attr('max');
                if (maxValue == undefined || parseInt(prevValue) < parseInt(maxValue)) {
                    $('.qty-increase-decrease input[name=quantity]').val(parseInt(prevValue) + 1)
                }
            });

            // giảm số lượng
            $('.qty-increase-decrease .decrease').on('click', function() {
                var prevValue = $('.product-qty input[name=quantity]').val();
                if (prevValue > 1) {
                    $('.qty-increase-decrease input[name=quantity]').val(parseInt(prevValue) - 1)
                }
            });

            // submit form
            $('.add-to-cart-form').on('submit', function(e) {
                e.preventDefault();
                if (isValidForAddingToCart()) {
                    $('.add-to-cart-btn').prop('disabled', true);
                    $('.add-to-cart-btn .add-to-cart-text').html('Đang thêm vào giỏ hàng');

                    // thêm
                    let data = $('.add-to-cart-form').serializeArray();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('carts.add') }}",
                        data: data,
                        success: function(data) {
                            $('.add-to-cart-btn').prop('disabled', false);
                            $('.add-to-cart-btn .add-to-cart-text').html('Thêm vào giỏ hàng');
                            updateCarts(data);
                            notifyMe(data.alert, data.message);
                        }
                    });

                } else {
                    optionsAlert();
                }
            })
        }
        cartFunc();

        function formatPrice(price) {
            return price.toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'đ'
            });
        }

        // handleCartItem
        function handleCartItem(action, id) {
            let data = {
                _token: " {{ csrf_token() }} ",
                action: action,
                id: id,
            };

            $.ajax({
                type: "POST",
                url: "{{ route('carts.update') }}",
                data: data,
                success: function(data) {
                    if (data.success == true) {
                        $('.apply-coupon-btn').removeClass('d-none');
                        $('.clear-coupon-btn').addClass('d-none');
                        $('.apply-coupon-btn').prop('disabled', false);
                        $('.apply-coupon-btn').html('Áp dụng');
                        updateCarts(data);
                        if (action == 'increase' && data.message) {
                            notifyMe(data.alert, data.message);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Lỗi AJAX:", error);
                }
            });
        }
        $('.gshop-header-user').on('submit', function(event) {
            event.preventDefault();
        });
        $('.coupon-form').on('submit', function(e) {
            e.preventDefault();
            $('.apply-coupon-btn').prop('disabled', true);
            $('.apply-coupon-btn').html('Vui lòng chờ');
            let data = $('.coupon-form').serializeArray();
            // Kiểm tra xem có input nào có name là "code" không
            let hasCode = data.some(function(field) {
                return field.name === "code";
            });
            // Nếu không có "code", thì lấy giá trị từ 'input[name="code"].coupon-input'
            if (!hasCode) {
                let couponInput = $('input[name="code"].coupon-input');
                let couponInputValue = couponInput.val();
                data.push({
                    name: "code",
                    value: couponInputValue
                });
            }
            $.ajax({
                type: "POST",
                url: "{{ route('carts.applyCoupon') }}",
                data: data,
                success: function(data) {
                    if (data.success == false) {
                        notifyMe('error', data.message);
                        $('.apply-coupon-btn').prop('disabled', false);
                        $('.apply-coupon-btn').html('Áp dụng');
                    } else {
                        $('.coupon-input').prop('disabled', false);
                        $('.apply-coupon-btn').addClass('d-none');
                        $('.clear-coupon-btn').removeClass('d-none');

                        $('.apply-coupon-btn').prop('disabled', false);
                        $('.apply-coupon-btn').html('Áp dụng');
                        updateCouponPrice(data);

                    }
                }
            });
        })
        $('.clear-coupon-btn').on('click', function(e) {
            e.preventDefault();
            $('.coupon-input').prop('disabled', false);
            $('.apply-coupon-btn').removeClass('d-none');
            $('.clear-coupon-btn').addClass('d-none');
            $.ajax({
                type: "GET",
                url: "{{ route('carts.clearCoupon') }}",
                success: function(data) {
                    updateCouponPrice(data);
                }
            });
        })

        function updateCouponPrice(data) {
            $('.coupon-discount-wrapper').toggleClass('d-none');
            var alert = 'error';
            if (data.message == 'Áp dụng mã giảm giá thành công') {
                alert = 'success';
                $('.coupon-discount-wrapper').empty();
                $('.coupon-discount-wrapper').html(data.coupon);
                if (data.couponCode) {
                    $('.coupon-discount-code').html(data.couponCode);
                }
                if (data.couponDiscount) {
                    $('.coupon-price').html(formatPrice(data.couponDiscount));
                }
                if (data.couponData) {
                    $('.coupon-discount-type').html('-' + data.couponData);
                }
            } else {
                alert = 'error';
            }
            notifyMe(alert, data.message);
        }

        function loadCoupon() {
            let couponInput = $('input[name="code"].coupon-input');

            if (couponInput.length) {
                let couponInputValue = couponInput.val();
                let clearCouponBtn = $('.clear-coupon-btn');
                if (clearCouponBtn.hasClass('d-none')) {
                    couponInput.prop('disabled', false);
                }
                if (couponInputValue) {
                    if (!$('.coupon-discount-wrapper').hasClass('d-none')) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('carts.infoCoupon') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                code: couponInputValue
                            },
                            success: function(data) {
                                if (data.success == true) {
                                    $('.coupon-discount-wrapper').removeClass('d-none');
                                    $('.coupon-discount-wrapper').empty();
                                    $('.coupon-discount-wrapper').html(data.coupon);
                                    if (data.couponCode) {
                                        $('.coupon-discount-code').html(data.couponCode);
                                    }
                                    if (data.couponDiscount) {
                                        $('.coupon-price').html(formatPrice(data.couponDiscount));
                                    }
                                    if (data.couponData) {
                                        $('.coupon-discount-type').html('-' + data.couponData);
                                    }
                                } else {
                                    notifyMe('error', 'Mã giảm giá không tồn tại');
                                }

                            },
                            error: function(xhr, status, error) {
                                console.error("Lỗi:", error);
                            }
                        });
                    }
                }
            }
        }
        loadCoupon();







        function updateCarts(data) {
            $('.cart-counter').empty();
            $('.sub-total-price').empty();

            $('.cart-navbar-wrapper .simplebar-content').empty();
            $('.cart-listing').empty();

            if (data.cartCount > 0) {
                $('.cart-counter').removeClass('d-none');
            } else {
                $('.cart-counter').addClass('d-none');
            }

            $('.cart-counter').html(data.cartCount);
            $('.sub-total-price').html(data.subTotal);
            $('.cart-navbar-wrapper .simplebar-content').html(data.navCarts);
            $('.cart-listing').html(data.carts);
            $('.coupon-discount-wrapper').addClass('d-none');
            $('.checkout-sidebar').empty();

        }
        Array.from(document.querySelectorAll(".scrollbar")).forEach(
            (el) => new SimpleBar(el, {
                autoHide: false,
                classNames: {
                    // defaults
                    content: "simplebar-content",
                    scrollContent: "simplebar-scroll-content",
                    scrollbar: "simplebar-scrollbar",
                    track: "simplebar-track",
                },
            })
        );
    </script>
</body>

</html>
