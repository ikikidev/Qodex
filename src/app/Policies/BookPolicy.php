<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Book;

class BookPolicy
{
    /**
     * Permitir ver libros a cualquiera (registrado o anónimo).
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Book $book): bool
    {
        return true;
    }

    /**
     * Solo usuarios registrados pueden crear libros.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['Directivo', 'Bibliotecario']);
    }

    /**
     * Solo usuarios registrados pueden actualizar libros.
     */
    public function update(User $user, Book $book): bool
    {
        return $user->hasRole(['Directivo', 'Bibliotecario']);
    }

    /**
     * Solo usuarios registrados pueden borrar libros.
     */
    public function delete(User $user, Book $book): bool
    {
        return $user->hasRole(['Directivo', 'Bibliotecario']);
    }
}
