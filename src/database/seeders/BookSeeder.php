<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Cien años de soledad',
                'isbn' => '978-3-16-148410-0',
                'publication_year' => 1967,
            ],
            [
                'title' => 'Kafka en la orilla',
                'isbn' => '978-3-16-148410-1',
                'publication_year' => 2002,
            ],
            [
                'title' => 'Orgullo y prejuicio',
                'isbn' => '978-3-16-148410-2',
                'publication_year' => 1813,
            ],
            [
                'title' => '1984',
                'isbn' => '978-3-16-148410-3',
                'publication_year' => 1949,
            ],
            [
                'title' => 'Don Quijote de la Mancha',
                'isbn' => '978-3-16-148410-4',
                'publication_year' => 1605,
            ],
            [
                'title' => 'El Principito',
                'isbn' => '978-3-16-148410-5',
                'publication_year' => 1943,
            ],
            [
                'title' => 'Rayuela',
                'isbn' => '978-3-16-148410-6',
                'publication_year' => 1963,
            ],
            [
                'title' => 'Fahrenheit 451',
                'isbn' => '978-3-16-148410-7',
                'publication_year' => 1953,
            ],
            [
                'title' => 'Matar a un ruiseñor',
                'isbn' => '978-3-16-148410-8',
                'publication_year' => 1960,
            ],
            [
                'title' => 'Los juegos del hambre',
                'isbn' => '978-3-16-148410-9',
                'publication_year' => 2008,
            ],
        ];

        $authorIds = Author::pluck('id')->toArray();

        foreach ($books as $bookData) {
            $book = Book::create($bookData);
            $randomAuthorIds = collect($authorIds)->shuffle()->take(rand(1, 3))->toArray();
            $book->authors()->attach($randomAuthorIds);
        }
    }
}
