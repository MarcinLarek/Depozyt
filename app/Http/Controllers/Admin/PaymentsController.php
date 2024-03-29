<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\WalletHistory;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    public function index()
    {
      try {
        $history = WalletHistory::all();
        return view('/frontend/admin/payments/index')
            ->with('history', $history);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Payments", "index", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }

    }

    public function withdrawal()
    {
      try {
        $history = WalletHistory::all();
        return view('/frontend/admin/payments/withdrawal')
            ->with('history', $history);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Payments", "withdrawal", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }
    }

    public function edit($id)
    {
      try {
        $payment = WalletHistory::find($id);
        $currencies = DB::table('currencies')->get();
        $banks = DB::table('client_bank_accounts')->get();
        $users = User::all();
        return view('/frontend/admin/payments/edit')
            ->with('payment', $payment)
            ->with('currencies', $currencies)
            ->with('banks', $banks)
            ->with('users', $users);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Payments", "edit", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }
    }

    public function update($id, Request $request)
    {
        try {
          $payment = WalletHistory::find($id);
          $request->validate([
              'user_id' => ['required'],
              'BankName' => ['required'],
              'CurrencyName' => ['required'],
              'Amount' => ['required'],
              'DocumentID' => ['required']
          ]);

          $currency =  Currency::where('symbol',$request['CurrencyName'])->first();
          $user =  User::where('username',$request['user_id'])->first();
          $data = array(
            'user_id' => $user['id'],
            'bank_name' => $request['BankName'],
            'currency_id' => $currency['id'],
            'amount' => $request['Amount'],
            'generated_document_id' => $request['DocumentID']
          );
          $payment->update($data);
          $history = WalletHistory::all();
          return view('/frontend/admin/payments/index')
              ->with('history', $history);
        } catch (\Exception $exception) {
            saveException(sqlDateTime(), 'Admin-Payments', 'update', $exception->getMessage(), $request->ip(), Auth::id());
            return view('/frontend/admin/admin/index');
        }
    }
}
