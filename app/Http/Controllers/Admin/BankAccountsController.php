<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\WalletHistory;
use Illuminate\Http\Request;
use App\Models\ClientBankAccount;
use App\Models\Currency;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BankAccountsController extends Controller
{
    public function index()
    {
        try {
            $banks = ClientBankAccount::all();
            return view('/frontend/admin/bankaccounts/index')
          ->with('banks', $banks);
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-BankAccounts", "index", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }

    public function edit($id)
    {
        try {
            $bank = ClientBankAccount::find($id);
            $currencies = Currency::all();
            $countries = Country::all();
            $users = User::all();
            return view('/frontend/admin/bankaccounts/edit')
          ->with('bank', $bank)
          ->with('currencies', $currencies)
          ->with('countries', $countries)
          ->with('users', $users);
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-BankAccounts", "edit", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }

    public function update($id, Request $request)
    {
        $request->validate([
        'user_username' => ['required','max:100'],
        'name' => ['required','max:100'],
        'bank_name' => ['required','max:100'],
        'currency_name' => ['required','max:100'],
        'country_name' => ['required','max:100'],
        'account_number' => ['required','iban'],
        'swift' => ['required','bic'],
        'active' => ['required','numeric','max:100'],
    ]);
        try {
            $bank = ClientBankAccount::find($id);
            $user =  User::where('username', $request['user_username'])->first();
            $currency =  Currency::where('symbol', $request['currency_name'])->first();
            $country =  Country::where('country_name', $request['country_name'])->first();
            $data = array(
          'user_id' => $user['id'],
          'name' => $request['name'],
          'bank_name' => $request['bank_name'],
          'currency_id' => $currency['id'],
          'country_id' => $country['id'],
          'account_number' => $request['account_number'],
          'swift' => $request['swift'],
          'active' => $request['active'],
        );
            $bank->update($data);

            return redirect()->route('admin.bankaccounts')->with('successalert', 'successalert');
        } catch (\Exception $exception) {
            saveException(sqlDateTime(), 'Admin-BankAccounts', 'store', $exception->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }
}
