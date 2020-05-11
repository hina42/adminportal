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

Route::get('/',function(){
  return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>['auth','admin']],function(){
  Route::get('/index',function(){
    return view('layouts.index');
  });
  Route::get('/dashboard',function(){
    return view('admin.dashboard');
  });
//media
  Route::get('/media','MediaController@index');
  Route::post('/addmedia','MediaController@store')->name('addmedia');
  Route::get('/category','CategoryController@index');
  Route::get('/delcat','CategoryController@destroy')->name('delcat');
  Route::post('/additem','CategoryController@store')->name('additem');
  Route::get('/product','ProductController@index');
  Route::get('/delprd','ProductController@destroy')->name('delprd');
  Route::post('/searchsubcat','CategoryController@searchsubcat')->name('searchsubcat');

});
