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


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['guard' => 'web'], function () {
    Route::get('/', ['as' => 'loginForm', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::get('/login', ['as' => 'loginForm', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);

    Route::group(['middleware' => 'auth', 'guard' => 'web'], function () {
        Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);
        Route::post('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

        // assign routes
        Route::group(['prefix' => 'assign'], function () {
            Route::get('/', ['as' => 'assign.index', 'uses' => 'AssignController@getList']);
            Route::get('/create', ['as' => 'assign.create', 'uses' => 'AssignController@getOne']);
            Route::get('/edit/{id}', ['as' => 'assign.edit', 'uses' => 'AssignController@getOne']);
            Route::post('/', ['as' => 'assign.store', 'uses' => 'AssignController@store']);
            Route::patch('/{id}', ['as' => 'assign.update', 'uses' => 'AssignController@store']);
            Route::delete('/{id}', ['as' => 'assign.update', 'uses' => 'AssignController@delete']);
        });

        // users management routes
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', ['as' => 'users.index', 'uses' => 'UserController@getList']);
            Route::get('/create', ['as' => 'users.create', 'uses' => 'UserController@getOne']);
            Route::get('/edit/{id}', ['as' => 'users.edit', 'uses' => 'UserController@getOne']);
            Route::post('/', ['as' => 'users.store', 'uses' => 'UserController@store']);
            Route::patch('/{id}', ['as' => 'users.update', 'uses' => 'UserController@store']);
        });

        // products management routes
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', ['as' => 'products.index', 'uses' => 'ProductController@getList']);
            Route::get('/create', ['as' => 'products.create', 'uses' => 'ProductController@getOne']);
            Route::get('/{id}/edit/', ['as' => 'products.edit', 'uses' => 'ProductController@getOne']);
            Route::post('/', ['as' => 'products.store', 'uses' => 'ProductController@store']);
            Route::patch('/{id}', ['as' => 'products.update', 'uses' => 'ProductController@store']);
        });

        // tables management routes
        Route::group(['prefix' => 'tables'], function () {
            Route::get('/', ['as' => 'tables.index', 'uses' => 'TableController@getList']);
            Route::get('/create', ['as' => 'tables.create', 'uses' => 'TableController@getOne']);
            Route::get('/{id}/edit/', ['as' => 'tables.edit', 'uses' => 'TableController@getOne']);
            Route::post('/', ['as' => 'tables.store', 'uses' => 'TableController@store']);
            Route::patch('/{id}', ['as' => 'tables.update', 'uses' => 'TableController@store']);
        });

        // orders management routes
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', ['as' => 'orders.index', 'uses' => 'OrderController@getList']);
            Route::get('/create', ['as' => 'orders.create', 'uses' => 'OrderController@getOne']);
            Route::post('/create', ['as' => 'orders.create', 'uses' => 'OrderController@getOne']);
            Route::get('/{id}/edit', ['as' => 'orders.edit', 'uses' => 'OrderController@getOne']);
            Route::post('/', ['as' => 'orders.store', 'uses' => 'OrderController@store']);
            Route::patch('/{id}', ['as' => 'orders.update', 'uses' => 'OrderController@store']);
        });
    });
});

require __DIR__ . '/../composers/menu/menu.php';