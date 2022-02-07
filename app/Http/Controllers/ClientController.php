<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function index()
    {
      try {
        $user = Auth::user();
        return View("/frontend/client/index")
        ->with('userData', $user);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Client", "index", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }

    }


    public function ResetPassword()
    {
        //if (string.IsNullOrEmpty(email) || string.IsNullOrEmpty(token))
        //{
        //    ModelState.AddModelError("", "BŁAD");
        //}

        return View("ResetPassword");
    }

    public function edit(User $user)
    {
      try {
        $this->authorize('update', $user);
        return view('/frontend/client/index', compact('user'));
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Client", "edit", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }

    }

    public function update(User $user, Request $request)
    {
      try {
        $request->validate([
            'newpassword' => ['required','max:100'],
            'email' => ['required','max:100'],

        ]);

        $data = array(
          'password' => Hash::make($request['newpassword']),
          'email' => $request['email']
        );

        auth()->user()->update($data);
        Auth::logout();
        return redirect('/sign-in');
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Client", "update", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }
    }

    // POST: Client/ForgotPassword


//        public function forgotPassword([Bind("UserName,Email")] ForgotPasswordModel forgotPasswordModel)
//        {
//            //Zmienna przyjmująca wynik operacji.
//            $result = 1;
//
//            if (ModelState.IsValid)
//            {
//                try
//                {
//                    //Tworzymy obiekt klasy KaucjaDbContext.
//
//
//                    //Tworzymy obiekt klasy Client. Wyszukujemy klienta na podstawie nazwy klienta i adresu email.
//                    Client client = kaucjaDbContext.Client.Where(c => c.UserName == forgotPasswordModel.UserName && c.Email == forgotPasswordModel.Email).FirstOrDefault();
//
//                    //Jeżeli odnaleziono klienta.
//                    if (client != null)
//                    {
//                        //Sprawdzamy czy adresy mailowe użytkownika zgadzają się pod względem wielkości liter.
//                        if (string.Compare(client.Email, forgotPasswordModel.Email, StringComparison.Ordinal) <= 0)
//                        {
//                            //Przypisujemy token.
//                            client.Token = TokenHelper.GenerateToken();
//
//                            //Blokujemy logowanie klienta.
//                            client.Blocked = true;
//
//                            //Edytujemy klienta.
//                            kaucjaDbContext.Entry(client).State = EntityState.Modified;
//
//                            //Zapisujemy zmiany.
//                            result = kaucjaDbContext.SaveChanges();
//
//                            //Jeżeli wynik jest równy jeden czyli dane zostały poprawnie zapisane w bazie danych.
//                            if (result == 1)
//                            {
//                                //Wysyłamy maila.
//                                MailHelper.SendResetPasswordLink(client.UserName, client.Token, forgotPasswordModel.Email);
//                            }
//                            else
//                            {
//                                //W przeciwnym wypadku przypisujemy zmiennej wartość zero.
//                                result = 0;
//                            }
//                        }
//                        else
//                        {
//                            //Przypisujemy zmiennej wartość false,  jeśli wielkość liter nie zgadza się.
//                            result = 0;
//                        }
//                    }
//                }
//                catch (\Exception $ex)
//                {
//                    //Wynik błędu operacji edycji.
//                    result = 0;
//
//                    //Zapisujemy wyjątek.
//                    LogHelper.SaveException(DateTime.Now, "Client", "ForgotPassword()", ex.Message);
//                }
//            }
//
//            //Zwracamy rezultat.
//            return result;
//        }

//        public function ResetPassword([Bind("Email,Token,UserPassword,CofirmPassword")] ResetPasswordModel resetPasswordModel)
//        {
//            //Zmienna przyjmująca wynik operacji.
//            $result = 1;
//
//            if (ModelState.IsValid)
//            {
//                try
//                {
//                    //Tworzymy obiekt klasy KaucjaDbContext.
//
//
//                    //Tworzymy obiekt klasy Client. Wyszukujemy klienta na podstawie adresu email oraz tokenu.
//                    Client client = kaucjaDbContext.Client.Where(c => c.Email == resetPasswordModel.Email && c.Token == resetPasswordModel.Token).FirstOrDefault();
//
//                    //Jeżeli odnaleziono klienta.
//                    if (client != null)
//                    {
//                        //Sprawdzamy czy adresy mailowe użytkownika zgadzają się pod względem wielkości liter.
//                        if (string.Compare(client.Email, resetPasswordModel.Email, StringComparison.Ordinal) <= 0)
//                        {
//                            //Przypisujemy token.
//                            client.Token = string.Empty;
//                            client.Blocked = false;
//
//                            //Edytujemy klienta.
//                            kaucjaDbContext.Entry(client).State = EntityState.Modified;
//
//                            //Zapisujemy zmiany.
//                            result = kaucjaDbContext.SaveChanges();
//                        }
//                        else
//                        {
//                            //Przypisujemy zmiennej wartość false,  jeśli wielkość liter nie zgadza się.
//                            result = 0;
//                        }
//                    }
//                }
//                catch (\Exception $ex)
//                {
//                    //Wynik błędu operacji edycji.
//                    result = 0;
//
//                    //Zapisujemy wyjątek.
//                    LogHelper.SaveException(DateTime.Now, "Client", "ResetPassword()", ex.Message);
//                }
//            }
//
//            //Zwracamy rezultat.
//            return result;
//        }
}
