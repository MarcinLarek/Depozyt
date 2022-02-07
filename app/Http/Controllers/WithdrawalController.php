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
      	    return view("/frontend/home/index");
              }
    }

    public function create()
    {
//        return $result;
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
        }
    }

//
//    int clientId = JsonConvert . DeserializeObject < LoginModel>(HttpContext . Session . GetString("ClientType")) . Id;
//
//            List<Withdrawal > withdrawalList = null;
//            //Pobieramy listę numerów id z tabeli wypłat.
//            withdrawalList = (from t in kaucjaDbContext . Withdrawal
//                              where t . ClientId == clientId
//                              select new Withdrawal()
//                              {
//                                  Id = t . Id,
//                                  Name = t . Name,
//                                  Amount = t . Amount,
//                                  ClientId = t . ClientId,
//                                  ConfirmDate = t . ConfirmDate,
//                              }).AsNoTracking() . ToList();

//        return PartialView("Withdrawal/GetHistory", withdrawalList);



    public function GeneratePdf()
    {

    }
}
