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
