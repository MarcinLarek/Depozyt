<?php


namespace App\Repositories;


use App\Models\ClientBankAccount;

class ClientBankAccountsRepository implements ClientBankAccountsRepositoryInterface
{

    public function getById(int $id): ClientBankAccount
    {
        return ClientBankAccount::find($id);
    }
}
