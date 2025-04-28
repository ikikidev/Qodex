<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/books",
     *     summary="Listado de todos los libros",
     *     tags={"Libros"},
     *     @OA\Response(
     *         response=200,
     *         description="Listado obtenido correctamente"
     *     )
     * )
     */
    public function index(Request $request): AnonymousResourceCollection| JsonResponse
    {
        $books = Book::with('authors')->get();

        // Aseguramos que siempre se devuelva como JSON
        if (!$request->expectsJson()) {
            return response()->json(BookResource::collection($books));
        }

        return BookResource::collection($books);
    }
}
