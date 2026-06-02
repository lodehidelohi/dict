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

use App\Models\Books;

Route::get('/books', function () {
    $books = Books::paginate(10);
    return view('books', compact('books'));
});

Route::get('/books', [App\Http\Controllers\booksController::class, 'index']);