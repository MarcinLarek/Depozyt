<?php


namespace App\Repositories;


use App\Models\ClientBankAccount;

interface ClientBankAccountsRepositoryInterface
{
    public function getById(int $id): ClientBankAccount;
}
