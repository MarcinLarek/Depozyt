<?php


namespace App\Providers;


use App\Repositories\ClientBankAccountsRepository;
use App\Repositories\ClientBankAccountsRepositoryInterface;
use App\Repositories\CurrenciesRepository;
use App\Repositories\CurrenciesRepositoryInterface;
use App\Repositories\PlatformBankAccountsRepository;
use App\Repositories\PlatformBankAccountsRepositoryInterface;
use App\Repositories\UsersRepository;
use App\Repositories\UsersRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(
            UsersRepositoryInterface::class,
            UsersRepository::class
        );

        $this->app->bind(
            CurrenciesRepositoryInterface::class,
            CurrenciesRepository::class
        );

        $this->app->bind(
            ClientBankAccountsRepositoryInterface::class,
            ClientBankAccountsRepository::class
        );

        $this->app->bind(
            PlatformBankAccountsRepositoryInterface::class,
            PlatformBankAccountsRepository::class
        );
    }
}
