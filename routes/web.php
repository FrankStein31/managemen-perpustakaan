<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('categories', CategoryController::class);
Route::resource('books', BookController::class);

// Routes for User management
Route::resource('users', UserController::class);

// Custom route for verification
Route::post('users/{user}/verify', [UserController::class, 'verify'])->name('users.verify');
Route::get('/users/promote/{id}', [UserController::class, 'promote'])->name('users.promote');



// Redirect root to home
Route::get('/', function () {
    return redirect()->route('home');
});