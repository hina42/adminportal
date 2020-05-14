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
  //category
  Route::get('/category','CategoryController@index');
  Route::get('/delcat','CategoryController@destroy')->name('delcat');
  Route::post('/additem','CategoryController@store')->name('additem');
  Route::post('/searchsubcat','CategoryController@searchsubcat')->name('searchsubcat');
  Route::post('/searchcat','CategoryController@searchcat')->name('searchcat');
  Route::get('/fetchcat','CategoryController@fetchcat')->name('fetchcat');
  Route::post('/updatecat','CategoryController@update')->name('updatecat');
  //subcategory
  Route::get('/subcategory','SubcategoryController@index');
  Route::get('/delsubcat','SubcategoryController@destroy')->name('delsubcat');
  Route::post('/updatesubcat','SubcategoryController@update')->name('updatesubcat');
  Route::get('/fetchsubcat','SubcategoryController@fetchsubcat')->name('fetchsubcat');
  //product
  Route::get('/product','ProductController@index');
  Route::get('/delprd','ProductController@destroy')->name('delprd');
  Route::post('/updateprd','ProductController@update')->name('updateprd');
  Route::get('/fetchprd','ProductController@fetchprd')->name('fetchprd');
  Route::get('/filterprd','ProductController@filterprd')->name('filterprd');

});
