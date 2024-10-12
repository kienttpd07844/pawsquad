<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="{{ asset('assets/admin') }}/" data-template="vertical-menu-template"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Admin</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/admin/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->

    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/rtl/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />

    <link rel="stylesheet" href="{{ asset('assets/admin/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/node-waves/node-waves.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css')

    <script src="{{ asset('assets/admin/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/admin/js/config.js') }}"></script>


    <style>
        .fancybox__container {
            z-index: 99999;
        }

        .swal2-container {
            z-index: 999999;
        }

        /* .mb-6:has(.error-help-block) input[aria-describedby$="error"],
        textarea[aria-describedby$="error"] {
            border: 1px solid #f56c6c;
        }

        input[aria-describedby$="error"][aria-invalid="false"],
        textarea[aria-describedby$="error"][aria-invalid="false"] {
            border: var(--bs-border-width) solid #d1d0d4!important;
        } */
        input[aria-describedby$="error"][aria-invalid="true"] {
            border: 1px solid red;
            background: rgb(250 190 190 / 5%);
        }

        /* .error-help-block {
            color: red;
        } */

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

        .mce-content-body {
            max-width: 100%;
        }

        .mce-content-body img {
            width: 100%;
        }

        .dz-thumbnail img,
        .dz-thumbnail .dz-nopreview {
            top: 50%;
            position: relative;
            transform: translateY(-50%) scale(1);
            margin: 0 auto;
            display: block;
        }

        .dz-thumbnail img {
            max-height: 100%;
            max-width: 100%;
        }
    </style>
    <style>
        .tox-statusbar__branding{
            display:none!important;
        }
        tr td[class*="footable-"][class$="-visible"]:not(.footable-last-visible) {
            display: flex !important;
        }

        .tables> :not(caption)>*>* {
            padding: 0.5rem 0.5rem;
            background-color: transparent;
            border-bottom-width: 1px;
            -webkit-box-shadow: inset 0 0 0 9999px transparent;
            box-shadow: inset 0 0 0 9999px transparent;
        }

        table.footable-details,
        table.footable>thead>tr.footable-filtering>th div.form-group {
            margin-bottom: 0;
        }

        table.footable,
        table.footable-details {
            position: relative;
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
        }

        table.footable-hide-fouc {
            display: none;
        }

        table>tbody>tr>td>span.footable-toggle {
            margin-right: 8px;
            opacity: 0.3;
        }

        table>tbody>tr>td>span.footable-toggle.last-column {
            margin-left: 8px;
            float: right;
        }

        table.table-condensed>tbody>tr>td>span.footable-toggle {
            margin-right: 5px;
        }

        table.footable-details>tbody>tr>th:nth-child(1) {
            min-width: 40px;
            width: 120px;
        }

        table.footable-details>tbody>tr>td:nth-child(2) {
            word-break: break-all;
        }

        table.footable-details>tbody>tr:first-child>td,
        table.footable-details>tbody>tr:first-child>th,
        table.footable-details>tfoot>tr:first-child>td,
        table.footable-details>tfoot>tr:first-child>th,
        table.footable-details>thead>tr:first-child>td,
        table.footable-details>thead>tr:first-child>th {
            border-top-width: 0;
        }

        table.footable-details.table-bordered>tbody>tr:first-child>td,
        table.footable-details.table-bordered>tbody>tr:first-child>th,
        table.footable-details.table-bordered>tfoot>tr:first-child>td,
        table.footable-details.table-bordered>tfoot>tr:first-child>th,
        table.footable-details.table-bordered>thead>tr:first-child>td,
        table.footable-details.table-bordered>thead>tr:first-child>th {
            border-top-width: 1px;
        }

        div.footable-loader {
            vertical-align: middle;
            text-align: center;
            height: 300px;
            position: relative;
        }

        div.footable-loader>span.fooicon {
            display: inline-block;
            opacity: 0.3;
            font-size: 30px;
            line-height: 32px;
            width: 32px;
            height: 32px;
            margin-top: -16px;
            margin-left: -16px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-animation: fooicon-spin-r 2s infinite linear;
            animation: fooicon-spin-r 2s infinite linear;
        }

        table.footable>tbody>tr.footable-empty>td {
            vertical-align: middle;
            text-align: center;
            font-size: 30px;
        }

        table.footable>tbody>tr>td,
        table.footable>tbody>tr>th {
            display: none;
        }

        table.footable>tbody>tr.footable-detail-row>td,
        table.footable>tbody>tr.footable-detail-row>th,
        table.footable>tbody>tr.footable-empty>td,
        table.footable>tbody>tr.footable-empty>th {
            display: table-cell;
        }

        table.footable>thead>tr.footable-filtering>th {
            border-bottom-width: 1px;
            font-weight: 400;
        }

        .footable-filtering-external.footable-filtering-right,
        table.footable.footable-filtering-right>thead>tr.footable-filtering>th,
        table.footable>thead>tr.footable-filtering>th {
            text-align: right;
        }

        .footable-filtering-external.footable-filtering-left,
        table.footable.footable-filtering-left>thead>tr.footable-filtering>th {
            text-align: left;
        }

        .footable-filtering-external.footable-filtering-center,
        .footable-paging-external.footable-paging-center,
        table.footable-paging-center>tfoot>tr.footable-paging>td,
        table.footable.footable-filtering-center>thead>tr.footable-filtering>th,
        table.footable>tfoot>tr.footable-paging>td {
            text-align: center;
        }

        table.footable>thead>tr.footable-filtering>th div.form-group+div.form-group {
            margin-top: 5px;
        }

        table.footable>thead>tr.footable-filtering>th div.input-group {
            width: 100%;
        }

        .footable-filtering-external ul.dropdown-menu>li>a.checkbox,
        table.footable>thead>tr.footable-filtering>th ul.dropdown-menu>li>a.checkbox {
            margin: 0;
            display: block;
            position: relative;
        }

        .footable-filtering-external ul.dropdown-menu>li>a.checkbox>label,
        table.footable>thead>tr.footable-filtering>th ul.dropdown-menu>li>a.checkbox>label {
            display: block;
            padding-left: 20px;
        }

        .footable-filtering-external ul.dropdown-menu>li>a.checkbox input[type="checkbox"],
        table.footable>thead>tr.footable-filtering>th ul.dropdown-menu>li>a.checkbox input[type="checkbox"] {
            position: absolute;
            margin-left: -20px;
        }

        @media (min-width: 768px) {
            table.footable>thead>tr.footable-filtering>th div.input-group {
                width: auto;
            }

            table.footable>thead>tr.footable-filtering>th div.form-group {
                margin-left: 2px;
                margin-right: 2px;
            }

            table.footable>thead>tr.footable-filtering>th div.form-group+div.form-group {
                margin-top: 0;
            }
        }

        table.footable>tbody>tr>td.footable-sortable,
        table.footable>tbody>tr>th.footable-sortable,
        table.footable>tfoot>tr>td.footable-sortable,
        table.footable>tfoot>tr>th.footable-sortable,
        table.footable>thead>tr>td.footable-sortable,
        table.footable>thead>tr>th.footable-sortable {
            position: relative;
            padding-right: 30px;
            cursor: pointer;
        }

        td.footable-sortable>span.fooicon,
        th.footable-sortable>span.fooicon {
            position: absolute;
            right: 6px;
            top: 50%;
            margin-top: -7px;
            opacity: 0;
            -webkit-transition: opacity 0.3s ease-in;
            transition: opacity 0.3s ease-in;
        }

        td.footable-sortable.footable-asc>span.fooicon,
        td.footable-sortable.footable-desc>span.fooicon,
        td.footable-sortable:hover>span.fooicon,
        th.footable-sortable.footable-asc>span.fooicon,
        th.footable-sortable.footable-desc>span.fooicon,
        th.footable-sortable:hover>span.fooicon {
            opacity: 1;
        }

        table.footable-sorting-disabled td.footable-sortable.footable-asc>span.fooicon,
        table.footable-sorting-disabled td.footable-sortable.footable-desc>span.fooicon,
        table.footable-sorting-disabled td.footable-sortable:hover>span.fooicon,
        table.footable-sorting-disabled th.footable-sortable.footable-asc>span.fooicon,
        table.footable-sorting-disabled th.footable-sortable.footable-desc>span.fooicon,
        table.footable-sorting-disabled th.footable-sortable:hover>span.fooicon {
            opacity: 0;
            visibility: hidden;
        }

        .footable-paging-external ul.pagination,
        table.footable>tfoot>tr.footable-paging>td>ul.pagination {
            margin: 10px 0 0;
        }

        .footable-paging-external span.label,
        table.footable>tfoot>tr.footable-paging>td>span.label {
            display: inline-block;
            margin: 0 0 10px;
            padding: 4px 10px;
        }

        .footable-paging-external.footable-paging-left,
        table.footable-paging-left>tfoot>tr.footable-paging>td {
            text-align: left;
        }

        .footable-paging-external.footable-paging-right,
        table.footable-editing-right td.footable-editing,
        table.footable-editing-right tr.footable-editing,
        table.footable-paging-right>tfoot>tr.footable-paging>td {
            text-align: right;
        }

        ul.pagination>li.footable-page {
            display: none;
        }

        ul.pagination>li.footable-page.visible {
            display: inline;
        }

        td.footable-editing {
            width: 90px;
            max-width: 90px;
        }

        table.footable-editing-no-delete td.footable-editing,
        table.footable-editing-no-edit td.footable-editing,
        table.footable-editing-no-view td.footable-editing {
            width: 70px;
            max-width: 70px;
        }

        table.footable-editing-no-delete.footable-editing-no-view td.footable-editing,
        table.footable-editing-no-edit.footable-editing-no-delete td.footable-editing,
        table.footable-editing-no-edit.footable-editing-no-view td.footable-editing {
            width: 50px;
            max-width: 50px;
        }

        table.footable-editing-no-edit.footable-editing-no-delete.footable-editing-no-view td.footable-editing,
        table.footable-editing-no-edit.footable-editing-no-delete.footable-editing-no-view th.footable-editing {
            width: 0;
            max-width: 0;
            display: none !important;
        }

        table.footable-editing-left td.footable-editing,
        table.footable-editing-left tr.footable-editing {
            text-align: left;
        }

        table.footable-editing button.footable-add,
        table.footable-editing button.footable-hide,
        table.footable-editing-show button.footable-show,
        table.footable-editing.footable-editing-always-show button.footable-hide,
        table.footable-editing.footable-editing-always-show button.footable-show,
        table.footable-editing.footable-editing-always-show.footable-editing-no-add tr.footable-editing {
            display: none;
        }

        table.footable-editing.footable-editing-always-show button.footable-add,
        table.footable-editing.footable-editing-show button.footable-add,
        table.footable-editing.footable-editing-show button.footable-hide {
            display: inline-block;
        }

        .footable-first-visible.text-start {
            padding-left: 1.5rem;
        }

        .footable-last-visible.text-end {
            padding-right: 1.5rem;
        }

        div.footable-loader>span.fooicon {
            border: 4px solid #4eb529;
            border-right-color: rgba(0, 0, 0, 0);
            border-radius: 50%;
        }

        div.footable-loader>span.fooicon:before,
        div.footable-loader>span.fooicon:after {
            content: none;
        }

        table.footable>tbody>tr.footable-empty>td {
            vertical-align: middle;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
        }

        .tt-footable-border-0 tbody,
        .tt-footable-border-0 tfoot,
        .tt-footable-border-0 tr:not(thead tr),
        .tt-footable-border-0 td:not(thead td),
        .tt-footable-border-0 th:not(thead th) {
            border: none !important;
        }

        table>tbody>tr>td>span.footable-toggle {
            opacity: 1;
            font-size: 15px;
            width: 18px;
            height: 18px;
            line-height: 18px;
            text-align: center;
            background: #4eb529;
            color: #fff;
            border: 0;
            border-radius: 0.25rem;
            font-weight: 700;
        }

        .footable-header th {
            border-top: none;
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('admin.blocks.menu')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('admin.blocks.nav')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    @yield('content')
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('admin.blocks.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('assets/admin/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/admin/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/admin/js/app-ecommerce-dashboard.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/38ae9ba0wriqvw8vp3verlh18yjjenvdqk5fsgbbhso2pbzl/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        function limitText(text, limit = 100, end = '...') {
            if (typeof text !== 'string') {
                return '';
            }
            if (text.length <= limit) {
                return text;
            }
            return text.substring(0, limit).trimEnd() + end;
        }

        var useDarkMode = window.matchMedia('(prefers-color-scheme: light)').matches;
        const images_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();

            xhr.withCredentials = false;

            xhr.open('POST', "{{ route('admin.file.uploadImage1') }}");

            xhr.upload.onprogress = (e) => {
                progress(e.loaded / e.total * 100);
            };

            xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content'));

            xhr.onload = () => {
                if (xhr.status === 403) {
                    reject({
                        message: 'HTTP Error: ' + xhr.status,
                        remove: true
                    });
                    return;
                }

                if (xhr.status < 200 || xhr.status >= 300) {
                    reject('HTTP Error: ' + xhr.status);
                    return;
                }

                const json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    reject('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                resolve(json.location);
            };

            xhr.onerror = () => {
                reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };
            const formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            formData.append('tinymce', true);
            xhr.send(formData);
        });
        tinymce.init({
            selector: 'textarea.tsonit',
            language: 'vi',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor insertdatetime advlist lists wordcount  noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '10s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            content_css: [
                "writer",
                "{{ asset('assets/admin/css/tiny.css') }}"
            ],
            image_class_list: [{
                    title: 'None',
                    value: ''
                },
                {
                    title: 'Some class',
                    value: 'class-name'
                }
            ],
            importcss_append: true,
            images_upload_handler: images_upload_handler,
            templates: [{
                    title: 'New Table',
                    description: 'creates a new table',
                    content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                },
                {
                    title: 'Starting my story',
                    description: 'A cure for writers block',
                    content: 'Once upon a time...'
                },
                {
                    title: 'New list with dates',
                    description: 'New List with dates',
                    content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 400,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image table',
            skin: useDarkMode ? 'oxide-dark' : 'oxide',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
    <script>
        "use strict"

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
            console.log('a')
            notifyMe('{{ session('alert-type') }}', '{{ session('message') }}')
        @endif

        @if (session()->has('flash_notification'))
            @foreach (session('flash_notification', collect())->toArray() as $message)
                notifyMe("{{ $message['level'] }}", "{{ $message['message'] }}");
            @endforeach
            {{ session()->forget('flash_notification') }}
        @endif
        @php
            $error_count = 0;
        @endphp

        @if (session('success_message'))
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: @json(session('success_message'))
            });
        @endif

        @if (session('error_message'))
            @php
                $errors = session('error_message');
            @endphp

            @if ($errors instanceof \Illuminate\Support\MessageBag)
                @foreach ($errors->all() as $error)
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: @json($error)
                    });
                @endforeach
            @elseif (is_string($errors))
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: @json($errors)
                });
            @else
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: @json(var_export($errors, true))
                });
            @endif
        @endif


        function getImage(image, type = 'default') {
            const basePath = "{{ env('APP_URL') }}";
            const defaultImage = 'public/assets/clients/uploads/default/abf94830_nSTKZ6jEZm.webp';
            if (type === 'none') {
                return basePath + '/' + defaultImage;
            }
            if (image.startsWith('/')) {
                return basePath + image;
            } else {
                return basePath + '/' + image;
            }
        }

        function format_date(dateString) {
            const date = new Date(dateString);
            if (isNaN(date.getTime())) {
                return 'Invalid';
            }
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();

            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');

            if (dateString.includes(':')) {
                return `${day}/${month}/${year} ${hours}:${minutes}`;
            }

            return `${day}/${month}/${year}`;
        }

        function ChangeToSlug() {
            var title, slug;
            //Lấy text từ thẻ input title
            title = document.getElementById("title").value;
            //Đổi chữ hoa thành chữ thường
            slug = title.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('slug').value = slug;
        }
    </script>
    @yield('js')
</body>

</html>
