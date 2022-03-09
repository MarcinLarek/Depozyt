<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlatformException;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewErrorMail;
use Illuminate\Support\Facades\DB;


class ErrorsController extends Controller
{
    public function index()
    {
      try {
        $errors = PlatformException::all();
        $errors = $errors->reverse();
        return view('/frontend/admin/errors/index')
            ->with('errors', $errors);
          }
      catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-Errors", "index", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }



}
