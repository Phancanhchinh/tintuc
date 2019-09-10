<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:web' || 'auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// category
Route::get('category',['as'=> 'admin-theloai-get',
                'uses'=>'API\CateController@getIndex']);
Route::post('add_category',['as'=> 'admin-theloai-create',
                    'uses'=>'API\CateController@getCreate']);

Route::post('delete_category/{id}',['as'=> 'admin-theloai-delete',
                    'uses'=>'API\CateController@getDelete']);

Route::post('update_category',['as'=> 'admin-theloai-update',
                    'uses'=>'API\CateController@getUpdate']);


// typenews

Route::get('typenews',['as'=> 'admin-loaitin-get',
                'uses'=>'API\TypeController@getIndex']);
Route::post('add_typenews',['as'=> 'admin-loaitin-create',
                    'uses'=>'API\TypeController@getCreate']);

Route::post('delete_typenews/{id}',['as'=> 'admin-loaitin-delete',
                    'uses'=>'API\TypeController@getDelete']);
Route::post('update_typenews',['as'=> 'admin-loaitin-update',
                    'uses'=>'API\TypeController@getUpdate']);

// News

// Route::resource('news', 'API\NewsController');


Route::get('news',['as'=> 'admin-tin-get',
                'uses'=>'API\NewsController@getIndex']);
Route::post('id_category',['as'=> 'admin-idcategory-get',
                'uses'=>'API\NewsController@getTypeCate']);

Route::post('add_news',['as'=> 'admin-loaitin-create',
                    'uses'=>'API\NewsController@getCreate']);

Route::post('delete_news/{id}',['as'=> 'admin-tin-delete',
                    'uses'=>'API\NewsController@getDelete']);
Route::post('update_news',['as'=> 'admin-tin-update',
                    'uses'=>'API\NewsController@getUpdate']);



// users

Route::get('users',['as'=> 'admin-nguoidung-get',
            'uses'=>'API\UsersController@getIndex']);
Route::post('add_users',['as'=> 'admin-nguoidung-create',
    'uses'=>'API\UsersController@getCreate']);

Route::post('delete_users/{id}',['as'=> 'admin-nguoidung-delete',
    'uses'=>'API\UsersController@getDelete']);

Route::post('update_users',['as'=> 'admin-nguoidung-update',
    'uses'=>'API\UsersController@getUpdate']);



