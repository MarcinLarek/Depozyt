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
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Client", "index", $ex->getMessage(), $request->ip(), Auth::id());
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }

    }

    public function edit(User $user)
    {
      try {
        $this->authorize('update', $user);
        return view('/frontend/client/index', compact('user'));
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Client", "edit", $ex->getMessage(), $request->ip(), Auth::id());
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }

    }

    public function update(User $user, Request $request)
    {
      try {
        $request->validate([
            'newpassword' => ['required','max:100'],
            'email' => ['required','max:100','email','unique'],

        ]);

        $data = array(
          'password' => Hash::make($request['newpassword']),
          'email' => $request['email']
        );

        auth()->user()->update($data);
        Auth::logout();
        return redirect('/sign-in');
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Client", "update", $ex->getMessage(), $request->ip(), Auth::id());
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }
    }

}
