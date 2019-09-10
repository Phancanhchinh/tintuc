<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\TheLoai;
use App\models\LoaiTin;
use App\Http\Requests\TypeRequest;
class TypeController extends Controller
{
    protected $type;
    protected $cate;
    public function __construct(LoaiTin $type,TheLoai $cate){
        $this->type = $type;
        $this->cate = $cate;
    }
    public function getIndex()
    {
        $typenews = $this->type->getAllTypePaginate();
        $namecate = $this->cate->getAllCategory();
        return response()->Json([
            'typenews' => $typenews,
            'namecate' => $namecate,
        ],200);
    }
    public function getCreate(TypeRequest $req)
    {
        $create_type = $this->type->createTypeNews($req);
        return response('ok',200);
    }
    public function getUpdate(TypeRequest $req)
    {
        $update_type = $this->type->updateTypeNews($req);
        return response('ok',200);
    }
    public function getDelete($id)
    {
        $delete_type = $this->type->deleteType($id);
        return response('ok',200);
    }
}
