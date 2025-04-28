<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{
    protected function handleRegistration(array $data): Model
    {
        // Crear el usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'email_verified_at' => now(),
        ]);

        // Asignar rol "Bibliotecario" automáticamente
        $user->assignRole('Bibliotecario');
        $user->refresh();
        $user->load('roles');

        // Enviar correo de bienvenida
        Mail::to($user->email)->send(new WelcomeMail($user));

        // Devolver el usuario creado para que Filament lo use
        return $user;
    }
}
