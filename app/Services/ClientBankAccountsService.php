<?php


namespace App\Services;


use App\Models\ClientBankAccount;
use App\Repositories\ClientBankAccountsRepositoryInterface;

class ClientBankAccountsService
{
    private $clientBankAccountsRepository;
    public function __construct(ClientBankAccountsRepositoryInterface $clientBankAccountsRepository)
    {
        $this->clientBankAccountsRepository = $clientBankAccountsRepository;
    }

    public function getById(int $id): ClientBankAccount
    {
        return $this->clientBankAccountsRepository->getById($id);
    }
}
