<?php

namespace App\Http\Controllers;

use App\Http\Requests\Recipients\StoreRequest;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipientController extends Controller
{
//    public function ValidateBankAccount(Recipient recipient)
//    {
//        string bankAccount = $"{recipient.Country} {recipient.AccountNumber}";
//            bankAccount = bankAccount . ToUpper(); //IN ORDER TO COPE WITH THE REGEX BELOW
//            if (String . IsNullOrEmpty(bankAccount))
//                return Json(false);
//            else if (System . Text . RegularExpressions . Regex . IsMatch(bankAccount, "^[A-Z0-9]")) {
//                bankAccount = bankAccount . Replace(" ", String . Empty);
//                string bank = bankAccount . Substring(4, bankAccount . Length - 4) + bankAccount . Substring(0, 4);
//                int asciiShift = 55;
//                StringBuilder sb = new StringBuilder();
//                foreach (char c in bank)
//                {
//                    int v;
//                    if (Char . IsLetter(c)) v = c - asciiShift;
//                    else v = int . Parse(c . ToString());
//                    sb . Append(v);
//                }
//                string checkSumString = sb . ToString();
//                int checksum = int . Parse(checkSumString . Substring(0, 1));
//                for (int i = 1; i < checkSumString . Length; i++)
//                {
//                    int v = int . Parse(checkSumString . Substring(i, 1));
//                    checksum *= 10;
//                    checksum += v;
//                    checksum %= 97;
//                }
//                return Json(checksum == 1);
//            } else
//                return Json(false);
//        }

    public function index()
    {
      try {
        $recipients = Auth::user()->recipients()->get();
        return View("/frontend/recipients/index")
            ->with('recipients', $recipients);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Recipient", "idit", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }
    }

    public function create()
    {
        return view("/frontend/recipients/create");
    }

    public function edit($id)
    {
      try {
        $recipient = Auth::user()->recipients()->find($id);
        return view("/frontend/recipients/edit")
            ->with('recipient', $recipient);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Recipient", "edit", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }
    }

    public function update($recipientId, Request $request)
    {
        try {
            $recipient = Auth::user()->recipients()->find($recipientId);
            $recipient->update($request->all());
            $recipients = Auth::user()->recipients()->get();
            return View("/frontend/recipients/index")
                ->with('recipients', $recipients);
        } catch (\Exception $exception) {
            saveException(sqlDateTime(), "Recipient", "update", $exception->getMessage(), $request->ip(), Auth::id());
        }
    }



    public function payment()
    {
      try {
        $recipients = Auth::user()->recipients()->get();
        $wallets = Auth::user()->wallet()->get();
        $walleterror = 0;
        if ($wallets->count()) {
            return view("/frontend/recipients/payment")
                ->with('recipients', $recipients)
                ->with('walleterror', $walleterror)
                ->with('wallets', $wallets);
        } else {
            return view('/frontend/recipients/_empty-wallet');
        }
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Recipient", "payment", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }
    }


    public function getHistory(Request $request)
    {
        try {
          $walletHistory = Auth::user()->walletHistory()->get();
          return view("/frontend/recipients/get-history", [
              'walletHistory' => $walletHistory
          ]);
        } catch (\Exception $exception) {
            saveException(sqlDateTime(), "PaymentController", "getHistory", $exception->getMessage(), $request->ip(), Auth::id());
        }
    }

//    public function GetRecipients()
//    {
//        //Zmienna klasy List.
//        List<RecipientModel > list = null;
//
//            try {
//                //Tworzymy obiekt klasy KaucjaDbContext.
//
//
//                //Pobieramy identyfikator zalogowanego klienta.
//                int clientId = JsonConvert . DeserializeObject < LoginModel>(HttpContext . Session . GetString("ClientType")) . Id;
//
//                //Wyszukujemy unikatowe nazwy banków klienta.
//                list = (from r in kaucjaDbContext . Recipient
//                        where r . Active == true && r . ClientId == clientId
//                        select new RecipientModel()
//                        {
//                            Name = r . Name
//                        }).AsNoTracking() . Distinct() . OrderBy(r => r . Name).ToList();
//
//                //Jeżeli lista banków jest równa zero.
//                if (list.Count == 0)
//                {
//                    //Przypisujemy wartość null.
//                    list = null;
//                }
//            } catch (\Exception $ex) {
//                //Przypisujemy wartość null.
//                list = null;
//
//                //Zapisujemy wyjątek.
//                LogHelper . SaveException(DateTime . Now, "Recipient", "GetRecipients()", ex . Message);
//            }
//
//            //Zwracamy dane.
//            return Json(list);
//        }

//    public function GetDataRecipient([Bind("Name")] RecipientPayment recipient)
//        {
//            //Zmienna przyjmująca nazwę widoku.
//            string view = string.Empty;
//
//            Recipient eRecipient = null;
//
//            try
//            {
//                //Tworzymy obiekt klasy KaucjaDbContext.
//
//
//                //Pobieramy identyfikator zalogowanego klienta.
//                int clientId = JsonConvert.DeserializeObject<LoginModel>(HttpContext.Session.GetString("ClientType")).Id;
//
//                eRecipient = kaucjaDbContext.Recipient.Where(r => r.Name == recipient.Name && r.ClientId == clientId).FirstOrDefault();
//
//                recipient.AccountNumber = $"{eRecipient.Country} {eRecipient.AccountNumber}";
//                recipient.Active = eRecipient.Active;
//                recipient.City = eRecipient.City;
//                recipient.ClientId = eRecipient.ClientId;
//                recipient.Country = eRecipient.Country;
//                recipient.Email = eRecipient.Email;
//                recipient.Id = eRecipient.Id;
//                recipient.ModyficationDate = eRecipient.ModyficationDate;
//                recipient.ModyfiedBy = eRecipient.ModyfiedBy;
//                recipient.Name = eRecipient.Name;
//                recipient.Nip = eRecipient.Nip;
//                recipient.PhoneNumber = eRecipient.PhoneNumber;
//                recipient.PostCode = eRecipient.PostCode;
//                recipient.Street = eRecipient.Street;
//
//                if(eRecipient != null)
//                {
//                    view = "RecipientPartial/_RecipientDataPartial";
//                }
//
//else
//{
//    //Przypisujemy nazwę widoku.
//    view = "RecipientPartial/_NoRecipientDataPartial";
//}
//}
//catch
//(\Exception $ex)
//            {
//                //Zapisujemy wyjątek.
//                LogHelper . SaveException(DateTime . Now, "Recipient", "GetDataRecipient()", ex . Message);
//            }
//
//            return PartialView(view, recipient);
//        }
//
//
//        public function Edit()
//        {
//            //Zmienna przyjmująca wynik operacji.
//            $result = 1;
//
//            try {
//                //Tworzymy obiekt klasy KaucjaDbContext.
//
//
//                //Pobieramy identyfikator zalogowanego klienta.
//                int clientId = JsonConvert . DeserializeObject < LoginModel>(HttpContext . Session . GetString("ClientType")) . Id;
//
//                //Wyszukujemy konto bankowe klienta na podstawie przekazanego identyfikatora.
//                Recipient eRecipient = kaucjaDbContext . Recipient . Where(r => r . Id == recipient . Id && r . ClientId == clientId).FirstOrDefault();
//
//                //Przypisujemy zmodyfikowane dane.
//                eRecipient . Name = recipient . Name;
//                eRecipient . Nip = recipient . Nip;
//                eRecipient . AccountNumber = recipient . AccountNumber;
//                eRecipient . Country = recipient . Country;
//                eRecipient . Email = recipient . Email;
//                eRecipient . PhoneNumber = recipient . PhoneNumber;
//                eRecipient . Street = recipient . Street;
//                eRecipient . PostCode = recipient . PostCode;
//                eRecipient . City = recipient . City;
//                eRecipient . ModyficationDate = DateTime . Now;
//                eRecipient . ModyfiedBy = clientId;
//                eRecipient . Active = recipient . Active;
//
//                //Edytujemy dane konta bankowego klienta.
//                kaucjaDbContext . Entry(eRecipient) . State = EntityState . Modified;
//
//                //Zapisujemy zmiany.
//                result = kaucjaDbContext . SaveChanges();
//            } catch (\Exception $ex) {
//                //Wynik błędu operacji edycji.
//                result = 0;
//
//                //Zapisujemy wyjątek.
//                LogHelper . SaveException(DateTime . Now, "Recipient", "Edit()", ex . Message);
//            }
//
//            //Zwracamy rezultat.
//            return result;
//        }

//        public function CheckCorrectAmount(string CurrencyName, string Amount)
//{
//    //Zmienna przyjmująca wartość true lub false w zależności od tego czy wprowadzona kwota wypłaty jest poprawna czy nie.
//    bool isExist = false;
//
//            try {
//                //Tworzymy obiekt klasy KaucjaDbContext.
//
//
//                //Pobieramy identyfikator zalogowanego klienta.
//                int clientId = JsonConvert . DeserializeObject < LoginModel>(HttpContext . Session . GetString("ClientType")) . Id;
//
//                //Wyszukujemy nazwy walut dostępne w portfelu klienta.
//                decimal availableAmount = kaucjaDbContext . Wallet . Where(w => w . ClientId == clientId && w . CurrencyName == CurrencyName).Sum(w => w . Amount);
//
//                //Jeżeli zmienna availableAmount jest równa 0.
//                if (availableAmount == 0.0M)
//                {
//                    //Przypisujemy zmiennej wartość false.
//                    isExist = false;
//                }
//                else
//                {
//                    //Sprawdzamy czy klient nie chce wypłacić więcej niż może.
//                    if (availableAmount >= decimal . Parse(Amount)) {
//                        //Przypisujemy zmiennej wartość true, jeśli kwoty są poprawne.
//                        isExist = true;
//                    } else {
//                        //Przypisujemy zmiennej wartość false,  jeśli kwoty nie są poprawne.
//                        isExist = false;
//                    }
//                }
//            } catch (\Exception $ex) {
//                //Zapisujemy wyjątek.
//                LogHelper . SaveException(DateTime . Now, "Recipient", "CheckCorrectAmount()", ex . Message);
//            }
//
//            //Zwracamy rezultat.
//            return Json(isExist);
//        }
//
//        public function GetCurrency()
//{
//    List<Wallet > list = null;
//
//            try {
//                //Tworzymy obiekt klasy KaucjaDbContext.
//
//
//                //Pobieramy identyfikator zalogowanego klienta.
//                int clientId = JsonConvert . DeserializeObject < LoginModel>(HttpContext . Session . GetString("ClientType")) . Id;
//
//                list = (from w in kaucjaDbContext . Wallet
//                        where w . ClientId == clientId
//                        select new Wallet()
//                        {
//                            CurrencyName = w . CurrencyName
//                        }).AsNoTracking() . Distinct() . OrderBy(w => w . CurrencyName).ToList();
//
//                if (list.Count == 0)
//                {
//                    //Przypisujemy wartość null.
//                    list = null;
//                }
//            } catch (\Exception $ex) {
//                list = null;
//                saveException(sqlDateTime(), "Recipient", "GetCurrency()", $ex->getMessage());
//            }
//            return Json(list);
//        }

//        public function GetData(int id)
//{
//    //Zmienna klasy ClientBankAccount.
//    Recipient recipient = null;
//
//            try {
//                //Tworzymy obiekt klasy KaucjaDbContext.
//
//
//                //Pobieramy identyfikator zalogowanego klienta.
//                int clientId = JsonConvert . DeserializeObject < LoginModel>(HttpContext . Session . GetString("ClientType")) . Id;
//
//                //Wyszukujemy konto bankowe klienta na podstawie przekazanego numeru identyfikacyjnego.
//                recipient = kaucjaDbContext . Recipient . Where(r => r . Id == id && r . ClientId == clientId).FirstOrDefault();
//            } catch (\Exception $ex) {
//                //Zapisujemy wyjątek.
//                LogHelper . SaveException(DateTime . Now, "Recipient", "GetData()", ex . Message);
//            }
//
//            //Zwracamy dane.
//            return Json(recipient);
//        }

    public function store(StoreRequest $request)
    {
      $data = $request->validated();
        try {
            $user = Auth::user();
            $data['country_id'] = $user->country->getId();
            $user->recipients()->create($data);
            return redirect()->route('recipients');
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Recipient", "Create()", $ex->getMessage(), $request->ip(), Auth::id());
            return view("/frontend/home/index");
        }

    }

//        public function CreatePayment([Bind("Id,PaymentTitle,CurrencyName,Amount")] RecipientPayment recipientPayment)
//        {
//            //Zmienna przyjmująca wynik operacji.
//            $result = 1;
//
//            if (ModelState . IsValid) {
//                try {
//                    //Tworzymy obiekt klasy KaucjaDbContext.
//
//
//                    int clientId = JsonConvert . DeserializeObject < LoginModel>(HttpContext . Session . GetString("ClientType")) . Id;
//
//                    var recipient = kaucjaDbContext . Recipient . Where(r => r . Id == recipientPayment . Id && r . ClientId == clientId).FirstOrDefault();
//
//                    var recipientPaymentModel = new RecipientPaymentModel
//                    {
//                    Id = SearchFirstFreeIdRecipientPayment(),
//                        RecipientId = recipient . Id,
//                        ClientId = clientId,
//                        Country = recipient . Country,
//                        AccountNumber = recipient . AccountNumber,
//                        PaymentTitle = recipientPayment . PaymentTitle,
//                        CurrencyName = recipientPayment . CurrencyName,
//                        Amount = recipientPayment . Amount,
//                        Token = ConfirmCodeHelper . GenerateConfirmCode(),
//                        ModyficationDate = DateTime . Now,
//                        ModyfiedBy = clientId
//                    };
//
//                    kaucjaDbContext . Entry(recipientPaymentModel) . State = EntityState . Added;
//
//                    result = kaucjaDbContext . SaveChanges();
//
//                    if (result == 1) {
//                        //Zmienna przyjmująca adres url do potwierdzenia wypłaty na platformie.
//                        string url = "https://www.depozyt.com/AcceptRecipientPayment/Main/?confirmCode=" + recipientPaymentModel . Token;
//
//                        //Wysyłamy maila.
//                        MailHelper . SendAcceptRecipientPaymentMail(recipientPaymentModel, recipientPayment . Id, url);
//                    }
//                } catch (\Exception $ex) {
//                    //Wynik błędu operacji edycji.
//                    result = 0;
//
//                    //Zapisujemy wyjątek.
//                    LogHelper . SaveException(DateTime . Now, "Recipient", "CreatePayment()", ex . Message);
//                }
//            }
//            return result;
//        }

//        public function GetList()
//{
//    //Zmienna przyjmująca nazwę widoku.
//    string view = string . Empty;
//
//            //Zmienna klasy List.
//            List<RecipientModel > list = null;
//
//            try {
//                //Tworzymy obiekt klasy KaucjaDbContext.
//
//
//                //Zmienna przyjmująca liczbę porządkową.
//                int lp = 1;
//
//                //Pobieramy identyfikator zalogowanego klienta.
//                int clientId = JsonConvert . DeserializeObject < LoginModel>(HttpContext . Session . GetString("ClientType")) . Id;
//
//                //Wyszukujemy odbiorców na podstawie przekazanego numeru identyfikacyjnego.
//                list = (from r in kaucjaDbContext . Recipient
//                        where r . ClientId == clientId
//                        orderby r . Name ascending
//                        select new RecipientModel()
//                        {
//                            Id = r . Id,
//                            Name = r . Name,
//                            Country = r . Country,
//                            AccountNumber = $"{r.Country} {r.AccountNumber}",
//                            City = r . City,
//                            Street = r . Street,
//                            PostCode = r . PostCode,
//                            Active = r . Active
//                        }).AsNoTracking() . ToList();
//
//                //Jeżeli lista kont bankowych jest większa niż zero.
//                if (list.Count > 0)
//                {
//                    //Przypisujemy nazwę widoku.
//                    view = "RecipientPartial/_RecipientsPartial";
//
//                    //W petli przypisujemy numer porządkowy.
//                    for (int x = 0; x < list.Count; x++)
//                    {
//                        list[x] . Lp = lp;
//
//                        //Zwiekszamy numer porządkowy.
//                        lp++;
//                    }
//                }
//                else
//                {
//                    //Przypisujemy nazwę widoku.
//                    view = "RecipientPartial/_NoRecipientsPartial";
//
//                    //Przypisujemy wartość null.
//                    list = null;
//                }
//            } catch (\Exception $ex) {
//                //Przypisujemy wartość null.
//                list = null;
//
//                //Zapisujemy wyjątek.
//                LogHelper . SaveException(DateTime . Now, "Recipient", "GetList()", ex . Message);
//            }
//
//            //Zwracamy dane.
//            return PartialView(view, list);
//        }

//        public function CheckName(Recipient recipient)
//{
//    //Zmienna przyjmująca wartość true lub false w zależności od tego czy nazwa odbiorcy występuje w bazie danych czy nie.
//    bool isExist = false;
//
//            try {
//                //Tworzymy obiekt klasy KaucjaDbContext.
//
//
//                //Pobieramy identyfikator zalogowanego klienta.
//                int clientId = JsonConvert . DeserializeObject < LoginModel>(HttpContext . Session . GetString("ClientType")) . Id;
//
//                //Wyszukujemy z tabeli odbiorców czy występuje już podana nazwa.
//                string name = kaucjaDbContext . Recipient . Where(r => r . Name == recipient . Name && r . ClientId == clientId).Select(r => r . Name).FirstOrDefault();
//
//                //Jeżeli zmienna name jest pusta.
//                if (string . IsNullOrEmpty(name)) {
//                    //Przypisujemy zmiennej wartość false.
//                    isExist = true;
//                } else {
//                    //Sprawdzamy odnalezione nazwy odbiorców zgadzają się pod względem wielkości liter.
//                    if (string . Equals(name, recipient . Name, StringComparison . Ordinal)) {
//                        //Przypisujemy zmiennej wartość true, jeśli wielkość liter się zgadza.
//                        isExist = false;
//                    } else {
//                        //Przypisujemy zmiennej wartość false,  jeśli wielkość liter nie zgadza się.
//                        isExist = true;
//                    }
//                }
//            } catch (\Exception $ex) {
//                //Zapisujemy wyjątek.
//                LogHelper . SaveException(DateTime . Now, "Recipient", "CheckName()", ex . Message);
//            }
//
//            //Zwracamy rezultat.
//            return Json(isExist);
//        }
}
