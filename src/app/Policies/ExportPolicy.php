<?php

namespace App\Policies;

use App\Models\User;

class ExportPolicy
{
    public function export(User $user): bool
    {
        return $user->hasRole('directivo');
    }
}
