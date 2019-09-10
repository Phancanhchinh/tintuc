<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Mail;
use Illuminate\Support\Facades\Session;
class SendMail extends Model
{
    public function SendMailComment($name,$email,$comment){
        $array = array('name' => $name,'email' => $email, 'comment' => $comment);
        Mail::send('main.pages.mailComment', $array, function ($message) use($name,$email,$comment) {
            $message->from('1551010013chinh@ou.edu.vn', 'Web Tin Tức');
            $message->to($email, $name);
            $message->subject("Cảm Ơn Đã Bình Luận");
        });
    }
    public function SendMailLienHe($name,$email,$content){
        $array1 = array('name' => $name,'email' => $email, 'content' => $content);
        Mail::send('main.pages.mailLienHe', $array1, function($message) use($name,$email,$content){
            $message->to($email, $name);
            $message->subject('Thư phản hồi');
        });
        Session::flash('thongbao', '<h1 class="text-danger">Tin nhắn của bạn đã được gửi.</h1>');
    }
}
