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

Auth::routes();

//Only authorized users can access here
Route::middleware(['auth'])->group(function(){
    Route::get('/profile/{user}/dreams', 'DreamController@index')->name('my_dreams');
    Route::get('/dream/new', 'DreamController@storeForm')->name('new_dream');
    Route::post('/dream/store', 'DreamController@store')->name('store_dream');
});

//All users can view and pay...
Route::get('/dream/{dream}', 'DreamController@show')->name('show_dream');
Route::match(['get', 'post'], '/dream/pay/{dream}', 'DreamController@pay')->name('pay_dream');
