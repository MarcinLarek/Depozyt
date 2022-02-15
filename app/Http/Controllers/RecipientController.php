<?php

namespace App\Http\Controllers;

use App\Http\Requests\Recipients\StoreRequest;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipientController extends Controller
{

    public function index()
    {
      try {
        $recipients = Auth::user()->recipients()->get();
        return View("/frontend/recipients/index")
            ->with('recipients', $recipients);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Recipient", "idit", $ex->getMessage(), $request->ip(), Auth::id());
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
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }
    }

    public function update($recipientId, Request $request)
    {
        try {
            $recipient = Auth::user()->recipients()->find($recipientId);
            $recipient->update($request->all());
            $recipients = Auth::user()->recipients()->get();
            return View("/frontend/recipients/index")
                ->with('recipients', $recipients);
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), "Recipient", "update", $exception->getMessage(), $request->ip(), Auth::id());
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
            $error = 1;
            return view("/frontend/home/index", compact('error'));
        }
    }

    public function store(StoreRequest $request)
    {
      $data = $request->validated();
        try {
            $user = Auth::user();
            $data['country_id'] = $user->country->getId();
            $user->recipients()->create($data);
            return redirect()->route('recipients');
        }
        catch (\Exception $ex) {
            saveException(sqlDateTime(), "Recipient", "Create()", $ex->getMessage(), $request->ip(), Auth::id());
            $error = 1;
            return view("/frontend/home/index", compact('error'));
        }

    }

}