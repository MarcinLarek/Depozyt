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
use Illuminate\Support\Facades\Mail;
use App\Mail\NewErrorMail;
use Illuminate\Support\Facades\DB;

class BankAccountsController extends Controller
{
  public function index()
  {
    try {
      $banks = ClientBankAccount::all();
      $succesaalert = 0;
      return view('/frontend/admin/bankaccounts/index')
          ->with('succesaalert', $succesaalert)
          ->with('banks', $banks);
    }
    catch (\Exception $ex) {
                saveException(sqlDateTime(), "Admin-BankAccounts", "index", $ex->getMessage(), $request->ip(), Auth::id());
                $admins = DB::table('admins')->get();
                foreach ($admins as $admin) {
                  if ($admin->error_notification==1) {
                    Mail::to($admin->email)->send(new NewErrorMail());
                  }
                }
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
                $admins = DB::table('admins')->get();
                foreach ($admins as $admin) {
                  if ($admin->error_notification==1) {
                    Mail::to($admin->email)->send(new NewErrorMail());
                  }
                }
          return view('/frontend/admin/admin/index');
            }
  }

  public function update($id, Request $request)
  {
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
      try {
        $bank = ClientBankAccount::find($id);
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

        $banks = ClientBankAccount::all();
        $succesaalert = 1;
        return view('/frontend/admin/bankaccounts/index')
            ->with('succesaalert', $succesaalert)
            ->with('banks', $banks);
      }
      catch (\Exception $exception) {
          saveException(sqlDateTime(), 'Admin-BankAccounts', 'store', $exception->getMessage(), $request->ip(), Auth::id());
          $admins = DB::table('admins')->get();
          foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new NewErrorMail());
          }
          return view('/frontend/admin/admin/index');
      }
  }
}
