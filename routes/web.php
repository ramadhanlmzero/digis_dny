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
        Route::resource('place', 'PlaceController');
        Route::resource('product', 'ProductController');
        Route::resource('distributorproduct', 'DistributorProductController');
    });
    Route::group(['middleware' => ['role:Admin,Distributor']], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::get('/profil/{id}', 'ProfileController@index')->name('profile.index');
        Route::get('/profil/{id}/edit', 'ProfileController@edit')->name('profile.edit');
        Route::put('/profil/{id}/update', 'ProfileController@update')->name('profile.update');
        Route::match(['put', 'patch'], '/profile/resetpassword/{id}', 'ProfileController@resetpassword')->name('profile.resetpassword');
        Route::get('/profile/{id}/reset', 'ProfileController@reset')->name('profile.reset');
        Route::resource('transaction', 'TransactionController');
		Route::post('transaction/checkout', 'TransactionController@checkout')->name('transaction.checkout');
		Route::get('transaction/checkout', 'TransactionController@checkout');
    });
    Route::get('{any}', 'FrontController@any');
});

Route::get('{any}', 'FrontController@any');
