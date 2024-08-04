<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'ten_nguoi_nhan' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'sđt' => 'required|string|regex:/^0[1-9][0-9]{8,9}$/|',
            'dia_chi' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [

            'ten_nguoi_nhan .required' => 'bắt buộc nhập',
            'ten_nguoi_nhan .string' => 'tên là chuỗi kí tự',
            'ten_nguoi_nhan .max' => 'Vượt quá giới hạn kí tự',

            'email .required' => 'Email bắt buộc nhập',
            'email .string' => 'Email là chuỗi kí tự',
            'email .email' => 'đây không phải là email',
            'email .max' => 'vượt quá giới hạn kí tự',

            'sđt .required' => 'Bắt buộc nhập số điện thoại',
            'sđt .string' => 'số điện thoại là chuỗi kí tự',
            'sđt .regex' => 'định dạng số điện thoại không hợp lệ',

            'dia_chi.required' => 'bắt buộc nhập địa chỉ',
            'dia_chi.string' => 'Địa chỉ là chuỗi kí tự',
            'dia_chi.max' => 'Địa chỉ quá giới hạn',

        ];
    }
}
