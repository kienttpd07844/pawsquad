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
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-1">Thêm thuộc tính</h4>
                    <a href="#" id="question" class="btn btn-link text-primary">
                        <i class="fas fa-question"></i>
                    </a>
                </div>

            </div>
            <form id="form-validate" method="POST">
                <div class="row ">
                    <div class="col-12 col-lg-12 order-1">
                        <div class="card mb-6 ">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Thông tin</h5>

                            </div>
                            <div class="card-body">
                                <div class="mb-6">
                                    <label class="form-label mb-1" for="attributeset"> Nhóm thuộc tính </label>
                                    <select id="attributeset" class="select2 form-select"
                                        data-placeholder="Chọn nhóm thuộc tính" name="attributeset">
                                        <option value="">Chọn nhóm thuộc tính</option>
                                        @forelse($attributeSet as $row)
                                            <option value="{{ $row->id }}"
                                                {{ old('attributeset') == $row->id ? 'selected' : '' }}>
                                                {{ $row->name }}
                                            </option>
                                        @empty
                                            <option value="" disabled>Không có nhóm thuộc tính</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="ecommerce-product-name">Tên thuộc tính</label>
                                    <input type="text" class="form-control" id="ecommerce-product-name"
                                        placeholder="Tên thuộc tính" name="name" aria-label="Tên thuộc tính"
                                        value="{{ old('name') }}" />
                                </div>

                                <div class="align-items-center border-top pt-2 status">
                                    <label class="form-label mb-1 me-3" for="status"> Hiển thị
                                    </label>
                                    <label class="switch switch-square">
                                        <input type="checkbox" name="status" class="switch-input" checked
                                            {{ old('status', 1) ? 'checked' : '' }}>
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on"><i class="ti ti-check"></i></span>
                                            <span class="switch-off"><i class="ti ti-x"></i></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label mb-1" for="value"> Giá trị thuộc tính <a
                                            href="javascript:void(0)" class="btn btn-default fw-bold" id="add-new-value">
                                            <i class="fa fa-plus me-2"></i> Thêm
                                        </a></label>
                                    <div id="attribute-values-wrapper">
                                        <div class="table-responsive">
                                            <table class="options table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width:65px"></th>
                                                        <th>Giá trị</th>
                                                        <th style="width:10px"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="attribute-values">

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 order-2">
                        <div class="d-flex align-content-center flex-wrap gap-4">
                            @csrf
                            <button type="submit" id="save" class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\AttributesRequestAdmin') !!}

    <script src="{{ asset('assets/admin/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/select2/select2.js') }}"></script>

    <script src="{{ asset('assets/admin/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('assets/admin/js/app-ecommerce-product-add.js') }}?v=1"></script>
    <script src="{{ asset('assets/admin/vendor/libs/shepherd/shepherd.js') }}"></script>
    <!-- Vendors JS -->
    <script src="{{ asset('assets/admin/vendor/libs/sortablejs/sortable.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/admin/js/extended-ui-drag-and-drop.js') }}"></script>
    <script>
        $(document).ready(function() {

           

            let valuesCount = 0;

            // Thêm giá trị mới
            function addAttributeValue(value = {id: "",value: ""}) {
                // Tạo HTML cho hàng mới
                let template = `
                    <tr>
                        <td class="text-center">
                            <span class="drag-handle">
                                <i class="fa"></i>
                                <i class="fa"></i>
                            </span>
                        </td>
                        <td>
                            <input type="hidden" name="values[${valuesCount}][id]" value="${value.id}">
                            <div class="form-group">
                                <input type="text" name="values[${valuesCount}][value]" value="${value.value}" class="form-control">
                            </div>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-default delete-row">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;

                // Tăng giá trị đếm
                valuesCount++;
                // Thêm template vào bảng
                document.querySelector("#attribute-values").insertAdjacentHTML("beforeend", template);
            }

            // Xử lý sự kiện
            function eventListeners() {
                document.querySelector("#add-new-value").addEventListener("click", function() {
                    addAttributeValue();
                });

                document.querySelector("#attribute-values").addEventListener("click", function(event) {
                    if (event.target.closest(".delete-row")) {
                        event.target.closest("tr").remove();
                    }
                });
            }

            // Kích hoạt Sortable cho danh sách giá trị
            function sortable() {
                Sortable.create(document.getElementById("attribute-values"), {
                    handle: ".drag-handle",
                    animation: 150
                });
            }

            // Khởi tạo
            if (document.querySelector("#attribute-values-wrapper")) {
                // Nếu chưa có giá trị, thêm giá trị mới
                if (valuesCount === 0) {
                    addAttributeValue();
                }
                eventListeners();
                sortable();
                window.admin.removeSubmitButtonOffsetOn("#values");
            }

            const startBtn = document.querySelector('#question');
            const tourSteps = [{
                    title: 'Tên thuộc tính',
                    text: 'Đây là thuộc tính cha. Dạng tướng,trang phục,ruby,...',
                    element: '[name="name"]'
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
