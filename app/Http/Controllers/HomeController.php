<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContactMessage;

class HomeController extends Controller
{
    public function index()
    {
      $error = 0;
        return view("/frontend/home/index", compact('error'));
    }

    public function regulations()
    {
        return View("/frontend/home/regulations");
    }

    public function contact()
    {
      $issend = 0;
        return View("/frontend/home/contact", compact('issend'));
    }

    public function sendcontact(Request $request, Contact $contact)
    {
      $request->validate([
          'message' => ['required'],
          'email' => ['required','max:100'],
      ]);
      try {
        $data = array(
          'message' => $request['message'],
          'email' => $request['email']
        );
        $contact->create($data);
        Mail::to('kontakt@domena.pl')->send(new NewContactMessage());
        $issend = 1;
        return View("/frontend/home/contact", compact('issend'));
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Home", "sendcontact", $ex->getMessage(), $request->ip(), Auth::id());
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }
    }

    public function whatIsDepozyt()
    {
        return View("/frontend/home/what-is-depozyt");
    }

    public function howItWorks()
    {
        return View("/frontend/home/how-it-works");
    }
}
