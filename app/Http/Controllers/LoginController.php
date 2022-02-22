<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewErrorMail;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    private $usersService;

    public function forgotPassword()
    {
      $wrongemail = 0;
          return View("/frontend/sign-in/ForgotPassword", compact('wrongemail'));
    }
    public function setNewPassword($token)
    {
      return View("/frontend/sign-in/SetNewPassword", compact('token'));
    }
    public function setNewPasswordUpdate(Request $request)
    {
      $request->validate([
          'password' => ['required','max:100','confirmed'],
      ]);
      try {
        $uservar =  User::where('token',$request['Token'])->first();
        $data = array(
          'password' => Hash::make($request['password']),
          );
        $uservar->update($data);
        return redirect('/sign-in');
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Login", "SetNewPasswordUpdate", $ex->getMessage(), $request->ip(), Auth::id());
                  $admins = DB::table('admins')->get();
                  foreach ($admins as $admin) {
                    Mail::to($admin->email)->send(new NewErrorMail());
                  }
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }
    }

    public function logout(Request $request) {
      Auth::logout();
      $failstatus = 0;
      $errortype = 0;
        return view("/frontend/sign-in/index")
          ->with('errortype', $errortype)
          ->with('failstatus', $failstatus);
    }

    public function forgotPasswordReset(Request $request)
    {
      try {
        $varmail = $request->input('email');
        $uservar =  User::where('email',$varmail)->first();
        if($uservar == null)
        {
          $wrongemail = 1;
          return View("/frontend/sign-in/ForgotPassword", compact('wrongemail'));
        }
        else
        {
          $uservar->update(['token' => Str::random(60)]);
          Mail::to($varmail)->send(new ResetPasswordMail($uservar));
          return redirect()->route('home');
        }
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Login", "ForgotPasswordReset", $ex->getMessage(), $request->ip(), Auth::id());
                  $admins = DB::table('admins')->get();
                  foreach ($admins as $admin) {
                    Mail::to($admin->email)->send(new NewErrorMail());
                  }
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }
    }

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function index(\App\Models\User $failstatus)
    {
      $failstatus = 0;
      $errortype = 0;
        return view("/frontend/sign-in/index")
          ->with('errortype', $errortype)
          ->with('failstatus', $failstatus);
    }

    public function signIn(LoginRequest $request,\App\Models\User $failstatus)
    {
      try {
        $input = $request->all();

        $this->validate($request, [
              'username' => 'required',
              'password' => 'required',
          ]);
          $user =  User::where('username',$request['username'])->first();
          if ($user == null) {
            $failstatus = 0;
            $errortype = 1;
              return view("/frontend/sign-in/index")
                ->with('errortype', $errortype)
                ->with('failstatus', $failstatus);
          }
          elseif ($user['email_verified_at'] == null)
          {
            $failstatus = 0;
            $errortype = 2;
              return view("/frontend/sign-in/index")
                ->with('errortype', $errortype)
                ->with('failstatus', $failstatus);
          }
          else
          {
            $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
             if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))
             {
                 return redirect()->route('home');
             }else{
               $failstatus = 0;
               $errortype = 0;
                 return view("/frontend/sign-in/index")
                   ->with('errortype', $errortype)
                   ->with('failstatus', $failstatus);
             }
          }


      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Login", "signIn", $ex->getMessage(), $request->ip(), Auth::id());

                  $admins = DB::table('admins')->get();
                  foreach ($admins as $admin) {
                    Mail::to($admin->email)->send(new NewErrorMail());
                  }

                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }

    }
}
