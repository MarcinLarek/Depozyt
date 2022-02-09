<?php


namespace App\Repositories;


use App\Models\PlatformBankAccount;

class PlatformBankAccountsRepository implements PlatformBankAccountsRepositoryInterface
{

    public function getActive()
    {
        return PlatformBankAccount::all()->where('active', true);
    }
}
