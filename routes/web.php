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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/payment', 'PaymentController@initiate_payment');
Route::get('/test', 'PaymentController@test');

Route::get('/home', 'PaymentController@home');


Route::get('/payment/success', 'PaymentController@payment_success')->name('payment.success');
Route::get('/payment/cancel', 'PaymentController@payment_cancel')->name('payment.cancel');
Route::get('/payment/notify', 'PaymentController@payment_notify')->name('payment.notify');





