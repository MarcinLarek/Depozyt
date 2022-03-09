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
                  return redirect()->route('admin.siteerror');
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
            return redirect()->route('admin.siteerror');
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
                  return redirect()->route('admin.siteerror');
              }
    }

    public function update($id, Request $request)
    {
      $currency = Currency::find($id);

      if ($currency['name'] == $request['name'] && $currency['symbol'] == $request['symbol'])
      {
        $this->validate($request, [
            'name' => ['required'],
            'symbol' => ['required']
        ]);
      }
      elseif ($currency['name'] == $request['name'])
      {
        $this->validate($request, [
            'name' => ['required'],
            'symbol' => ['required', 'unique:currencies']
        ]);
      }
      elseif ($currency['symbol'] == $request['symbol'])
      {
        $this->validate($request, [
        'name' => ['required', 'unique:currencies'],
        'symbol' => ['required']
        ]);
      }
      else
      {
        $this->validate($request, [
            'name' => ['required', 'unique:currencies'],
            'symbol' => ['required', 'unique:currencies']
        ]);
      }
        try {
          $data = array(
            'name' => $request['name'],
            'symbol' => $request['symbol'],
           );
          $currency->update($data);
          $currencies = Currency::all();
          $succesalert = 1;
          return view('/frontend/admin/currencies/index')
              ->with('currencies', $currencies)
              ->with('succesalert', $succesalert);
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), 'CurrenciesController', 'store', $exception->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }

}
