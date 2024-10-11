@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <!-- Category List Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Danh sách danh sách sản phẩm đã bị xoá</h5>
                <small class="text-muted">Đây là danh sách sản phẩm đã bị xoá</small>

            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables-products table">
                    <thead class="border-top">
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Danh mục</th>
                            <th>Giá</th>
                            <th>Trạng thái</th>
                            <th>Lượt xem</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/admin/vendor/libs/select2/select2.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="{{ asset('assets/admin/vendor/libs/block-ui/block-ui.js') }}"></script>

    <script>
        $(document).ready(function() {
            console.log($.fn.dataTable.version);

            $('.datatables-products').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('assets/admin/vendor/libs/datatables-bs5/vi.json') }}",
                },
                ajax: {
                    url: "{{ route('admin.products.trashed') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataSrc: function(json) {
                        window.status_flag = json.status_flag || [];
                        return json.data;
                    },
                    "beforeSend": function() {
                        $('.datatables-products').block({
                            message: '<div class="spinner-border text-primary" role="status"></div>',
                            css: {
                                backgroundColor: 'transparent',
                                border: '0'
                            },
                            overlayCSS: {
                                backgroundColor: '#fff',
                                opacity: 0.8
                            }
                        });
                    }
                },
                drawCallback: function(settings) {
                    // Tắt spinner sau khi bảng đã được vẽ
                    $('.datatables-products').unblock();
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'category'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'views'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                        // For Responsive
                        className: 'control',
                        responsivePriority: 2,
                        searchable: false,
                        targets: 0,
                        render: function(data, type, full, meta) {
                            return '';
                        }
                    },
                    {
                        // ID
                        targets: 1,
                        render: function(data, type, full, meta) {
                            var $id = full['id'];
                            var $row_output = '<a href="">#' + $id + '</a>';
                            return $row_output;
                        }
                    },
                    {
                        // Name
                        targets: 2,
                        render: function(data, type, full, meta) {
                            var $img = full['image'];
                            var $name = full['name'];
                            var $row_output =
                                '<div class="d-flex flex-column align-items-center justify-content-center align-items-start product-name">';

                            // Avatar (hình ảnh)
                            if ($img) {
                                $row_output +=
                                '<div class="avatar-wrapper me-4 mb-2">'; // Thêm khoảng cách dưới hình ảnh
                                $row_output +=
                                    '<div class="avatar avatar rounded-2 bg-label-secondary">';
                                $row_output += '<img src="' + getImage($img) +
                                    '" data-fancybox data-caption="' + $name +
                                    '" alt="' + $name + '" class="rounded-2">';
                                $row_output += '</div>';
                                $row_output += '</div>';
                            }

                            // Danh mục
                            if ($name) {
                                $row_output += '<div class="d-flex flex-column">';
                                $row_output += '<h6 class="text-nowrap mb-0">' + limitText($name,
                                    15) + '</h6>';
                                $row_output += '</div>';
                            }

                            $row_output += '</div>';
                            return $row_output;
                        }
                    },
                    {
                        // Category
                        targets: 3,
                        render: function(data, type, full, meta) {
                            return limitText(full['category']['name'], 15);
                        }
                    },
                    {
                        // Price
                        targets: 4,
                        render: function(data, type, full, meta) {
                            return limitText(full['price_custom'], 20);
                        }
                    },
                    {
                        // Status
                        targets: 5,
                        render: function(data, type, full, meta) {
                            var invoiceStatus = full['status'] == 0 ? 'nhap' : full['status'] ==
                                1 ? 'hien' : 'an';
                            var statusBadge = {
                                'nhap': '<span class="me-2 badge d-flex align-items-center justify-content-center bg-warning" style="white-space: nowrap;">Nháp</span>',
                                'hien': '<span class="me-2 badge d-flex align-items-center justify-content-center bg-success" style="white-space: nowrap;">Công khai</span>',
                                'an': '<span class="me-2 badge d-flex align-items-center justify-content-center bg-secondary" style="white-space: nowrap;">Ẩn</span>'
                            };
                            return (
                                "<div class='d-inline-flex align-items-center'>" +
                                statusBadge[invoiceStatus] +
                                "</div>"
                            );
                        }
                    },
                    {
                        // View
                        targets: 6,
                        render: function(data, type, full, meta) {
                            return full['views'];
                        }
                    },
                ],
                order: [
                    [1, 'desc']
                ],
                dom: '<"row"' +
                    '<"col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-2"l<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start"B>>' +
                    '<"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-5 gap-md-4 mt-n5 mt-md-0"f<"invoice_status mb-6 mb-md-0">>' +
                    '>t' +
                    '<"row"' +
                    '<"col-sm-12 col-md-6"i>' +
                    '<"col-sm-12 col-md-6"p>' +
                    '>',
                displayLength: 10,
                lengthMenu: [10, 20, 50, 75, 100],
                // Buttons with Dropdown
                buttons: [{
                    text: '<i class="ti ti-plus ti-xs me-md-2"></i><span class="d-md-inline-block d-none">Tạo sản phẩm</span>',
                    className: 'btn btn-primary waves-effect waves-light',
                    action: function(e, dt, button, config) {
                        window.location = "{{ route('admin.products.addProduct') }}";
                    }
                }],
                // For responsive popup
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function(row) {
                                var data = row.data();
                                return 'Chi tiết sản phẩm - ' + data['name'];
                            }
                        }),
                        type: 'column',
                        renderer: function(api, rowIdx, columns) {
                            var data = $.map(columns, function(col, i) {
                                return col.title !==
                                    '' // ? Do not show row in modal popup if title is blank (for check box)
                                    ?
                                    '<tr data-dt-row="' +
                                    col.rowIndex +
                                    '" data-dt-column="' +
                                    col.columnIndex +
                                    '">' +
                                    '<td>' +
                                    col.title +
                                    ':' +
                                    '</td> ' +
                                    '<td>' +
                                    col.data +
                                    '</td>' +
                                    '</tr>' :
                                    '';
                            }).join('');

                            return data ? $('<table class="table"/><tbody />').append(data) : false;
                        }
                    }
                }
            });
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
        });
    </script>
@endsection
