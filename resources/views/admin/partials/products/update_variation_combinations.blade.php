<div class="border bg-light-subtle rounded p-2">
    <table class="tables tt-footable tt-footable-border-0">
        <thead>
            <tr>
                <th>
                    <label for="" class="control-label">Biến thể</label>
                </th>
                <th data-breakpoints="xs sm">
                    <label for="" class="control-label">Giá</label>
                </th>
                <th data-breakpoints="xs sm">
                    <label for="" class="control-label">Số lượng</label>
                </th>
                <th data-breakpoints="xs sm">
                    <label for="" class="control-label">Code</label>
                </th>
                <th>
                    <label for="" class="control-label">Xóa</label>
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($variations as $key => $variation)
                @php
                    $name = '';
                    $code_array = array_filter(explode('/', $variation->variation_key));
                    $lstKey = array_key_last($code_array);

                    foreach ($code_array as $key2 => $comb) {
                        $comb = explode(':', $comb);

                        $option_name = \App\Models\Variations::withTrashed()->find($comb[0])->name;
                        $choice_name = \App\Models\VariationValues::find($comb[1])->name;

                        $name .= $choice_name;

                        if ($lstKey != $key2) {
                            $name .= '-';
                        }
                    }
                @endphp

                <tr class="variant">
                    <td>
                        <input type="text" value="{{ $name }}" class="form-control" disabled>
                        <input type="hidden" value="{{ $variation->variation_key }}"
                            name="variations[{{ $key }}][variation_key]">
                    </td>
                    <td>
                        <input type="number" step="1000" name="variations[{{ $key }}][price]"
                            min="0" class="form-control" value="{{ $variation->price }}" required>
                    </td>
                    <td>
                        <input type="number" name="variations[{{ $key }}][stock]"
                            value="{{ $variation->product_variation_stock ? $variation->product_variation_stock->stock_qty : 0 }}"
                            min="0" class="form-control" required>
                    </td>
                    <td>
                        <input type="text" name="variations[{{ $key }}][code]"
                            value="{{ $variation->code }}" value="code" class="form-control">
                    </td>
                    <td>
                        <a class="text-danger" data-toggle="remove-parent" data-parent="tr">
                            <i class="me-1 menu-icon tf-icons ti ti-trash"></i>
                        </a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
