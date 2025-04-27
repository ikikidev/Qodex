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

            ],
            [
                'title' => 'Kafka en la orilla',
                'isbn' => '978-3-16-148410-1',
            ],
            [
                'title' => 'Orgullo y prejuicio',
                'isbn' => '978-3-16-148410-2',
            ],
        ];

        foreach ($books as $index => $bookData) {
            $book = Book::create($bookData);
            $book->authors()->attach(Author::all()->pluck('id')->random());
        }
    }
}
