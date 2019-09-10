<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'AnHien'=>'required',
            'HienMenu'=>'required',
            'TenTL' => 'required|min:3|max:30',
            'ThuTu'=>'required',
            'lang'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'TenTL.min' => 'Tên Thể Loại không được nhỏ hơn 3 ký tự',
            'TenTL.max' => 'Tên Thể Loại lớn hơn 30 ký tự',
        ];
    }
    public function attributes()
    {
        return [
            'AnHien'=>'Ẩn Hiện Trên Menu',
            'HienMenu'=>'Hiện Menu',
            'TenTL' => 'Tên Thể Loại',
            'ThuTu'=>'Thứ Tự',
            'lang'=>'Ngôn Ngữ'
        ];
    }
}
