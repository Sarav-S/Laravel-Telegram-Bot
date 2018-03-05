<?php

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'auth'], function() {
    Route::resource('reminders', 'ReminderController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
