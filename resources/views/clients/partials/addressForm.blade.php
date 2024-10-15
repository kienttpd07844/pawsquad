<div class="modal fade addAddressModal" id="addAddressModal">
    <div class="modal-dialog modal-dialog-centered modal-lg shadow-0">
        <div class="modal-content">
            <div class="modal-header bg-white">
                <h2 class="modal-title fs-5 mb-0">Thêm thông tin địa chỉ</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="gstore-product-quick-view bg-white rounded-3 py-6 px-4">

                    <div class="row align-items-center g-4 mt-3">

                        <form action="{{ route('address.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="row g-4 form-wrapper">
                                <div class="col-sm-6">
                                    <div class="label-input-field form-inner">
                                        <label>Họ và tên</label>
                                        <input placeholder="Nguyễn Văn A" name="name" required autocomplete="off" role="presentation">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="label-input-field form-inner">
                                        <label>Số điện thoại</label>
                                        <input placeholder="0399999999" name="phone" required autocomplete="off" role="presentation">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="w-100 label-input-field form-inner">
                                        <label>Tỉnh/Thành Phố</label>
                                        <select class="select2Address" name="province_id" required autocomplete="off" role="presentation">
                                            <option value="">Chọn Tỉnh/Thành phố</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->code }}">{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="w-100 label-input-field form-inner">
                                        <label>Quận/Huyện</label>
                                        <select class="select2Address" required name="district_id" autocomplete="off" role="presentation">
                                            <option value="">Chọn Quận/Huyện</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="w-100 label-input-field form-inner">
                                        <label>Phường/Xã</label>
                                        <select class="select2Address" required name="ward_id" autocomplete="off" role="presentation">
                                            <option value="">Chọn Phường/Xã</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="w-100 label-input-field form-inner">
                                        <label>Thôn/Xóm</label>
                                        <select class="select2Address" required name="village_id" autocomplete="off" role="presentation">
                                            <option value="">Chọn Thôn/Xóm</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="label-input-field form-inner">
                                        <label>Địa chỉ chi tiết</label>
                                        <input placeholder="Số nhà ABC, ngõ 5/2" name="address" required autocomplete="off" role="presentation">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="w-100 label-input-field form-inner">
                                        <label>Địa chỉ mặc định</label>
                                        <select class="select2Address" name="is_default" autocomplete="off" role="presentation">
                                            <option value="0">Không</option>
                                            <option value="1">Mặc định</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-6 d-flex form-inner">
                                    <button class="primary-btn3 px-3 py-2">Lưu</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade editAddressModal" id="editAddressModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-white">
                <h2 class="modal-title fs-5 mb-0">Cập nhật địa chỉ</h2>
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="gstore-product-quick-view bg-white rounded-3 py-6 px-4">

                    <div class="spinner pt-6 pb-8 d-none">
                        <div class="row align-items-center g-4 mt-3">
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="edit-address d-none">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade deleteAddressModal" id="deleteAddressModal">
    <div class="modal-dialog address-delete-modal modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-white">
                <h2 class="modal-title fs-5 mb-3">Xoá địa chỉ</h2>
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="bg-white rounded-3 py-6 px-4">
                    <div class="pt-6 pb-8 text-center">
                        <h6>Bạn có muốn xoá địa chỉ</h6>
                    </div>
                    <div class="text-center">
                        <a href="" class="btn btn-secondary delete-address-link">Xoá</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/vi.js"></script>
    <script>
        "use strict";

        var parent = '.addAddressModal';

        // chạy khi tài liệu đã sẵn sàng --> đối với các tệp phương tiện
        $(document).ready(function() {
            if ($("input[name='shipping_address_id']").is(':checked')) {
                let city_id = $("input[name='shipping_address_id']:checked").data('city_id');
                getLogistics(city_id);
            }
        });


        // Địa chỉ mới
        function addNewAddress() {
            $('#addAddressModal').modal('show');
            const parent = '.addAddressModal';
            addressModalSelect2(parent);
        }

        //  sửa địa chỉ
        function editAddress(addressId) {
            $('#editAddressModal').modal('show');
            $('.spinner').removeClass('d-none');
            $('.edit-address').addClass('d-none');

            parent = '.editAddressModal';
            getAddress(addressId);
        }

        //  xoá địa chỉ
        function deleteAddress(thisAnchorTag) {
            $('#deleteAddressModal').modal('show');
            $('.delete-address-link').prop('href', $(thisAnchorTag).data('url'));
        }

        function addressModalSelect2(parent = '.addAddressModal') {
            // Hủy khởi tạo Nice Select nếu đã khởi tạo
            if ($('.select2Address').hasClass('nice-select')) {
                $('.select2Address').niceSelect('destroy');
            }

            $('.select2Address').select2({
                dropdownParent: $(parent),
                language: 'vi',
                width: '100%'
            });

        }

        $(document).ready(function() {
            addressModalSelect2();
        });

        $(document).on('select2:select', 'select[name="province_id"]', function(e) {
            var province_id = e.params.data.id;
            if (province_id) {
                resetFields(['district_id', 'ward_id', 'village_id']);
                getDistrict(province_id);
            }
        });


        // Hàm lấy dữ liệu Quận/Huyện theo Province ID
        function getDistrict(province_id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: "{{ route('address.getDistrict') }}",
                type: 'POST',
                data: {
                    province_id: province_id
                },
                success: function(response) {
                    var $districtSelect = $('select[name="district_id"]');
                    $districtSelect.html(response);
                    addressModalSelect2(parent)
                },
                error: function(xhr) {
                    console.error('Error:', xhr); // Kiểm tra lỗi
                }
            });
        }




        //  lấy Phường/Xã khi chọn Huyện
        $(document).on('select2:select', 'select[name="district_id"]', function(e) {
            var district_id = e.params.data.id;
            if (district_id) {
                resetFields(['ward_id', 'village_id']);
                getWard(district_id);
            }
        });



        //  lấy Phường/Xã
        function getWard(district_id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: "{{ route('address.getWard') }}",
                type: 'POST',
                data: {
                    district_id: district_id
                },
                success: function(response) {
                    var $ward_id = $('select[name="ward_id"]');
                    $ward_id.html(response);
                    addressModalSelect2(parent)

                }
            });
        }

        //  lấy Thôn/Xóm chọn Xã
        $(document).on('select2:select', 'select[name="ward_id"]', function(e) {
            var ward_id = e.params.data.id;
            if (ward_id) {
                resetFields(['village_id']);
                getVillage(ward_id);
            }
        });

        //  lấy Thôn/Xóm
        function getVillage(ward_id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: "{{ route('address.getVillage') }}",
                type: 'POST',
                data: {
                    ward_id: ward_id
                },
                success: function(response) {
                    var $village_id = $('select[name="village_id"]');
                    $village_id.html(response);
                    addressModalSelect2(parent)
                }
            });
        }

        function resetFields(fields) {
            fields.forEach(function(field) {
                var placeholder = '';
                switch (field) {
                    case 'district_id':
                        placeholder = 'Chọn Quận/Huyện';
                        break;
                    case 'ward_id':
                        placeholder = 'Chọn Phường/Xã';
                        break;
                    case 'village_id':
                        placeholder = 'Chọn Thôn/Xóm';
                        break;
                    default:
                        placeholder = 'Chọn...';
                }
                $('select[name="' + field + '"]').html('<option value="">' + placeholder + '</option>');
            });
        }


        //  sửa địa chỉ
        function getAddress(addressId) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: "{{ route('address.edit') }}",
                type: 'POST',
                data: {
                    addressId: addressId
                },
                success: function(response) {
                    $('.spinner').addClass('d-none');
                    $('.edit-address').html(response);
                    $('.edit-address').removeClass('d-none');
                    addressModalSelect2(parent);
                }
            });
        }
    </script>
@endsection
