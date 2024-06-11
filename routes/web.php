<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Middleware\Authenticate;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [CustomAuthController::class, 'login'])->name('login');
Route::get('/registration', [CustomAuthController::class, 'registration'])->name('registration');
Route::post('/register', [CustomAuthController::class, 'register'])->name('register');
Route::post('/login', [CustomAuthController::class,'loginUser'])->name('loginUser');
Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/users', [CustomAuthController::class, 'index'])->name('users.index');
    Route::get('/users/create', [CustomAuthController::class, 'create'])->name('users.create');
    Route::post('/users', [CustomAuthController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [CustomAuthController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [CustomAuthController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [CustomAuthController::class, 'destroy'])->name('users.destroy');
});



/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');*/


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    
});

/*Route::middleware(['restrict.dashboard'])->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
});*/

