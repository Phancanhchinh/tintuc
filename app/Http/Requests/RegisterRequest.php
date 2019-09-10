<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
                'email' => 'required|unique:users,email|min:5|max:30',
                'name'=>'required|max:30',
                'phone'=>'required|min:5|max:30',
                'address'=>'required|min:5|max:100',
                'password'  =>  'required|min:5|max:30',
                'passwordAgain' => 'same:password',

        ];
    }
    public function messages()
    {
        return [
                'required' => ':attribute không được để trống',
                'unique'=>'Email đã tồn tại',
                'email'=>'Không đúng định dạng email',
                'min'=>':attribute chưa đủ 5 ký tự',
                'address.max'  =>  'Địa chỉ quá 100 ký tự',
                'max'  =>  ':attribute quá 30 ký tự',
                'same' => '2 mật khẩu không trùng nhau',

        ];
    }
    public function attributes()
    {
        return [
                'email' => 'Địa chỉ email',
                'name'=>'Tên',
                'phone'=>'Số điện thoại',
                'address'=>'Địa chỉ',
                'password'  =>  'Mật khẩu',
        ];
    }
}
