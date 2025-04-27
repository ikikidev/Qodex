<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @OA\Schema(
 *     schema="User",
 *     title="Usuario",
 *     description="Información de un usuario registrado",
 *     @OA\Property(property="id", type="integer", description="ID del usuario"),
 *     @OA\Property(property="name", type="string", description="Nombre completo del usuario"),
 *     @OA\Property(property="email", type="string", format="email", description="Dirección de correo electrónico del usuario"),
 *     @OA\Property(property="email_verified_at", type="string", format="date-time", description="Fecha de verificación del correo electrónico", nullable=true),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación del usuario"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de última actualización del usuario")
 * )
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
