<?php

Auth::routes();

Route::get('/', 'MainController@index');

Route::get('/stjornbord', 'DashboardController@index');
