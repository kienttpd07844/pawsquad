@extends('layouts.clients')
@section('css')
    <style>
        .accordion-button {
            background-color: #F46F30;
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }

        .accordion-button strong {
            color: white !important;
        }

        .accordion-button:hover {
            background-color: #e05a28;
        }

        .accordion-button:not(.collapsed) {
            background-color: #d85524;
        }

        .accordion-body {
            background-color: #f9f9f9;
            color: #333;
            padding: 15px;
        }

        .containerss {
            display: block;
            margin-bottom: 10px;
        }

        .containerss input[type="checkbox"] {
            margin-right: 10px;
        }

        .checkmark {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #F46F30;
            border-radius: 4px;
            position: relative;
        }

        .containerss input[type="checkbox"]:checked+.checkmark {
            background-color: #F46F30;
        }

        .containerss input[type="checkbox"]:checked+.checkmark::after {
            content: "";
            position: absolute;
            left: 6px;
            top: 2px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
    </style>
@endsection
@section('content')
    @include('clients.partials.breadcrum', [
        'breadcrumbs' => [['name' => 'Danh mục' . ' ' . $category->name, 'url' => '']],
        'title' => 'Danh mục' . ' ' . $category->name,
    ])


    <div class="shop-page pt-120 mb-120">
        <div class="container">
            <div class="row" id="filterForm">
                <div class="col-lg-3">
                    <div class="shop-sidebar">
                        <div class="shop-widget">
                            <h5 class="shop-widget-title">Giá</h5>
                            <div class="range-widget">
                                <div id="slider-range" class="price-filter-range"></div>
                                <div class="mt-25 d-flex justify-content-between gap-4">
                                    <input type="number" min="1000" max="9999999"
                                        oninput="validity.valid||(value='1000');" id="min_price"
                                        class="price-range-field" />
                                    <input type="number" min="1000-" max="10000000"
                                        oninput="validity.valid||(value='10000000');" id="max_price"
                                        class="price-range-field" />
                                </div>
                            </div>
                        </div>
                        @if (isset($childCategories) && $childCategories->isNotEmpty())
                            <div class="shop-widget">
                                <div class="check-box-item">
                                    <h5 class="shop-widget-title">{{ $category->name }}</h5>
                                    <div class="checkbox-container">
                                        @foreach ($childCategories as $child)
                                            <label class="containerss">{{ $child->name }}
                                                <input type="checkbox" class="category-filter" name="category"
                                                    data-category="{{ $child->slug }}" value="{{ $child->slug }}">
                                                <span class="checkmark"></span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (isset($brands) && $brands->isNotEmpty())
                            <div class="shop-widget">
                                <div class="check-box-item">
                                    <h5 class="shop-widget-title">Nhãn hàng</h5>
                                    <div class="checkbox-container">
                                        @foreach ($brands as $brand)
                                            <label class="containerss">{{ $brand->name }}
                                                <input type="checkbox" class="brand-filter" name="brand"
                                                    data-brand="{{ $brand->slug }}" value="{{ $brand->slug }}">
                                                <span class="checkmark"></span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row mb-50">
                        <div class="col-lg-12">
                            <div class="multiselect-bar">
                                <h6>Sản phẩm</h6>
                                <div class="multiselect-area">
                                    <div class="single-select">
                                        <span>Hiển thị</span>
                                        <select class="defult-select-drowpown" id="take-dropdown" name="per_page">
                                            <option selected value="9">9</option>
                                            <option value="12">12</option>
                                            <option value="15">15</option>
                                            <option value="18">18</option>
                                            <option value="21">21</option>
                                        </select>
                                    </div>
                                    <div class="single-select two">
                                        <select class="defult-select-drowpown" id="eyes-dropdown" name="order">
                                            <option selected value="0">Sắp xếp theo</option>
                                            <option value="1">Mới nhất</option>
                                            <option value="2">Nhiều lượt xem</option>
                                            <option value="3">Giá từ cao xuống thấp</option>
                                            <option value="4">Giá từ thấp lên cao</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="gallery" class="row g-4 justify-content-center">

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.querySelectorAll('.accordion-button').forEach(button => {
            button.addEventListener('click', () => {
                const accordionItem = button.parentElement;
                accordionItem.classList.toggle('active');
            });
        });
        $(function() {
            // Khởi tạo slider
            var min_price_range = parseInt($("#min_price").val(), 10) || 1000; // Giá trị mặc định là 1000
            var max_price_range = parseInt($("#max_price").val(), 10) || 10000000; // Giá trị mặc định là 10000000

            $("#slider-range").slider({
                range: true,
                orientation: "horizontal",
                min: 1000, // Giá trị tối thiểu
                max: 10000000, // Giá trị tối đa
                values: [min_price_range, max_price_range],
                step: 1000,
                slide: function(event, ui) {
                    if (ui.values[0] == ui.values[1]) {
                        return false;
                    }
                    $("#min_price").val(ui.values[0]);
                    $("#max_price").val(ui.values[1]);
                }
            });

            $("#min_price").val($("#slider-range").slider("values", 0));
            $("#max_price").val($("#slider-range").slider("values", 1));

            // Xử lý sự kiện khi nhập
            $("#min_price, #max_price").on("paste keyup", function() {
                $('#price-range-submit').show();
                var min_price_range = parseInt($("#min_price").val(), 10) || 1000;
                var max_price_range = parseInt($("#max_price").val(), 10) || 10000000;

                if (min_price_range == max_price_range) {
                    max_price_range = min_price_range + 100; // Đảm bảo max lớn hơn min
                    $("#max_price").val(max_price_range);
                }

                // Cập nhật giá trị cho slider
                $("#slider-range").slider({
                    values: [min_price_range, max_price_range]
                });
            });
        });

        // Xử lý sự kiện cho nút tìm kiếm
        $("#slider-range, #price-range-submit").on('click', function() {
            var min_price = $('#min_price').val();
            var max_price = $('#max_price').val();
            $("#searchResults").text("Here List of products will be shown which are cost between " + min_price +
                " and " + max_price + ".");
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filterForm');

            function collectFormData() {
                const formData = {};
                const categoryInput = document.querySelector('input[name="category"]:checked');
                if (categoryInput) {
                    formData.category = categoryInput.dataset.category;
                }
                // Lấy giá trị từ slider
                formData.price_min = $("#min_price").val();
                formData.price_max = $("#max_price").val();
                const orderInput = document.querySelector('select[name="order"]');
                if (orderInput) {
                    formData.order = orderInput.value;
                }
                const perPageInput = document.querySelector('select[name="per_page"]');
                if (perPageInput) {
                    formData.per_page = perPageInput.value;
                }
                return formData;
            }

            function performAjaxRequest(formData = {}, page = 1) {
                $('#gallery').html('<p>Đang xử lý...</p>');

                $.ajax({
                    type: "GET",
                    url: "{{ route('filter.category', ['slug' => request()->slug]) }}",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'slug': '{{ request()->slug }}',
                        ...formData,
                        page
                    },
                    success: function(data) {
                        updateProduct(data);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }

            function updateProduct(data) {
                $('#gallery').html(data.products);
            }

            // Lắng nghe thay đổi trên slider
            $("#slider-range").on("slidechange", function() {
                const formData = collectFormData();
                performAjaxRequest(formData);
            });

            // Lắng nghe thay đổi trên form
            form.addEventListener('change', function(event) {
                const formData = collectFormData();
                console.log(formData);
                performAjaxRequest(formData);
            });

            // Lắng nghe thay đổi trên dropdowns của nice-select
            $('#take-dropdown').on('change', function() {
                const formData = collectFormData();
                performAjaxRequest(formData);
            });

            $('#eyes-dropdown').on('change', function() {
                const formData = collectFormData();
                performAjaxRequest(formData);
            });

            // Sự kiện phân trang
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                const pageUrl = $(this).attr('href');
                if (!pageUrl) return; // Nếu không có URL, thoát hàm
                const page = new URLSearchParams(pageUrl.split('?')[1]).get('page');
                const formData = collectFormData();
                performAjaxRequest(formData, page);
            });

        });
    </script>
@endsection
