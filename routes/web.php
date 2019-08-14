<?php

Auth::routes();

Route::get('/', 'MainController@index');

Route::get('/stjornbord', 'DashboardController@index');

Route::prefix('api')->group(function () {
	Route::get('services/get', 'ApiController@getServices');
	Route::get('car/info/get', 'ApiController@getCarInfo');
	Route::get('booking/get/id', 'ApiController@getBookingId');
	
	Route::post('booking/create', 'ApiController@createBooking');
	Route::post('session/add/booking', 'ApiController@addBookingToSession');
	Route::post('session/add/id', 'ApiController@addNextIdToSession');
	// Route::post('session/add/key', 'ApiController@addKeyToSession');
});


