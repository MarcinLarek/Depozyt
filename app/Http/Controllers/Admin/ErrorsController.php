<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlatformException;
use Illuminate\Support\Facades\Auth;



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
