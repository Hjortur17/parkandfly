<?php

Route::get('/', 'MainController@index');
Route::get('/um-okkur', 'PagesController@about');
Route::get('/skilmalar', 'PagesController@terms');
Route::get('/hvernig-virkar-park-and-fly', 'PagesController@howDoesItWork');
Route::get('/algengar-spurningar', 'PagesController@questions');
Route::get('/verdskra', 'PagesController@prices');

Route::get('/stjornbord', 'DashboardController@index')->middleware('auth');

Route::prefix('api')->group(function () {
	Route::get('services/get', 'ApiController@getServices');
	Route::get('car/info/get', 'ApiController@getCarInfo');
	Route::get('booking/get/id', 'ApiController@getBookingId');

	Route::post('booking/create', 'ApiController@createBooking');
	Route::post('session/add/booking', 'ApiController@addBookingToSession');
});


