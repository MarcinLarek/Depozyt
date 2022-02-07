<?php


namespace App\Services;


use App\Repositories\CurrenciesRepositoryInterface;

class CurrenciesService
{
    private $currenciesRepository;


    public function __construct(CurrenciesRepositoryInterface $currenciesRepository)
    {
        $this->currenciesRepository = $currenciesRepository;
    }

    public function getActive()
    {
        return $this->currenciesRepository->getActive();
    }
}
