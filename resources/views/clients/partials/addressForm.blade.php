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

                        <form action="{{ route('address.store') }}" id="address_info" method="POST" autocomplete="off">
                            @csrf
                            <div class="row g-4 form-wrapper">
                                <div class="col-sm-6">
                                    <div class="label-input-field form-inner">
                                        <label>Họ và tên</label>
                                        <input placeholder="Nguyễn Văn A" name="name"  autocomplete="off"
                                            role="presentation">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="label-input-field form-inner">
                                        <label>Số điện thoại</label>
                                        <input placeholder="0399999999" name="phone"  autocomplete="off"
                                            role="presentation">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="w-100 label-input-field form-inner">
                                        <label>Tỉnh/Thành Phố</label>
                                        <select class="select2Address" name="province_id"  autocomplete="off"
                                            role="presentation">
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
                                        <select class="select2Address"  name="district_id" autocomplete="off"
                                            role="presentation">
                                            <option value="">Chọn Quận/Huyện</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="w-100 label-input-field form-inner">
                                        <label>Phường/Xã</label>
                                        <select class="select2Address"  name="ward_id" autocomplete="off"
                                            role="presentation">
                                            <option value="">Chọn Phường/Xã</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="w-100 label-input-field form-inner">
                                        <label>Thôn/Xóm</label>
                                        <select class="select2Address"  name="village_id" autocomplete="off"
                                            role="presentation">
                                            <option value="">Chọn Thôn/Xóm</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="label-input-field form-inner">
                                        <label>Địa chỉ chi tiết</label>
                                        <input placeholder="Số nhà ABC, ngõ 5/2" name="address"
                                            autocomplete="off" role="presentation">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="w-100 label-input-field form-inner">
                                        <label>Địa chỉ mặc định</label>
                                        <select class="select2Address" name="is_default" autocomplete="off"
                                            role="presentation">
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
    <div class="modal-dialog modal-dialog-centered modal-lg shadow-0">
        <div class="modal-content">
            <div class="modal-header bg-white">
                <h2 class="modal-title fs-5 mb-0">Cập nhật thông tin địa chỉ</h2>
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="gstore-product-quick-view bg-white rounded-3 py-6 px-4">

                    <div class="spinner pt-6 pb-8 d-none">
                        <div class="row align-items-center g-4 mt-3">
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Đang tải...</span>
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
                <h2 class="modal-title fs-5 mb-3">Xoá thông tin địa chỉ</h2>
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="bg-white rounded-3 py-6 px-4">
                    <div class="pt-6 pb-8 text-center">
                        <h5 class="text-danger">Bạn có chắc muốn xoá địa chỉ?</h5>
                    </div>
                    <div class="text-center form-inner">
                        <a href="" class="primary-btn3 px-3 py-2 delete-address-link">Xác nhận</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


