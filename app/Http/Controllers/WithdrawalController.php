<?php

namespace App\Http\Controllers;
use App\Models\PlatformData;
use App\Models\WalletHistory;
use App\Models\Wallet;
use App\Services\PlatformBankAccountsService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewErrorMail;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    public function index()
    {
      try {
        $currencies = DB::table('currencies')->get();
        $succesaalert = 0;
          return View("/frontend/withdrawal/index")
          ->with('currencies', $currencies)
          ->with('succesaalert', $succesaalert);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Withdrawal", "index", $ex->getMessage(), $request->ip(), Auth::id());
                  $admins = DB::table('admins')->get();
                  foreach ($admins as $admin) {
                    if ($admin->error_notification==1) {
                      Mail::to($admin->email)->send(new NewErrorMail());
                    }
                  }
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
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

        $wallethistorydata = array(
          'user_id' => $user['id'],
          'bank_name' => $request['bank_name'],
          'currency_id' => $request['currency_id'],
          'amount' => -$request['amount']
        );
        $walletupdate = $wallet['amount'] - $request['amount'];

        if ($walletupdate >= 0) {
          WalletHistory::create($wallethistorydata);
          $wallet->update(['amount' => $walletupdate ]);
        }

        $currencies = DB::table('currencies')->get();
        $succesaalert = 1;
          return View("/frontend/withdrawal/index")
          ->with('currencies', $currencies)
          ->with('succesaalert', $succesaalert);
      }
      catch (\Exception $e) {
        saveException(sqlDateTime(), "Withdrawal", "store", $exception->getMessage(), $request->ip(), Auth::id());
        $admins = DB::table('admins')->get();
        foreach ($admins as $admin) {
          if ($admin->error_notification==1) {
            Mail::to($admin->email)->send(new NewErrorMail());
          }
        }
        $error = 1;
        return view("/frontend/home/index", compact('error'));
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
            $admins = DB::table('admins')->get();
            foreach ($admins as $admin) {
              if ($admin->error_notification==1) {
                Mail::to($admin->email)->send(new NewErrorMail());
              }
            }
            $error = 1;
            return view("/frontend/home/index", compact('error'));
        }
    }

}
