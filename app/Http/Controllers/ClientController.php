<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewErrorMail;
use Illuminate\Support\Facades\DB;

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

    public function edit(User $user)
    {
      try {
        $this->authorize('update', $user);
        return view('/frontend/client/index', compact('user'));
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Client", "edit", $ex->getMessage(), $request->ip(), Auth::id());
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

    public function update(User $user, Request $request)
    {
      $user2 = Auth::user();

      if ($request['email'] == $user2['email']) {
        $request->validate([
            'newpassword' => ['required','max:100'],
        ]);
      }
      else {
        $request->validate([
            'newpassword' => ['required','max:100'],
            'email' => ['required','max:100','email','unique:users'],
        ]);
      }

      try {
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
