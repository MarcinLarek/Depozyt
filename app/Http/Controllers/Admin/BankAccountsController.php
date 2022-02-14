<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\WalletHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ClientBankAccount;
use App\Models\Currency;
use App\Models\Country;
use App\Models\User;

class BankAccountsController extends Controller
{
  public function index()
  {
    try {
      $banks = ClientBankAccount::all();
      return view('/frontend/admin/bankaccounts/index')
          ->with('banks', $banks);
    }
    catch (\Exception $ex) {
                saveException(sqlDateTime(), "Admin-BankAccounts", "index", $ex->getMessage(), $request->ip(), Auth::id());
          return view('/frontend/admin/admin/index');
            }
  }

  public function edit($id)
  {
    try {
      $bank = ClientBankAccount::find($id);
      $currencies = DB::table('currencies')->get();
      $countries = DB::table('countries')->get();
      $users = User::all();
      return view('/frontend/admin/bankaccounts/edit')
          ->with('bank', $bank)
          ->with('currencies', $currencies)
          ->with('countries', $countries)
          ->with('users', $users);
    }
    catch (\Exception $ex) {
                saveException(sqlDateTime(), "Admin-BankAccounts", "edit", $ex->getMessage(), $request->ip(), Auth::id());
          return view('/frontend/admin/admin/index');
            }
  }

  public function update($id, Request $request)
  {
    $bank = ClientBankAccount::find($id);
    $request->validate([
        'user_username' => ['required'],
        'name' => ['required'],
        'bank_name' => ['required'],
        'currency_name' => ['required'],
        'country_name' => ['required'],
        'account_number' => ['required'],
        'swift' => ['required'],
        'active' => ['required'],
    ]);
    $user =  User::where('username',$request['user_username'])->first();
    $currency =  Currency::where('symbol',$request['currency_name'])->first();
    $country =  Country::where('country_name',$request['country_name'])->first();
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
    return redirect()->route('admin.bankaccounts');
    /*
      try {

      }
      catch (\Exception $exception) {
          saveException(sqlDateTime(), 'Admin-BankAccounts', 'store', $exception->getMessage(), $request->ip(), Auth::id());
          return view('/frontend/admin/admin/index');
      }
      */

  }
}
