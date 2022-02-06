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


Route::prefix('admin')->name('admin.')->namespace('Backend')->middleware('auth')->group(function (){
    Route::get('/','PageController@home')->name('home');//domain/admin/Backend/PageController

    Route::resource('adminUser','AdminUserController');
    Route::get('adminUser/dataTable','AdminUserController@show')->name('adminUser.dataTable');

    Route::resource('user','userController');
    Route::get('user/dataTable','userController@show')->name('user.dataTable');

    Route::get('wallet','WalletController@index')->name('wallet.index');
    Route::get('wallet/dataTable','WalletController@show')->name('wallet.dataTable');
});

