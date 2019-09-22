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
	
	Route::post('database/booking/checkbooking', 'ApiController@bookingCheck');
	Route::post('database/booking/create', 'ApiController@bookingStepOne');
	Route::post('database/booking/update', 'ApiController@bookingStepTwo');
});


