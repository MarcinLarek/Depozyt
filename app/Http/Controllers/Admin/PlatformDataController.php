<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlatformData;
use Illuminate\Http\Request;

class PlatformDataController extends Controller
{
    public function index()
    {
      try {
        $platformData = PlatformData::first();
        if (empty($platformData)) {
            $platformData = PlatformData::make();
        }

        return view('/frontend/admin/platform-data/index')
            ->with('platformData', $platformData);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-PlatformData", "index", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }
    }

    public function update(Request $request)
    {
      try {
        if (PlatformData::count() == 0) {
            PlatformData::create($request->all());
        } else {
            PlatformData::first()->update($request->all());
        }

        return redirect()->route('admin.platform-data');
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-PlatformData", "update", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }

    }
}
