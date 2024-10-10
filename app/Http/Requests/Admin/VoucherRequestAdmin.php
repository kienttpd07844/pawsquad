<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VoucherRequestAdmin extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'min:2',
                'max:20',
            ],
            'description' => 'required|max:50',
            'start_date' => 'required|date_format:d-m-Y H:i',
            'end_date' => 'required|date_format:d-m-Y H:i|after:start_date',
            'quantity' => 'required|numeric',
            'index' => 'numeric|in:0,1',
            'discount_type' => 'required|in:flat,percentage',
            'discount' => 'required|numeric|min:1',
            'min_spend' => 'required|numeric|min:1',
            'customer_usage_limit' => 'required|numeric|min:1'
        ];
    }
    public function withValidator($validator)
    {
        $validator->sometimes('discount', 'numeric|max:100', function ($input) {
            return $input->discount_type === 'percentage';
        });
    }
    public function messages()
    {
        return [
            '*.required' => 'Vui lòng nhập :attribute',
            '*.min' => ':Attribute tối thiểu :min ký tự',
            '*.max' => ':Attribute tối đa :max ký tự',
            '*.unique' => ':Attribute đã tồn tại trong hệ thống',
            '*.date_format' => ':Attribute có định dạng không hợp lệ. Định dạng yêu cầu là dd/mm/yyyy',
            '*.numeric' => ':Attribute phải là 1 số',
            '*.in' => ':Attribute không hợp lệ',
            'end_date.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
            'discount.max' => 'Phần trăm giảm giá không được vượt quá 100%.',
        ];
    }
    public function attributes()
    {
        return [
            'code' => 'mã code giảm giá',
            'description' => 'mô tả',
            'start_date' => 'ngày bắt đầu',
            'end_date' => 'ngày kết thúc',
            'quantity' => 'số lượng',
            'index' => 'hiển thị trang chủ',
            'discount_type' => 'loại giảm giá',
            'discount' => 'số tiền giảm giá',
            'min_spend' => 'số tiền tối thiểu',
            'customer_usage_limit' => 'số lần sử dụng',
        ];
    }
}
