<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Asignar rol "bibliotecario" por defecto
        $user->assignRole('bibliotecario');

        // Enviar correo de bienvenida
        Mail::to($user->email)->send(new WelcomeMail($user));

        // Redirigir al login de Filament
        return redirect()->route('filament.admin.auth.login')
            ->with('status', '¡Registro exitoso! Ahora puedes iniciar sesión.');
    }
}
