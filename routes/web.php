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

    Route::group(['prefix'=>'orders', 'middleware'=>['web', 'auth']], static function(){
        Route::name('frontend.orders.index')->get('/', 'Frontend\OrderController@index');
        Route::name('frontend.orders.show')->get('{order}', 'Frontend\OrderController@show');
        Route::name('frontend.orders.answer')->post('{order}/answer', 'Frontend\OrderController@answer');
    });
