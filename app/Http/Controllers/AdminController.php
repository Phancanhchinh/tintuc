<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getIndex()
    {
        return view('admin.layout.master');
    }
    public function getLogin()
    {
        return  view('admin.layout.login');
    }
    public function postLogin(Request $req)
    {
        $req->validate(
            ['email'=>'required',
            'password'=>'required|min:3|max:32',]);
        if(Auth::attempt(['email' => $req->email, 'password' => $req->password]))
        {
            return redirect('/backend');
        }else{
            return redirect('/backend/login')->with('thongbao','dang nhap nhat bai');
        }
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect('/backend/login');
    }
}
