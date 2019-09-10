<?php
namespace App\models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
class TheLoai extends Model
{
    protected $table = 'theloai';
    protected $fillable = ['lang', 'TenTL','TenTL_KhongDau' ,'ThuTu', 'AnHien', 'HienMenu'];
    public $timestamps = false;
    public function loaitin(){
        return $this->hasMany('App\models\LoaiTin','idTL','id');  // khoA PHU // KHJOA CHINH
    }
    public function tin()  // tin -> loaitin -> theloai
    {
        return $this->hasManyThrough('App\models\Tin','App\models\LoaiTin','idLT','idTL', 'id');    // khoa phu  // khoa phu // khoa chinh tl
    }
    public function getAllCategory(){    // lấy tất cả thể loại
        return $this->all();
    }
    public function getAllCategoryPaginate(){           // lấy phân trang thể loại
        return $this->paginate(8);
    }
    public function createCategory($req){                   // tạo mới 1 thể loại
        $req['TenTL_KhongDau'] = Str::slug($req->TenTL);
        return $this->create($req->all());
    }
    public function getIdCategory($id){                 // lấy id thể loại
        return $this->findOrFail($id);
    }
    public function updateCategory($req){               // edit một thể loại
        $update_cate = $this->getIdCategory($req->id);
        $req['TenTL_KhongDau'] = Str::slug($req->TenTL);
        return $update_cate->update($req->all());
    }
    public function deleteCategory($id){                // xóa một thể loại
        $delete_cate = $this->getIdCategory($id);
        return $delete_cate->delete();
    }
}
