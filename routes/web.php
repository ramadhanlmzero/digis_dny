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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::resource('user', 'UserController');
        Route::match(['put', 'patch'], '/user/resetpassword/{id}', 'UserController@resetpassword')->name('user.resetpassword');
        Route::get('/user/{id}/reset', 'UserController@reset')->name('user.reset');
        Route::resource('distributor', 'DistributorController');
        Route::resource('place', 'PlaceController');
        Route::resource('product', 'ProductController');
    });
    Route::group(['middleware' => ['role:Admin,Distributor']], function () {
        Route::resource('transaction', 'TransactionController');
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    });
});
