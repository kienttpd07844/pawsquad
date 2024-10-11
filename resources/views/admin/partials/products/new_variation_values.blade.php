<select class="form-control variations select2" name="option_{{ $variation_id }}_choices[]" multiple required
    onchange="generateVariationCombinations()" data-placeholder="Chọn giá trị biến thể">
    @foreach ($variation_values as $key => $variation_value)
        <option value="{{ $variation_value->id }}">{{ $variation_value->name }}</option>
    @endforeach
</select>
