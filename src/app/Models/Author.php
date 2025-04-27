<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Author",
 *     title="Autor",
 *     description="Información de un autor",
 *     @OA\Property(property="id", type="integer", description="ID del autor"),
 *     @OA\Property(property="name", type="string", description="Nombre completo del autor"),
 *     @OA\Property(property="birthdate", type="string", format="date", description="Fecha de nacimiento del autor"),
 *     @OA\Property(property="nationality", type="string", description="Nacionalidad del autor"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación del registro"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de última actualización")
 * )
 */
class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birthdate',
        'nationality',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
