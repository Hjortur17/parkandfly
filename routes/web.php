<?php

Auth::routes();

Route::get('/', 'PagesController@index');
Route::get('/um-okkur', 'PagesController@about');
Route::get('/skilmalar', 'PagesController@terms');
Route::get('/hvernig-virkar-park-and-fly', 'PagesController@howDoesItWork');
Route::get('/algengar-spurningar', 'PagesController@questions');
Route::get('/verdskra', 'PagesController@prices');

// Route::get('/stjornbord', function () {
//     return redirect('/stjornbord/i-dag');
// });

Route::get('/stjornbord/i-dag', 'DashboardController@today')->name('today');
Route::get('/stjornbord/i-dag/koma-inn', 'DashboardController@todayIn')->name('todayIn');
Route::get('/stjornbord/i-dag/fara-ut', 'DashboardController@todayGoingOut')->name('todayGoingOut');

Route::prefix('api')->group(function () {
	Route::get('services/get', 'ApiController@getServices');
	Route::get('discounts/get', 'ApiController@getDiscounts');
	Route::get('car/info/get', 'ApiController@getCarInfo');
	Route::get('flight/info/get', 'ApiController@getFlightInfo');
	Route::get('booking/get/id', 'ApiController@getBookingId');
	
	Route::post('database/booking/create', 'ApiController@createBooking');
	Route::post('database/booking/update', 'ApiController@updateBooking');
});


