<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'TieuDe' => 'required|min:3|max:30',
            'Content'=>'required',
            'TomTat'=>'required',
            'idTL'=>'required',
            'TinNoiBat'=>'required',
            'lang'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'TieuDe.min' => 'Tên Thể Loại không được nhỏ hơn 3 ký tự',
            'TieuDe.max' => 'Tên Thể Loại lớn hơn 30 ký tự',
        ];
    }
    public function attributes()
    {
        return [
            'AnHien'=>'Ẩn Hiện Trên Menu',
            'TieuDe'=>'Tiêu Đề Bài Viết',
            'Content' => 'Nội Dung Bài Viết',
            'TomTat'=>'Tóm Tắt Bài Viết',
            'idTL'=>'Tên Thể Loại',
            'TinNoiBat'=>'Tin Nổi Bật',
            'lang'=>'Ngôn Ngữ',
        ];
    }
}
