<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Panel;


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
class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasAnyRole(['Directivo', 'Bibliotecario']);
    }

    public function assignRoleAndSync(string $role): void
    {
        if ($this->roles()->exists()) {
            $this->syncRoles([$role]);
        } else {
            $this->assignRole($role);
        }

        $this->update([
            'role' => $role,
        ]);
    }
}
