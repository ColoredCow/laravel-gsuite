<?php

Route::get('auth/google', 'Controllers\Auth\LoginController@redirectToProvider');
Route::get('auth/google/callback', 'Controllers\Auth\LoginController@handleProviderCallback');
