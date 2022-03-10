<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WalletHistory;
use App\Models\Currency;
use App\Models\ClientBankAccount;
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
            return redirect()->route('admin.siteerror');
        }
    }

    public function create()
    {
        $users = User::all();
        $currencies = Currency::all();
        $banks = ClientBankAccount::all();
        return view('/frontend/admin/payments/create')
             ->with('users', $users)
             ->with('banks', $banks)
             ->with('currencies', $currencies);
    }

    public function withdrawal()
    {
        try {
            $history = WalletHistory::all();
            return view('/frontend/admin/payments/withdrawal')
            ->with('history', $history);
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-Payments", "withdrawal", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }

    public function edit($id)
    {
        try {
            $payment = WalletHistory::find($id);
            $currencies = Currency::all();
            $banks = ClientBankAccount::all();
            $users = User::all();
            return view('/frontend/admin/payments/edit')
            ->with('payment', $payment)
            ->with('currencies', $currencies)
            ->with('banks', $banks)
            ->with('users', $users);
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-Payments", "edit", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }

    public function update($id, Request $request)
    {
        $request->validate([
          'user_id' => ['required'],
          'BankName' => ['required'],
          'CurrencyName' => ['required'],
          'Amount' => ['required','numeric'],
          'DocumentID' => ['required','numeric']
      ]);
        try {
            $payment = WalletHistory::find($id);
            $currency =  Currency::where('symbol', $request['CurrencyName'])->first();
            $user =  User::where('username', $request['user_id'])->first();
            $data = array(
            'user_id' => $user['id'],
            'bank_name' => $request['BankName'],
            'currency_id' => $currency['id'],
            'amount' => $request['Amount'],
            'generated_document_id' => $request['DocumentID']
          );
            $payment->update($data);
            if ($request['amount']>0) {
                return redirect()->route('admin.payments')->with('successalert', 'successalert');
            } else {
                return redirect()->route('admin.withdrawal')->with('successalert', 'successalert');
            }
        } catch (\Exception $exception) {
            saveException(sqlDateTime(), 'Admin-Payments', 'update', $exception->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
          'user_id' => ['required','numeric'],
          'bank_name' => ['required'],
          'currency_id' => ['required'],
          'amount' => ['required','numeric'],
          'document_id' => ['required','numeric']
      ]);

        try {
            $data = array(
            'user_id' => $request['user_id'],
            'bank_name' => $request['bank_name'],
            'currency_id' => $request['currency_id'],
            'amount' => $request['amount'],
            'generated_document_id' => $request['document_id']
          );
            WalletHistory::create($data);
            if ($request['amount']>0) {
                return redirect()->route('admin.payments')->with('successalert', 'successalert');
            } else {
                return redirect()->route('admin.withdrawal')->with('successalert', 'successalert');
            }
        } catch (\Exception $e) {
            saveException(sqlDateTime(), 'Admin-Payments', 'store', $exception->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }
}
