<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyDataRequest;
use App\Http\Requests\RepresentativeRequest;
use App\Models\CompanyData;
use App\Models\Representative;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Promise\all;

class CompanyDataController extends Controller
{
    public function index()
    {
        try {
            $companyData = Auth::user()->companyData()->first();
            if (empty($companyData)) {
                $companyData = CompanyData::make();
            }
            $succesaalert = 0;
            return View("/frontend/company-data/index")
            ->with('companyData', $companyData)
            ->with('succesaalert', $succesaalert);
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "CompanyData", "index", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('siteerror');
        }
    }

    public function edit(companyDataRequest $request)
    {
        try {
            $companyData = Auth::user()->companyData();
            if ($companyData->count() != 0) {
                $companyData->first()->update($request->all());
            } else {
                $companyData->create($request->all());
            }

            $companyData = Auth::user()->companyData()->first();
            if (empty($companyData)) {
                $companyData = CompanyData::make();
            }
            return redirect()->route('company-data')->with('succesaalert', 'succesaalert');
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "CompanyData", "edit", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('siteerror');
        }
    }
}
