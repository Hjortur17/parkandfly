<?php

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
	
	Route::post('booking/checkbooking', 'ApiController@bookingCheck');
	Route::post('booking/create', 'ApiController@bookingCreate');
	
	Route::post('booking/update/korta', 'ApiController@kortaBookingUpdate');
	Route::post('booking/update/netgiro', 'ApiController@netgiroBookingUpdate');
});


