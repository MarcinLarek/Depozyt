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
        $notification = 0;
        return view('/frontend/admin/sign-in/index')
        ->with('notification', $notification);
    }

    public function login(Request $request)
    {
        try {
            $user = Admin::where('login', $request['username'])->first();
            if ($user !=null && Hash::check($request['password'], $user['password'])) {
                $user->update(['token' => Str::random(60)]);
                Mail::to($user['email'])->send(new AdminLoginMail($user));
                $notification = 2;
                return view('/frontend/admin/sign-in/index')
            ->with('notification', $notification);
            } else {
                $notification = 1;
                return view('/frontend/admin/sign-in/index')
            ->with('notification', $notification);
            }
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "SignInController", "login", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }

    public function AdminLogin($token)
    {
        try {
            $user = Admin::where('token', $token)->first();
            if ($user == null) {
                return redirect()->route('admin');
            }
            $user->update(['token' => Str::random(60)]);
            Auth::guard('admin')->login($user->first());
            return redirect()->route('admin');
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "SignInController", "AdminLogin", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }

    public function adminlogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin');
    }
}
