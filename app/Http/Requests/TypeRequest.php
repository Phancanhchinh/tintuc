<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest
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
            'idTL'=>'required',
            'Ten' => 'required|min:3|max:30',
            'ThuTu'=>'required',
            'lang'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'Ten.min' => 'Tên Loại Tin không được nhỏ hơn 3 ký tự',
            'Ten.max' => 'Tên Loại Tin lớn hơn 30 ký tự',
        ];
    }
    public function attributes()
    {
        return [
            'AnHien'=>'Ẩn Hiện Trên Menu',
            'idTL'=>'Tên Thể Loại',
            'Ten' => 'Tên Loại Tin',
            'ThuTu'=>'Thứ Tự',
            'lang'=>'Ngôn Ngữ'
        ];
    }
}
