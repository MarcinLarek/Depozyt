<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientTypesController extends Controller
{
    public function index()
    {
      try {
        $clientTypes = ClientType::all();
        $succesaalert = 0;
        return view('/frontend/admin/client-types/index')
            ->with('clientTypes', $clientTypes)
            ->with('succesaalert', $succesaalert);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-ClientTypes", "index", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'unique:client_types'],
        ]);

        try {
            ClientType::create($request->all());
            $clientTypes = ClientType::all();
            $succesaalert = 1;
            return view('/frontend/admin/client-types/index')
                ->with('clientTypes', $clientTypes)
                ->with('succesaalert', $succesaalert);
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), 'Admin-ClientTypes', 'store', $exception->getMessage(), $request->ip(), Auth::id());
            return view('/frontend/admin/admin/index');
        }
    }

    public function edit($id)
    {
      try {
        $clientType = ClientType::find($id);
        return view('/frontend/admin/client-types/edit')
            ->with('clientType', $clientType);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-ClientTypes", "edit", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }
    }

    public function update($id, Request $request)
    {
        try {
            $clientType = ClientType::find($id);
            $clientType->update($request->all());
            $clientTypes = ClientType::all();
            $succesaalert = 1;
            return view('/frontend/admin/client-types/index')
                ->with('clientTypes', $clientTypes)
                ->with('succesaalert', $succesaalert);
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), 'Admin-ClientTypes', 'store', $exception->getMessage(), $request->ip(), Auth::id());
            return view('/frontend/admin/admin/index');
        }
    }

}
