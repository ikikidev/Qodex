<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Author;

class AuthorPolicy
{
    /**
     * Permitir ver autores a cualquiera (registrado o anónimo).
     */
    public function viewAny(User $user = null): bool
    {
        return true;
    }

    public function view(User $user = null, Author $author): bool
    {
        return true;
    }

    /**
     * Solo usuarios registrados pueden crear autores.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['Directivo', 'Bibliotecario']);
    }

    /**
     * Solo usuarios registrados pueden actualizar autores.
     */
    public function update(User $user, Author $author): bool
    {
        return $user->hasRole(['Directivo', 'Bibliotecario']);
    }

    /**
     * Solo usuarios registrados pueden borrar autores.
     */
    public function delete(User $user, ?Author $author = null): bool
    {
        return $user->hasAnyRole(['Directivo', 'Bibliotecario']);
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasAnyRole(['Directivo', 'Bibliotecario']);
    }
}
