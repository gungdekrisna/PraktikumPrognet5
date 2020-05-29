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

//Product
Route::resource('products','ProductController')->middleware('auth:admin');
Route::get('/addImage/{id}', 'ProductController@upload');
Route::post('/addImage/{id}', 'ProductController@upload_image');
Route::get('/products/delete/{id}', 'ProductController@soft_delete');
Route::get('/products-trash', 'ProductController@trash');
Route::get('/products/restore/{id}', 'ProductController@restore');
Route::get('/products-restore-all', 'ProductController@restore_all');
Route::get('/products/destroy/{id}', 'ProductController@delete');
Route::get('/products-delete-all', 'ProductController@delete_all');
Route::resource('product_images','ProductImageController');

//Courier
Route::resource('couriers', 'CourierController')->middleware('auth:admin');
Route::get('/couriers/delete/{id}', 'CourierController@soft_delete');
Route::get('/couriers-trash', 'CourierController@trash');
Route::get('/couriers/restore/{id}', 'CourierController@restore');
Route::get('/couriers-restore-all', 'CourierController@restore_all');
Route::get('/couriers/destroy/{id}', 'CourierController@delete');
Route::get('/couriers-delete-all', 'CourierController@delete_all');

//Product_Categories
Route::resource('categories', 'CategoryController')->middleware('auth:admin');
Route::get('/categories/delete/{id}', 'CategoryController@soft_delete');
Route::get('/categories-trash', 'CategoryController@trash');
Route::get('/categories/restore/{id}', 'CategoryController@restore');
Route::get('/categories-restore-all', 'CategoryController@restore_all');
Route::get('/categories/destroy/{id}', 'CategoryController@delete');
Route::get('/categories-delete-all', 'CategoryController@delete_all');

// User's page or Landing Page
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/product/{id}', 'HomeController@product_detail');
Route::get('/product/payment/{id}/{qty}', 'HomeController@product_payment');
Route::post('/product/buy', 'HomeController@product_buy');
Route::get('/product/payment/courier-service/{destination}/{courier}/{product}/{product_qty}', 'HomeController@getShippingCost');
Route::post('/product/transaction/store', 'HomeController@TransactionStore');
Route::get('product/payment-confirmation/{id}', 'HomeController@PaymentConfirmation');
Route::get('product/proof-of-payment/{id}', 'HomeController@PaymentConfirmation');