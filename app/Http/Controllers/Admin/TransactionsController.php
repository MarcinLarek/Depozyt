<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    public function index()
    {
      try {
        $transactions = Transaction::all();
        return view('/frontend/admin/transactions/index')
            ->with('transactions', $transactions);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Transaction", "index", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }
    }

    public function edit($id)
    {
      try {
        $transaction = Transaction::find($id);
        $currencies = DB::table('currencies')->get();
        $banks = DB::table('client_bank_accounts')->get();
        $users = User::all();
        return view('/frontend/admin/transactions/edit')
            ->with('transaction', $transaction)
            ->with('currencies', $currencies)
            ->with('banks', $banks)
            ->with('users', $users);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Transaction", "edit", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }
    }

    public function update($id, Request $request)
    {
      $request->validate([
          'customer_id' => ['required'],
          'contractor_id' => ['required'],
          'Name' => ['required'],
          'TransactionType' => ['required'],
          'FromDate' => ['required'],
          'ToDate' => ['required'],
          'CommissionPayer' => ['required'],
          'BankName' => ['required'],
          'CurrencyName' => ['required'],
          'Payment' => ['required'],
          'Amount' => ['required']
      ]);
        try {
          $success = 1;
          $transaction = Transaction::find($id);
          $currency =  Currency::where('symbol',$request['CurrencyName'])->first();
          $customer =  User::where('username',$request['customer_id'])->first();
          $contractor =  User::where('username',$request['contractor_id'])->first();

          $data = array(
            'customer_id' => $customer['id'],
            'contractor_id' => $contractor['id'],
            'bank_name' => $request['BankName'],
            'currency_id' => $currency['id'],
            'name' => $request['Name'],
            'commission_payer' => $request['CommissionPayer'],
            'from_date' => $request['FromDate'],
            'to_date' => $request['ToDate'],
            'amount' => $request['Amount'],
            'payment' => $request['Payment']
          );
          $transaction->update($data);
          $transactions = Transaction::all();
          return view('/frontend/admin/transactions/index')
              ->with('transactions', $transactions);
        } catch (\Exception $exception) {
            saveException(sqlDateTime(), 'Admin-Transaction', 'update', $exception->getMessage(), $request->ip(), Auth::id());
            return view('/frontend/admin/admin/index');
        }
    }
}
