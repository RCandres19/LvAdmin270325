<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

//  Registro de usuario
Route::post('/register', [AuthController::class, 'register'])->name('register');

//  Inicio de sesión
Route::post('/login', [AuthController::class, 'login'])->name('login');

//  Cierre de sesión (solo para usuarios autenticados)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');

//  Obtener usuario autenticado (solo para usuarios con sesión activa)
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');

//  Refrescar token (solo para usuarios autenticados)
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
