<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlatformBankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewErrorMail;
use Illuminate\Support\Facades\DB;

class PlatformBankAccountController extends Controller
{
    public function index()
    {
      try {
        $bankAccounts = PlatformBankAccount::all();
        return view('/frontend/admin/platform-bank-account/index')
            ->with('bankAccounts', $bankAccounts);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-PlatformBankAccount", "index", $ex->getMessage(), $request->ip(), Auth::id());
                  $admins = DB::table('admins')->get();
                  foreach ($admins as $admin) {
                    Mail::to($admin->email)->send(new NewErrorMail());
                  }
      	    return view('/frontend/admin/admin/index');
              }

    }

    public function store(Request $request)
    {
        try {
            PlatformBankAccount::create($request->all());
            return redirect()->route('admin.platform-bank-account');
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), "Admin\PlatformBankAccount", "store()", $exception->getMessage(), $request->ip(), Auth::id());
            $admins = DB::table('admins')->get();
            foreach ($admins as $admin) {
              Mail::to($admin->email)->send(new NewErrorMail());
            }
            return view('/frontend/admin/admin/index');
        }
    }

    public function edit($id)
    {
      try {
        $bankAccount = PlatformBankAccount::find($id);
        return view('/frontend/admin/platform-bank-account/edit')
            ->with('bankAccount', $bankAccount);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-PlatformBankAccount", "edit", $ex->getMessage(), $request->ip(), Auth::id());
                  $admins = DB::table('admins')->get();
                  foreach ($admins as $admin) {
                    Mail::to($admin->email)->send(new NewErrorMail());
                  }
      	    return view('/frontend/admin/admin/index');
              }
    }

    public function update($id, Request $request)
    {
        try {
            $bankAccount = PlatformBankAccount::find($id);
            $bankAccount->update($request->all());
            return redirect()->back();
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), "Admin-PlatformBankAccount", "update()", $exception->getMessage(), $request->ip(), Auth::id());
            $admins = DB::table('admins')->get();
            foreach ($admins as $admin) {
              Mail::to($admin->email)->send(new NewErrorMail());
            }
            return view('/frontend/admin/admin/index');
        }
    }
}
