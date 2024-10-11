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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-footable/3.1.6/footable.bootstrap.min.css"
        integrity="sha512-3kAToXGLroNvC/4WUnxTIPnfsiaMlCn0blp0pl6bmR9X6ibIiBZAi9wXmvpmg1cTyd2CMrxnMxqj7D12Gn5rlw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-footable/3.1.6/footable.core.bootstrap.min.css"
        integrity="sha512-HEeKPk2NP2D6/2UW3Nn+8z7GDfHExPyRyN9rwfdj7Pg3+2bAD5pgUILN3dT9cd/RC3v3C9/RKHw13f1i1bWH7g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .visible-lg,
        .visible-md,
        .visible-sm,
        .visible-xs,
        .visible-lg-block,
        .visible-lg-inline,
        .visible-lg-inline-block,
        .visible-md-block,
        .visible-md-inline,
        .visible-md-inline-block,
        .visible-sm-block,
        .visible-sm-inline,
        .visible-sm-inline-block,
        .visible-xs-block,
        .visible-xs-inline,
        .visible-xs-inline-block {
            display: none !important;
        }

        #product-attributes-wrapper .table>tbody>tr>td:nth-child(2) {
            width: 190px;
            min-width: 160px
        }

        #attribute-values-wrapper,
        #attribute-values-wrapper .table-responsive {
            margin-bottom: 15px
        }

        #attribute-values-wrapper .table>tbody>tr>td:nth-child(2) {
            min-width: 150px
        }

        #product-attributes-wrapper .table-responsive,
        #attribute-values-wrapper .table-responsive {
            margin-bottom: 15px;
            overflow: visible
        }

        #product-attributes-wrapper .table thead th:first-child,
        #attribute-values-wrapper .table thead th:first-child {
            width: 35px
        }

        #product-attributes-wrapper .table thead th:last-child,
        #attribute-values-wrapper .table thead th:last-child {
            width: 60px;
            padding: 0px;
        }

        #product-attributes-wrapper .table .form-group,
        #attribute-values-wrapper .table .form-group {
            margin: 0
        }

        @media screen and (max-width: 991px) {
            #product-attributes-wrapper .table>tbody>tr>td:nth-child(2) {
                min-width: 160px
            }
        }

        @media screen and (max-width: 767px) {
            .visible-xs {
                display: block !important;
            }

            .hidden-xs {
                display: none !important;
            }

            #product-attributes-wrapper .table>tbody>tr {
                border-top: 1px solid #e9e9e9
            }

            #product-attributes-wrapper .table>tbody>tr>td:nth-child(2) {
                padding-top: 15px
            }

            #product-attributes-wrapper .table>tbody>tr>td:nth-child(2),
            #product-attributes-wrapper .table>tbody>tr>td:nth-child(3),
            #product-attributes-wrapper .table>tbody>tr>td:nth-child(4) {
                display: block;
                border: none;
                width: auto;
                padding-left: 15px;
                padding-right: 15px
            }

            .ltr #product-attributes-wrapper .table>tbody>tr>td:nth-child(2),
            .ltr #product-attributes-wrapper .table>tbody>tr>td:nth-child(3),
            .ltr #product-attributes-wrapper .table>tbody>tr>td:nth-child(4) {
                text-align: left
            }

            .rtl #product-attributes-wrapper .table>tbody>tr>td:nth-child(2),
            .rtl #product-attributes-wrapper .table>tbody>tr>td:nth-child(3),
            .rtl #product-attributes-wrapper .table>tbody>tr>td:nth-child(4) {
                text-align: right
            }

            #product-attributes-wrapper .table>tbody>tr>td:nth-child(4) {
                padding-bottom: 15px
            }
        }

        @media (max-width: 767px) {}


        @media screen and (max-width: 767px) {

            .table-responsive>.table>tbody>tr>td,
            .table-responsive>.table>tbody>tr>th,
            .table-responsive>.table>tfoot>tr>td,
            .table-responsive>.table>tfoot>tr>th,
            .table-responsive>.table>thead>tr>td,
            .table-responsive>.table>thead>tr>th {
                white-space: nowrap;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-1">Thêm sản phẩm</h4>
                    <a href="#" id="question" class="btn btn-link text-primary">
                        <i class="fas fa-question"></i>
                    </a>
                </div>

            </div>
            <form id="form-validate" method="POST">
                <div class="row ">
                    <div class="col-12 col-12 order-1">
                        <div class="card mb-6 ">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Thông tin</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-6">
                                    <label class="form-label" for="ecommerce-product-name">Tên</label>
                                    <input type="text" class="form-control" placeholder="Tên sản phẩm" name="name"
                                        id="title" aria-label="Tên sản phẩm" value="{{ old('name') }}"
                                        onkeyup="ChangeToSlug();" />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="ecommerce-product-name">Đường dẫn</label>
                                    <input type="text" class="form-control" placeholder="Đường dẫn sản phẩm"
                                        name="slug" id="slug" aria-label="Đường dẫn sản phẩm"
                                        value="{{ old('slug') }}" />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="ecommerce-product-name">Mô tả ngắn</label>
                                    <textarea class="form-control" placeholder="Mô tả ngắn sản phẩm" name="short_description" id="short_description"
                                        aria-label="Mô tả ngắn sản phẩm" rows="5">{{ old('short_description') }}</textarea>
                                </div>
                                <div class="mb-6">
                                    <label class="mb-1">Mô tả</label>
                                    <textarea class="tsonit w-100" rows="4" cols="12" name="description">{!! html_decode(old('description')) !!}</textarea>
                                </div>
                                <div class="align-items-center border-top pt-2 status">
                                    <span class="mb-0 me-3">Hiển thị</span>
                                    <select name="status" class="form-select">
                                        <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Nháp</option>
                                        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Hiện</option>
                                        <option value="2" {{ old('status', 1) == 2 ? 'selected' : '' }}>Ẩn</option>
                                    </select>
                                </div>
                                <div class="mb-6 border-top mt-3">
                                    <label class="mb-1 mt-3">Nổi bật</label>
                                    <div class="input-group">
                                        <select class="form-control featured" name="featured" id="featured">
                                            <option value="1" {{ old('featured', 0) == 1 ? 'selected' : '' }}>Nổi bật
                                            </option>
                                            <option value="0" {{ old('featured', 0) == 0 ? 'selected' : '' }}>Không
                                                nổi bật</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="card mb-6 ">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Hình ảnh</h5>
                            </div>
                            <div class="card-body">

                                <div class="mb-6">
                                    <label class="mb-1">Hình ảnh</label>
                                    <div class="dropzone needsclick p-0" id="dropzone-product" data-type="avatar">
                                        <div class="dz-message needsclick">
                                            <p class="h4 needsclick pt-3 mb-2">Kéo thả ảnh vào đây</p>
                                            <p class="h6 text-muted d-block fw-normal mb-2">hoặc</p>
                                            <span class="note needsclick btn btn-sm btn-label-primary" id="btnBrowse">Tải
                                                ảnh lên</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="mb-1">Hình ảnh chi tiết</label>
                                    <div class="dropzone needsclick p-0" id="dropzone-product-detail" data-type="detail">
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
                        <div class="card mb-6 ">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Danh mục và nhãn hàng</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label mb-1" for="category">Danh mục</label>
                                        <select id="category" class="select2 form-select"
                                            data-placeholder="Chọn danh mục" name="category">
                                            <option value="">Chọn danh mục</option>
                                            @forelse($categories as $row)
                                                <option value="{{ $row->id }}"
                                                    {{ old('category', session('parent_category')) == $row->id ? 'selected' : '' }}>
                                                    {{ $row->name }}
                                                </option>
                                            @empty
                                                <option value="" disabled>Không có danh mục</option>
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-6">
                                        <label class="form-label mb-1" for="brands">Nhãn hàng</label>
                                        <select id="brands" class="select2 form-select"
                                            data-placeholder="Chọn nhãn hàng" name="brands">
                                            <option value="">Chọn nhãn hàng</option>
                                            @forelse($brands as $row)
                                                <option value="{{ $row->id }}"
                                                    {{ old('brands') == $row->id ? 'selected' : '' }}>
                                                    {{ $row->name }}
                                                </option>
                                            @empty
                                                <option value="" disabled>Không có nhãn hàng</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-6">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-4">Giá, số lượng</h5>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label fw-medium text-primary" for="is_variant">Có Biến
                                            Thể?</label>
                                        <input type="checkbox" class="form-check-input" id="is_variant"
                                            onchange="isVariantProduct(this)" name="is_variant">
                                    </div>
                                </div>

                                <div class="noVariation">
                                    <div class="row g-3">
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="price" class="form-label">Giá</label>
                                                <input type="number" min="0" step="1000" id="price"
                                                    name="price" placeholder="Giá sản phẩm" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="price" class="form-label">Giá cũ</label>
                                                <input type="number" min="0" step="1000" id="old_price"
                                                    name="old_price" placeholder="Giá cũ của sản phẩm" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="stock" class="form-label">Số lượng</label>
                                                <input type="number" id="stock" placeholder="Số lượng"
                                                    name="stock" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="code" class="form-label">Code</label>
                                                <input type="text" id="code" placeholder="Mã code"
                                                    name="code" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="hasVariation" style="display: none">
                                    <div class="row g-3">
                                        @if (count($variations) > 0)
                                            <div class="row g-3 mt-1">
                                                <div class="col-lg-6">
                                                    <div class="mb-0">
                                                        <label class="form-label">Chọn biến thể</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-0">
                                                        <label class="form-label">Chọn giá trị</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="chosen_variation_options">
                                                <div class="row g-3">
                                                    <div class="col-lg-6">
                                                        <div class="mb-0">
                                                            <select class="form-select variations select2"
                                                                onchange="getVariationValues(this)"
                                                                name="chosen_variations[]">
                                                                <option value="">
                                                                    Chọn biến thể
                                                                </option>
                                                                @foreach ($variations as $key => $variation)
                                                                    @if ($variation->id != 1)
                                                                        <option value="{{ $variation->id }}">
                                                                            {{ $variation->name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-0">
                                                            <div class="variationvalues">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Chọn giá trị biến thể" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-4">
                                                        <button class="btn btn-link px-0 fw-medium fs-base" type="button"
                                                            onclick="addAnotherVariation()">
                                                            <i class="me-1 menu-icon tf-icons ti ti-plus"></i>
                                                            Thêm một biến thể khác
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="variation_combination" id="variation_combination">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-6 ">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Thông tin thêm
                                    <button class="btn btn-link px-0 fw-medium fs-base" type="button"
                                        id="add-attribute-btn">
                                        <i class="me-1 menu-icon tf-icons ti ti-plus"></i>
                                        Thêm thông tin
                                    </button>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div id="product-attributes-wrapper">
                                    <div class="table-responsive">
                                        <table class="options table table-bordered">
                                            <thead class="hidden-xs">
                                                <tr>
                                                    <th></th>
                                                    <th>Thông tin</th>
                                                    <th>Giá trị</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="attribute-list">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-6 ">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">SEO</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-6 border-top pt-2 mt-2">
                                    <label class="form-label" for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control" placeholder="Meta Title"
                                        name="meta_title" value="{{ old('meta_title') }}" />
                                </div>
                                <div class="mb-6">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control" rows="3" name="meta_description">{{ old('meta_description') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 order-3">
                            <div class="d-flex align-content-center flex-wrap gap-4">
                                @csrf
                                <button type="submit" id="save" class="btn btn-primary">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ProductRequestAdmin') !!}

    <script src="{{ asset('assets/admin/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/select2/select2.js') }}"></script>

    <script src="{{ asset('assets/admin/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('assets/admin/js/app-ecommerce-product-add.js') }}?v=1"></script>
    <script src="{{ asset('assets/admin/vendor/libs/shepherd/shepherd.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-footable/3.1.6/footable.min.js"
        integrity="sha512-aVkYzM2YOmzQjeGEWEU35q7PkozW0vYwEXYi0Ko06oVC4NdNzALflDEyqMB5/wB4wH50DmizI1nLDxBE6swF3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-footable/3.1.6/footable.core.min.js"
        integrity="sha512-brNV+D950pGUcB7+/9J5YWsprTXTVOx3D5UvoAGxn22h4kfTHvjewYwmHP/cC/QlQWaVF3hPOMUKAlSifSJCIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/admin/vendor/libs/sortablejs/sortable.js') }}"></script>
    @include('admin.partials.products.script_new_attributes')
    @include('admin.partials.products.script')
    <script>
        $(document).ready(function() {
            const previewTemplate = `<div class="dz-preview dz-file-preview">
                <div class="dz-details">
                <div class="dz-thumbnail">
                    <img data-dz-thumbnail>
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
                        this.on("success", function(file, response) {
                            file.upload.filename = response.filename;
                            file.upload.filepath = response.filepath;
                            console.log(file.upload);
                            file.upload.type = fileType;
                        });

                        this.on("error", function(file, response) {
                            console.error('Upload error:', response);
                            notifyMe('danger', response);
                        });

                        this.on("removedfile", function(file) {
                            var filename = file.upload.filename;
                            var filepath = file.upload.filepath;
                            var type = file.upload.type;
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
                                    name: 'product'
                                },
                                success: function(data) {
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

            var myDropzone = initializeDropzone("#dropzone-product");
            var myDropzoneDetail = initializeDropzone("#dropzone-product-detail", true);

            const startBtn = document.querySelector('#question');
            const tourSteps = [{
                    title: 'Tên danh mục',
                    text: 'Đây có thể là thể loại sản phẩm hoặc tên thể loại con. Ví dụ: Thức ăn chó',
                    element: '[name="name"]'
                },
                {
                    title: 'Hiển thị',
                    text: 'Nếu muốn ẩn hoặc hiện thì nhấn vào đây',
                    element: '.status'
                },
                {
                    title: 'Hiển thị ngoài trang chủ',
                    text: 'Nếu bạn muốn danh mục này hiển thị ngoài trang chủ.',
                    element: '[name="show_on_homepage"]'
                },
                {
                    title: 'Danh mục',
                    text: 'Tại đây bạn có thể chọn một danh mục con từ danh sách. Nếu không chọn một danh mục con cụ thể, hệ thống sẽ sử dụng danh mục chính mặc định.',
                    element: '[name="category"]'
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
