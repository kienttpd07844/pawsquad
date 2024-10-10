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
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/jquery-timepicker/jquery-timepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/pickr/pickr-themes.css') }}" />
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-1">Thêm mã giảm giá</h4>
                    <a href="#" id="question" class="btn btn-link text-primary">
                        <i class="fas fa-question"></i>
                    </a>
                </div>

            </div>
            <form id="form-validate" method="POST">
                <div class="row ">
                    <div class="col-12  order-1">
                        <div class="card mb-6">
                            <div class="card-body">
                                <div class="nav-align-top mb-6">
                                    <ul class="nav nav-pills mb-4" role="tablist">
                                        <li class="nav-item">
                                            <button type="button" class="nav-link active" role="tab"
                                                data-bs-toggle="tab" data-bs-target="#navs-info" aria-controls="navs-info"
                                                aria-selected="true">
                                                Thông tin
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                                data-bs-target="#navs-limit" aria-controls="navs-limit"
                                                aria-selected="false">
                                                Giới hạn
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content p-0">
                                        <div class="tab-pane fade show active" id="navs-info" role="tabpanel">
                                            <div class="mb-6">
                                                <label class="form-label">Mã code giảm giá</label>
                                                <input type="text" class="form-control" placeholder="Mã code giảm giá"
                                                    name="code" aria-label="Mã code giảm giá"
                                                    value="{{ old('code') }}" />
                                            </div>
                                            <div class="mb-6">
                                                <label class="form-label">Mô tả</label>
                                                <input type="text" class="form-control" placeholder="Mô tả"
                                                    name="description" aria-label="Mô tả" id="description"
                                                    value="{{ old('description') }}" />
                                            </div>
                                            <div class="mb-6">
                                                <label class="mb-1">Ngày bắt đầu</label>
                                                <input type="text" name="start_date" class="form-control"
                                                    placeholder="DD-MM-YYYY HH:MM" id="start_date"
                                                    value="{{ old('start_date') }}" />
                                            </div>
                                            <div class="mb-6">
                                                <label class="mb-1">Ngày kết thúc</label>
                                                <input type="text" name="end_date" class="form-control"
                                                    placeholder="DD-MM-YYYY HH:MM" id="end_date"
                                                    value="{{ old('end_date') }}" />
                                            </div>

                                            <div class="mb-6">
                                                <label class="mb-1">Hiển thị</label>
                                                <div class="input-group">
                                                    <select class="form-control status" name="index" id="status">
                                                        <option value="1"
                                                            {{ old('index', 1) == 1 ? 'selected' : '' }}>Hiện</option>
                                                        <option value="0"
                                                            {{ old('index', 1) == 0 ? 'selected' : '' }}>Ẩn</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="mb-6">
                                                <label class="mb-1">Loại giảm giá</label>
                                                <div class="input-group">
                                                    <select class="form-control" name="discount_type" id="discount_type">
                                                        <option value="flat"
                                                            {{ old('discount_type') == 'flat' ? 'selected' : '' }}>Giảm
                                                            theo tiền
                                                        </option>
                                                        <option value="percentage"
                                                            {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>
                                                            Giảm theo phần
                                                            trăm</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-6">
                                                <label class="mb-1">Giá được giảm</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        placeholder="Giá được giảm" aria-label="Giá được giảm"
                                                        aria-describedby="basic-addon11" name="discount"
                                                        value="{{ old('discount') }}">
                                                    <span class="input-group-text" id="price_discount">đ</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="navs-limit" role="tabpanel">
                                            <div class="mb-6">
                                                <label class="form-label">Thanh toán tối thiểu</label>
                                                <input type="number" class="form-control"
                                                    placeholder="Thanh toán tối thiểu" name="min_spend"
                                                    aria-label="Thanh toán tối thiểu"
                                                    value="{{ old('min_spend', 1) }}" />
                                            </div>
                                            <div class="mb-6">
                                                <label class="form-label">Số lần sử dụng / người</label>
                                                <input type="number" class="form-control"
                                                    placeholder="Số lần sử dụng / người" name="customer_usage_limit"
                                                    aria-label="Số lần sử dụng / người"
                                                    value="{{ old('customer_usage_limit', 1) }}" />
                                            </div>
                                            <div class="mb-6">
                                                <label class="form-label">Số lượng</label>
                                                <input type="number" class="form-control" placeholder="Số lượng"
                                                    name="quantity" aria-label="Số lượng"
                                                    value="{{ old('quantity', 1) }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
            </form>

        </div>
    </div>
@endsection
@section('js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\VoucherRequestAdmin') !!}

    <script src="{{ asset('assets/admin/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/select2/select2.js') }}"></script>

    <script src="{{ asset('assets/admin/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('assets/admin/js/app-ecommerce-product-add.js') }}?v=1"></script>
    <script src="{{ asset('assets/admin/vendor/libs/shepherd/shepherd.js') }}"></script>

    <script src="{{ asset('assets/admin/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/pickr/pickr.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/flatpickr/vn.js') }}?v=1"></script>
    <script>
        $(document).ready(function() {
            const startBtn = document.querySelector('#question');
            const tourSteps = [{
                    title: 'Mã code giảm giá',
                    text: 'Mã code giảm giá cho khách hàng',
                    element: '[name="code"]'
                },
                {
                    title: 'Mô tả',
                    text: 'Thông tin mô tả về mã giảm giá',
                    element: '#description'
                },
                {
                    title: 'Ngày bắt đầu',
                    text: 'Chọn ngày bắt đầu hiệu lực của mã giảm giá',
                    element: '[name="start_date"]'
                },
                {
                    title: 'Ngày kết thúc',
                    text: 'Chọn ngày kết thúc hiệu lực của mã giảm giá',
                    element: '[name="end_date"]'
                },
                {
                    title: 'Hiển thị',
                    text: 'Lựa chọn hiển thị hoặc ẩn mã giảm giá',
                    element: '#status'
                },
                {
                    title: 'Loại giảm giá',
                    text: 'Chọn loại giảm giá: theo số tiền hoặc theo phần trăm',
                    element: '[name="discount_type"]'
                },
                {
                    title: 'Giá được giảm',
                    text: 'Nhập giá trị được giảm',
                    element: '[name="discount"]'
                },
                {
                    title: 'Thanh toán tối thiểu',
                    text: 'Nhập số tiền tối thiểu để áp dụng mã giảm giá',
                    element: '[name="min_spend"]'
                },
                {
                    title: 'Số lần sử dụng / người',
                    text: 'Số lần một người có thể sử dụng mã giảm giá',
                    element: '[name="customer_usage_limit"]'
                },
                {
                    title: 'Số lượng',
                    text: 'Số lượng mã giảm giá có thể phát hành',
                    element: '[name="quantity"]'
                },
                {
                    title: 'Lưu',
                    text: 'Lưu lại thông tin đã nhập',
                    element: '#save'
                }
            ];


            function setupTour(tour) {
                const backBtnClass = 'btn btn-sm btn-label-secondary md-btn-flat waves-effect waves-light',
                    nextBtnClass = 'btn btn-sm btn-primary btn-next waves-effect waves-light';

                tourSteps.forEach((step, index) => { // Thêm index vào đây
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
                                action: () => {
                                    const previousStep = tourSteps[index -
                                    1]; // Sử dụng index đã định nghĩa
                                    if (previousStep) {
                                        const previousTargetElement = document
                                            .querySelector(previousStep.element);
                                        const previousTabPane = previousTargetElement
                                            .closest('.tab-pane');
                                        if (previousTabPane && !previousTabPane.classList
                                            .contains('active')) {
                                            const previousTabId = previousTabPane.id;
                                            const previousTabButton = document
                                                .querySelector(
                                                    `[data-bs-target="#${previousTabId}"]`
                                                );
                                            previousTabButton.click();
                                        }
                                    }
                                    tour.back();
                                }
                            },
                            {
                                text: 'Tiếp',
                                classes: nextBtnClass,
                                action: () => {
                                    const targetElement = document.querySelector(step
                                        .element);
                                    const tabPane = targetElement.closest('.tab-pane');

                                    if (tabPane && !tabPane.classList.contains('active')) {
                                        const tabId = tabPane.id;
                                        const tabButton = document.querySelector(
                                            `[data-bs-target="#${tabId}"]`
                                        );
                                        tabButton.click();
                                    }
                                    tour.next();
                                }
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

            const start_date = document.querySelector('#start_date'),
                end_date = document.querySelector('#end_date');

            if (start_date && end_date) {
                const startDatePicker = start_date.flatpickr({
                    enableTime: true,
                    "locale": "vn",
                    dateFormat: 'd-m-Y H:i',
                    onChange: function(selectedDates, dateStr, instance) {
                        // Kiểm tra nếu end_date đã được chọn và nhỏ hơn start_date
                        const endDateObj = end_date._flatpickr.selectedDates[0];
                        if (endDateObj && endDateObj <= selectedDates[0]) {
                            notifyMe('error', 'Thời gian kết thúc phải lớn hơn thời gian bắt đầu.');
                            end_date._flatpickr.clear();
                        }
                        end_date._flatpickr.set('minDate', selectedDates[
                            0]);
                    }
                });

                const endDatePicker = end_date.flatpickr({
                    enableTime: true,
                    "locale": "vn",
                    dateFormat: 'd-m-Y H:i',
                    onChange: function(selectedDates, dateStr, instance) {
                        // Kiểm tra nếu end_date <= start_date
                        const startDateObj = start_date._flatpickr.selectedDates[0];
                        if (startDateObj && selectedDates[0] <= startDateObj) {
                            notifyMe('error', 'Thời gian kết thúc phải lớn hơn thời gian bắt đầu.');
                            end_date._flatpickr.clear();
                        }
                    }
                });
            }

            const discountPercentSelect = document.getElementById('discount_type');
            const discountAddon = document.getElementById('price_discount');
            const discountInput = document.querySelector('input[name="discount"]');
            let timeout = null;

            if (discountPercentSelect && discountAddon && discountInput) {
                function updateDiscountAddon() {
                    if (discountPercentSelect.value === 'percentage') {
                        discountAddon.textContent = '%';
                    } else {
                        discountAddon.textContent = 'đ';
                    }
                }

                function validateInputs() {
                    const discountValue = parseFloat(discountInput.value);
                    const discountType = discountPercentSelect.value;

                    if (isNaN(discountValue) || discountValue <= 0) {
                        notifyMe('error', 'Giá trị giảm giá phải lớn hơn 0.');
                        discountInput.value = '';
                        return;
                    }

                    if (discountType === 'percentage' && discountValue > 100) {
                        notifyMe('error', 'Phần trăm giảm giá không được vượt quá 100%.');
                        discountInput.value = '';
                        return;
                    }
                }

                updateDiscountAddon();
                discountPercentSelect.addEventListener('change', updateDiscountAddon);
                discountInput.addEventListener('input', function() {
                    clearTimeout(timeout);
                    timeout = setTimeout(function() {
                        validateInputs();
                    }, 2000);
                });
            }





        });
    </script>
@endsection
