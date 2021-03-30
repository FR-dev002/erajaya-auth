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

/**
 * Halaman Utama
 */
Route::get('/', 'MainController@index')->name('main_page');


/**
 * Route Auth
 */
Route::namespace('Auth')->group(function () {
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('login', 'LoginController@login_action')->name('login_action');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', 'LoginController@logout')->name('logout');
    });
});


/**
 * @desc Route untuk Admin
 */
// List Routing setelah login
Route::group(['middleware'=>'auth', 'prefix' => 'admin'], function(){

    // Super admin
    Route::get('/', 'AdminController@home')->name('admin');

    Route::group(['prefix' => 'user'], function () {
        Route::POST('', 'UserController@store')->name('user');
        Route::get('', 'UserController@getAll')->name('get_all_user');
        Route::get('{id}', 'UserController@edit')->name('user_detail');
        Route::delete('', 'UserController@delete')->name('delete_user');
    });
});



/**
 * @desc Route untuk Admin
 */
// List Routing setelah login
Route::group(['middleware' => 'auth', 'prefix' => 'user'], function () {

    // Super admin
    Route::get('/', 'UserController@home')->name('user');
});