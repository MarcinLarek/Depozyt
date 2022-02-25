<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewErrorMail;
use Illuminate\Support\Facades\DB;

class CurrenciesController extends Controller
{
    public function index()
    {
      try {
        $currencies = Currency::all();
        return view('/frontend/admin/currencies/index')
            ->with('currencies', $currencies);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Currencies", "index", $ex->getMessage(), $request->ip(), Auth::id());
                  $admins = DB::table('admins')->get();
                  foreach ($admins as $admin) {
                    if ($admin->error_notification==1) {
                      Mail::to($admin->email)->send(new NewErrorMail());
                    }
                  }
      	    return view('/frontend/admin/admin/index');
              }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'symbol' => ['required']
        ]);
        try {
            $currency = array('name' => $request['name'],
            'symbol' => $request['symbol'],
            'active' => '1'
            );
            Currency::create($currency);
            return redirect()->route('admin.currencies');
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), 'CurrenciesController', 'store', $exception->getMessage(), $request->ip(), Auth::id());
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
        $currency = Currency::find($id);
        return view('/frontend/admin/currencies/edit')
            ->with('currency', $currency);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Currencies", "PLACEHOLDER", $ex->getMessage(), $request->ip(), Auth::id());
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
        try {
          $currency = Currency::find($id);
          return redirect()->route('admin.currencies');
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), 'CurrenciesController', 'store', $exception->getMessage(), $request->ip(), Auth::id());
            $admins = DB::table('admins')->get();
            foreach ($admins as $admin) {
              if ($admin->error_notification==1) {
                Mail::to($admin->email)->send(new NewErrorMail());
              }
            }
            return view('/frontend/admin/admin/index');
        }
    }

}
