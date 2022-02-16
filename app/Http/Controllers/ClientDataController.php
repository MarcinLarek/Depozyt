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
        $succesaalert = 0;
        return View("/frontend/client-data/index")
            ->with('clientData', $clientData)
            ->with('succesaalert', $succesaalert);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "ClientData", "index", $ex->getMessage(), $request->ip(), Auth::id());
                  $error = 1;
                  return view("/frontend/home/index", compact('error'));
              }

    }

    public function edit(ClientDataRequest $request)
    {
        $data = $request->validated();
        try {
            $this->usersService->updateClientData(Auth::user(), $data);
            $clientData = Auth::user()->clientData;
            if (empty($clientData)) {
                $clientData = ClientData::make();
            }
            $succesaalert = 1;
            return View("/frontend/client-data/index")
                ->with('clientData', $clientData)
                ->with('succesaalert', $succesaalert);

        }
        catch (\Exception $ex) {
            saveException(sqlDateTime(), "ClientData", "edit", $ex->getMessage(), $request->ip(), Auth::id());
            $error = 1;
            return view("/frontend/home/index", compact('error'));
        }
    }
}
