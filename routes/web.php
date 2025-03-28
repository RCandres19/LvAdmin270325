<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin', function () {
        return 'Bienvenido, administrador';
    });
});

//  Formularios de autenticación
Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::get('/logout', [AuthController::class, 'logoutForm'])->name('logout.form');
Route::get('/me', [AuthController::class, 'meForm'])->name('me.form');
Route::get('/refresh', [AuthController::class, 'refreshForm'])->name('refresh.form');

//  Acciones de autenticación
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

//  Rutas protegidas con autenticación
Route::middleware('auth:web')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/me', [AuthController::class, 'me'])->name('me');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
});