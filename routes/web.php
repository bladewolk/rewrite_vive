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


Route::get('/', 'HomeController@index');

/*
Route::group(['middleware' => ['auth']], function () {

    Route::get('/admin/manageprices', 'AdminController@managePrices');
    Route::get('/admin/createnewuser', 'AdminController@CreateNewUser');

    Route::post('/admin/register', 'AdminController@register');
   // Route::get('/admin/destroy/{id}', 'AdminControdller@destroyUser');
    Route::get('/admin/update/{id}', 'AdminController@updateUser');
});
*/


//Route::get('/admin/manageusers', 'AdminController@manageUsers')->middleware('admin');
//Route::resource('/Admin/users', 'AdminControllerResource');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('/admin/users', 'UsersController');
    Route::resource('/admin/devices', 'DevicesController');
    Route::resource('/admin/prices', 'PricesController');
});

Route::get('/ajaxPrice', 'HomeController@ajaxPrice');