<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientDataRequest;
use App\Http\Requests\RepresentativeRequest;
use App\Models\ClientData;
use App\Models\Representative;
use App\Services\UsersService;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Promise\all;

class ClientDataController extends Controller
{
    private $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function index()
    {
      try {
        $clientData = Auth::user()->clientData;
        if (empty($clientData)) {
            $clientData = ClientData::make();
        }
        return View("/frontend/client-data/index")
            ->with('clientData', $clientData);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "ClientData", "index", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }

    }

    public function edit(ClientDataRequest $request)
    {
        $data = $request->validated();
        try {
            $this->usersService->updateClientData(Auth::user(), $data);
            return redirect()->back();
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "ClientData", "edit", $ex->getMessage(), $request->ip(), Auth::id());
            return view("/frontend/home/index");
        }
    }
}
