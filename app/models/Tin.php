<?php

namespace App\models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class Tin extends Model
{
    protected $table = 'tin';
    protected $fillable = ['id', 'lang', 'TieuDe', 'TieuDe_KhongDau', 'TomTat', 'urlHinh',
    'Ngay', 'idUser', 'Content', 'idLT', 'idTL', 'SoLanXem', 'TinNoiBat', 'AnHien', 'tags'];
    public $timestamps = false;
    public function loaitin()
    {
        return $this->belongsTo('App\models\LoaiTin', 'idLT', 'id');   // 1 tin tuc chi thuoc 1 loai tin   // khoa ngoai // khoa chinh
    }
    public function ykien()
    {
        return $this->hasMany('App\models\Ykien','idTin','idYKien');
    }


    //-------------------------------------------------------------------------------------------- Admin

    public function getAllNewsPaginate()      // lấy tất cả tin phân trang
    {
        return $this->paginate(20);
    }
    public function createNews($req)      // thêm một bài viết
    {
        $exploded = explode(',', $req->urlHinh);
        $decoded = base64_decode($exploded[1]);
        if(str_contains($exploded[0], 'jpg'))
        {
            $extension = 'jpg';
        }else if (str_contains($exploded[0], 'png'))
        {
            $extension = 'png';
        }
        $nameImage = str_random().".". $extension;
        $path = public_path().'/mid/upload/images/'.$nameImage;
        file_put_contents($path,$decoded);
        $req['Ngay'] = date('Y-m-d H:i:s');
        $req['TieuDe_KhongDau'] = Str::slug($req->TieuDe);
        $req['urlHinh'] = $nameImage;
        return $this->create($req->all());
    }
    public function getIdNews($id)    // lấy ra tin
    {
        return $this->findOrFail($id);
    }
    public function updateNews($req)      // edit một bài viết
    {
        $news = $this->getIdNews($req->id);
        $req['Ngay'] = date('Y-m-d H:i:s');
        $req['TieuDe_KhongDau'] = Str::slug($req->TieuDe);
        return $news->update($req->all());
    }
    public function deleteNews($id)    // delete bài viết
    {
        $news = $this->getIdNews($id);
        return $news->delete();
    }

    //--------------------------------------------------------------------------------End Admin



    //-----------------------------------------------------------------------------------Main
    public function getLang()
    {
        if(Session::has('locale'))
        {
            $lang = Session::get('locale');
        }else{
            $lang = "vi";
        }
        return $lang;
    }
    public function getLatestNews()
    {
        return $newsLatest = $this->where('idTL','=',22)->get();
    }
    public function getHotNews($lang)
    {
        return $newsHot  = $this->with('loaitin')
                                ->where('tin.AnHien','=','1')
                                ->where('tin.TinNoiBat','=','1')
                                ->where('tin.lang','=',$lang)
                                ->orderBy('tin.id','desc')
                                ->limit(4)
                                ->get();
    }
    public function getNewsAll($lang)
    {
        $cauhinh1 = DB::table('cauhinh')
                    ->where('id','=','1')
                    ->first()->giatri;
        if (Session::get('locale') == "en"){
            $tinmoinhat_all = $this->where('AnHien','=',1)
                                    ->where('lang','=',$lang)
                                    ->whereIn('idLT',[59,61,62,64,52])
                                    ->orderBy('id','desc')
                                    ->limit(4)
                                    ->get();
        }else{
            $tinmoinhat_all = $this->where('AnHien','=',1)
                                    ->where('lang','=',$lang)
                                    ->whereIn('idLT',explode(",",$cauhinh1))
                                    ->orderBy('id','desc')
                                    ->limit(4)
                                    ->get();
        }
        return $tinmoinhat_all;
    }
    public function getNewsCarousel($lang,$id)
    {
        return $tin_carousel = $this->where('lang','=',$lang)
                            ->where('AnHien','=','1')
                            ->whereIn('idLT',[$id])
                            ->limit(8)
                            ->orderby('id','desc')
                            ->get();
    }
    public function getRecommend($lang)
    {
        return $recommend = $this->where('lang','=',$lang)
                            ->where('AnHien','=','1')
                            ->limit(3)
                            ->get();
    }
    public function getGeneralNews($lang)
    {
        return $tintonghop = $this->with('loaitin')
                            ->where('tin.Anhien','=',1)
                            ->where('tin.lang','=',$lang)
                            ->paginate(6);
    }
    public function getDetailNews($name)
    {
        return $chitiet_tin = $this->with('loaitin')
                            ->where('tin.TieuDe_KhongDau','=',$name)
                            ->first();
    }
    public function getRelatedNews($lang,$idTL,$id)
    {
        return  $tinlienquan = $this->where('lang','=',$lang)
                            ->where('AnHien','=',1)
                            ->where('idLT','=',$idTL)
                            ->where('id','<>',$id)->limit(6)->get();
    }
    public function getSearch($lang,$key)
    {
        return $result = $this->with('loaitin')
                    ->where('tin.Anhien','=',1)
                    ->where('tin.lang','=',$lang)
                    ->where('tin.TieuDe','LIKE',"%".$key."%")
                    ->paginate(5);
    }
    public function getNewsByType($id,$lang)
    {
        return $detail_loaitin = $this->with('loaitin')
        ->where('tin.idLT','=',$id)
        ->where('tin.AnHien','=',1)
        ->where('tin.lang','=',$lang)
        ->orderby('Ngay','desc')
        ->paginate(4);
    }
    //-----------------------------------------------------------------------------------EndMain
}
