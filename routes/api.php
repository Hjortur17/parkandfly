<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('services/get', 'ApiController@getServices');
Route::get('car/info/get', 'ApiController@getCarInfo');
Route::post('booking/create', 'ApiController@createBooking');
Route::post('session/add/booking', 'ApiController@addBookingToSession');
