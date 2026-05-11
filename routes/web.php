<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('auth.login');
});
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');
