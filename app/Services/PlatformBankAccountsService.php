<?php


namespace App\Services;


use App\Repositories\PlatformBankAccountsRepositoryInterface;

class PlatformBankAccountsService
{
    private $platformBankAccountsRepository;

    public function __construct(PlatformBankAccountsRepositoryInterface $platformBankAccountsRepository)
    {
        $this->platformBankAccountsRepository = $platformBankAccountsRepository;
    }

    public function getActive()
    {
        return $this->platformBankAccountsRepository->getActive();
    }
}
