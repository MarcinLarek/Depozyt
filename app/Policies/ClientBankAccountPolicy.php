<?php

namespace App\Policies;

use App\Models\ClientBankAccount;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientBankAccountPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, ClientBankAccount $clientBankAccount)
    {
        return $user->getId() === $clientBankAccount->getId();
    }
}
