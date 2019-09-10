<?php
namespace App\Http\Controllers\API;
use App\models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
class UsersController extends Controller
{
    protected $user;
    public function __construct(User $user){
        $this->user = $user;
    }
    public function getIndex()
    {
        $user = $this->user->getAllUser();
        return response()->Json(['user' => $user],200);
    }
    public function getCreate(UserRequest $req)
    {
        $newUsers = $this->user->createNewUser($req);
        return response('ok',200);
    }
    public function getUpdate(UserRequest $req)
    {
        $updUser = $this->user->updateUser($req);
        return response('ok',200);
    }
    public function getDelete($id)
    {
        $delUser = $this->user->deleteUser($id);
        return response('ok',200);
    }
}
