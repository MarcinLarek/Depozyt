<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    private $usersService;

    public function ForgotPassword()
    {
      $wrongemail = 0;
          return View("/frontend/sign-in/ForgotPassword", compact('wrongemail'));
    }
    public function SetNewPassword($token)
    {
      return View("/frontend/sign-in/SetNewPassword", compact('token'));
    }
    public function SetNewPasswordUpdate(Request $request)
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
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Login", "SetNewPasswordUpdate", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }
    }

    public function logout(Request $request) {
      Auth::logout();
      return redirect('/sign-in');
    }

    public function ForgotPasswordReset(Request $request)
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
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Login", "ForgotPasswordReset", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }
    }

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function index(\App\Models\User $failstatus)
    {
      $failstatus = 0;
        return view("/frontend/sign-in/index", compact('failstatus'));
    }

    public function signIn(LoginRequest $request,\App\Models\User $failstatus)
    {
      try {
        $input = $request->all();

        $this->validate($request, [
              'username' => 'required',
              'password' => 'required',
          ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
         if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))
         {
             return redirect()->route('home');
         }else{
           $failstatus = 1;
           return view("/frontend/sign-in/index", compact('failstatus'));
         }
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Login", "signIn", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }

    }
}
