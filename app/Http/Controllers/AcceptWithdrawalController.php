using System;
using System.Linq;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;

using Kaucja.Models;
using Kaucja.Helpers;

namespace App\Http\Controllers;
    class AcceptWithdrawalController extends Controller
    {
        // GET: AcceptWithdrawal


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

                //Wyszukujemy zlecenie wypłaty na podstawie tokenu akceptacji.
                Withdrawal withdrawal = kaucjaDbContext.Withdrawal.Where(w => w.Token == confirmCode[1]).FirstOrDefault();

                //Jeżeli odnaleziono zlecenia wypłaty.
                if (withdrawal != null)
                {
                    //Przypisujemy pustą wartość tokenowi.
                    withdrawal.Token = string.Empty;

                    //Modyfyfikujemy dane klienta.
                    kaucjaDbContext.Entry(withdrawal).State = EntityState.Modified;

                    //Zapisujemy zmiany.
                    result = kaucjaDbContext.SaveChanges();
                }

                //Jeżeli poprawnie zmodyfikowano dane.
                if (result == 1)
                {
                    //Przypisujemy widok sukcesu.
                    view = "AcceptWithdrawalPartial/_SuccessPartial";
                }
                else
                {
                    //Przypisujemy widok porażki.
                    view = "AcceptWithdrawalPartial/_ErrorPartial";
                }
            }
            catch (\Exception $ex)
            {
                //Przypisujemy widok porażki.
                view = "AcceptWithdrawalPartial/_ErrorPartial";

                //Zapisujemy wyjątek.
                LogHelper.SaveException(DateTime.Now, "AcceptWithdrawal", "Main()", ex.Message);
            }

            //Zwracamy dane.
            return View(view);
        }
    }
}
