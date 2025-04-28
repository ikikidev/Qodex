<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Support\Facades\Auth;

class Login extends BaseLogin
{
    public function getHeading(): string
    {
        return 'Sign In';
    }

    public function authenticate(): ?LoginResponse
    {
        $credentials = $this->form->getState();

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ], $credentials['remember'] ?? false)) {
            return app(LoginResponse::class);
        }

        return null;
    }
}
