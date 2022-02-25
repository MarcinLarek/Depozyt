<?php

namespace App\Http\Controllers;

use App\Http\Requests\Recipients\StoreRequest;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewErrorMail;
use Illuminate\Support\Facades\DB;

class RecipientController extends Controller
{

    public function index()
    {
      try {
        $recipients = Auth::user()->recipients()->get();
        $succesaalert = 0;
        return View("/frontend/recipients/index")
            ->with('succesaalert', $succesaalert)
            ->with('recipients', $recipients);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Recipient", "idit", $ex->getMessage(), $request->ip(), Auth::id());
                  $admins = DB::table('admins')->get();
                  foreach ($admins as $admin) {
                    if ($admin->error_notification==1) {
                      Mail::to($admin->email)->send(new NewErrorMail());
                    }
                  }
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }
    }

    public function create()
    {
        return view("/frontend/recipients/create");
    }

    public function edit($id)
    {
      try {
        $recipient = Auth::user()->recipients()->find($id);
        return view("/frontend/recipients/edit")
            ->with('recipient', $recipient);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Recipient", "edit", $ex->getMessage(), $request->ip(), Auth::id());
                  $admins = DB::table('admins')->get();
                  foreach ($admins as $admin) {
                    if ($admin->error_notification==1) {
                      Mail::to($admin->email)->send(new NewErrorMail());
                    }
                  }
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }
    }

    public function update($recipientId, Request $request)
    {
      $request->validate([
          'name' => ['required','max:100'],
          'nip' => ['required','NIP'],
          'country_id' => ['required'],
          'bank_name' => ['required','max:100'],
          'account_number' => ['required','iban'],
          'email' => ['required','max:100', 'email'],
          'phone' => ['required','max:100'],
          'street' => ['required','max:100'],
          'post_code' => ['required','post_code'],
          'city' => ['required','max:100'],
          'active' => ['required'],
      ]);
        try {
            $recipient = Auth::user()->recipients()->find($recipientId);
            $recipient->update($request->all());
            $recipients = Auth::user()->recipients()->get();
            $succesaalert = 1;
            return View("/frontend/recipients/index")
                ->with('succesaalert', $succesaalert)
                ->with('recipients', $recipients);
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), "Recipient", "update", $exception->getMessage(), $request->ip(), Auth::id());
            $admins = DB::table('admins')->get();
            foreach ($admins as $admin) {
              if ($admin->error_notification==1) {
                Mail::to($admin->email)->send(new NewErrorMail());
              }
            }
            $error = 1;
            return view("/frontend/home/index", compact('error'));
        }
    }

    public function payment()
    {
      try {
        $recipients = Auth::user()->recipients()->get();
        $wallets = Auth::user()->wallet()->get();
        $walleterror = 0;
        if ($wallets->count()) {
            return view("/frontend/recipients/payment")
                ->with('recipients', $recipients)
                ->with('walleterror', $walleterror)
                ->with('wallets', $wallets);
        } else {
            return view('/frontend/recipients/_empty-wallet');
        }
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Recipient", "payment", $ex->getMessage(), $request->ip(), Auth::id());
                  $admins = DB::table('admins')->get();
                  foreach ($admins as $admin) {
                    if ($admin->error_notification==1) {
                      Mail::to($admin->email)->send(new NewErrorMail());
                    }
                  }
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }
    }


    public function getHistory(Request $request)
    {
        try {
          $walletHistory = Auth::user()->walletHistory()->get();
          return view("/frontend/recipients/get-history", [
              'walletHistory' => $walletHistory
          ]);
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), "PaymentController", "getHistory", $exception->getMessage(), $request->ip(), Auth::id());
            $admins = DB::table('admins')->get();
            foreach ($admins as $admin) {
              if ($admin->error_notification==1) {
                Mail::to($admin->email)->send(new NewErrorMail());
              }
            }
            $error = 1;
            return view("/frontend/home/index", compact('error'));
        }
    }

    public function store(StoreRequest $request)
    {
      $data = $request->validate([
          'name' => ['required','max:100'],
          'nip' => ['required','NIP'],
          'bank_name' => ['required','max:100'],
          'account_number' => ['required','iban'],
          'email' => ['required','max:100', 'email'],
          'phone' => ['required','max:100'],
          'street' => ['required','max:100'],
          'post_code' => ['required','post_code'],
          'city' => ['required','max:100'],
      ]);
        try {
            $user = Auth::user();
            $data['country_id'] = $user->country->getId();
            $user->recipients()->create($data);
            $recipients = Auth::user()->recipients()->get();
            $succesaalert = 1;
            return View("/frontend/recipients/index")
                ->with('succesaalert', $succesaalert)
                ->with('recipients', $recipients);
        }
        catch (\Exception $ex) {
            saveException(sqlDateTime(), "Recipient", "Create()", $ex->getMessage(), $request->ip(), Auth::id());
            $admins = DB::table('admins')->get();
            foreach ($admins as $admin) {
              if ($admin->error_notification==1) {
                Mail::to($admin->email)->send(new NewErrorMail());
              }
            }
            $error = 1;
            return view("/frontend/home/index", compact('error'));
        }

    }

}
