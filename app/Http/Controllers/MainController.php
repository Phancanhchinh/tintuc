<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\SendMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use App\models\User;
use App\models\Tin;
use App\models\LoaiTin;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
class MainController extends Controller
{
    protected $news,$type,$user;
    public function __construct(Tin $news,LoaiTin $type,User $user)
    {
        $this->news = $news;
        $this->type = $type;
        $this->user = $user;
    }
    public function getIndex(){
        $lang = $this->news->getLang();
        $newsLatest = $this->news->getLatestNews();
        $newsHot = $this->news->getHotNews($lang);
        $NewsByType = $this->type->getItemType();
        $NewsFastAll = $this->news->getNewsAll($lang);
        $NewsFastByType = $this->type->getNewsinType($lang);
        $TypeCarousel = $this->type->getTypeCarousel();
        $NewsCarousel = $this->news->getNewsCarousel($lang,$TypeCarousel->id);
        $NewsColumn = $this->type->getTypeRow();
        $recommend = $this->news->getRecommend($lang);
        $NewsGaneral = $this->news->getGeneralNews($lang);
        return view('main.pages.center',
        compact('newsLatest','newsHot','NewsByType','NewsFastAll',
        'NewsFastByType','TypeCarousel','NewsCarousel','NewsColumn','recommend','NewsGaneral'));
    }
    public function getTimKiem(Request $req){
        $lang = $this->news->getLang();
        $key = $req->txtSearch;
        $result = $this->news->getSearch($lang,$key);
        return view('main.pages.show_search',compact('key','result'));
    }
    public function getLienHe(Request $req){
        return view('main.pages.show_contact');
    }
    public function postLienHe(Request $req){
        $mail = new SendMail();
        $mail->SendMailLienHe($req->name,$req->email,$req->message);
        return redirect()->back();
    }
    public function getLogin()
    {
        return view('main.pages.show_login');
    }
    public function postLogin(LoginRequest $req)
    {
        if($login = $this->user->LoginAccount($req))
        {
            return redirect('/');
        }else{
            return redirect('/dang-nhap')->with('thongbao','Đăng nhập thất bại');
        }
    }
    public function getRegister()
    {
        return view('main.pages.show_register');
    }
    public function postRegister(RegisterRequest $req)
    {
        $this->user->registerAccount($req);
        return redirect('/dang-nhap')->with('thongbao','đăng ký thành công mời bạn đăng nhập');
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}



