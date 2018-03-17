<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/','pageController@getindex')->name('/');

Route::get('registerW','pageController@getregister')->name('registerW');
Route::get('registersuccess','pageController@getregisterSuccess')->name('registersuccess');
Route::get('logoutW','loginController@logoutW')->name('logoutW');
Route::get('loginW','pageController@getlogin')->name('loginW');

Route::post('loginpost','loginController@postLoginW')->name('loginpost');
Route::post('registerWpost','loginController@registerW')->name('registerWpost');
// login facebook
Route::get('login/facebook/redirect', 'loginController@redirectToProvider')->name('loginfacebook');
Route::get('login/facebook/callback', 'loginController@handleProviderCallback');

//user
Route::get('user','pageController@getuser');

?>