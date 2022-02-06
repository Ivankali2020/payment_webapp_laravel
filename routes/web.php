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



Auth::routes();
Route::get('/','Frontend\PageController@home')->name('home');

Route::get('admin/login','Auth\Admin@showLoginForm');
Route::post('admin/login','Auth\Admin@login')->name('admin.login');
Route::post('admin/logout','Auth\Admin@logout')->name('admin.logout');

Route::namespace('Frontend')->group(function (){
    Route::get('profile','PageController@profile')->name('profile');
    Route::get('updatePassword','PageController@updatePassword')->name('updatePassword');
    Route::post('newPassword','PageController@newPassword')->name('newPassword');

    Route::get('wallet','PageController@walletShow')->name('wallet');
    Route::get('transferShow','PageController@transferShow')->name('transferShow');
    Route::post('transferConfirm','PageController@transferConfirm')->name('transferConfirm');

    Route::get('verify/{phone?}','PageController@verifyAcc')->name('verify');

    Route::get('checkPassword','PageController@checkPassword')->name('checkPassword');

    Route::get('transitionShow','PageController@transitionShow')->name('transitionShow');
    Route::get('transitionDetail/{trx_id}','PageController@transitionDetail')->name('transitionDetail');


    Route::get('receiveQR','PageController@receiveQR')->name('receiveQR');
    Route::get('paymentQR','PageController@paymentQR')->name('paymentQR');


    //notification
    Route::get('notification/index','NotificationController@index')->name('notification.index');
    Route::get('notification/detail/{id}','NotificationController@detail')->name('notification.detail');


    //changeImg
    Route::post('changeImg','PageController@changeImg')->name('changeImg');
});

