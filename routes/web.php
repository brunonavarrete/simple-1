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

/*
 /
 / Home routes
 /
*/
	Route::get('/', function() {
	    return view('app');
	})->middleware('auth');

	Route::get('/get-data', 'HomeController@getAppData');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/dashboard', function() {
		return view('dashboard');
	});

/*
 /
 / Store routes
 /
*/
	Route::resource('/stores', 'StoreController');
	Route::get('/stores/owner/{owner_id}','StoreController@showByOwner');

/*
 /
 / Station routes
 /
*/
	Route::resource('/stations', 'StationController');
	Route::get('/stations/store/{store_id}', 'StationController@showByStore');

/*
 /
 / Service routes
 /
*/
	Route::resource('/services', 'ServiceController');
	Route::get('/services/owner/{owner_id}', 'ServiceController@showByOwner');

/*
 /
 / Slot routes
 /
*/
	Route::resource('/slots', 'SlotController');
	Route::get('/slots/{store_id}/{date}', 'SlotController@showByDate');
	Route::get('/slots/employee/{employee_id}/{date}', 'SlotController@showByEmployee');

/*
 /
 / Slot routes
 /
*/

	Route::resource('/concepts', 'ConceptController');

/*
 /
 / User routes
 /
*/
	Route::resource('/users', 'UserController');

	//
	// Employees
	//
		Route::post('/employees/toggle/{id}', 'EmployeeController@toggle');

/*
 /
 / Auth routes
 /
*/
 	Auth::routes();


