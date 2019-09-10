<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/dang-nhap',['as' => 'frontend-login',
            'uses' => 'MainController@getLogin']);
Route::post('/dang-nhap','MainController@postLogin');
Route::get('/dang-ky',['as' => 'frontend-register',
            'uses' => 'MainController@getRegister']);
Route::post('/dang-ky','MainController@postRegister');
Route::get('/dang-xuat',['as' => 'frontend-logout',
            'uses' => 'MainController@getLogout']);

Route::get('lang/{lang}',['as' => 'language',
            'uses' => 'LangController@getLang']);

Route::get('/',['as' => 'index',
            'uses' => 'MainController@getIndex']);
Route::get('/tin-tuc/{tenkd}.html',['as' => 'detail',
            'uses' => 'DetailMainController@getDetail']);
Route::get('/loai-tin/{tenkd}',['as' => 'detailloaitin',
            'uses' => 'DetailMainController@getAllNewsByType']);
Route::get('/tim-kiem',['as' => 'search',
            'uses' => 'MainController@getTimKiem']);
Route::post('/tin-tuc/{tenkd}',['as' => 'detail_news',
            'uses' => 'DetailMainController@postDetail']);

Route::get('/lien-he',['as' => 'contact',
            'uses' => 'MainController@getLienHe']);
Route::post('/lien-he','MainController@postLienHe');





//admin
Route::group(['prefix' => 'backend'], function () {
    Route::get('/login', 'AdminController@getLogin');
    Route::post('/login', ['as' => 'admin-login',
                'uses' => 'AdminController@postLogin']);
    Route::get('/logout',['as' => 'admin-logout',
                'uses' => 'AdminController@getLogout']);
});
Route::get('/backend', ['as' => 'admin-index',
                    'uses' => 'AdminController@getIndex'])->middleware('AdminLogin');


Auth::routes(['register' => false]);

