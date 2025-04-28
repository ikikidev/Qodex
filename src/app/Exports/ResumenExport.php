<?php

namespace App\Exports;

use App\Models\Book;
use App\Models\Author;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class ResumenExport implements FromCollection, WithHeadings
{
    public function collection(): Collection
    {
        $totalLibros = Book::count();
        $totalAutores = Author::count();

        $librosPorAutor = Author::withCount('books')->get()->map(function ($author) {
            return [
                'Autor' => $author->name,
                'Total de libros' => $author->books_count,
            ];
        });

        $resumen = collect([
            ['Descripcion', 'Cantidad'],
            ['Total de libros', $totalLibros],
            ['Total de autores', $totalAutores],
            ['---', '---'],
        ]);

        return $resumen->merge($librosPorAutor);
    }

    public function headings(): array
    {
        return [
            'Descripcion',
            'Cantidad',
        ];
    }
}
