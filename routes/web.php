<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','IndexController@index');
Route::get('/OrderProcess','IndexController@orderMethod');
Route::get('/Customization','IndexController@Customization');
Route::get('/Contact','IndexController@contact');

Route::get('/Product','ProductController@productAll');
Route::get('/Product/{cate}','ProductController@productCate');
Route::get('/Product/{cate}/{cate_sub}','ProductController@productCate');
Route::get('/ProductDetail/{detail}','ProductController@productDetail');
Route::post('/AddCart','ProductController@addToCart');
Route::post('/ClearCart','ProductController@clearCart');

Route::get('/Checkout','CheckoutController@index');
Route::get('/GetDistricts/{id}','AutoProviceController@GetDistricts');
Route::get('/GetSubDistrict/{id}','AutoProviceController@GetSubDistricts');

Route::get('/Login','LoginController@login');
Route::get('/Logout','LoginController@logout');
Route::post('/Checklogin','LoginController@checkLogin');
Route::get('/google/login','LoginController@googleLogin');
Route::get('/google/callback','LoginController@googleCallback');