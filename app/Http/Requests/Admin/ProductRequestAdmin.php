<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequestAdmin extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:300',
            'description' => 'required|string',
            'status' => 'required|integer|in:0,1,2',
            'featured' => 'required|integer|in:0,1',
            'category' => 'required',
            'brands' => 'nullable',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:500',
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
            'name' => 'Tên sản phẩm',
            'slug' => 'Đường dẫn sản phẩm',
            'short_description' => 'Mô tả ngắn',
            'description' => 'Nô tả',
            'status' => 'Trạng thái',
            'featured' => 'Nổi bật',
            'price' => 'Giá sản phẩm',
            'old_price' => 'Giá cũ sản phẩm',
            'stock' => 'Số lượng',
            'code' => 'Mã sản phẩm',
            'category' => 'Danh mục sản phẩm',
            'brands' => 'Thương hiệu',
            'meta_title' => 'Tiêu đề SEO',
            'meta_description' => 'Mô tả SEO',
        ];
    }
}
