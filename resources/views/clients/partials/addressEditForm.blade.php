<div class="row align-items-center g-4 mt-3">
    <form action="{{ route('address.update') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $address->id }}">
        <div class="row g-4">
            <div class="col-sm-6">
                <div class="w-100 label-input-field">
                    <label>Tỉnh/Thành phố</label>
                    <select class="select2Address" name="province_id" required>
                        <option value="">Chọn Tỉnh/Thành phố</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}" @if ($address->province_id == $province->id) selected @endif>
                                {{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="w-100 label-input-field">
                    <label>Quận/Huyện</label>
                    <select class="select2Address" required name="district_id">
                        <option value="">Chọn Quận/Huyện</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}" @if ($address->district_id == $district->id) selected @endif>
                                {{ $district->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="w-100 label-input-field">
                    <label>Phường/Xã</label>
                    <select class="select2Address" required name="ward_id">
                        <option value="">Chọn Phường/Xã</option>
                        @foreach ($wards as $ward)
                            <option value="{{ $ward->id }}" @if ($address->ward_id == $ward->id) selected @endif>
                                {{ $ward->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
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

            <div class="col-sm-12">
                <div class="label-input-field">
                    <label>Địa chỉ chi tiết</label>
                    <textarea rows="4" placeholder="Số nhà ABC, ngõ 5/2" name="address" required>{{ $address->address }}</textarea>
                </div>
            </div>

        </div>
        <div class="mt-6 d-flex">
            <button type="submit" class="btn btn-secondary btn-md me-3">Cập nhật</button>
        </div>
    </form>
</div>
