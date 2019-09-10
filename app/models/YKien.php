<?php

namespace App\models;
use Datetime;
use App\SendMail;
use Illuminate\Database\Eloquent\Model;

class YKien extends Model
{
    protected $table = 'ykien';
    protected $fillable = [
        'idTin', 'Ngay', 'NoiDung','Email','HoTen','AnHien'
    ];
    public $timestamps = false;
    public function tin()
    {
        return $this->belongsTo('App\models\Tin', 'idTin', 'idYKien');
    }
    public function getComment($id)
    {
        return $comment = $this->where('idTin','=',$id)->get();
    }
    public function CommentNews($req)
    {
        $req['Ngay'] = new Datetime();
        $mail = new sendMail();
        $mail->SendMailComment($req->HoTen,$req->Email,$req->NoiDung);
        return $comment = $this->create($req->all());
    }
}


