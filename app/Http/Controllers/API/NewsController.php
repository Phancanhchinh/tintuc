<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\TheLoai;
use App\models\LoaiTin;
use App\models\Tin;
use App\Http\Requests\NewsRequest;
class NewsController extends Controller
{
    protected $news;
    protected $category;
    protected $type;
    public function __construct(Tin $news,TheLoai $category,LoaiTin $type)
    {
        $this->news = $news;
        $this->category = $category;
        $this->type = $type;
    }
    public function getIndex()
    {
        $type = $this->type->getAllType();
        $cate = $this->category->getAllCategory();
        $news = $this->news->getAllNewsPaginate();
        return response()->Json([
            'news' => $news,
            'type' => $type,
            'cate' => $cate
        ],200);
    }
    public function getTypeCate(Request $req)
    {
        $type_in_cate = $this->type->getTypeInCate($req);
        return response()->Json([
            'type_in_cate' => $type_in_cate,
        ],200);
    }
    public function getCreate(NewsRequest $req)
    {
        $this->news->createNews($req);
    }
    public function getUpdate(NewsRequest $req)
    {
        $this->news->updateNews($req);
    }
    public function getDelete($id)
    {
        $this->news->deleteNews($id);
    }
}
