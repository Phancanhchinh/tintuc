<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules(Request $req)
    {
        return [
            'password'=>'required|min:5',
            'email'=>'required|email|min:5|max:30|unique:users,email,'.$req->id,
            'name' => 'required|min:5|max:30',
            'phone'=>'required|min:5|max:15',
            'address'=>'required|min:5|max:50',
            'role'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',// hiển thị lỗi validate
            'min' => ':attribute phải có ít nhất 5 ký tự',
            'email.max' => 'Email quá 30 ký tự',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Không đúng định dạng email',
            'name.max' => 'tên của bạn quá 30 ký tự',
            'address.max' => 'Địa Chỉ quá 50 ký tự',
            'phone.max' => 'Số điện thoại quá 15 ký tự',
        ];
    }
    public function attributes()
    {
        return [
            'password' => 'Mật khẩu',
            'email'=>'Địa chỉ email',
            'name' => 'Họ và Tên',
            'phone'=>'Số Điện Thoại',
            'address'=>'Địa Chỉ',
            'role'=>'Quyền'
        ];
    }
}
