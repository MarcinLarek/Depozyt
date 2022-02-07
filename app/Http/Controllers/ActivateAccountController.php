using System;
using System.Linq;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;

using Kaucja.Models;
using Kaucja.Helpers;

namespace App\Http\Controllers;
    class ActivateAccountController extends Controller
    {
        // GET: Main


        public function Main()
        {
            //Zmienna przyjmująca wynik operacji.
            $result = 1;

            //Zmienna przyjmująca nazwę widoku.
            string view = string.Empty;

            try
            {
                //Tworzymy obiekt klasy KaucjaDbContext.


                //Zmienna przyjmuje wydzielony kod aktywacyjny z adresu url.
                string[] confirmCode = Request.QueryString.ToString().Split(new char[] { '=' });

                //Wyszukujemy klienta na podstawie tokenu rejestracyjnego.
                Client client = kaucjaDbContext.Client.Where(c => c.Token == confirmCode[1] && c.Blocked == true).FirstOrDefault();

                //Jeżeli odnaleziono klienta.
                if (client != null)
                {
                    //Odblokowujemy klienta oraz przypisujemy pustą wartość tokenowi.
                    client.Blocked = false;
                    client.Token = string.Empty;

                    //Modyfyfikujemy dane klienta.
                    kaucjaDbContext.Entry(client).State = EntityState.Modified;

                    //Zapisujemy zmiany.
                    result = kaucjaDbContext.SaveChanges();
                }

                //Jeżeli poprawnie zmodyfikowano dane.
                if (result == 1)
                {
                    //Przypisujemy widok sukcesu.
                    view = "ActivateAccountPartial/_SuccessPartial";
                }
                else
                {
                    //Przypisujemy widok porażki.
                    view = "ActivateAccountPartial/_ErrorPartial";
                }
            }
            catch (\Exception $ex)
            {
                //Przypisujemy widok porażki.
                view = "ActivateAccountPartial/_ErrorPartial";

                //Zapisujemy wyjątek.
                LogHelper.SaveException(DateTime.Now, "ActivateAccount", "Main()", ex.Message);
            }

            //Zwracamy dane.
            return View(view);
        }
    }
}
