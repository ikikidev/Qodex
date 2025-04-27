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
     * Muestra el listado de libros (alternativa a la raíz).
     */
    public function listBooks()
    {
        $books = Book::with('authors')->latest()->paginate(10);

        return view('public.books.index', compact('books'));
    }

    /**
     * Muestra el detalle de un autor y sus libros.
     */
    public function showAuthor(Author $author)
    {
        // Asegura que también cargamos los libros
        $author->load('books');

        return view('public.authors.show', compact('author'));
    }
}
