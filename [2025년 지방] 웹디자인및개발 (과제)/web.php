<?php

use Gondr\App\Route;

Route::get('/', 'MainController@index');

Route::get('/user/register', 'UserController@register');
Route::post('/user/register', 'UserController@registerProcess');

Route::get('/user/login', 'UserController@login');
Route::post('/user/login', 'UserController@loginProcess');
Route::get('/products', 'ProductController@index'); //전체 상품 페이지

Route::get('/notices', 'MainController@getNotices'); //공지사항 전체 긁어오기

if(user()->checkLogin()){
    Route::get('/purchase/{id}', 'BucketController@purchase');
    Route::get('/buckets', 'BucketController@indexPage');
    Route::get('/buckets/{option}/{id}', 'BucketController@adjustCount');
    Route::get('/user/logout', 'UserController@logout');
}

if(user()->isAdmin())
{
    Route::get("/admin/notice", "AdminController@noticeManage");
    Route::get("/admin/notice/delete/{id}", "AdminController@deleteNotice");
    Route::get("/admin/notice/create", "AdminController@noticeCreatePage");
    Route::post("/admin/notice/create", "AdminController@noticeCreate");

    Route::get("/admin/notice/modify/{id}", "AdminController@noticeModifyPage");
    Route::post("/admin/notice/modify/{id}", "AdminController@noticeModify");
}


//테스트라우터
Route::post("/product/insert", "ProductController@insertProductFromJson");