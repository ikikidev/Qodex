<?php
namespace App\Swagger\Schemas;
/**
 * @OA\Schema(
 *     schema="Book",
 *     type="object",
 *     title="Libro",
 *     required={"id", "title", "isbn", "publication_year"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Cien años de soledad"),
 *     @OA\Property(property="isbn", type="string", example="978-3-16-148410-0"),
 *     @OA\Property(property="publication_year", type="integer", example=1967),
 *     @OA\Property(
 *         property="authors",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Author")
 *     )
 * )
 */
