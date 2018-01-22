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



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


//Route::post('/doLogin',  'Auth\LoginController@doLogin');


Route::middleware(['auth.basic'])->group(function () {

	/*
	 * Products Collection
	 */

	Route::get('/products',  'ProductsController@index');
    Route::post('/products', 'ProductsController@store');
	Route::get('/products/{id}', 'ProductsController@show');
	Route::put('/products/{id}', 'ProductsController@update');
	Route::delete('/products/{id}', 'ProductsController@delete');
	Route::get('/lastProduct', 'ProductsController@last');

	Route::get('/productDay', 'ProductDayController@productDay');
});



Route::post('/doLogin', 'Auth\LoginController@doLogin');
Route::get('/doLogout', 'Auth\LoginController@doLogout');

