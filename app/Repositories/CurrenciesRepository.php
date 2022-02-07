<?php


namespace App\Repositories;


use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;


class CurrenciesRepository implements CurrenciesRepositoryInterface
{
    public function getActive(): Collection
    {
        return Currency::all()->where('active')->sortBy('name');
    }
}
