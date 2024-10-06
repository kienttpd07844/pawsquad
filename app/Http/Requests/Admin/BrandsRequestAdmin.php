<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandsRequestAdmin extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string',
            'status' => 'nullable|in:on',
            'description' => 'nullable|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:500',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            '*.image' => ':attribute phải là một hình ảnh.',
            '*.mimes' => ':attribute phải có định dạng: :values.',
        ];
    }
    public function attributes()
    {
        return [
            'slug' => 'Đường dẫn',
            'name' => 'Tên nhãn hàng',
            'description' => 'Mô tả',
            'status' => 'Trạng thái',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
        ];
    }
}
