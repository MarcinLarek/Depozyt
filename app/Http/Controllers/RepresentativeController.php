<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepresentativeRequest;
use App\Models\Representative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewErrorMail;
use Illuminate\Support\Facades\DB;

class RepresentativeController extends Controller
{
    public function index()
    {
      try {
        $representativeData = Auth::user()->representative()->first();
        if (empty($representativeData)) {
            $representativeData = Representative::make();
        }
        $succesaalert = 0;
        return View("/frontend/representative/index")
            ->with('representative', $representativeData)
            ->with('succesaalert', $succesaalert);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Representative", "index", $ex->getMessage(), $request->ip(), Auth::id());
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

    public function edit(RepresentativeRequest $request)
    {
      $request->validate([
          'surname' => ['required','max:100'],
          'name' => ['required','max:100'],
          'pesel' => ['required','PESEL'],
          'document_type' => ['required'],
          'document_number' => ['required','max:100'],
          'email' => ['required','max:100','email'],
          'phone' => ['required','max:100'],
          'street' => ['required','max:100'],
          'post_code' => ['required','post_code'],
          'city' => ['required','max:100']
      ]);
      try {
        $user = Auth::user();
        $data = array(
          'user_id' => $user['id'],
          'surname' => $request['surname'],
          'name' => $request['name'],
          'pesel' => $request['pesel'],
          'document_type' => $request['document_type'],
          'document_number' => $request['document_number'],
          'email' => $request['email'],
          'phone' => $request['phone'],
          'post_code' => $request['post_code'],
          'street' => $request['street'],
          'city' => $request['city'],
        );

        $representativeData = Auth::user()->representative()->first();
        if ($representativeData == null) {
          Representative::create($data);
          $representativeData = Auth::user()->representative()->first();
          $succesaalert = 1;
          return View("/frontend/representative/index")
              ->with('representative', $representativeData)
              ->with('succesaalert', $succesaalert);
        }
        else {
          $representativeData->update($request->all());
          $succesaalert = 1;
          return View("/frontend/representative/index")
              ->with('representative', $representativeData)
              ->with('succesaalert', $succesaalert);
        }
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Representative", "edit", $ex->getMessage(), $request->ip(), Auth::id());
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
