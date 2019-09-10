<?php

namespace App\models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'password','role','phone','address'
    ];
    protected $table = 'users';
    public $timestamps = true;
    protected $hidden = [
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getAllUser(){                           // lấy tất cả người dùng
        return $this->paginate(5);
    }
    public function createNewUser($req){
        $req['password'] = Hash::make($req['password']);        // tạo mới 1 người dùng
        return $this->create($req->all());
    }
    public function getIdUser($id){                 // lấy id một người dùng
        return $this->findOrFail($id);
    }
    public function updateUser($req){           // edit một người dùng
        $user = $this->getIdUser($req->id);
        return $user->update($req->all());
    }
    public function deleteUser($id){             // xóa một người dùng
        $user = $this->getIdUser($id);
        return $user->delete();
    }
    public function registerAccount($req){
        $req['password'] = Hash::make($req->password);
        return $this->create($req->all());
    }
    public function LoginAccount($req){
        if(Auth::attempt(['email' => $req->email, 'password' => $req->password]))
        {
            return true;
        }else{
            return false;
        }
    }
}
