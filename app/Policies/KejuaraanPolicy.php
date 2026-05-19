<?php

namespace App\Policies;

use App\Models\Kejuaraan;
use App\Models\User;

class KejuaraanPolicy
{
    public function view(User $user, Kejuaraan $kejuaraan): bool
    {
        if ($user->hasRole('superadmin')) {
            return true;
        }

        if ($user->hasRole('admin')) {
            return $user->kejuaraans->contains($kejuaraan->id);
        }

        if ($user->hasRole('manajer')) {
            return true;
        }

        return false;
    }
}
