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
        $succesalert = 0;
        return view('/frontend/admin/countries/index')
            ->with('countries', $countries)
            ->with('succesalert', $succesalert);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Countries", "index", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('admin.siteerror');
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
            return redirect()->route('admin.countries')->with('successalert','successalert');
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), 'CountriesController', 'store', $exception->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
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
                  return redirect()->route('admin.siteerror');
              }
    }

    public function update($id, Request $request)
    {
      $country = Country::find($id);

      if ($country['country_name'] == $request['country_name'] && $country['country_code'] == $request['country_code'])
      {
        $this->validate($request, [
            'country_name' => ['required'],
            'country_code' => ['required']
        ]);
      }
      elseif ($country['country_name'] == $request['country_name'])
      {
        $this->validate($request, [
            'country_name' => ['required'],
            'country_code' => ['required', 'unique:countries']
        ]);
      }
      elseif ($country['country_code'] == $request['country_code'])
      {
        $this->validate($request, [
        'country_name' => ['required', 'unique:countries'],
        'country_code' => ['required']
        ]);
      }
      else
      {
        $this->validate($request, [
            'country_name' => ['required', 'unique:countries'],
            'country_code' => ['required', 'unique:countries']
        ]);
      }


        try {
          $data = array(
            'country_name' => $request['country_name'],
            'country_code' => $request['country_code'],
           );
            $country->update($data);
            return redirect()->route('admin.countries')->with('successalert','successalert');
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), 'CountriesController', 'store', $exception->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }


    }
}
