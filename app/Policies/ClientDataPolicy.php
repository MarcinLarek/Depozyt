<?php

namespace App\Policies;

use App\Models\ClientData;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientDataPolicy
{
    use HandlesAuthorization;
}
