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
