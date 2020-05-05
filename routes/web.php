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

Auth::routes();

Route::get('/home', 'Frontend\\HomeController@index')->name('home');


Route::group(['prefix'=>'orders', 'middleware'=>['web', 'auth'], 'namespace'=>'Frontend'], static function(){
    Route::name('frontend.orders.index')->get('/', 'OrderController@index');
    Route::name('frontend.orders.create')->get('/create', 'OrderController@create');
    Route::name('frontend.orders.store')->post('/store', 'OrderController@store');
    Route::name('frontend.orders.close')->patch('{order}/close', 'OrderController@close');

    Route::name('frontend.orders.show')->get('{order}', 'OrderController@show');
    Route::name('frontend.orders.answer')->post('{order}/answer', 'OrderController@answer');
});

Route::group(['prefix'=>'manage/orders', 'middleware'=>['web', 'auth'], 'namespace'=>'Backend'], static function(){
    Route::name('backend.orders.index')->get('/', 'OrderController@index');

    Route::name('backend.orders.close')->patch('{order}/close', 'OrderController@close');

    Route::name('backend.orders.show')->get('{order}', 'OrderController@show');
    Route::name('backend.orders.answer')->post('{order}/answer', 'OrderController@answer');
});

