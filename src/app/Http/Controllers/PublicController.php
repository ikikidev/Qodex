<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;

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
     *     tags={"Libros"},
     *     summary="Listado de todos los libros disponibles",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de libros obtenida exitosamente."
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
     *     tags={"Autores"},
     *     summary="Muestra los detalles de un autor específico",
     *     @OA\Parameter(
     *         name="author",
     *         in="path",
     *         required=true,
     *         description="ID del autor",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles del autor obtenidos exitosamente."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Autor no encontrado."
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
