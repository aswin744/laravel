<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
return view('welcome');
});
Route::view('/users/create', 'users.create_user');
Route::view('/users', 'users.display_users');
Route::view('/users/{id}/edit', 'users.update_user')->name('edit_user');


