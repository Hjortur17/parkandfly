<?php

// Auth::routes();

Route::get('/', 'PagesController@index');
Route::get('/um-okkur', 'PagesController@about');
Route::get('/skilmalar', 'PagesController@terms');
Route::get('/hvernig-virkar-park-and-fly', 'PagesController@howDoesItWork');
Route::get('/algengar-spurningar', 'PagesController@questions');
Route::get('/verdskra', 'PagesController@prices');

Route::prefix('api')->group(function () {
	Route::get('services/get', 'ApiController@getServices');

	Route::get('discounts/get/{discount}', 'ApiController@getSingleDiscount');

	Route::get('car/info/get', 'ApiController@getCarInfo');
	Route::get('flight/info/get', 'ApiController@getFlightInfo');
	
	Route::post('database/booking/create', 'ApiController@createBookingStepOne');
	Route::post('database/booking/update', 'ApiController@updateBooking');
	
	// Route::get('discounts/get', 'ApiController@getDiscounts');
	// Route::post('database/booking/create', 'ApiController@createBooking');
});


