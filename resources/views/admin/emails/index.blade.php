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
                <h5 class="card-title">Danh sách email</h5>
                <small class="text-muted">Đây là email của hệ thống</small>

            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables-products table">
                    <thead class="border-top">
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Loại</th>
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
                    url: "{{ route('admin.emails.index') }}",
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
                        data: 'email_type'
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
                            return limitText(full['name'], 20);
                        }
                    },
                    {
                        // Email_type
                        targets: 3,
                        render: function(data, type, full, meta) {
                            return limitText(full['email_type'], 20);
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
                buttons: [],
                // For responsive popup
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function(row) {
                                var data = row.data();
                                return 'Chi tiết email - ' + data['name'];
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
