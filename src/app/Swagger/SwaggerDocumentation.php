<?php

namespace App\Swagger;

/**
 * @OA\OpenApi(
 *     @OA\Server(
 *         url="http://localhost:8000/api",
 *         description="Servidor local de desarrollo"
 *     ),
 *     @OA\Info(
 *         title="API Biblioteca Pública",
 *         version="1.0.0",
 *         description="Documentación de la API REST para gestión de autores y libros.",
 *         @OA\Contact(
 *             email="soporte@biblioteca.com"
 *         ),
 *         @OA\License(
 *             name="MIT",
 *             url="https://opensource.org/licenses/MIT"
 *         )
 *     ),
 *     @OA\Tag(
 *         name="Libros",
 *         description="Operaciones relacionadas con los libros"
 *     ),
 *     @OA\Tag(
 *         name="Autores",
 *         description="Operaciones relacionadas con los autores"
 *     )
 * )
 */
class SwaggerDocumentation
{
    // Esta clase solo existe para alojar las anotaciones de Swagger
}
