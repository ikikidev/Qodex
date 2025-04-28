<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'isbn' => $this->isbn,
            'publication_year' => $this->publication_year,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'authors' => $this->authors->pluck('name'),
        ];
    }
}
