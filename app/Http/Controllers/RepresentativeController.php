<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepresentativeRequest;
use App\Models\Representative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepresentativeController extends Controller
{
    public function index()
    {
      try {
        $representativeData = Auth::user()->representative()->first();
        if (empty($representativeData)) {
            $representativeData = Representative::make();
        }
        return View("/frontend/representative/index")
            ->with('representative', $representativeData);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Representative", "index", $ex->getMessage(), $request->ip(), Auth::id());
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }
    }

    public function edit(RepresentativeRequest $request)
    {
      $request->validate([
          'surname' => ['required'],
          'name' => ['required'],
          'pesel' => ['required'],
          'document_type' => ['required'],
          'document_number' => ['required'],
          'email' => ['required'],
          'phone' => ['required'],
          'street' => ['required'],
          'post_code' => ['required'],
          'city' => ['required']
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
          return View("/frontend/representative/index")
                ->with('representative', $representativeData);
        }
        else {
          $representativeData->update($request->all());
          return View("/frontend/representative/index")
                ->with('representative', $representativeData);
        }
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Representative", "edit", $ex->getMessage(), $request->ip(), Auth::id());
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }


    }
}
