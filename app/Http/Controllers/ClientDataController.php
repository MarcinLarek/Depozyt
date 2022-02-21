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
        $request->validate([
            'name' => ['required','max:100'],
            'surname' => ['required','max:100'],
            'pesel' => ['required','PESEL'],
            'document_type' => ['required'],
            'document_number' => ['required','numeric'],
            'email' => ['required','email','max:100'],
            'phone' => ['required','numeric',],
            'street' => ['required','max:100'],
            'post_code' => ['required','max:100','post_code'],
            'city' => ['required','max:100'],
        ]);

        try {
          $data = array(
            'name' => $request['name'],
            'surname' => $request['surname'],
            'pesel' => $request['pesel'],
            'document_type' => $request['document_type'],
            'document_number' => $request['document_number'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'street' => $request['street'],
            'post_code' => $request['post_code'],
            'city' => $request['city']
          );
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
