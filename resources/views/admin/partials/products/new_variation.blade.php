<div class="row g-3 mt-2">
    <div class="col-lg-6">
        <div class="mb-0">
            <select class="form-select variations select2" onchange="getVariationValues(this)" name="chosen_variations[]">
                <option value="">Chọn biến thể
                </option>
                @foreach ($variations as $key => $variation)
                    <option value="{{ $variation->id }}">
                        {{ $variation->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="d-flex">
            <div class="row flex-grow-1">
                <div class="variationvalues">
                    <input type="text" class="form-control"
                        placeholder="Chọn giá trị biến thể" />
                </div>
            </div>

            <button type="button" data-toggle="remove-parent" class="btn btn-link px-2" data-parent=".row">
                <i class="menu-icon tf-icons ti ti-trash text-danger"></i>
            </button>
        </div>
        <span class="text-danger fw-medium fs-xs">
            Trước khi nhấp vào nút xóa, hãy xóa các biến thể đã chọn nếu đã chọn
        </span>
    </div>

</div>
