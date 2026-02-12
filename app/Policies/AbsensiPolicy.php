<?php

namespace App\Policies;

use App\Models\Absensi;
use App\Models\User;

class AbsensiPolicy
{
    public function view(User $user, Absensi $absensi): bool
    {
        return $user->role === 'admin' || $user->id === $absensi->user_id;
    }

    public function delete(User $user, Absensi $absensi): bool
    {
        return $user->role === 'admin';
    }
}
