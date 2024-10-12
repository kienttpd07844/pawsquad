@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/quill/editor.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/dropzone/dropzone.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/shepherd/shepherd.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-1">Sửa email</h4>
                    <a href="#" id="question" class="btn btn-link text-primary">
                        <i class="fas fa-question"></i>
                    </a>
                </div>

            </div>
            <form id="form-validate" method="POST">
                <div class="row ">
                    <div class="col-12 order-1">
                        <div class="card mb-6 ">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Thông tin</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-6">
                                    <label class="form-label" for="ecommerce-product-name">Nội dung</label>
                                    <textarea class="editor w-100 h-100" name="content">
                                        <div dir="ltr" class="es-wrapper-color" lang="vi" style="background-color:#FAFAFA">
                                            <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" role="none"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#FAFAFA">
                                                <tr>
                                                    <td valign="top" style="padding:0;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" class="es-header" align="center" role="none"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
                                                            <tr>
                                                                <td align="center" style="padding:0;Margin:0">
                                                                    <table bgcolor="#ffffff" class="es-header-body" align="center" cellpadding="0"
                                                                        cellspacing="0" role="none"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px">
                                                                        <tr>
                                                                            <td align="left" style="padding:20px;Margin:0">
                                                                                <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                    <tr>
                                                                                        <td class="es-m-p0r" valign="top" align="center"
                                                                                            style="padding:0;Margin:0;width:560px">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%"
                                                                                                role="none"
                                                                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tr>
                                                                                                    <td align="center"
                                                                                                        style="padding:0;Margin:0;display:none"></td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                                            <tr>
                                                                <td align="center" style="padding:0;Margin:0">
                                                                    <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0"
                                                                        cellspacing="0" role="none"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                                                                        <tr>
                                                                            <td align="left"
                                                                                style="padding:0;Margin:0;padding-top:15px;padding-left:20px;padding-right:20px">
                                                                                <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                    <tr>
                                                                                        <td align="center" valign="top"
                                                                                            style="padding:0;Margin:0;width:560px">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%"
                                                                                                role="presentation"
                                                                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tr>
                                                                                                    <td align="center"
                                                                                                        style="padding:0;Margin:0;padding-bottom:10px;font-size:0px">
                                                                                                        <img src="https://i.imgur.com/b6tuVc7.png"
                                                                                                            alt="{{ env('APP_NAME') }}"
                                                                                                            style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;font-size:12px"
                                                                                                            width="100" title="{{ env('APP_NAME') }}">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align="center" class="es-m-p0r es-m-p0l es-m-txt-c"
                                                                                                        style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:40px;padding-right:40px">
                                                                                                        <h1
                                                                                                            style="Margin:0;line-height:40px;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:33px;font-style:normal;font-weight:bold;color:#333333">
                                                                                                            Khôi phục mật khẩu</h1>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align="left"
                                                                                                        style="padding:0;Margin:0;padding-top:10px">
                                                                                                        <p
                                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                                            Chúng tôi đã gửi đường dẫn thay đổi mật khẩu đến
                                                                                                            email của bạn để giúp bạn đăng nhập lại vào Tài
                                                                                                            khoản {{ env('APP_NAME') }}. Vui lòng nhấn vào
                                                                                                            nút bên
                                                                                                            dưới để thay đổi mật khẩu:</p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left"
                                                                                style="padding:0;Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px">
                                                                                <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                    <tr>
                                                                                        <td align="center" valign="top"
                                                                                            style="padding:0;Margin:0;width:560px">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%"
                                                                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-radius:5px"
                                                                                                role="presentation">
                                                                                                <tr>
                                                                                                    <td align="center"
                                                                                                        style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px">
                                                                                                        <span class="es-button-border"
                                                                                                            style="border-style:solid;border-color:#2CB543;background:#d8188f;border-width:0px;display:inline-block;border-radius:6px;width:auto"><a
                                                                                                                href="a"
                                                                                                                class="es-button" target="_blank"
                                                                                                                style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:16px;padding:10px 30px 10px 30px;display:inline-block;background:#d8188f;border-radius:6px;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:19px;width:auto;text-align:center;mso-padding-alt:0;mso-border-alt:10px solid #D8188F;padding-left:30px;padding-right:30px">Thay
                                                                                                                đổi mật khẩu</a></span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align="center" class="es-m-txt-c"
                                                                                                        style="padding:0;Margin:0;padding-top:10px">
                                                                                                        <h4
                                                                                                            style="Margin:0;line-height:17px;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;font-style:normal;font-weight:bold;color:#333333;text-align:left">
                                                                                                            Hoặc truy cập đường dẫn: <a target="_blank"
                                                                                                                style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#5C68E2;font-size:14px;text-align:left"
                                                                                                                href="a">a</a>
                                                                                                        </h4>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align="center" class="es-m-txt-c"
                                                                                                        style="padding:0;Margin:0;padding-top:10px">
                                                                                                        <h4
                                                                                                            style="Margin:0;line-height:26px;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:17px;font-style:normal;font-weight:bold;color:#333333">
                                                                                                            Liên kết sẽ hết hạn sau 1 giờ.&nbsp;</h4>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align="left"
                                                                                                        style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px">
                                                                                                        <p
                                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                                            <strong>Bạn không biết vì sao mình nhận được
                                                                                                                mail này?</strong>
                                                                                                        </p>
                                                                                                        <p
                                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                                            <br>
                                                                                                        </p>
                                                                                                        <p
                                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                                            Một người khác không nhớ được mật khẩu Tài khoản
                                                                                                            {{ env('APP_NAME') }} của họ có thể đã cung cấp
                                                                                                            nhầm địa
                                                                                                            chỉ email của bạn. Bạn có thể bỏ qua email này
                                                                                                            mà không sợ gặp rủi ro gì.</p>
                                                                                                        <p
                                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                                            <br>
                                                                                                        </p>
                                                                                                        <p
                                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                                            Để bảo vệ tài khoản của bạn, đừng chuyển tiếp
                                                                                                            email này hoặc cung cấp đường dẫn này cho bất kỳ
                                                                                                            ai.</p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align="center" style="padding:0;Margin:0">
                                                                                                        <p
                                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                                            <a target="_blank" href=""
                                                                                                                style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#5C68E2;font-size:14px"></a>
                                                                                                                {{ env('APP_NAME') }}
                                                                                                        </p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table cellpadding="0" cellspacing="0" class="es-footer" align="center" role="none"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
                                                            <tr>
                                                                <td align="center" style="padding:0;Margin:0">
                                                                    <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"
                                                                        role="none">
                                                                        <tr>
                                                                            <td align="left"
                                                                                style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px">
                                                                                <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                    <tr>
                                                                                        <td align="left" style="padding:0;Margin:0;width:560px">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%"
                                                                                                role="none"
                                                                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tr>
                                                                                                    <td align="center"
                                                                                                        style="padding:0;Margin:0;display:none"></td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                                            <tr>
                                                                <td class="es-info-area" align="center" style="padding:0;Margin:0">
                                                                    <table class="es-content-body" align="center" cellpadding="0" cellspacing="0"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"
                                                                        bgcolor="#FFFFFF" role="none">
                                                                        <tr>
                                                                            <td align="left" style="padding:20px;Margin:0">
                                                                                <table cellpadding="0" cellspacing="0" width="100%" role="none"
                                                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                    <tr>
                                                                                        <td align="center" valign="top"
                                                                                            style="padding:0;Margin:0;width:560px">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%"
                                                                                                role="none"
                                                                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tr>
                                                                                                    <td align="center"
                                                                                                        style="padding:0;Margin:0;display:none"></td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        {!! html_decode(old('content', $data->content)) !!}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 order-3">
                        <div class="d-flex align-content-center flex-wrap gap-4">
                            @csrf
                            @method('PUT')
                            <button type="submit" id="save" class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('js')

    <script src="{{ asset('assets/admin/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/select2/select2.js') }}"></script>

    <script src="{{ asset('assets/admin/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('assets/admin/js/app-ecommerce-product-add.js') }}?v=1"></script>
    <script src="{{ asset('assets/admin/vendor/libs/shepherd/shepherd.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

    <script>
        $(document).ready(function() {



            const startBtn = document.querySelector('#question');
            const tourSteps = [{
                    title: 'Tên danh mục',
                    text: 'Đây có thể là thể loại game hoặc tên thể loại con. Ví dụ: Liên Quân VIP',
                    element: '[name="name"]'
                },
                {
                    title: 'Hiển thị',
                    text: 'Nếu muốn ẩn hoặc hiện thì nhấn vào đây',
                    element: '.status'
                },
                {
                    title: 'Danh mục',
                    text: 'Tại đây bạn có thể chọn một danh mục con từ danh sách. Nếu không chọn một danh mục con cụ thể, hệ thống sẽ sử dụng danh mục chính mặc định.',
                    element: '[name="category"]'
                },
                {
                    title: 'Hiển thị ngoài trang chủ',
                    text: 'Nếu bạn muốn danh mục này hiển thị ngoài trang chủ.',
                    element: '[name="show_on_homepage"]'
                },
                {
                    title: 'Hình ảnh',
                    text: 'Ảnh đại diện (thumbnail) của danh mục',
                    element: '[name="img"]'
                },
                {
                    title: 'Meta Title',
                    text: 'Meta Title là tiêu đề chính của trang web bạn. Nó xuất hiện trên tab của trình duyệt và trong kết quả tìm kiếm của các công cụ tìm kiếm như Google. Tiêu đề này nên ngắn gọn, mô tả chính xác nội dung của trang và bao gồm từ khóa quan trọng.',
                    element: '[name="meta_title"]'
                },
                {
                    title: 'Meta Description',
                    text: 'Meta Description là mô tả ngắn gọn về nội dung của trang web. Nó thường xuất hiện dưới tiêu đề trong kết quả tìm kiếm và giúp người dùng quyết định có nên nhấp vào liên kết hay không. Mô tả nên bao gồm từ khóa và khuyến khích người dùng nhấp vào liên kết của bạn.',
                    element: '[name="meta_description"]'
                },
                {
                    title: 'Meta Keyword',
                    text: 'Meta Keywords là danh sách từ khóa liên quan đến nội dung của trang. Dù hiện tại ít được các công cụ tìm kiếm sử dụng, nhưng việc khai báo từ khóa giúp bạn quản lý và tổ chức nội dung tốt hơn. Hãy nhập các từ khóa quan trọng mà bạn muốn trang của mình được tìm thấy khi người dùng tìm kiếm.',
                    element: '[name="meta_keyword"]'
                },
                {
                    title: 'Lưu',
                    text: 'Sau khi hoàn tất những thông tin thì lưu lại.',
                    element: '#save'
                }
            ];

            function setupTour(tour) {
                const backBtnClass = 'btn btn-sm btn-label-secondary md-btn-flat waves-effect waves-light',
                    nextBtnClass = 'btn btn-sm btn-primary btn-next waves-effect waves-light';

                tourSteps.forEach(step => {
                    tour.addStep({
                        title: step.title,
                        text: step.text,
                        attachTo: {
                            element: step.element,
                            on: 'top' // Đặt vị trí mặc định là 'top'
                        },
                        buttons: [{
                                text: 'Bỏ qua',
                                classes: backBtnClass,
                                action: tour.cancel
                            },
                            {
                                text: 'Quay lại',
                                classes: backBtnClass,
                                action: tour.back
                            },
                            {
                                text: 'Tiếp',
                                classes: nextBtnClass,
                                action: tour.next
                            }
                        ]
                    });
                });

                return tour;
            }

            if (startBtn) {
                startBtn.onclick = function() {
                    const tourVar = new Shepherd.Tour({
                        defaultStepOptions: {
                            scrollTo: false,
                            cancelIcon: {
                                enabled: true
                            }
                        },
                        useModalOverlay: true
                    });

                    setupTour(tourVar).start();
                };
            }

            const images_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();

                xhr.withCredentials = false;

                xhr.open('POST', "{{ route('admin.file.uploadImage1') }}");

                xhr.upload.onprogress = (e) => {
                    progress(e.loaded / e.total * 100);
                };

                xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]')
                    .getAttribute(
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
                selector: '.editor',
                language: 'vi',
                plugins: 'print advtemplate  preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                toolbar_sticky: true,
                menubar: false,
                setup: function(editor) {
                    editor.on('change', function() {
                        editor.getDoc().body.style.height = 'auto';
                        editor.getDoc().body.style.height = editor.getDoc().body.scrollHeight +
                            'px';
                    });
                },
                editable_root: true,
                editable_class: 'tiny-editable',
                elementpath: false,
                visual: false,
                link_target_list: false,
                object_resizing: false,
                formats: {
                    h1: {
                        block: 'h1',
                        styles: {
                            fontSize: '24px',
                            color: '#335dff'
                        }
                    },
                    h2: {
                        block: 'h2',
                        styles: {
                            fontSize: '20px'
                        }
                    },
                    largetext: {
                        block: 'p',
                        styles: {
                            fontSize: '20px'
                        }
                    },
                    calltoaction: {
                        selector: 'a',
                        styles: {
                            backgroundColor: '#335dff',
                            padding: '12px 16px',
                            color: '#ffffff',
                            borderRadius: '4px',
                            textDecoration: 'none',
                            display: 'inline-block'
                        }
                    }
                },
                style_formats: [{
                        title: 'Paragraph',
                        format: 'p'
                    },
                    {
                        title: 'Heading 1',
                        format: 'h1'
                    },
                    {
                        title: 'Heading 2',
                        format: 'h2'
                    },
                    {
                        title: 'Large text',
                        format: 'largetext'
                    },
                    {
                        title: 'Button styles'
                    },
                    {
                        title: 'Call-to-action',
                        format: 'calltoaction'
                    },
                ],
                images_upload_handler: images_upload_handler,
                images_file_types: "jpeg,jpg,png,gif,webp",
                spellchecker_ignore_list: ['i.e', 'Mailchimp', 'CSS-inlined'],
                mergetags_list: [{
                        title: "Contact",
                        menu: [{
                                value: 'Contact.FirstName',
                                title: 'Contact First Name'
                            },
                            {
                                value: 'Contact.LastName',
                                title: 'Contact Last Name'
                            },
                            {
                                value: 'Contact.Email',
                                title: 'Contact Email'
                            }
                        ]
                    },
                    {
                        title: "Sender",
                        menu: [{
                                value: 'Sender.FirstName',
                                title: 'Sender First Name'
                            },
                            {
                                value: 'Sender.LastName',
                                title: 'Sender Last name'
                            },
                            {
                                value: 'Sender.Email',
                                title: 'Sender Email'
                            }
                        ]
                    },
                    {
                        title: 'Subscription',
                        menu: [{
                                value: 'Subscription.UnsubscribeLink',
                                title: 'Unsubscribe Link'
                            },
                            {
                                value: 'Subscription.Preferences',
                                title: 'Subscription Preferences'
                            }
                        ]
                    }
                ],
                advtemplate_templates: [{
                        title: "Newsletter intro",
                        content: '<h1 style="font-size: 24px; color: rgb(51, 93, 255); font-family:Arial;">TinyMCE Newsletter</h1>\n<p style="font-family:Arial;">Welcome to your monthly digest of all things TinyMCE, where you&quot;ll find helpful tips, how-tos, and stories of how people are using rich text editing to bring their apps to new heights!</p>',
                    },
                    {
                        title: "CTA Button",
                        content: '<p><a style="background-color: rgb(51, 93, 255); padding: 12px 16px; color: rgb(255, 255, 255); border-radius: 4px; text-decoration: none; display: inline-block; font-family:Arial;" href="https://tiny.cloud/pricing">Get started with your 14-day free trial</a></p>',
                    },
                    {
                        title: "Footer",
                        content: '<p style="text-align: center; font-size: 10px; font-family:Arial;">You received this email at because you previously subscribed.</p>\n<p style="text-align: center; font-size: 10px; font-family:Arial;">{Subscription.Preferences} | {Subscription.UnsubscribeLink}</p>',
                    },
                ],
                content_style: `
                    body {
                        background-color: #f9f9fb;
                    }

                    /* Edit area functional css */
                    .tiny-editable {
                        position: relative;
                    }
                    .tiny-editable:hover:not(:focus),
                    .tiny-editable:focus {
                        outline: 3px solid #b4d7ff;
                        outline-offset: 4px;
                    }

                    /* Create an edit placeholder */
                    .tiny-editable:empty::before,
                    .tiny-editable:has(> br[data-mce-bogus]:first-child)::before {
                        content: "Write here...";
                        position: absolute;
                        top: 0;
                        left: 0;
                        color: #999;
                    }
                    `
            });
        });
    </script>
@endsection
