<?php

namespace App\Policies;

use App\Models\Kontingen;
use App\Models\User;

class KontingenPolicy
{
    public function view(User $user, Kontingen $kontingen): bool
    {
        if ($user->hasRole('superadmin')) {
            return true;
        }

        if ($user->hasRole('admin')) {
            return $user->kejuaraans->contains($kontingen->kejuaraans_id);
        }

        if ($user->hasRole('manajer')) {
            return $kontingen->users_id === $user->id;
        }

        return false;
    }
}
