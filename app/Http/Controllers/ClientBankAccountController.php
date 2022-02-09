<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientBankAccounts\StoreRequest;
use App\Models\ClientBankAccount;
use App\Services\ClientBankAccountsService;
use App\Services\CurrenciesService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientBankAccountController extends Controller
{
    private $currenciesService;
    private $clientBankAccountsService;

    public function __construct(CurrenciesService $currenciesService, ClientBankAccountsService $clientBankAccountsService)
    {
        $this->currenciesService = $currenciesService;
        $this->clientBankAccountsService = $clientBankAccountsService;
    }

    public function index()
    {
      try {
        $bankAccounts = Auth::user()->bankAccounts;
        return View("/frontend/client-bank-account/index")
            ->with('bankAccounts', $bankAccounts);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "ClientBankAccount", "index", $ex->getMessage(), $request->ip(), Auth::id());
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }
    }

    public function create()
    {
      try {
        $currencies = $this->currenciesService->getActive();
        return view("/frontend/client-bank-account/create")
            ->with('currencies', $currencies);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "ClientBankAccount", "create", $ex->getMessage(), $request->ip(), Auth::id());
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }

    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        try {
                $user = Auth::user();
                $data['country_id'] = $user->country->getId();
                $user->bankAccounts()->create($data);
                return redirect()->route('bank-accounts')->withSuccess('Konto bankowe zostało dodane');
            } catch (\Exception $ex) {
            saveException(sqlDateTime(), "ClientBankAccount", "store", $ex->getMessage(), $request->ip(), Auth::id());
            $error = 1;
            return view("/frontend/home/index", compact('error'));
        }
    }

    public function edit(int $id, Request $request)
    {
        try {
          $bankAccount =  ClientBankAccount::where('id',$id)->first();
          return view("/frontend/client-bank-account/edit")
              ->with('bankAccount', $bankAccount);
        } catch (\Exception $ex) {
          saveException(sqlDateTime(), "ClientBankAccount", "edit", $ex->getMessage(), $request->ip(), Auth::id());
          $error = 1;
          return view("/frontend/home/index", compact('error'));
        }

    }

    public function update(Request $request)
    {
      try {
        $request->validate([
            'bank_name' => ['required','max:100'],
            'currency_id' => ['required'],
            'country_id' => ['required'],
            'account_number' => ['required','max:100'],
            'swift' => ['required','max:100'],
            'active' => ['required'],
            'id' => ['required'],
        ]);

        ClientBankAccount::where('id',$request['id'])->update([
          'bank_name' => $request['bank_name'],
          'currency_id' => $request['currency_id'],
          'country_id' => $request['country_id'],
          'account_number' => $request['account_number'],
          'swift' => $request['swift'],
          'active' => $request['active']
        ]);
        $bankAccounts = Auth::user()->bankAccounts;
        return View("/frontend/client-bank-account/index")
            ->with('bankAccounts', $bankAccounts);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "ClientBankAccount", "update", $ex->getMessage(), $request->ip(), Auth::id());
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }
    }
}
