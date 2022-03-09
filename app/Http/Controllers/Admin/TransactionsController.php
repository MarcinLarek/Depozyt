<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewErrorMail;
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
        foreach ($transactions as $transaction) {
          $transaction['from_date'] = Carbon::parse($transaction['from_date'])->format('d/m/Y');
          $transaction['to_date'] = Carbon::parse($transaction['to_date'])->format('d/m/Y');
        }
        $succesaalert = 0;
        return view('/frontend/admin/transactions/index')
            ->with('succesaalert', $succesaalert)
            ->with('transactions', $transactions);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Transaction", "index", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('admin.siteerror');
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
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Transaction", "edit", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('admin.siteerror');
              }
    }

    public function update($id, Request $request)
    {
      $request->validate([
          'customer_id' => ['required'],
          'contractor_id' => ['required'],
          'name' => ['required'],
          'transaction_type' => ['required'],
          'from_date' => ['required'],
          'to_date' => ['required'],
          'commission_payer' => ['required'],
          'bank_name' => ['required'],
          'currency_name' => ['required'],
          'payment' => ['required'],
          'amount' => ['required']
      ]);
        try {
          $success = 1;
          $transaction = Transaction::find($id);
          $currency =  Currency::where('symbol',$request['currency_name'])->first();
          $customer =  User::where('username',$request['customer_id'])->first();
          $contractor =  User::where('username',$request['contractor_id'])->first();

          $data = array(
            'customer_id' => $customer['id'],
            'contractor_id' => $contractor['id'],
            'bank_name' => $request['bank_name'],
            'currency_id' => $currency['id'],
            'name' => $request['name'],
            'commission_payer' => $request['commission_payer'],
            'from_date' => $request['from_date'],
            'to_date' => $request['to_date'],
            'amount' => $request['amount'],
            'payment' => $request['payment']
          );
          $transaction->update($data);
          $transactions = Transaction::all();
          foreach ($transactions as $transaction) {
            $transaction['from_date'] = Carbon::parse($transaction['from_date'])->format('d/m/Y');
            $transaction['to_date'] = Carbon::parse($transaction['to_date'])->format('d/m/Y');
          }
          $succesaalert = 1;
          return view('/frontend/admin/transactions/index')
              ->with('succesaalert', $succesaalert)
              ->with('transactions', $transactions);
        } catch (\Exception $exception) {
            saveException(sqlDateTime(), 'Admin-Transaction', 'update', $exception->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }
}
