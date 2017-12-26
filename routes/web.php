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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('anuong', 'anuongController');
Route::resource('binhluan', 'binhluanController');
Route::resource('chitietlichtrinh', 'chitietlichtrinhController');
Route::resource('danhgia', 'danhgiaController');
Route::resource('dichvu', 'dichvuController');
Route::resource('khachsan', 'khachsanController');
Route::resource('lichtrinh', 'lichtrinhController');
Route::resource('diadiem', 'diadiemController');
Route::resource('loaihinhsukien', 'loaihinhsukienController');
Route::resource('nguoidung', 'nguoidungController');
Route::resource('phuongtien', 'phuongtienController');
Route::resource('sukien', 'sukienController');
Route::resource('thamquan', 'thamquanController');
Route::resource('vuichoi', 'vuichoiController');
Route::resource('tukhoa', 'tukhoaController');
Route::resource('tukhoa_dichvu', 'tukhoa_dichvu_Controller');
Route::resource('yeuthich', 'yeuthichController');


// TIM KIEM
Route::get('timkiem/dichvulancan/id={iddiadiem}','timkiemController@search_dichvu_lancan');

Route::get('timkiem/dichvuall/keyword={keyword}','timkiemController@search_dichvu_all');


Route::get('test', 'timkiemController@test');

Route::get('get-only-icon-image', 'hinhanhController@GetOnlyIconImage');

Route::get('test', 'timkiemController@test');


Route::post('upload-image','hinhanhController@Upload');
Route::get('lay-mot-hinh-icon/{id}', 'hinhanhController@LayMotIcon');
Route::get('lay-mot-hinh-banner/{id}', 'hinhanhController@LayMotBanner');
Route::get('lay-mot-hinh-thumb/{id}', 'hinhanhController@LayMotThumb');
Route::get('lay-mot-hinh-chi-tiet-1/{id}', 'hinhanhController@LayMotHinhChiTiet1');
Route::get('lay-mot-hinh-chi-tiet-2/{id}', 'hinhanhController@LayMotHinhChiTiet2');


