<?php

use Illuminate\Support\Facades\Route;

Route::pattern('id', '[1-9][0-9]*');  // sécuriser le type: dans l'URL, on ne peut mettre que les chiffres
Route::pattern('slug', '[a-z-]*');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::get('mentions', 'FrontController@mentions');

Route::group(['middleware' => ['web']], function () {

    Route::get('/', ['as' => 'home', 'uses' => 'FrontController@index']);
    Route::get('cat/{id}/{slug?}', 'FrontController@showProductByCategory');    //slug? => optionnel
    Route::get('tag/{id}/{slug?}', 'FrontController@showProductByTag');
    Route::get('prod/{id}/{slug?}', 'FrontController@showProduct');

    Route::post('storeCart', 'FrontController@storeCart');
    Route::get('cart', 'FrontController@showCart');
    Route::get('removeCart/{id}', 'FrontController@removeCart');
    Route::post('quantityCart', 'FrontController@quantityCart');
    Route::post('updateQuantity', 'FrontController@updateQuantity');

    Route::get('contact', 'FrontController@showContact');
    Route::post('storeContact', 'FrontController@storeContact');
    Route::get('account', 'FrontController@account');

    // limit 60 requests per one minute from a single address IP, throttle
    //                                      60: nombre de tentatives(requêtes); 1: une minute
    Route::group(['middleware' => ['throttle:60,1']], function () {
        Route::any('login', 'LoginController@login');   // any = get and post
    });

    Route::get('logout', 'LoginController@logout');

    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::resource('product', 'Admin\ProductController');
        Route::get('product/status/{id}', 'Admin\ProductController@changeStatus');
        Route::get('product/remove/{id}', 'Admin\ProductController@confirmRemove');
        Route::get('history', 'Admin\HistoryController@index');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('validateCart', 'FrontController@validateCart');
        Route::get('confirmCart', 'FrontController@confirmCart');
        Route::post('payment', 'FrontController@payment');
    });
});