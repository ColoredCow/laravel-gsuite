<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('auth/google', 'App\Http\Controllers\Auth\LoginController@redirectToProvider');
    Route::get('auth/google/callback', 'App\Http\Controllers\Auth\LoginController@handleProviderCallback');
});
