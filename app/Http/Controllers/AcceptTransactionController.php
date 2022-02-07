using System;
using System.Linq;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using Newtonsoft.Json;

using Kaucja.Models;
using Kaucja.Helpers;

namespace App\Http\Controllers;
    class AcceptTransactionController extends Controller
    {
        // GET: AcceptTransaction


        public function Main()
        {
            //Zmienna przyjmująca wynik operacji.
            $result = 1;

            //Zmienna przyjmująca nazwę widoku.
            string view = string.Empty;

            try
            {
                //Tworzymy obiekt klasy KaucjaDbContext.


                //Pobieramy identyfikator zalogowanego klienta.
                int clientId = JsonConvert.DeserializeObject<LoginModel>(HttpContext.Session.GetString("ClientType")).Id;

                //Zmienna przyjmuje wydzielony kod akceptacji z adresu url.
                string[] confirmCode = Request.QueryString.ToString().Split(new char[] { '=' });

                //Wyszukujemy transakcję na podstawie tokenu akceptacji.
                Transaction transaction = kaucjaDbContext.Transaction.Where(t => t.Token == confirmCode[1]).FirstOrDefault();

                //Zmienna od wysokości prowizji.
                decimal commissionValue = -1;

                //Jeżeli prowizję płaci wykonawca lub po połowie.
                if (transaction.CommissionPayer.Equals("contractor") || transaction.CommissionPayer.Equals("half"))
                {
                    //Pobieramy wykonawcy.
                    Client clientCommission = kaucjaDbContext.Client.Where(t => t.Id == transaction.ContractorId).FirstOrDefault();

                    //Jeżeli indywidualna prowizja jest aktywna.
                    if (clientCommission.IndyvidualCommissionStatus == true)
                    {
                        commissionValue = clientCommission.IndyvidualCommissionValue;
                    }
                    else
                    {
                        //Wyszukujemy wartość prowizji.
                        commissionValue = kaucjaDbContext.Commission.Where(t => transaction.Amount >= t.AmountMin && transaction.Amount <= t.AmountMax).FirstOrDefault().CommissionValue;
                    }
                }

                //Jeżeli odnaleziono transakcji.
                if (transaction != null)
                {
                    //Przypisujemy pustą wartość tokenowi.
                    transaction.Token = string.Empty;
                    transaction.Status = "TC";

                    //Modyfyfikujemy dane transakcji.
                    kaucjaDbContext.Entry(transaction).State = EntityState.Modified;

                    //Zapisujemy zmiany.
                    result = kaucjaDbContext.SaveChanges();

                    if (result == 1)
                    {
                        Wallet wallet = kaucjaDbContext.Wallet.Where(w => w.ClientId == transaction.ContractorId && w.CurrencyName == transaction.CurrencyName).FirstOrDefault();

                        if (wallet != null)
                        {
                            if (commissionValue > -1)
                            {
                                wallet.Amount += transaction.Payment - (transaction.Payment * commissionValue / 100.00M);
                            }
                            else
                            {
                                wallet.Amount += transaction.Payment;
                            }

                            //Modyfyfikujemy dane transakcji.
                            kaucjaDbContext.Entry(wallet).State = EntityState.Modified;

                            //Zapisujemy zmiany.
                            result = kaucjaDbContext.SaveChanges();
                        }
                        else
                        {
                            Wallet wallet1 = new Wallet();
                            if (commissionValue > -1)
                            {
                                wallet1.Amount = transaction.Payment - (transaction.Payment * commissionValue / 100.00M);
                            }
                            else
                            {
                                wallet1.Amount = transaction.Amount;
                            }
                            wallet1.ClientId = transaction.ContractorId;
                            wallet1.CurrencyName = transaction.CurrencyName;

                            using WalletController walletController = new WalletController();

                            wallet1.Id = walletController.SearchFirstFreeId();
                            wallet1.ModyficationDate = DateTime.Now;
                            wallet1.ModyfiedBy = clientId;

                            //Dodajemy portfel.
                            kaucjaDbContext.Entry(wallet1).State = EntityState.Added;

                            //Zapisujemy zmiany.
                            result = kaucjaDbContext.SaveChanges();
                        }
                    }
                }

                //Jeżeli poprawnie zmodyfikowano dane.
                if (result == 1)
                {
                    //Przypisujemy widok sukcesu.
                    view = "AcceptTransacionPartial/_SuccessPartial";

                    //Wysyłamy maila.
                    MailHelper.SendAcceptTransactionMailToCustomer(clientId, transaction.TransactionCode);
                }
                else
                {
                    //Przypisujemy widok porażki.
                    view = "AcceptTransacionPartial/_ErrorPartial";
                }
            }
            catch (\Exception $ex)
            {
                //Przypisujemy widok porażki.
                view = "AcceptWithdrawalPartial/_ErrorPartial";

                //Zapisujemy wyjątek.
                LogHelper.SaveException(DateTime.Now, "AcceptTransaction", "Main()", ex.Message);
            }

            //Zwracamy dane.
            return View(view);
        }
    }
}
