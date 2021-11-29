<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\CustomAuthController;

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
    return redirect('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    // Dashboard
    Route::get('/home', 'HomeController@index')->name('home');
    // end

    // Employee Route User Admin side
    Route::resource('/employee', 'EmployeeController');
    Route::get('managerole', 'EmployeeController@role');
    Route::post('/employee/addrole', 'EmployeeController@addrole');
    // end

    //car modoule Routes
    Route::resource('category', 'CategoryController');
    Route::resource('subcategory', 'SubCategoryController');
    Route::resource('year', 'YearController');
    Route::resource('brand', 'BrandController');
    Route::resource('car', 'CarController');
    // end

    //provider
    Route::resource('provider', 'ProviderController');
    Route::get('provider/status/{id}', 'ProviderController@providerstatus'); //provider status update Active | Deactive
    // end

    // Oil Brand Route
    Route::resource('oilbrand', 'OilBrandController');
    Route::resource('productcategory', 'ProductCategoryController');
    Route::resource('product', 'ProductController');
    // end







});

Route::group(['middleware' => ['verifytoken']], function () {
});



//Custom Auth Route

Route::get('/custom/login', 'CustomAuthController@login')->middleware('alreadyLogedIn');
Route::get('/custom/registration', 'CustomAuthController@registration')->middleware('alreadyLogedIn');

Route::post('/register-user', 'CustomAuthController@registerUser')->name('register-user');
Route::post('/login-user', 'CustomAuthController@loginUser')->name('login-user');
Route::get('/logout', 'CustomAuthController@logout');
Route::get('/dashboard', 'customAuthController@dashboard')->middleware('isLogedIn');




//Api Route
Route::get('post', 'DataController@postRequest');
Route::get('get', 'DataController@getRequest');
Route::post('user/register', 'DataController@userRegister');
Route::get('user', 'DataController@getUser');
//niticication route

Route::get('/fcm', 'Controller@index');
Route::get('/send-notification', 'Controller@sendNotification');
