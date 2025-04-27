<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            ['name' => 'Gabriel García Márquez', 'birthdate' => '1927-03-06', 'nationality' => 'Colombiano'],
            ['name' => 'Jane Austen', 'birthdate' => '1775-12-16', 'nationality' => 'Británica'],
            ['name' => 'George Orwell', 'birthdate' => '1903-06-25', 'nationality' => 'Británica'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
