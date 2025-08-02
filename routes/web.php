<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/store', [UserController::class, 'store'])->name('user.store');
Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

// // Route::resource()

require __DIR__ . '/auth.php';

// Route::get('/greeting', function () {
//     return 'Hello World';
// })->name('greet');


// Route::resource('/user', UserController::class)->names('bottle');

// Route::resource('/create', [UserController::class, 'create'])->names('dashboard');
