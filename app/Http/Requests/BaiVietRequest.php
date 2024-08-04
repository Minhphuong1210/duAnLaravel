<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaiVietRequest extends FormRequest
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
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
throw new HttpResponseException(response()->json([
    'message'=>'Loi them bai viet',
    'status' =>false,
    'errors'=>$validator->errors()
],400));
    }
    public function rules(): array
    {
        return [
            'hinh_anh' =>'nullable|image|mimes:jpg,png,',
            'tieu_de' =>'required|string|max:255',
            'noi_dung' =>'required',
        ];
    }
   
}
