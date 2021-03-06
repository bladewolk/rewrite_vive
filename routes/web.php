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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group([
    'middleware' => 'auth'
], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/ajaxPrice', 'HomeController@ajaxPrice');

    Route::resource('/events', 'EventsController');
    Route::get('/cancel/{id}', 'EventsController@cancel')->name('cancel');


    Route::group([
        'prefix' => 'admin',
        'middleware' => 'admin'
    ], function () {
        Route::resource('/users', 'UsersController');
        Route::resource('/devices', 'DevicesController');
        Route::resource('/prices', 'PricesController');
        Route::resource('/records', 'RecordsController');
    });
});