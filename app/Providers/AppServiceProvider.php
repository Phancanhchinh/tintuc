<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\models\Tin;
use App\models\LoaiTin;
use App\models\TheLoai;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $req)
    {
        $lang = "vi";
        if($req->lang)
        {
            $lang = $req->lang;
        }
        $category = TheLoai::where('AnHien','=',1)
                ->where('HienMenu','=',1)
                ->where('lang','=',$lang)
                ->orderby('ThuTu','asc')
                ->get();
        $type = LoaiTin::where('AnHien','=',1)
                ->where('lang','=',$lang)
                ->orderby('ThuTu','asc')
                ->get();
        $newsRateView = Tin::where('lang','=',$lang)
                ->where('AnHien','=',1)
                ->orderBy('SoLanXem','desc')
                ->limit(6)
                ->get();
        view()->share(['category' => $category,'typenews' => $type,'newsRateView' => $newsRateView,]);
    }
}
