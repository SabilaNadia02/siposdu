<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/layouts/mainheader');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');
