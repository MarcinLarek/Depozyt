<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlatformBankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlatformBankAccountController extends Controller
{
    public function index()
    {
        try {
            $bankAccounts = PlatformBankAccount::all();
            return view('/frontend/admin/platform-bank-account/index')
            ->with('bankAccounts', $bankAccounts);
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-PlatformBankAccount", "index", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
          'account_number' => ['required','iban'],
          'bank_name' => ['required','max:100'],
          'currency_id' => ['required','numeric','max:100'],
          'active' => ['required','numeric','max:100'],
      ]);
        $data = array(
        'account_number' => $request['account_number'],
        'bank_name' => $request['bank_name'],
        'currency_id' => $request['currency_id'],
        'active' => $request['active'],
      );
        try {
            PlatformBankAccount::create($data);
            return redirect()->route('admin.platform-bank-account')->with('successalert', 'successalert');
        } catch (\Exception $exception) {
            saveException(sqlDateTime(), "Admin\PlatformBankAccount", "store()", $exception->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }

    public function edit($id)
    {
        try {
            $bankAccount = PlatformBankAccount::find($id);
            return view('/frontend/admin/platform-bank-account/edit')
            ->with('bankAccount', $bankAccount);
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-PlatformBankAccount", "edit", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }

    public function update($id, Request $request)
    {
        $request->validate([
          'account_number' => ['required','iban'],
          'bank_name' => ['required','max:100'],
          'currency_id' => ['required','numeric','max:100'],
          'active' => ['required','numeric','max:100'],
      ]);
        $bankAccount = PlatformBankAccount::find($id);
        $data = array(
        'account_number' => $request['account_number'],
        'bank_name' => $request['bank_name'],
        'currency_id' => $request['currency_id'],
        'active' => $request['active'],
      );
        //dd($bankAccount);
        $bankAccount->update($data);
        return redirect()->route('admin.platform-bank-account')->with('successalert', 'successalert');
        try {
        } catch (\Exception $exception) {
            saveException(sqlDateTime(), "Admin-PlatformBankAccount", "update()", $exception->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }
}
