<?php

use App\Http\Controllers\Api\Auth\RegisterApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\AuthorController;

Route::prefix('v1')->group(function () {
    // Libros
    Route::get('/books', [BookController::class, 'index'])->name('api.books.index');

    // Autores
    Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('api.authors.show');

    // Registro de Usuarios (Bibliotecarios y Directivos)
    Route::post('/register', [RegisterApiController::class, 'register'])->name('api.register');
});
