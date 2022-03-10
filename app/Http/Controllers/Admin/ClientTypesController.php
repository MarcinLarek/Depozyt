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
        return view('/frontend/admin/client-types/index')
            ->with('clientTypes', $clientTypes);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-ClientTypes", "index", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('admin.siteerror');
              }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'unique:client_types'],
        ]);

        try {
            ClientType::create($request->all());
            return redirect()->route('admin.client-types')->with('successalert','successalert');
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), 'Admin-ClientTypes', 'store', $exception->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
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
                  return redirect()->route('admin.siteerror');
              }
    }

    public function update($id, Request $request)
    {
      $this->validate($request, [
          'name' => ['required', 'unique:client_types'],
      ]);
        try {
            $clientType = ClientType::find($id);
            $clientType->update($request->all());
            $clientTypes = ClientType::all();
            return redirect()->route('admin.client-types')->with('successalert','successalert');
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), 'Admin-ClientTypes', 'store', $exception->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }

}
