<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/movies', function () {
    return view('movies');
});

Route::get('/books', function () {
    return view('books');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/mySettings', function () {
    return view('mySettings');
});