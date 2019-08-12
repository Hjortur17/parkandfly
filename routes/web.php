<?php

Auth::routes();

Route::get('/', 'MainController@index');

Route::get('/stjornbord', 'DashboardController@index');

Route::get('api/services/get', 'ApiController@getServices');
Route::get('api/car/info/get', 'ApiController@getCarInfo');
Route::post('api/booking/create', 'ApiController@createBooking');