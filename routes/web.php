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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('homeAdmin');

/* User Login */
/*Route::get('/login', 'Auth\LoginController@userLoginForm')->name('userLoginForm');
Route::post('/login', 'Auth\LoginController@userLogin')->name('userLogin');*/
Route::post('/register/user', 'Auth\RegisterController@createUser')->name('createUser');

/*Admin Login*/
Route::get('/login/admin', 'Auth\LoginController@adminLoginForm')->name('adminLoginForm');
Route::post('/login/admin', 'Auth\LoginController@adminLogin')->name('adminLogin');

/*Admin Register*/
Route::get('/register/admin', 'Auth\AdminRegisterController@adminRegisterForm')->name('adminRegisterForm');
Route::post('/register/admin', 'Auth\AdminRegisterController@createAdmin')->name('createAdmin');
