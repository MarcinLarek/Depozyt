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
        return view('/frontend/admin/countries/index')
            ->with('countries', $countries);
      } catch (\Exception $ex) {
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
            return redirect()->route('admin.countries');
        } catch (\Exception $exception) {
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
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Countries", "edit", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }
    }

    public function update($id, Request $request)
    {
        try {
            $country = Country::find($id);
            $country->update($request->all());
            return redirect()->route('admin.countries')->with('success', $success);
        } catch (\Exception $exception) {
            saveException(sqlDateTime(), 'CountriesController', 'store', $exception->getMessage(), $request->ip(), Auth::id());
            return view('/frontend/admin/admin/index');
        }
        

    }
}
