<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminLoginMail;

class SignInController extends Controller
{
    public function index()
    {
        return view('/frontend/admin/sign-in/index');
    }

    public function login(Request $request)
    {
        $user = Admin::where('login',$request['username'])->first();
        $user->update(['token' => Str::random(60)]);
        Mail::to($user['email'])->send(new AdminLoginMail($user));
        return view('/frontend/admin/sign-in/index');

        //if ($user->count() != 0 && Hash::check($request->post('password'), $user->first()->password)) {
        //    Auth::guard('admin')->login($user->first());
        //    return redirect()->route('admin');
        //}
    }

    public function AdminLogin($token)
    {
      $user = Admin::where('token',$token)->first();
      Auth::guard('admin')->login($user->first());
        return redirect()->route('admin');
    }

}
