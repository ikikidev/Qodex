<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;

class AuthorController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/authors/{author}",
     *     summary="Mostrar detalles de un autor",
     *     tags={"Autores"},
     *     @OA\Parameter(
     *         name="author",
     *         in="path",
     *         required=true,
     *         description="ID del autor",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles del autor obtenidos correctamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Autor no encontrado"
     *     )
     * )
     */
    public function show(Author $author): AuthorResource
    {
        $author->load('books');

        return new AuthorResource($author);
    }
}
