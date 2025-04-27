<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Auth\RegisterController;
use L5Swagger\Http\Controllers\SwaggerController;

// Página principal de libros (RAIZ)
Route::get('/', [PublicController::class, 'index'])->name('home');

// Documentación Swagger
Route::get('/api/documentation', [SwaggerController::class, 'api'])->name('swagger.api');

// Registro de usuarios
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Listado público de libros (puedes unificar rutas si quieres)
Route::get('/libros', [PublicController::class, 'listBooks'])->name('public.books.index');

// Detalle de un autor
Route::get('/autores/{author}', [PublicController::class, 'showAuthor'])->name('public.authors.show');
