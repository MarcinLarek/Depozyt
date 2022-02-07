<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientBankAccounts\StoreRequest;
use App\Models\ClientBankAccount;
use App\Services\ClientBankAccountsService;
use App\Services\CurrenciesService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientBankAccountController extends Controller
{
    private $currenciesService;
    private $clientBankAccountsService;

    public function __construct(CurrenciesService $currenciesService, ClientBankAccountsService $clientBankAccountsService)
    {
        $this->currenciesService = $currenciesService;
        $this->clientBankAccountsService = $clientBankAccountsService;
    }

    public function index()
    {
      try {
        $bankAccounts = Auth::user()->bankAccounts;
        return View("/frontend/client-bank-account/index")
            ->with('bankAccounts', $bankAccounts);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "ClientBankAccount", "index", $ex->getMessage(), $request->ip(), Auth::id());
                  return view("/frontend/home/index");
              }
    }

    public function create()
    {
      try {
        $currencies = $this->currenciesService->getActive();
        return view("/frontend/client-bank-account/create")
            ->with('currencies', $currencies);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "ClientBankAccount", "create", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }

    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        try {
                $user = Auth::user();
                $data['country_id'] = $user->country->getId();
                $user->bankAccounts()->create($data);
                return redirect()->route('bank-accounts')->withSuccess('Konto bankowe zostało dodane');
            } catch (\Exception $ex) {
            saveException(sqlDateTime(), "ClientBankAccount", "store", $ex->getMessage(), $request->ip(), Auth::id());
            return view("/frontend/home/index");
        }
    }

    public function edit(int $id, Request $request)
    {
        try {
          $bankAccount =  ClientBankAccount::where('id',$id)->first();
          return view("/frontend/client-bank-account/edit")
              ->with('bankAccount', $bankAccount);
        } catch (\Exception $ex) {
          saveException(sqlDateTime(), "ClientBankAccount", "edit", $ex->getMessage(), $request->ip(), Auth::id());
          return view("/frontend/home/index");
        }

    }

    public function update(Request $request)
    {
      try {
        $request->validate([
            'bank_name' => ['required','max:100'],
            'currency_id' => ['required'],
            'country_id' => ['required'],
            'account_number' => ['required','max:100'],
            'swift' => ['required','max:100'],
            'active' => ['required'],
            'id' => ['required'],
        ]);

        ClientBankAccount::where('id',$request['id'])->update([
          'bank_name' => $request['bank_name'],
          'currency_id' => $request['currency_id'],
          'country_id' => $request['country_id'],
          'account_number' => $request['account_number'],
          'swift' => $request['swift'],
          'active' => $request['active']
        ]);
        $bankAccounts = Auth::user()->bankAccounts;
        return View("/frontend/client-bank-account/index")
            ->with('bankAccounts', $bankAccounts);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "ClientBankAccount", "update", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }
    }

    // GET: ClientBankAccount/GetBank


//        public function GetBank()
//        {
//            //Zmienna klasy List.
//            List<Bank> list = null;
//
//            try
//            {
//                //Tworzymy obiekt klasy KaucjaDbContext.
//
//
//                //Wyszukujemy nazwy banków dostępne na platformie.
//                list = (from b in kaucjaDbContext.Bank
//                        where b.Active == true
//                        orderby b.Name ascending
//                        select new Bank()
//                        {
//                            Id = b.Id,
//                            Name = b.Name
//                        }).AsNoTracking().ToList();
//
//                //Jeżeli lista banków jest równa zero.
//                if (list.Count == 0)
//                {
//                    //Przypisujemy wartość null.
//                    list = null;
//                }
//            }
//            catch (\Exception $ex)
//            {
//                //Przypisujemy wartość null.
//                list = null;
//
//                //Zapisujemy wyjątek.
//                LogHelper.SaveException(DateTime.Now, "ClientBankAccount", "GetBank()", ex.Message);
//            }
//
//            //Zwracamy dane.
//            return Json(list);
//        }

//        public function GetCurrency()
//        {
//            //Zmienna klasy List.
//            List<Currency> list = null;
//
//            try
//            {
//                //Tworzymy obiekt klasy KaucjaDbContext.
//
//
//                //Wyszukujemy nazwy walut dostępne na platformie.
//                list = (from c in kaucjaDbContext.Currency
//                        where c.Active == true
//                        orderby c.Symbol ascending
//                        select new Currency()
//                        {
//                            Id = c.Id,
//                            Name = c.Name,
//                            Symbol = c.Symbol
//                        }).AsNoTracking().ToList();
//
//                //Jeżeli lista walut jest równa zero.
//                if (list.Count == 0)
//                {
//                    //Przypisujemy wartość null.
//                    list = null;
//                }
//            }
//            catch (\Exception $ex)
//            {
//                //Przypisujemy wartość null.
//                list = null;
//
//                //Zapisujemy wyjątek.
//                LogHelper.SaveException(DateTime.Now, "ClientBankAccount", "GetCurrency()", ex.Message);
//            }
//
//            //Zwracamy dane.
//            return Json(list);
//        }

//        public function CheckName(ClientBankAccount clientBankAccount)
//        {
//            //Zmienna przyjmująca wartość true lub false w zależności od tego czy nazwa konta bankowego występuje w bazie danych czy nie.
//            bool isExist = false;
//
//            try
//            {
//                //Tworzymy obiekt klasy KaucjaDbContext.
//
//
//                //Wyszukujemy z tabeli kont bankowych klientów czy występuje już podana nazwa.
//                string name = kaucjaDbContext.ClientBankAccount.Where(cba => cba.Name == clientBankAccount.Name).Select(cba => cba.Name).FirstOrDefault();
//
//                //Jeżeli zmienna name jest pusta.
//                if (string.IsNullOrEmpty(name))
//                {
//                    //Przypisujemy zmiennej wartość false.
//                    isExist = true;
//                }
//                else
//                {
//                    //Sprawdzamy odnalezione nazwy kont bankowych zgadzają się pod względem wielkości liter.
//                    if (string.Equals(name, clientBankAccount.Name, StringComparison.Ordinal))
//                    {
//                        //Przypisujemy zmiennej wartość true, jeśli wielkość liter się zgadza.
//                        isExist = false;
//                    }
//                    else
//                    {
//                        //Przypisujemy zmiennej wartość false,  jeśli wielkość liter nie zgadza się.
//                        isExist = true;
//                    }
//                }
//            }
//            catch (\Exception $ex)
//            {
//                //Zapisujemy wyjątek.
//                LogHelper.SaveException(DateTime.Now, "ClientBankAccount", "CheckName()", ex.Message);
//            }
//
//            //Zwracamy rezultat.
//            return Json(isExist);
//        }
}
