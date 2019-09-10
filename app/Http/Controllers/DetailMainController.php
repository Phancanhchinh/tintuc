<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\SendMail;
use Illuminate\Mail\Mailable;
use Datetime;
use App\models\User;
use App\models\Tin;
use App\models\LoaiTin;
use App\models\YKien;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Session;

class DetailMainController extends Controller
{
    protected $news,$type,$user,$comment;
    public function __construct(Tin $news,LoaiTin $type,User $user,YKien $comment)
    {
        $this->news = $news;
        $this->type = $type;
        $this->user = $user;
        $this->comment = $comment;
    }
    public function getDetail(Request $req){

        $lang = $this->news->getLang();
        $detailNews = $this->news->getDetailNews($req->tenkd);
        $comment = $this->comment->getComment($detailNews->id);
        $relateNews = $this->news->getRelatedNews($lang,$detailNews->idTL,$detailNews->id);
        return view('main.pages.show_detailnews',compact('detailNews','comment','relateNews'));
    }
    public function postDetail(CommentRequest $req){
        $comment = $this->comment->CommentNews($req);
        return redirect()->back();
    }
    public function getAllNewsByType(Request $req)
    {
        $lang = $this->news->getLang();
        $detailType = $this->type->getIdTypebyName($req->tenkd);
        $allnewsByType = $this->news->getNewsByType($detailType->id,$lang);
        return view('main.pages.show_allnewsbytype',compact('detailType','allnewsByType'));
    }
}

