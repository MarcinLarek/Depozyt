<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\ConfirmEmail;
use App\Models\User;
use App\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\Email;
use App\Mail\RegisterConfirmation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    private $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function index()
    {
        return view("/frontend/register/index");
    }

    public function store(RegisterRequest $request)
    {

        $data = $request->validated();
        try {
            $this->usersService->create($data);
            $registersucces = 1;

            $uservar =  User::where('email',$request['email'])->first();
            Mail::to($request['email'])->send(new RegisterConfirmation($uservar));
            return redirect()->route('register')->with('registersucces','registersucces');

        }
        catch (\Exception $ex) {
            var_dump($ex->getMessage());
            die;
            saveException(sqlDateTime(), "Register", "Register", $ex->getMessage(), $request->ip());
            return redirect()->route('siteerror');
        }
    }

    public function confirmation($token)
    {
      try {
        $carbon = Carbon::now();
        $mytime = $carbon->format('Y-m-d H:i:s');
        $user =  User::where('personal_code',$token)->first();
        $data = array('email_verified_at' => $mytime , );
        $user->update($data);
        return redirect()->route('home')->with('confirmsuccess','confirmsuccess');
      }
      catch (\Exception $e) {
        saveException(sqlDateTime(), "Register", "confirmation", $ex->getMessage(), $request->ip(), Auth::id());
        return redirect()->route('siteerror');
      }

    }

}
