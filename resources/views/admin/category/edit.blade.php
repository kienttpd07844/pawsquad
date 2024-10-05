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
                    <h4 class="mb-1">Sửa danh mục sản phẩm</h4>
                    <a href="#" id="question" class="btn btn-link text-primary">
                        <i class="fas fa-question"></i>
                    </a>
                </div>

            </div>
            <form id="form-validate" method="POST">
                <div class="row ">
                    <div class="col-12 col-lg-8 order-1">
                        <div class="card mb-6 ">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Thông tin</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-6">
                                    <label class="form-label" for="ecommerce-product-name">Tên</label>
                                    <input type="text" class="form-control" id="ecommerce-product-name"
                                        placeholder="Tên danh mục" name="name" aria-label="Tên danh mục"
                                        value="{{ old('name', $data->name) }}" />
                                </div>

                                <div class="align-items-center border-top pt-2 status">
                                    <span class="mb-0 me-3">Hiển thị</span>
                                    <label class="switch switch-square">
                                        <input type="checkbox" name="status" class="switch-input"
                                            {{ old('status', $data->status) ? 'checked' : '' }}>
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on"><i class="ti ti-check"></i></span>
                                            <span class="switch-off"><i class="ti ti-x"></i></span>
                                        </span>
                                    </label>
                                </div>

                                <div class="mb-6 border-top pt-2 mt-2">
                                    <label class="form-label" for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control" placeholder="Meta Title" name="meta_title"
                                        value="{{ old('meta_title', $data->meta_title) }}" />
                                </div>
                                <div class="mb-6">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control" rows="3" name="meta_description">{{ old('meta_description', $data->meta_description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 order-2">
                        <div class="card mb-6 ">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 card-title">Chi tiết</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-6">
                                    <label class="form-label mb-1" for="category"> Danh mục </label>
                                    <select id="category" class="select2 form-select" data-placeholder="Chọn danh mục"
                                        name="category">
                                        <option value="">Chọn danh mục</option>
                                        @forelse($categories as $row)
                                            <option value="{{ $row->id }}"
                                                {{ old('category', $data->parent_id) == $row->id ? 'selected' : '' }}>
                                                {{ $row->name }}
                                            </option>
                                        @empty
                                            <option value="" disabled>Không có danh mục</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mb-6">
                                    <label class="mb-1">Hình ảnh</label>
                                    <div class="dropzone needsclick p-0" id="dropzone-category" data-type="avatar">
                                        <div class="dz-message needsclick">
                                            <p class="h4 needsclick pt-3 mb-2">Kéo thả ảnh vào đây</p>
                                            <p class="h6 text-muted d-block fw-normal mb-2">hoặc</p>
                                            <span class="note needsclick btn btn-sm btn-label-primary" id="btnBrowse">Tải
                                                ảnh lên</span>
                                        </div>
                                    </div>
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

    {!! JsValidator::formRequest('App\Http\Requests\Admin\CategoryRequestAdmin') !!}
    <script>
        $(document).ready(function() {

            const previewTemplate = `<div class="dz-preview dz-file-preview">
                <div class="dz-details">
                <div class="dz-thumbnail">
                    <a href="#" data-fancybox="gallery" data-dz-thumbnail><img data-dz-thumbnail></a>
                    <span class="dz-nopreview">Không có xem trước</span>
                    <div class="dz-success-mark"></div>
                    <div class="dz-error-mark"></div>
                    <div class="dz-error-message"><span data-dz-errormessage></span></div>
                    <div class="progress">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
                    </div>
                </div>
                <div class="dz-filename" data-dz-name></div>
                <div class="dz-size" data-dz-size></div>
                </div>
            </div>`;
            Fancybox.bind("[data-fancybox]", {
                infinite: false,
                transitionEffect: "fade",
                buttons: ["zoom", "close"],
                loop: false,
                toolbar: true,
                thumbs: {
                    autoStart: true
                },
                zoom: true,
            });

            function initializeDropzone(selector, multipleFiles = false) {
                const maxFilesize = 10;
                const maxFiles = multipleFiles ? null : 1;
                return new Dropzone(selector, {
                    previewTemplate: previewTemplate,
                    addRemoveLinks: true,
                    url: "{{ route('admin.file.uploadImage1') }}",
                    method: "post",
                    paramName: "file",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    maxFiles: maxFiles,
                    maxFilesize: maxFilesize,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp",
                    dictDefaultMessage: multipleFiles ? "Chọn nhiều ảnh để tải lên" :
                        "Kéo hoặc chọn ảnh để tải lên",
                    chunking: true,
                    forceChunking: true,
                    chunkSize: 2 * 1024 * 1024,
                    parallelChunkUploads: true,
                    retryChunks: true,
                    retryChunksLimit: 5,
                    dictDefaultMessage: multipleFiles ? "Chọn nhiều ảnh để tải lên" :
                        "Kéo hoặc chọn ảnh để tải lên",
                    dictFallbackMessage: "Trình duyệt của bạn không hỗ trợ tính năng kéo thả tệp.",
                    dictInvalidFileType: "Loại tệp này không được chấp nhận.",
                    dictFileTooBig: `Tệp quá lớn. Kích thước tối đa cho phép: ${maxFilesize} MB.`,
                    dictResponseError: "Đã xảy ra lỗi khi tải tệp lên..",
                    dictCancelUpload: "Hủy tải lên",
                    dictCancelUploadConfirmation: "Bạn có chắc chắn muốn hủy tải lên tệp này?",
                    dictRemoveFile: "Xóa tệp",
                    dictMaxFilesExceeded: `Bạn chỉ có thể tải lên tối đa ${maxFiles} tệp.`,
                    dictUploadCanceled: "Tải lên đã bị hủy.",
                    init: function() {
                        var dropzone = this;
                        var fileType = dropzone.element.getAttribute('data-type');
                        this.on("addedfile", function(file) {
                            if (dropzone.files.length >= 1 && !file.uploaded && fileType ==
                                "avatar") {
                                if (hasAvatarImage) {
                                    if (file.previewElement) {
                                        file.previewElement.remove();
                                    }
                                    notifyMe('danger',
                                        "Đã có ảnh avatar. Bạn không thể tải lên thêm ảnh.");
                                } else {
                                    hasAvatarImage = true;
                                }
                            }
                        });
                        $.ajax({
                            type: 'GET',
                            url: "{{ route('admin.file.getOldImage1') }}",
                            data: {
                                name: 'category'
                            },
                            success: function(response) {
                                console.log(response)
                                if (response.status === 'success') {
                                    var avatarImage = "{{ session('category.image') }}";
                                    if (avatarImage && fileType === 'avatar') {
                                        var mockFile = {
                                            name: response.filename,
                                            size: response.size,
                                            filepath: response.filepath,
                                            type: "avatar"
                                        };
                                        hasAvatarImage = true;

                                        dropzone.emit("addedfile", mockFile);
                                        dropzone.emit("thumbnail", mockFile,
                                            response.url);
                                        dropzone.emit("complete", mockFile);
                                        var thumbnailElement = mockFile
                                            .previewElement.querySelector(
                                                '[data-fancybox]');
                                        if (thumbnailElement) {
                                            thumbnailElement.href = response
                                                .url; // Cập nhật URL của hình ảnh
                                        }
                                    }
                                }
                            },

                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });

                        this.on("success", function(file, response) {
                            file.upload.filename = response.filename;
                            file.upload.filepath = response.filepath;
                            file.upload.type = fileType;
                            if (fileType == 'avatar') {
                                hasAvatarImage = true;
                            }
                            var thumbnailElement = file.previewElement.querySelector(
                                '[data-fancybox]');
                            if (thumbnailElement) {
                                thumbnailElement.href = response
                                    .url; // Cập nhật URL của hình ảnh
                            }
                        });

                        this.on("error", function(file, response) {
                            console.error('Upload error:', response);
                            notifyMe('danger', response);
                        });

                        this.on("removedfile", function(file) {
                            var filename = file.name;
                            if (file.upload) {
                                var filepath = file.upload.filepath;
                            } else {
                                var filepath = file.filepath;
                            }

                            var type = file.type;
                            $(selector).addClass(
                                "dropzone needsclick p-0 dz-clickable dz-started");
                            $.ajax({
                                type: 'get',
                                url: "{{ route('admin.file.deleteImage1') }}",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                data: {
                                    filename: filename,
                                    filepath: filepath,
                                    type: type,
                                    name: 'category',
                                },
                                success: function(data) {
                                    if (fileType == 'avatar') {
                                        hasAvatarImage = false;
                                    }
                                    var dropzoneElement = dropzone
                                        .element;
                                    var remainingFiles = dropzoneElement
                                        .childElementCount;

                                    var isSingleFile = remainingFiles <= 1;

                                    if (isSingleFile) {
                                        $(selector).removeClass("dz-started")
                                            .addClass(
                                                "dropzone needsclick p-0 dz-clickable"
                                            );
                                    } else {
                                        $(selector).addClass("dz-started");
                                    }
                                    console.log('JS xoa: ' + filename);
                                },
                                error: function(xhr, status, error) {
                                    console.error('Delete error:', xhr
                                        .responseText);
                                }
                            });
                        });

                        this.on("sending", function(file, xhr, formData) {
                            formData.append("type", fileType);
                        });
                    }
                });
            }

            var myDropzone = initializeDropzone("#dropzone-category");




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


        });
    </script>
@endsection
