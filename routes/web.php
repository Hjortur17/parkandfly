<?php

Auth::routes();

Route::get('/home', 'ApiController@getSessionData');

Route::get('/', 'MainController@index');


Route::get('/stjornbord', 'DashboardController@index');
