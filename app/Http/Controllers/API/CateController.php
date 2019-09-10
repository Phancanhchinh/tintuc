<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\TheLoai;
use App\Http\Requests\CategoryRequest;
class CateController extends Controller
{
    protected $cate;
    public function __construct(TheLoai $cate)
    {
        $this->cate = $cate;
    }
    public function getIndex()
    {
        $category = $this->cate->getAllCategoryPaginate();
        return response()->Json([
            'data' => $category,
            ]);
    }
    public function getCreate(CategoryRequest $req)
    {
        $create_cate = $this->cate->createCategory($req);
        return response('ok',200);
    }
    public function getUpdate(CategoryRequest $req)
    {
        $update_cate = $this->cate->updateCategory($req);
        return response('ok',200);
    }
    public function getDelete($id)
    {
        $delete_cate = $this->cate->deleteCategory($id);
        return response('ok',200);
    }
}
