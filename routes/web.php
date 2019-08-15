<?php

Auth::routes([
	'register' => false, // Registration Routes...
	'reset' => false, // Password Reset Routes...
	'verify' => false, // Email Verification Routes...
]);

Route::get('/', function () {
	return view('welcome');
});

Route::get('/testing', 'MainController@index')->middleware('auth');;
Route::get('/stjornbord', 'DashboardController@index')->middleware('auth');;

Route::prefix('api')->group(function () {
	Route::get('services/get', 'ApiController@getServices');
	Route::get('car/info/get', 'ApiController@getCarInfo');
	Route::get('booking/get/id', 'ApiController@getBookingId');
	
	Route::post('booking/create', 'ApiController@createBooking');
	Route::post('session/add/booking', 'ApiController@addBookingToSession');
});


