<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

//  Rutas de autenticación (Formularios)
Route::get('/register', [AuthController::class, 'registerForm'])->name('register.view');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.view');
Route::get('/welcome', function () { return view('welcome'); })->name('welcome.view');   

//  Acciones de autenticación
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

//  Rutas protegidas con autenticación
Route::middleware('auth:web')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/me', [AuthController::class, 'me'])->name('me');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');

    //  Rutas solo para ADMINISTRADORES
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', function () {
            return 'Bienvenido, administrador';
        });
    });

    //  Rutas protegidas por PERMISOS
    Route::middleware(['permission:crear boletines'])->post('/boletines', function () {
        return "Boletín creado";
    });

    Route::middleware(['permission:editar informacion'])->put('/informacion/{id}', function ($id) {
        return "Información con ID $id editada";
    });
});
