<?php

namespace App\models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class LoaiTin extends Model
{
    //----------------------------------------------------------------------------------- Admin
    protected $table = 'loaitin';
    protected $fillable = ['lang', 'Ten','Ten_KhongDau' ,'ThuTu', 'AnHien', 'idTL'];
    public $timestamps = false;
    public function theloai()
    {
        return $this->belongsTo('App\models\TheLoai', 'idTL', 'id');   // kết nối từ bảng con đến cha // khóa phụ // khóa chính
    }
    public function tin()
    {
        return $this->hasMany('App\models\Tin', 'idLT', 'id');   // kết nối từ bảng con đến cha // khóa phụ // khóa chính
    }
    public function getTypeInCate($req){     // lấy loại tin trong thể loại
        return $this->where('idTL','=',$req->idTL)->get();
    }
    public function getAllType(){           // lấy tất cả loại tin
        return $this->all();
    }
    public function getAllTypePaginate(){       // lấy tất cả loại tin phân trang
        return $this->with('theloai')->paginate(10);
    }
    public function createTypeNews($req)            // tạo mới 1 loai tin
    {
        $req['Ten_KhongDau'] = Str::slug($req->Ten);
        return $this->create($req->all());
    }
    public function getIdType($id)          // lấy id một loại tin
    {
        return $this->findOrFail($id);
    }
    public function updateTypeNews($req)         // edit một loại tin
    {
        $type = $this->getIdType($req->id);
        $req['Ten_KhongDau'] = Str::slug($req->Ten);
        return $type->update($req->all());
    }
    public function deleteType($id)             // xóa một loại tin
    {
        $type = $this->getIdType($id);
        return $type->delete();
    }
    //----------------------------------------------------------------------------------- End Admin

    //----------------------------------------------------------------------------------- Main

    public function getItemType()
    {
        $cauhinh1 = DB::table('cauhinh')
        ->where('id','=','1')
        ->first()->giatri;
        if(Session::get('locale') == "vi")
        {
            $loaitin_item = $this->whereIn('id',explode(",",$cauhinh1))->get();
        }else if (Session::get('locale') == "en"){
            $loaitin_item =$this->whereIn('id',[51,52,53,54,59])->get();
        }else{
            $loaitin_item = $this->whereIn('id',explode(",",$cauhinh1))->get();
        }
        return $loaitin_item;
    }
    public function getTypeCarousel()
    {
        $cauhinh2 = DB::table('cauhinh')
                        ->where('id','=','2')
                        ->first()->giatri;
        if(Session::get('locale') == "vi")
        {
            $loaitin_carousel = $this->whereIn('id',explode(',',$cauhinh2))->first();
        }else if (Session::get('locale') == "en"){
            $loaitin_carousel = $this->where('id','=',52)->first();
        }else{
            $loaitin_carousel = $this->whereIn('id',explode(',',$cauhinh2))->first();
        }
        return $loaitin_carousel;
    }
    public function getTypeRow()
    {
        $cauhinh3 = DB::table('cauhinh')
                        ->where('id','=','3')
                        ->first()->giatri;
        if(Session::get('locale') == "vi")
        {
            $loaitin_row = $this->whereIn('id',explode(',',$cauhinh3))->get();
        }else if (Session::get('locale') == "en"){
            $loaitin_row = $this->whereIn('id',[51,52,53,54])->get();
        }else{
            $loaitin_row = $this->whereIn('id',explode(',',$cauhinh3))->get();
        }
        return $loaitin_row;
    }
    public function getNewsinType($lang)
    {
        return $tintrong_loaitin = $this->with('tin')
                                ->where('lang','=',$lang)
                                ->where('loaitin.AnHien','=',1)
                                ->limit(5)
                                ->get();
    }
    public function getIdTypebyName($tenkd)
    {
        return $detail_loaitin = $this->where('Ten_KhongDau','=',$tenkd)->first();
    }
    //----------------------------------------------------------------------------------- End Main
}


