using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Kaucja.Helpers;
using Kaucja.Models;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;

namespace App\Http\Controllers;
    class AcceptRecipientPaymentController extends Controller
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


                //Zmienna przyjmuje wydzielony kod akceptacji z adresu url.
                string[] confirmCode = Request.QueryString.ToString().Split(new char[] { '=' });

                RecipientPaymentModel recipient = kaucjaDbContext.RecipientPayment.Where(r => r.Token == confirmCode[1]).FirstOrDefault();

                //Jeżeli odnaleziono transakcję oraz odnaleziono wysokość prowizji.
                if (recipient != null)
                {
                    Wallet wallet = kaucjaDbContext.Wallet.Where(t => t.ClientId == recipient.ClientId && t.CurrencyName == recipient.CurrencyName).FirstOrDefault();

                    if (wallet != null)
                    {
                        //Jeżeli klient ma wystarczająco duże saldo do zapłaty transakcji z prowizją.
                        if (wallet.Amount >= recipient.Amount)
                        {
                            //Odejmowanie kwoty transakcji z portfela.
                            wallet.Amount -= recipient.Amount;

                            wallet.ModyficationDate = DateTime.Now;

                            wallet.ModyfiedBy = recipient.ClientId;

                            //Modyfyfikujemy dane portfela.
                            kaucjaDbContext.Entry(wallet).State = EntityState.Modified;

                            //Zapisujemy zmiany.
                            result = kaucjaDbContext.SaveChanges();

                            if (result == 1)
                            {
                                //Przypisujemy pustą wartość tokenowi.
                                recipient.Token = string.Empty;

                                recipient.ModyficationDate = DateTime.Now;

                                recipient.ModyfiedBy = recipient.ClientId;

                                //Edytujemy obiekt.
                                kaucjaDbContext.Entry(recipient).State = EntityState.Modified;

                                //Zapisujemy dane.
                                result = kaucjaDbContext.SaveChanges();

                                if (result == 1)
                                {
                                    Withdrawal withdrawal = new Withdrawal
                                    {
                                        Id = SearchFirstFreeId(),
                                        ClientId = recipient.ClientId,
                                        BankName = string.Empty,
                                        Name = recipient.PaymentTitle,
                                        //CurrencyName = recipient.CurrencyName,
                                        CurrencyName = recipient.CurrencyName + "|" + recipient.RecipientId,
                                        Amount = recipient.Amount,
                                        Token = string.Empty,
                                        ConfirmDate = DateTime.Now,
                                        ModyficationDate = DateTime.Now,
                                        ModyfiedBy = recipient.ClientId,
                                        Available = true
                                    };

                                    //Edytujemy obiekt.
                                    kaucjaDbContext.Entry(withdrawal).State = EntityState.Added;

                                    //Zapisujemy dane.
                                    result = kaucjaDbContext.SaveChanges();
                                }
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
                    view = "AcceptRecipientPaymentPartial/_SuccessPartial";
                }
                else if (result == -1)
                {
                    //Przypisujemy widok sukcesu.
                    view = "AcceptRecipientPaymentPartial/_ErrorAmountPartial";
                }
                else
                {
                    //Przypisujemy widok porażki.
                    view = "AcceptRecipientPaymentPartial/_ErrorPartial";
                }
            }
            catch (\Exception $ex)
            {
                //Przypisujemy widok porażki.
                view = "AcceptRecipientPaymentPartial/_ErrorPartial";

                //Zapisujemy wyjątek.
                LogHelper.SaveException(DateTime.Now, "AcceptRecipientPayment", "Main()", ex.Message);
            }
            //Zwracamy dane.
            return View(view);
        }
        private int SearchFirstFreeId()
        {
            //Zmienna zawierająca wyznaczony wolny identyfikator.
            int freeId = 0;

            try
            {
                //Tworzymy obiekt klasy KaucjaDbContext.


                //Pobieramy listę numerów id z tabeli wypłat.
                List<int> list = kaucjaDbContext.Withdrawal.Select(w => w.Id).ToList();

                //Jeżeli mamy więcej niż 0 elementów.
                if (list.Count > 0)
                {
                    for (int x = 0; x < list.Count - 1; x++)
                    {
                        //Wyznaczamy różnicę pomiędzy n-tym a poprzednim numerem.
                        int difference = list[x + 1] - list[x];

                        //Jeżeli różnica jest większa niż 1.
                        if (difference > 1)
                        {
                            //WolnyId -> poprzedni numer Id + 1. Przerywamy pętle.
                            freeId = list[x] + 1;
                            break;
                        }
                    }

                    //Jeżeli nie odnaloziono różnicy, wolnyId = ostatni numer Id na liście + 1.
                    if (freeId == 0)
                    {
                        freeId = list[list.Count - 1] + 1;
                    }
                }
                else
                {
                    //Jeżeli lista jest pusta, to wolnyId = 1.
                    freeId = 1;
                }
            }
            catch (\Exception $ex)
            {
                //W przypadku błędu zapisujemy wyjątek.
                LogHelper.SaveException(DateTime.Now, "Withdrawal", "SearchFirstFreeId()", ex.Message);
            }

            //Zwracamy wynik.
            return freeId;
        }
    }
}
