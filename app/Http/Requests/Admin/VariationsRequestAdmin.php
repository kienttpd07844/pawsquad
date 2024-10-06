<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VariationsRequestAdmin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'status' => 'nullable|in:on',
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
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên biến thể',
            'status' => 'Trạng thái',
        ];
    }
}
