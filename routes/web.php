<?php

use App\Http\Controllers\booksController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Models\Profile;
use App\Http\Controllers\AuthorController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    if (!session()->has('user_id')) {
        return redirect()->route('login')
            ->withErrors(['login' => 'Please login first.']);
    }

    $user = Profile::find(session('user_id'));

    return view('dashboard', compact('user'));

})->name('dashboard');

Route::get('/movies', function () {
    return view('movies');
});


Route::get('/profile', function () {

    if (!session()->has('user_id')) {
        return redirect()->route('login');
    }

    $user = Profile::find(session('user_id'));

    return view('profile', compact('user'));

})->name('profile');

Route::get('/mySettings', function () {
    return view('mySettings');
});

// Books Routes
Route::get('/books', [booksController::class, 'index'])->name('books.index');
Route::get('/books/create', [booksController::class, 'create'])->name('books.create');
Route::post('/books/store', [booksController::class, 'store'])->name('books.store');
Route::get('/books/edit/{id}', [booksController::class, 'edit'])->name('books.edit');
Route::post('/books/update/{id}', [booksController::class, 'update'])->name('books.update');
Route::delete('/books/delete/{id}', [booksController::class, 'destroy'])->name('books.delete');
Route::get('/register', function () {
    return view('registration');
})->name('register.form');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/profile', function () {
    return back()->with('success', 'Profile updated successfully.');
})->name('profile.update');


Route::get('/login', function () {
    if (session()->has('user_id')) {
        return redirect()->route('dashboard')->with('success', 'You are already logged in.');
    }
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', function () {
    session()->forget('user_id');
    session()->flush();
    return redirect()->route('login')->with('success', 'Logged out successfully.');
})->name('logout');

Route::get('/logout', function () {
    session()->forget('user_id');
    session()->flush();
    return redirect()->route('login')->with('success', 'Logged out successfully.');
})->name('logout');



Route::post('/profile', [AuthController::class, 'updateProfile'])
    ->name('profile.update');



Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/authors/create', [AuthorController::class, 'create'])->name('authors.create');
Route::post('/authors/store', [AuthorController::class, 'store'])->name('authors.store');
Route::get('/authors/edit/{id}', [AuthorController::class, 'edit'])->name('authors.edit');
Route::post('/authors/update/{id}', [AuthorController::class, 'update'])->name('authors.update');
Route::delete('/authors/delete/{id}', [AuthorController::class, 'destroy'])->name('authors.delete');

use App\Http\Controllers\MovieController;

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
Route::post('/movies/store', [MovieController::class, 'store'])->name('movies.store');
Route::get('/movies/edit/{id}', [MovieController::class, 'edit'])->name('movies.edit');
Route::post('/movies/update/{id}', [MovieController::class, 'update'])->name('movies.update');
Route::delete('/movies/delete/{id}', [MovieController::class, 'destroy'])->name('movies.delete');