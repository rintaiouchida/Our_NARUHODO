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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/review', 'PostController@create')->name('create');

    Route::post('/store','PostController@store');

    Route::get('/show_all','PostController@show_all')->name('show_all');

    Route::get('/show_likes','PostController@show_likes')->name('show_likes');

    Route::get('/search',function(){
        return view('search');
    })->name('search');
    Route::post('/show_search','Postcontroller@show_search')->name('show_search');
    Route::post('/ajaxlike', 'PostController@ajaxlike')->name('ajaxlike');
});

