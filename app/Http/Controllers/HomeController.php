<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewContactMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewErrorMail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view("/frontend/home/index");
    }

    public function siteerror()
    {
      $admins = DB::table('admins')->get();
      foreach ($admins as $admin) {
        if ($admin->error_notification==1) {
          Mail::to($admin->email)->send(new NewErrorMail());
        }
      }
      return redirect()->route('home')->with('siteerror','siteerror');
    }

    public function regulations()
    {
        return View("/frontend/home/regulations");
    }

    public function contact()
    {
        return View("/frontend/home/contact");
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
        return redirect()->route('contact')->with('issend','issend');
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Home", "sendcontact", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('siteerror');
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
