<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::domain('localhost')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'index'])->name('register');
        Route::post('/register/store', [\App\Http\Controllers\RegisterController::class, 'store'])->name('register.store');
        Route::get('/register/{token}', [\App\Http\Controllers\RegisterController::class, 'confirmation'])->name('register.confirmation');

        Route::get('/sign-in', [\App\Http\Controllers\LoginController::class, 'index'])->name('sign-in');
        Route::post('/sign-in', [\App\Http\Controllers\LoginController::class, 'signIn'])->name('client.sign-in');
        Route::get('/ForgotPassword', [\App\Http\Controllers\LoginController::class, 'forgotPassword'])->name('ForgotPassword');
        Route::post('/ForgotPassword', [\App\Http\Controllers\LoginController::class, 'forgotPasswordReset'])->name('client.ForgotPasswordReset');
        Route::get('/SetNewPassword', [\App\Http\Controllers\LoginController::class, 'setNewPassword'])->name('SetNewPassword');
        Route::post('/SetNewPassword', [\App\Http\Controllers\LoginController::class, 'setNewPassword'])->name('client.SetNewPassword');
    });

    Route::middleware('auth:client')->group(function () {
        Route::prefix('/payment')->group(function () {
            Route::get('/', [\App\Http\Controllers\PaymentController::class, 'index'])->name('payment');
            Route::get('/get-amount', [\App\Http\Controllers\PaymentController::class, 'getAmount']);
            Route::get('/document/{walletHistoryId}', [\App\Http\Controllers\PaymentController::class, 'downloadDocument'])->name('payment.download');
        });

        Route::prefix('/representative')->group(function () {
            Route::get('/', [\App\Http\Controllers\RepresentativeController::class, 'index'])->name('representative');
            Route::post('/edit', [\App\Http\Controllers\RepresentativeController::class, 'edit'])->name('representative.edit');
        });

        Route::prefix('/client-data')->group(function () {
            Route::get('/', [\App\Http\Controllers\ClientDataController::class, 'index'])->name('client-data');
            Route::post('/edit', [\App\Http\Controllers\ClientDataController::class, 'edit'])->name('client-data.edit');
        });

        Route::prefix('/company-data')->group(function () {
            Route::get('/', [\App\Http\Controllers\CompanyDataController::class, 'index'])->name('company-data');
            Route::post('/edit', [\App\Http\Controllers\CompanyDataController::class, 'edit'])->name('company-data.edit');
        });

        Route::prefix('/recipients')->group(function () {
            Route::get('/', [\App\Http\Controllers\RecipientController::class, 'index'])->name('recipients');
            Route::get('/create', [\App\Http\Controllers\RecipientController::class, 'create'])->name('recipients.create');
            Route::post('/store', [\App\Http\Controllers\RecipientController::class, 'store'])->name('recipients.store');
            Route::get('/{id}/edit', [\App\Http\Controllers\RecipientController::class, 'edit'])->name('recipients.edit');
            Route::put('/{id}/update', [\App\Http\Controllers\RecipientController::class, 'update'])->name('recipients.update');
            Route::get('/payment', [\App\Http\Controllers\RecipientController::class, 'payment'])->name('recipients.payment');
            Route::get('/get-history', [\App\Http\Controllers\RecipientController::class, 'getHistory']);
            Route::post('/paymentpost', [\App\Http\Controllers\PaymentController::class, 'paymentpost'])->name('payment.paymentpost');
        });

        Route::prefix('/client')->group(function () {
            Route::get('/', [\App\Http\Controllers\ClientController::class, 'index'])->name('client');
            Route::post('/edit', [\App\Http\Controllers\ClientController::class, 'edit'])->name('client.edit');
            Route::patch('/update', [\App\Http\Controllers\ClientController::class, 'update'])->name('client.update');
        });

        Route::prefix('/bank-accounts')->group(function () {
            Route::get('/', [\App\Http\Controllers\ClientBankAccountController::class, 'index'])->name('bank-accounts');
            Route::get('/create', [\App\Http\Controllers\ClientBankAccountController::class, 'create'])->name('bank-accounts.create');
            Route::get('/{id}/edit', [\App\Http\Controllers\ClientBankAccountController::class, 'edit'])->name('bank-accounts.edit');
            Route::post('/{id}/update', [\App\Http\Controllers\ClientBankAccountController::class, 'update'])->name('bank-accounts.update');
            Route::post('/store', [\App\Http\Controllers\ClientBankAccountController::class, 'store'])->name('bank-accounts.store');
        });

        Route::prefix('withdrawal')->group(function () {
            Route::get('/', [\App\Http\Controllers\WithdrawalController::class, 'index'])->name('withdrawal');
            Route::get('/get-history', [\App\Http\Controllers\WithdrawalController::class, 'getHistory']);
            Route::get('/document/{walletHistoryId}', [\App\Http\Controllers\WithdrawalController::class, 'downloadDocument'])->name('withdrawal.download');
        });

        Route::prefix('/transactions')->group(function () {
            Route::get('/', [\App\Http\Controllers\TransactionController::class, 'index'])->name('transaction');
            Route::get('/create', [\App\Http\Controllers\TransactionController::class, 'create'])->name('transaction.create');
            Route::post('/get-contractor', [\App\Http\Controllers\TransactionController::class, 'getContractor'])->name('transactions.get-contractor');
            Route::get('/get-list', [\App\Http\Controllers\TransactionController::class, 'getTransactions']);
            Route::post('/store', [\App\Http\Controllers\TransactionController::class, 'store'])->name('transactions.store');
            Route::post('/filter', [\App\Http\Controllers\TransactionController::class, 'filter'])->name('transactions.filter');
            Route::get('/{id}/edit', [\App\Http\Controllers\TransactionController::class, 'edit'])->name('transactions.edit');
            Route::post('/{id}/update', [\App\Http\Controllers\TransactionController::class, 'update'])->name('transactions.update');
            Route::get('/transactionsToAccept', [\App\Http\Controllers\TransactionController::class, 'transactionsToAccept'])->name('transaction.transactionsToAccept');
            Route::get('/confirm', [\App\Http\Controllers\TransactionController::class, 'confirm'])->name('transactions.confirm');
            Route::get('/{id}/preview', [\App\Http\Controllers\TransactionController::class, 'preview'])->name('transactions.preview');
            Route::get('/{id}/generatepdf2', [\App\Http\Controllers\TransactionController::class, 'generatePdf2'])->name('transactions.generatepdf2');
        });


        Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
    });

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('what-is-depozyt', [HomeController::class, 'whatIsDepozyt'])->name('what-is-depozyt');
    Route::get('how-it-works', [HomeController::class, 'howItWorks'])->name('how-it-works');
    Route::get('regulations', [HomeController::class, 'regulations'])->name('regulations');
    Route::get('contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('sendcontact', [HomeController::class, 'sendcontact'])->name('sendcontact');
    Route::get('/SetNewPassword/{token}', [\App\Http\Controllers\LoginController::class, 'setNewPassword'])->name('SetNewPassword');
    Route::post('SetNewPasswordUpdate', [\App\Http\Controllers\LoginController::class, 'setNewPasswordUpdate'])->name('SetNewPasswordUpdate');

    Route::get('lang/change/{lan}', [\App\Http\Controllers\LangController::class, 'change'])->name('changeLang');
});

