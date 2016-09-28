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




//Admin routes


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/admin/manageusers', 'AdminController@manageUsers');
    Route::get('/admin/manageprices', 'AdminController@managePrices');
    Route::get('/admin/createnewuser', 'AdminController@CreateNewUser');

    Route::post('/admin/register', 'AdminController@registerUser');
    Route::get('/admin/destroy/{id}', 'AdminController@destroyUser');
    Route::get('/admin/update/{id}', 'AdminController@updateUser');
});
