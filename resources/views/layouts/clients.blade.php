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

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"
        integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .title-limit {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
        }

        .title-limit-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
        }

        .service .list {
            width: 100%;
        }

        .service .nice-select {
            color: #a2a2a2;
            font-family: var(--font-cabin);
            background: rgba(255, 255, 255, .6);
            border: 1px solid rgba(0, 29, 35, .1);
            border-radius: 5px;
        }

        .inner-page-banner .banner-content h1 {
            font-size: 2.375rem !important;
        }

        .dropdown-main {
            width:200px!important;
            list-style-type: none!important;
            margin: 0!important;
        }

        .dropdown-main ul {
            width:100%!important;
            flex-direction: column;
            display: flex;
        }

        .dropdown-main li {
            width:100%!important;
            display: block!important;
        }

        .dropdown-main li a {
            width:100%!important;
            height:100%!important;
            text-decoration: none!important;
            padding: 10px!important;
            display: block!important;
            color: white!important;
            border:none!important;
            background:none!important;
            border-radius: 4px!important;
            transition: background-color 0.3s!important;
        }

        .dropdown-main li a:hover {
            background-color: var(--primary-color3)!important;
        }
    </style>
    <style>
        input[aria-describedby$="error"][aria-invalid="true"] {
            border: 1px solid red;
            background: rgb(250 190 190 / 5%);
        }

        .error-help-block {
            align-items: start;
            display: flex;
            color: #f56c6c;
            justify-content: flex-start;
            text-align: left;
            margin: 0;
            padding: 0;
            width: 100%;
            box-sizing: border-box;

        }

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

        .container_partner .swiper-slide {
            background: none !important;
        }

        .container_partner .swiper-slide {
            -webkit-flex-shrink: 0;
            -ms-flex-negative: 0;
            flex-shrink: 0;
            width: 100%;
            height: 100%;
            position: relative;
            -webkit-transition-property: -webkit-transform;
            transition-property: -webkit-transform;
            transition-property: transform;
            transition-property: transform, -webkit-transform;
            display: block;
        }
    </style>

    @yield('css')
</head>

<body class="home-pages-2">

    @include('clients.blocks.header')

    @yield('content')

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
    </script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
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
</body>

</html>
