<?php
namespace App\Http\Controllers;
use Kaucja.Models;
use Kaucja.Helpers;
    class AcceptChangeController extends Controller
    {
        // GET: Main


        public function Main()
        {
            //Zmienna przyjmująca wynik operacji.
            $result = 1;

            //Zmienna przyjmująca nazwę widoku.
            $view = "";

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
                    $view = "AcceptChangePartial/_SuccessPartial";
                }
                else
                {
                    //Przypisujemy widok porażki.
                    $view = "AcceptChangePartial/_ErrorPartial";
                }
            }
            catch (\Exception $ex)
            {
                //Przypisujemy widok porażki.
                $view = "AcceptChangePartial/_ErrorPartial";

                //Zapisujemy wyjątek.
                LogHelper.SaveException(DateTime.Now, "AcceptChange", "Main()", ex.Message);
            }

            //Zwracamy dane.
            return View($view);
        }
    }
}
