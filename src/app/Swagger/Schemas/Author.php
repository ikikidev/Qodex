<?php
namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="Author",
 *     type="object",
 *     title="Autor",
 *     required={"id", "name", "birthdate", "nationality"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Gabriel García Márquez"),
 *     @OA\Property(property="birthdate", type="string", format="date", example="1927-03-06"),
 *     @OA\Property(property="nationality", type="string", example="Colombiano"),
 *     @OA\Property(
 *         property="books",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Book")
 *     )
 * )
 */
