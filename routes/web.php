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

Route::get('/', 'FrontController@index')->name('index');

Auth::routes();

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::resource('user', 'UserController');
        Route::match(['put', 'patch'], '/user/resetpassword/{id}', 'UserController@resetpassword')->name('user.resetpassword');
        Route::get('/user/{id}/reset', 'UserController@reset')->name('user.reset');
        // Route::resource('distributor', 'DistributorController');
        Route::resource('product', 'ProductController');
        Route::resource('distributorproduct', 'DistributorProductController');
    });
    Route::group(['middleware' => ['role:Admin,Distributor']], function () {
        Route::resource('place', 'PlaceController');
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::get('/profil/{id}', 'UserController@profile')->name('user.profile');
        Route::resource('transaction', 'TransactionController');
		Route::post('transaction/checkout', 'TransactionController@checkout')->name('transaction.checkout');
		Route::get('transaction/checkout', 'TransactionController@checkout');
    });
    Route::get('{any}', 'FrontController@any');
});

Route::get('{any}', 'FrontController@any');
