<?php

namespace App\Http\Controllers;
use App\Models\PlatformData;
use App\Models\WalletHistory;
use App\Services\PlatformBankAccountsService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    public function index()
    {
      try {
        $currencies = DB::table('currencies')->get();
          return View("/frontend/withdrawal/index", compact('currencies'));
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Withdrawal", "index", $ex->getMessage(), $request->ip(), Auth::id());
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
        } catch (\Exception $exception) {
            saveException(sqlDateTime(), "Withdrawal", "getHistory", $exception->getMessage(), $request->ip(), Auth::id());
            $error = 1;
            return view("/frontend/home/index", compact('error'));
        }
    }

    public function GeneratePdf()
    {

    }
}
