<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routes for the User Management SPA using Livewire.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// User Management - Form + Table side by side
Route::get('/users', function () {
    return view('users');
})->name('users.index');
