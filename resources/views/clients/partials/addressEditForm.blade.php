<div class="row align-items-center g-4 mt-3">
    <form action="{{ route('address.update') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $address->id }}">
        <div class="row g-4 form-wrapper">
            <div class="col-sm-6">
                <div class="label-input-field form-inner">
                    <label>Họ và tên</label>
                    <input placeholder="Nguyễn Văn A" name="name" required autocomplete="off"
                        role="presentation" value="{{ $address->name }}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="label-input-field form-inner">
                    <label>Số điện thoại</label>
                    <input placeholder="0399999999" name="phone" required autocomplete="off"
                        role="presentation" value="{{ $address->phone }}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="w-100 label-input-field form-inner">
                    <label>Tỉnh/Thành phố</label>
                    <select class="select2Address" name="province_id" required autocomplete="off" role="presentation">
                        <option value="">Chọn Tỉnh/Thành phố</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->code }}" @if ($address->province_id == $province->code) selected @endif>
                                {{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="w-100 label-input-field form-inner">
                    <label>Quận/Huyện</label>
                    <select class="select2Address" required name="district_id" autocomplete="off" role="presentation">
                        <option value="">Chọn Quận/Huyện</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->code }}" @if ($address->district_id == $district->code) selected @endif>
                                {{ $district->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="w-100 label-input-field form-inner">
                    <label>Phường/Xã</label>
                    <select class="select2Address" required name="ward_id" autocomplete="off" role="presentation">
                        <option value="">Chọn Phường/Xã</option>
                        @foreach ($wards as $ward)
                            <option value="{{ $ward->code }}" @if ($address->ward_id == $ward->code) selected @endif>
                                {{ $ward->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="w-100 label-input-field form-inner">
                    <label>Thôn/Xóm</label>
                    <select class="select2Address" required name="village_id" autocomplete="off" role="presentation">
                        <option value="">Chọn Thôn/Xóm</option>
                        @if ($villages && $villages->isNotEmpty())
                            @foreach ($villages as $village)
                                <option value="{{ $village->code }}" @if ($address->village_id == $village->code) selected @endif>
                                    {{ $village->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="w-100 label-input-field form-inner">
                    <label>Địa chỉ chi tiết</label>
                    <input  placeholder="Số nhà ABC, ngõ 5/2" name="address" required autocomplete="off"
                        role="presentation" value="{{ $address->address }}">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="w-100 label-input-field">
                    <label>Mặc định</label>
                    <select class="select2Address" name="is_default">
                        <option value="0" @if ($address->is_default == 0) selected @endif>Không
                        </option>
                        <option value="1" @if ($address->is_default == 1) selected @endif>
                            Mặc định</option>
                    </select>
                </div>
            </div>
            <div class="mt-6 d-flex form-inner">
                <button class="primary-btn3 px-3 py-2">Thay đổi</button>
            </div>
        </div>

    </form>
</div>
