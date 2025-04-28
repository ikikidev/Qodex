<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $directivo = User::create([
            'name' => 'Directivo de prueba',
            'email' => 'directivo@qodex.local',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $directivo->assignRoleAndSync('Directivo');

        $bibliotecario = User::create([
            'name' => 'Bibliotecario de prueba',
            'email' => 'bibliotecario@qodex.local',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $bibliotecario->assignRoleAndSync('Bibliotecario');

    }
}
