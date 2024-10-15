<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressFormRequest extends FormRequest
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
        $rules = [
            'name' => [
                'required',
                'string',
                'max:30',
                'regex:/^[AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]+ [AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]+(?: [AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]*)*$/u'
            ],
            'phone' => 'required|numeric|digits_between:8,12|regex:/^[0-9]{8,12}$/',
            'is_default' => 'nullable|in:0,1',
            'address' => 'required',
        ];
        if ($this->isMethod('post') || $this->isMethod('put')) {
            $rules['province_id'] = 'required|numeric';
            $rules['district_id'] = 'required|numeric';
            $rules['ward_id'] = 'required|numeric';
            $rules['village_id'] = 'required|numeric';
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Họ tên là bắt buộc.',
            'name.string' => 'Họ tên không hợp lệ.',
            'name.max' => 'Họ tên tối đa :max ký tự.',
            'name.regex' => 'Phải nhập đúng họ tên.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.numeric' => 'Số điện thoại không hợp lệ.',
            'phone.digits_between' => 'Số điện thoại phải có từ 8 đến 12 chữ số.',
            'phone.regex' => 'Số điện thoại phải đúng định dạng.',
            'is_default.in' => 'Địa chỉ mặc định không hợp lệ.',
            'province_id.required' => 'Tỉnh/Thành phố là bắt buộc.',
            'province_id.numeric' => 'Tỉnh/Thành phố không hợp lệ.',
            'district_id.required' => 'Quận/Huyện là bắt buộc.',
            'district_id.numeric' => 'Quận/Huyện không hợp lệ.',
            'ward_id.required' => 'Phường/Xã là bắt buộc.',
            'ward_id.numeric' => 'Phường/Xã không hợp lệ.',
            'village_id.required' => 'Thôn/Xóm là bắt buộc.',
            'village_id.numeric' => 'Thôn/Xóm không hợp lệ.',
            'address.required' => 'Địa chỉ chi tiết là bắt buộc.',
        ];
    }
}
