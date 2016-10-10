<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::group([
    'middleware' => 'auth'
], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/ajaxPrice', 'HomeController@ajaxPrice');
    Route::post('/ajaxCancel', 'HomeController@ajaxCancel');

    Route::resource('/events', 'EventsController');

    Route::group([
        'prefix' => 'admin',
        'middleware' => 'admin'
    ], function () {
        Route::resource('/users', 'UsersController');
        Route::resource('/devices', 'DevicesController');
        Route::resource('/prices', 'PricesController');
    });
});