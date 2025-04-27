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

    /**
     * @OA\Post(
     *     path="/register",
     *     summary="Registro de nuevo usuario (Bibliotecario o Directivo)",
     *     tags={"Usuarios"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password","password_confirmation"},
     *             @OA\Property(property="name", type="string", example="Juan Pérez"),
     *             @OA\Property(property="email", type="string", format="email", example="juan.perez@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=302,
     *         description="Registro exitoso, redirige al login de Filament",
     *         @OA\Header(
     *             header="Location",
     *             description="Redirección al login",
     *             @OA\Schema(type="string", example="/admin/login")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación (faltan datos o formatos incorrectos)"
     *     )
     * )
     */
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
