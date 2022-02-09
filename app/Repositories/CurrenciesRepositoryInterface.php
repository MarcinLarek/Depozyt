<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface CurrenciesRepositoryInterface
{
    public function getActive(): Collection;
}
