<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class LangController extends Controller
{
    public function getLang($lang){
        Session::put('locale',$lang);
        return redirect()->route('index',['lang' => $lang]);
    }
}
