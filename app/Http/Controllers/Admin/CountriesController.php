<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CountriesController extends Controller
{
    public function index()
    {
      try {
        $countries = Country::all();
        $succesaalert = 0;
        return view('/frontend/admin/countries/index')
            ->with('countries', $countries)
            ->with('succesaalert', $succesaalert);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Countries", "index", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'country_name' => ['required', 'unique:countries'],
            'country_code' => ['required', 'unique:countries'],
        ]);

        try {
            Country::create($request->all());
            $countries = Country::all();
            $succesaalert = 1;
            return view('/frontend/admin/countries/index')
                ->with('countries', $countries)
                ->with('succesaalert', $succesaalert);
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), 'CountriesController', 'store', $exception->getMessage(), $request->ip(), Auth::id());
            return view('/frontend/admin/admin/index');
        }
    }

    public function edit($id)
    {
      try {
        $country = Country::find($id);
        return view('/frontend/admin/countries/edit')
            ->with('country', $country);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Countries", "edit", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }
    }

    public function update($id, Request $request)
    {
      $this->validate($request, [
          'country_name' => ['required', 'unique:countries'],
          'country_code' => ['required', 'unique:countries'],
      ]);
        try {
            $country = Country::find($id);
            $country->update($request->all());
            $countries = Country::all();
            $succesaalert = 1;
            return view('/frontend/admin/countries/index')
                ->with('countries', $countries)
                ->with('succesaalert', $succesaalert);
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), 'CountriesController', 'store', $exception->getMessage(), $request->ip(), Auth::id());
            return view('/frontend/admin/admin/index');
        }


    }
}
