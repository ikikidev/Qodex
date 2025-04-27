<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Muestra la página principal (listado de libros).
     */
    public function index()
    {
        $books = Book::with('authors')->latest()->paginate(10);

        return view('public.books.index', compact('books'));
    }

    /**
     * @OA\Get(
     *     path="/libros",
     *     summary="Obtener listado de libros",
     *     tags={"Libros"},
     *     @OA\Response(
     *         response=200,
     *         description="Listado de libros obtenido exitosamente",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Book")
     *         )
     *     )
     * )
     */
    public function listBooks()
    {
        $books = Book::with('authors')->latest()->paginate(10);

        return view('public.books.index', compact('books'));
    }

    /**
     * @OA\Get(
     *     path="/autores/{author}",
     *     summary="Obtener detalles de un autor específico",
     *     tags={"Autores"},
     *     @OA\Parameter(
     *         name="author",
     *         in="path",
     *         required=true,
     *         description="ID del autor",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles del autor obtenidos exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Author")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Autor no encontrado"
     *     )
     * )
     */
    public function showAuthor(Author $author)
    {
        // Asegura que también cargamos los libros
        $author->load('books');

        return view('public.authors.show', compact('author'));
    }
}
