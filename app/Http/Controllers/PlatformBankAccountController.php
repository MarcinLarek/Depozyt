using System;
using System.Collections.Generic;
using System.Linq;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;

using Kaucja.Helpers;
using Kaucja.Models;

namespace App\Http\Controllers;
    class PlatformBankAccountController extends Controller
    {
        // GET: PlatformBankAccount/GetBank


        public function GetBank()
        {
            //Zmienna klasy List.
            List<Bank> list = null;

            try
            {
                //Tworzymy obiekt klasy KaucjaDbContext.


                //Wyszukujemy unikatowe nazwy banków, które obsługuje platforma.
                list = (from pba in kaucjaDbContext.PlatformBankAccount
                        where pba.Active == true
                        select new Bank()
                        {
                            Name = pba.BankName
                        }).AsNoTracking().Distinct().OrderBy(pba => pba.Name).ToList();

                //Jeżeli lista banków jest równa zero.
                if (list.Count == 0)
                {
                    //Przypisujemy wartość null.
                    list = null;
                }
            }
            catch (\Exception $ex)
            {
                //Przypisujemy wartość null.
                list = null;

                //Zapisujemy wyjątek.
                LogHelper.SaveException(DateTime.Now, "PlatformBankAccount", "GetBank()", ex.Message);
            }

            //Zwracamy dane.
            return Json(list);
        }

        // GET: PlatformBankAccount/GetCurrency


        public function GetCurrency(string bankName)
        {
            //Zmienna klasy List.
            List<Currency> list = null;

            try
            {
                //Tworzymy obiekt klasy KaucjaDbContext.


                //Wyszukujemy nazwy walut na podstawie przekazanego identyfikatora banku.
                list = (from pba in kaucjaDbContext.PlatformBankAccount
                        where pba.BankName == bankName
                        join c in kaucjaDbContext.Currency on pba.CurrencyName equals c.Symbol
                        orderby c.Symbol ascending
                        select new Currency()
                        {
                            Id = c.Id,
                            Name = c.Name,
                            Symbol = c.Symbol
                        }).AsNoTracking().ToList();

                //Jeżeli lista walut jest równa zero.
                if (list.Count == 0)
                {
                    //Przypisujemy wartość null.
                    list = null;
                }
            }
            catch (\Exception $ex)
            {
                //Przypisujemy wartość null.
                list = null;

                //Zapisujemy wyjątek.
                LogHelper.SaveException(DateTime.Now, "PlatformBankAccount", "GetCurrency()", ex.Message);
            }

            //Zwracamy dane.
            return Json(list);
        }
    }
}
