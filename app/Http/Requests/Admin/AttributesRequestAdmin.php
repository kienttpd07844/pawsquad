<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AttributesRequestAdmin extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'nullable|in:on',
            'attributeset' => 'required',
            'categories' => 'nullable',
            'value' => 'nullable|array',
            'value.*.id' => 'required|string',
            'value.*.value' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            '*.required' => ':attribute là bắt buộc.',
            '*.string' => ':attribute phải là chuỗi ký tự.',
            '*.max' => ':attribute không được dài quá :max ký tự.',
            '*.exists' => ':attribute không hợp lệ.',
            '*.in' => ':attribute không đúng.',
            'value.array' => 'Giá trị phải là mảng.',
            'value.*.id.required' => 'ID thuộc tính là bắt buộc.',
            'value.*.id.string' => 'ID thuộc tính phải là chuỗi ký tự.',
            'value.*.value.required' => 'Giá trị thuộc tính là bắt buộc.',
            'value.*.value.string' => 'Giá trị thuộc tính phải là chuỗi ký tự.',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên thuộc tính',
            'status' => 'Trạng thái',
            'categories' => 'Danh mục game',
            'value' => 'Giá trị thuộc tính',
            'attributeset' => 'Nhóm thuộc tính'
        ];
    }
}
