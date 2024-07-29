<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSanPhamRequest extends FormRequest
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
            'ma_san_pham'=>'required|max:10|unique:san_phams,ma_san_pham,'.$this->route('id'),
            'ten_san_pham'=>'required|max:255|',
            'hinh_anh_san_pham'=>'image|mimes:jpg,jpeg,png,gif',
            'gia_san_pham'=>'required|numeric|min:0',
            'gia_khuyen_mai'=>'numeric|nullable|min:0|lt:gia_san_pham',
            'mo_ta_ngan'=>'max:255',
            'so_luong'=>'integer|min:0',
            'ngay_nhap'=>'required|date',
            'danh_muc_id'=>'required|exists:danh_mucs,id'
    // ở đây là số ít không phải số nhiều 
        ];
    }

    public function messages(): array
    {
        return [
            'ma_san_pham.required'=>' mã sản phẩm bắt buộc điền ',
            'ma_san_pham.max:10'=>'mã sản phẩm không được quá 10 kí tự',
            'ma_san_pham.unique'=>'mã sản phẩm không được trùng nhau',
            'ten_san_pham.required'=>'tên sản phẩm bắt buộc điền',
            'ten_san_pham.max:255'=>'tên sản phẩm không được quá 255 kí tự',
            'hinh_anh_san_pham.image'=>'hình ảnh không hợp lệ',
            'hinh_anh_san_pham.mimes'=>'hình ảnh không hợp lệ',
            'gia_san_pham.required'=>'giá sản phẩm là bắt buộc',
            'gia_san_pham.numeric'=>'giá sản phẩm phải là số',
            'gia_san_pham.min:0'=>'giá sản phẩm lớn hơn không',
            'gia_khuyen_mai.numeric'=>'giá khuyến mãi phải là số',
            'gia_khuyen_mai.min:0'=>'giá khuyến mãi lớn hơn không',
            'gia_khuyen_mai.lt'=>'giá khuyến mãi phải là nhỏ hơn giá sản phẩm',
            'mo_ta_ngan.max'=>'không được vượt quá 255 kí tự',
            'so_luong.integer'=>'số lượng phải là số',
            'so_luong.min'=>'số lượng phải lớn hơn hoặc bằng không ',
            'ngay_nhap.required'=>'ngày nhập bắt buộc điền',
            'ngay_nhap.date'=>'ngày nhập sai định dạng',
            'danh_muc_id.required'=>'danh mục là bắt buộc',
            'danh_muc_id.exists'=>'danh mục không hợp lệ'
        ];
    } 
    
}
