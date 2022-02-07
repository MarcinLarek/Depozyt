<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function login(User $user)
    {
        return $user->isActive() && !$user->isBlocked();
    }

    public function edit(User $user)
    {

    }


}
