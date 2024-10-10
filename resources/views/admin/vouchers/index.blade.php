@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

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
    <style>
        .flatpickr-calendar {
            left: 50% !important;
            transform: translateX(-50%) !important;
        }

        @media (max-width: 768px) {
            #dateRange {
                display: none;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <!-- Category List Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Danh sách mã giảm giá</h5>
                <small class="text-muted">Đây là mã giảm giá</small>

            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables-products table">
                    <thead class="border-top">
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Tên mã</th>
                            <th>Thời gian</th>
                            <td>Số lượng</td>
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

    <script src="{{ asset('assets/admin/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/pickr/pickr.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/flatpickr/vn.js') }}?v=1"></script>

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
                    url: "{{ route('admin.vouchers.index') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function(d) {
                        d.date_range = $('#dateRange').val(); // Lấy giá trị range ngày
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
                        data: 'start_date'
                    },
                    {
                        data: 'voucher_quantity'
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
                            var $row_output = '';
                            var $name = full['name'];
                            var $voucherType = full['voucher_type'] ? full['voucher_type']['name'] :
                                'N/A';
                            $row_output += '<div class="d-flex flex-column">';
                            $row_output += '<h6 class="text-nowrap mb-0">' + limitText($name,
                                    20) +
                                '</h6>';
                            $row_output +=
                                '<small class="text-truncate d-none d-sm-block text-success">' +
                                limitText($voucherType, 15) + ' </small>';
                            $row_output += '</div>';
                            return $row_output;
                        }
                    },
                    {
                        // Date
                        targets: 3,
                        render: function(data, type, full, meta) {
                            var $row_output = '';
                            var $start_date = format_date(full['start_date']);
                            var $expired_date = format_date(full['expired_date']);
                            var $row_output = '<div class="d-flex flex-column">';
                            $row_output += '<h6 class="text-nowrap mb-0">Bắt đầu: ' +
                                $start_date + '</h6>';
                            $row_output += '<h6 class="text-nowrap mb-0">Kết thúc: ' +
                                $expired_date + '</h6>';
                            $row_output += '</div>';
                            return $row_output;
                        }
                    },
                    {
                        // Quantity
                        targets: 4,
                        render: function(data, type, full, meta) {
                            var $row_output = '';
                            var total_quantity = full['voucher_quantity'];
                            var used_quantity = full['usages_count'];
                            var row_output = '<div class="d-flex flex-column">';
                            row_output += '<h6 class="text-nowrap mb-0">Tổng: ' + total_quantity +
                                '</h6>';
                            row_output += '<h6 class="text-nowrap mb-0">Đã dùng: ' + used_quantity +
                                '</h6>';
                            row_output += '</div>';
                            return row_output;
                        }
                    }
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
                buttons: [{
                        text: '<i class="ti ti-plus ti-xs me-md-2"></i><span class="d-md-inline-block d-none">Tạo mã giảm giá</span>',
                        className: 'btn btn-primary waves-effect waves-light',
                        action: function(e, dt, button, config) {
                            window.location = "{{ route('admin.vouchers.addVouchers') }}";
                        }
                    },
                    {
                        text: '<i class="ti ti-calendar ti-xs me-md-2"></i>',
                        className: 'ms-2 btn btn-primary',
                        action: function(e, dt, button, config) {
                            flatpickr("#dateRange", {
                                mode: "range",
                                enableTime: false,
                                "locale": "vn",
                                dateFormat: "Y-m-d",
                                onClose: function(selectedDates, dateStr, instance) {
                                    dt.ajax
                                        .reload();
                                },
                            }).open();
                        }
                    }
                ],
                // For responsive popup
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function(row) {
                                var data = row.data();
                                return 'Chi tiết mã giảm giá - ' + data['name'];
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
            $('body').append('<input type="hidden" id="dateRange">');
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
