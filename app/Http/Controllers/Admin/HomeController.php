<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\WalletHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewErrorMail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('/frontend/admin/admin/index');
    }

    public function siteerror()
    {
      $admins = DB::table('admins')->get();
      foreach ($admins as $admin) {
        if ($admin->error_notification==1) {
          Mail::to($admin->email)->send(new NewErrorMail());
        }
      }
      return redirect()->route('admin')->with('siteerror','siteerror');
    }

}
