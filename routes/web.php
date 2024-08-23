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
Route::post('/ClearItem','ProductController@clearItem');
Route::post('/ClearCart','ProductController@clearCart');

Route::get('/Profile','ProfileController@profile');
Route::post('/ProfileStatus','ProfileController@profileStatus');
Route::post('/ProfileOrderItem','ProfileController@orderItem');

Route::get('/Checkout','CheckoutController@index');
Route::post('/DeliverPrice','CheckoutController@checkPrice');
Route::post('/UseCoupon','CheckoutController@useCode');

Route::post('/SendOtpSMS','SendOtpController@sendOtpSMS');
Route::post('/CheckSMS_Otp','SendOtpController@validate_otp');
Route::post('/SendOtpEmail','SendOtpController@sendOtpEmail');
Route::post('/CheckEmail_Otp','SendOtpController@confirmEmail');

Route::post('/SaveOrder','OrderController@saveOrder');
Route::post('/ReOrder','OrderController@reOrder');
Route::post('/paymentOrder','OrderController@orderWaitPayment');
Route::any('/CreditCardGB','OrderController@creditGB');
Route::post('/CheckQrPayment','OrderController@checkpay_qr');
Route::any('/GB/Callback/BG','OrderController@logGB');
Route::any('/GB/Callback','OrderController@callbackGB');

Route::get('/GetDistricts/{id}','AutoProviceController@GetDistricts');
Route::get('/GetSubDistrict/{id}','AutoProviceController@GetSubDistricts');

Route::post('/SaveShipAddr','AddressController@saveShip');
Route::post('/SaveBillAddr','AddressController@saveBill');

Route::get('/Login','LoginController@login');
Route::get('/Logout','LoginController@logout');
Route::post('/Checklogin','LoginController@checkLogin');
Route::get('/google/login','LoginController@googleLogin');
Route::get('/google/callback','LoginController@googleCallback');