Route::domain('admin.localhost')->group(function () {
    Route::middleware('auth:admin')->group(function () {

        Route::prefix('/users')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\UsersController::class, 'index'])->name('admin.users');
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\UsersController::class, 'edit'])->name('admin.users.edit');
            Route::patch('/{id}/update', [\App\Http\Controllers\Admin\UsersController::class, 'update'])->name('admin.users.update');
            Route::get('/{id}/delete', [\App\Http\Controllers\Admin\UsersController::class, 'delete'])->name('admin.users.delete');
            Route::post('/{id}/deleteuser', [\App\Http\Controllers\Admin\UsersController::class, 'deleteuser'])->name('admin.users.deleteuser');
        });

        Route::prefix('/admins')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\AdminsController::class, 'adminslist'])->name('admin.admins');
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\AdminsController::class, 'edit'])->name('admin.admins.edit');
            Route::patch('/{id}/update', [\App\Http\Controllers\Admin\AdminsController::class, 'update'])->name('admin.admins.update');
            Route::get('/{id}/delete', [\App\Http\Controllers\Admin\AdminsController::class, 'delete'])->name('admin.admins.delete');
            Route::post('/{id}/deleteadmin', [\App\Http\Controllers\Admin\AdminsController::class, 'deleteadmin'])->name('admin.admins.deleteadmin');
        });

        Route::prefix('/errors')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\ErrorsController::class, 'index'])->name('admin.errors');
        });

        Route::prefix('/countries')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\CountriesController::class, 'index'])->name('admin.countries');
            Route::post('/store', [\App\Http\Controllers\Admin\CountriesController::class, 'store'])->name('admin.countries.store');
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\CountriesController::class, 'edit'])->name('admin.countries.edit');
            Route::put('/{id}/update', [\App\Http\Controllers\Admin\CountriesController::class, 'update'])->name('admin.countries.update');
        });

        Route::prefix('/bankaccounts')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\BankAccountsController::class, 'index'])->name('admin.bankaccounts');
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\BankAccountsController::class, 'edit'])->name('admin.bankaccounts.edit');
            Route::put('/{id}/update', [\App\Http\Controllers\Admin\BankAccountsController::class, 'update'])->name('admin.bankaccounts.update');
        });

        Route::prefix('/transactions')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\TransactionsController::class, 'index'])->name('admin.transactions');
            Route::post('/store', [\App\Http\Controllers\Admin\TransactionsController::class, 'store'])->name('admin.transactions.store');
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\TransactionsController::class, 'edit'])->name('admin.transactions.edit');
            Route::put('/{id}/update', [\App\Http\Controllers\Admin\TransactionsController::class, 'update'])->name('admin.transactions.update');
        });

        Route::prefix('/payments')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\PaymentsController::class, 'index'])->name('admin.payments');
            Route::post('/store', [\App\Http\Controllers\Admin\PaymentsController::class, 'store'])->name('admin.payments.store');
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\PaymentsController::class, 'edit'])->name('admin.payments.edit');
            Route::put('/{id}/update', [\App\Http\Controllers\Admin\PaymentsController::class, 'update'])->name('admin.payments.update');
        });
        Route::prefix('/withdrawal')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\PaymentsController::class, 'withdrawal'])->name('admin.withdrawal');
        });

        Route::prefix('/client-types')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\ClientTypesController::class, 'index'])->name('admin.client-types');
            Route::post('/store', [\App\Http\Controllers\Admin\ClientTypesController::class, 'store'])->name('admin.client-types.store');
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\ClientTypesController::class, 'edit'])->name('admin.client-types.edit');
            Route::put('/{id}/update', [\App\Http\Controllers\Admin\ClientTypesController::class, 'update'])->name('admin.client-types.update');
        });

        Route::prefix('/currencies')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\CurrenciesController::class, 'index'])->name('admin.currencies');
            Route::post('/store', [\App\Http\Controllers\Admin\CurrenciesController::class, 'store'])->name('admin.currencies.store');
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\CurrenciesController::class, 'edit'])->name('admin.currencies.edit');
            Route::put('/{id}/update', [\App\Http\Controllers\Admin\CurrenciesController::class, 'update'])->name('admin.currencies.update');
        });

        Route::prefix('/contact')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\ContactController::class, 'index'])->name('admin.contact');
            Route::get('/{id}/show', [\App\Http\Controllers\Admin\ContactController::class, 'show'])->name('admin.contact.show');
            Route::get('/{id}/reply', [\App\Http\Controllers\Admin\ContactController::class, 'reply'])->name('admin.contact.reply');
            Route::post('/{id}/sendreply', [\App\Http\Controllers\Admin\ContactController::class, 'sendreply'])->name('admin.contact.sendreply');
            Route::get('/{id}/delete', [\App\Http\Controllers\Admin\ContactController::class, 'delete'])->name('admin.contact.delete');
            Route::post('/{id}/delectmessege', [\App\Http\Controllers\Admin\ContactController::class, 'deletemessege'])->name('admin.contact.deletemessege');
        });

        Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin');
        Route::get('/csvexport', [\App\Http\Controllers\Admin\CsvController::class, 'csvexport'])->name('admin.csvexport');
        Route::post('/csvimport', [\App\Http\Controllers\Admin\CsvController::class, 'csvimport'])->name('admin.csvimport');

        Route::prefix('/platform-bank-account')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\PlatformBankAccountController::class, 'index'])->name('admin.platform-bank-account');
            Route::post('/store', [\App\Http\Controllers\Admin\PlatformBankAccountController::class, 'store'])->name('admin.platform-bank-account.store');
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\PlatformBankAccountController::class, 'edit'])->name('admin.platform-bank-account.edit');
            Route::put('/{id}/update', [\App\Http\Controllers\Admin\PlatformBankAccountController::class, 'update'])->name('admin.platform-bank-account.update');
        });

        Route::prefix('/platform-data')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\PlatformDataController::class, 'index'])->name('admin.platform-data');
            Route::post('/update', [\App\Http\Controllers\Admin\PlatformDataController::class, 'update'])->name('admin.platform-data.update');
        });
    });

    Route::middleware('guest')->group(function () {
        Route::prefix('/sign-in')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\SignInController::class, 'index'])->name('admin.sign-in');
            Route::post('/login', [\App\Http\Controllers\Admin\SignInController::class, 'login'])->name('admin.login');
            Route::get('/LoginAdmin', [\App\Http\Controllers\Admin\SignInController::class, 'LoginAdmin'])->name('admin.LoginAdmin');
            Route::get('/AdminLogin/{token}', [\App\Http\Controllers\Admin\SignInController::class, 'AdminLogin'])->name('admin.AdminLogin');
        });
    });
});
