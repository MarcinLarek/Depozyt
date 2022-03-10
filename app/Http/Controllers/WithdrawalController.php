<?php

namespace App\Http\Controllers;
use App\Models\PlatformData;
use App\Models\WalletHistory;
use App\Models\Wallet;
use App\Models\Currency;
use App\Services\PlatformBankAccountsService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;


class WithdrawalController extends Controller
{
    public function index()
    {
      try {
        $currencies = Currency::all();
        $succesaalert = 0;
          return View("/frontend/withdrawal/index")
          ->with('currencies', $currencies)
          ->with('succesaalert', $succesaalert);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Withdrawal", "index", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('siteerror');
              }
    }

    public function store(Request $request)
    {
      $request->validate([
          'bank_name' => ['required','max:100'],
          'currency_id' => ['required'],
          'amount' => ['required','numeric'],
      ]);
      try {
        $user = Auth::user();
        $wallet = Wallet::where('currency_id',$request['currency_id'])
        ->where('user_id',$user['id'])
        ->first();

        $walletupdate = $wallet['amount'] - $request['amount'];
        if ($wallet != null && $walletupdate >= 0) {
            $wallethistorydata = array(
              'user_id' => $user['id'],
              'bank_name' => $request['bank_name'],
              'currency_id' => $request['currency_id'],
              'amount' => -$request['amount']
            );

            WalletHistory::create($wallethistorydata);
            $wallet->update(['amount' => $walletupdate ]);
            return redirect()->route('withdrawal')->with('successalert','successalert');
          }
        else {
            return redirect()->route('withdrawal')->with('nomoney','nomoney');
          }
      }
      catch (\Exception $e) {
        saveException(sqlDateTime(), "Withdrawal", "store", $exception->getMessage(), $request->ip(), Auth::id());
        return redirect()->route('siteerror');
      }

    }

    public function getHistory(Request $request)
    {
        try {
            $walletHistory = Auth::user()->walletHistory()->get();
            return view("/frontend/withdrawal/get-history", [
                'walletHistory' => $walletHistory
            ]);
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), "Withdrawal", "getHistory", $exception->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('siteerror');
        }
    }

}
