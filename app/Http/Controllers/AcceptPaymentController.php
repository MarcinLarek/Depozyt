using System;
using System.Linq;
using Kaucja.Helpers;
using Kaucja.Models;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;

namespace App\Http\Controllers;
    class AcceptPaymentController extends Controller
    {
        // GET: AcceptPayment


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
                //int clientId = JsonConvert.DeserializeObject<LoginModel>(HttpContext.Session.GetString("ClientType")).Id;

                //Zmienna przyjmuje wydzielony kod akceptacji z adresu url.
                string[] confirmCode = Request.QueryString.ToString().Split(new char[] { '=' });

                //Wyszukujemy transakcję na podstawie tokenu akceptacji.
                Transaction transaction = kaucjaDbContext.Transaction.Where(t => t.Token == confirmCode[1]).FirstOrDefault();

                //Zmienna od wysokości prowizji.
                decimal commissionValue = -1;

                //Jeżeli prowizję płaci zleceniodawca lub po połowie.
                if (transaction.CommissionPayer.Equals("principal") || transaction.CommissionPayer.Equals("half"))
                {
                    //Pobieramy zleceniodawcy.
                    Client clientCommission = kaucjaDbContext.Client.Where(t => t.Id == transaction.CustomerId).FirstOrDefault();

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
                //Jeżeli odnaleziono transakcję oraz odnaleziono wysokość prowizji.
                if (transaction != null)
                {
                    Wallet wallet = kaucjaDbContext.Wallet.Where(t => t.ClientId == transaction.CustomerId && t.CurrencyName == transaction.CurrencyName).FirstOrDefault();

                    //Jeżeli kwota transakcji jest mniejsza lub równa saldo.
                    if (wallet != null)
                    {
                        //Obliczanie procentu dla zleceniodawcy.
                        decimal percent = 0;
                        if (commissionValue > -1)
                        {
                            //Zmienna od procentu.
                            percent = transaction.Amount * commissionValue / 100.00M;
                        }
                        //Jeżeli klient ma wystarczająco duże saldo do zapłaty transakcji z prowizją.
                        if (wallet.Amount >= transaction.Amount + percent)
                        {
                            //Odejmowanie kwoty transakcji z portfela.
                            wallet.Amount -= transaction.Amount + percent;

                            wallet.ModyficationDate = DateTime.Now;

                            wallet.ModyfiedBy = transaction.CustomerId;

                            //Modyfyfikujemy dane portfela.
                            kaucjaDbContext.Entry(wallet).State = EntityState.Modified;

                            //Zapisujemy zmiany.
                            result = kaucjaDbContext.SaveChanges();

                            if (result == 1)
                            {
                                //Przypisujemy wpłatę.
                                transaction.Payment = transaction.Amount;

                                //Przypisujemy pustą wartość tokenowi.
                                transaction.Token = string.Empty;

                                //Zmieniamy status transakcji.
                                transaction.Status = "TP";

                                //Edytujemy obiekt.
                                kaucjaDbContext.Entry(transaction).State = EntityState.Modified;

                                //Zapisujemy dane.
                                result = kaucjaDbContext.SaveChanges();
                            }
                        }
                        else
                        {
                            result = -1;
                        }
                    }
                }

                //Jeżeli poprawnie zmodyfikowano dane.
                if (result == 1)
                {
                    //Przypisujemy widok sukcesu.
                    view = "AcceptPaymentPartial/_SuccessPartial";
                }
                else if (result == -1)
                {
                    //Przypisujemy widok sukcesu.
                    view = "AcceptPaymentPartial/_ErrorAmountPartial";
                }
                else
                {
                    //Przypisujemy widok porażki.
                    view = "AcceptPaymentPartial/_ErrorPartial";
                }
            }
            catch (\Exception $ex)
            {
                //Przypisujemy widok porażki.
                view = "AcceptPaymentPartial/_ErrorPartial";

                //Zapisujemy wyjątek.
                LogHelper.SaveException(DateTime.Now, "AcceptPayment", "Main()", ex.Message);
            }
            //Zwracamy dane.
            return View(view);
        }
    }
}
