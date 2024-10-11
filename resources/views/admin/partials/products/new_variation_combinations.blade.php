@if (count($combinations[0]) > 0)
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
                @foreach ($combinations as $key => $combination)
                    @php
                        $name = '';
                        $variation_key = '';
                        $lstKey = array_key_last($combination);

                        foreach ($combination as $option_id => $choice_id) {
                            $option_name = \App\Models\Variations::find($option_id)->name;
                            $choice_name = \App\Models\VariationValues::find($choice_id)->name;

                            $name .= $choice_name;
                            $variation_key .= $option_id . ':' . $choice_id . '/';

                            if ($lstKey != $option_id) {
                                $name .= '-';
                            }
                        }
                    @endphp
                    <tr class="variant">
                        <td>
                            <input type="text" value="{{ $name }}" class="form-control" disabled>

                            <input type="hidden" value="{{ $variation_key }}"
                                name="variations[{{ $key }}][variation_key]">
                        </td>
                        <td>
                            <input type="number" step="1000" name="variations[{{ $key }}][price]"
                                value="0" min="0" class="form-control" required>
                        </td>
                        <td>
                            <input type="number" name="variations[{{ $key }}][stock]" value="0"
                                min="0" class="form-control" required>
                        </td>
                        <td>
                            <input type="text" name="variations[{{ $key }}][code]"
                                value="{{ $name }}" class="form-control text-lowercase">
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
@endif
