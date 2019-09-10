<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email'=>'required|email',
            'password'=>'required|min:4|max:15',
        ];
    }
    public function messages()
    {
        return [
                'required' => ':attribute không được bỏ trống',
                'email.email' => 'không đúng định dạng email',
                'password.min' => 'mật khẩu tối thiểu 4 ký tự',
                'password.max' => 'mật khẩu quá 15 kí tự',

        ];
    }
    public function attributes()
    {
        return [
            'email' => 'Địa chỉ email',
            'password' => 'Mật khẩu'
        ];
    }
}
