<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'Email' => 'required|min:5|max:30|email',
            'HoTen'=>'required|min:5|max:30',
            'NoiDung'=>'required|min:5|max:300',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',
            'min' => ':attribute nhỏ hơn 5 ký tự',
            'max' => ':attribute quá 30 ký tự',
            'Email.email' => 'không đúng định dạng email',
            'NoiDung.max' => 'Comment quá 300 ký tự',

        ];
    }
    public function attributes()
    {
        return [
            'Email' => 'Địa chỉ email',
            'HoTen' => 'Họ và Tên',
            'NoiDung' => 'Bình Luận'
        ];
    }
}
