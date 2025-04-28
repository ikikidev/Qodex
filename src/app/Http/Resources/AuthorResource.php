<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'birthdate' => optional($this->birthdate)->format('Y-m-d'),
            'nationality' => $this->nationality,
            'books' => $this->books->map(function ($book) {
                return [
                    'id' => $book->id,
                    'title' => $book->title,
                    'publication_year' => $book->publication_year,
                ];
            }),
        ];
    }
}
