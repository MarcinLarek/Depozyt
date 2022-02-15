<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\ConfirmEmail;
use App\Models\User;
use App\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PharIo\Manifest\Email;
use App\Mail\RegisterConfirmation;
use Illuminate\Support\Carbon;

class RegisterController extends Controller
{
    private $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function index()
    {
      $registersucces = 0;
        return view("/frontend/register/index", compact('registersucces'));
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        try {
            $this->usersService->create($data);
            $registersucces = 1;

            $uservar =  User::where('email',$request['email'])->first();
            Mail::to($request['email'])->send(new RegisterConfirmation($uservar));
            return view("/frontend/register/index", compact('registersucces'));

        }
        catch (\Exception $ex) {
            var_dump($ex->getMessage());
            die;
            saveException(sqlDateTime(), "Register", "Register", $ex->getMessage(), $request->ip());
            $registersucces = 0;
            return view("/frontend/register/index");
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
        $error = 0;
          return view("/frontend/home/index", compact('error'));
      }
      catch (\Exception $e) {
        saveException(sqlDateTime(), "Register", "confirmation", $ex->getMessage(), $request->ip(), Auth::id());
        $error = 2;
        return view("/frontend/home/index", compact('error'));
      }

    }

    public function checkEmail(Request $request)
    {
        $isExist = false;
        $email = $request->input->post('email');
        try {
            if (User::where('email', $email)->count()) {
                $isExist = true;
            }
        }
        catch (\Exception $ex) {
            saveException(date('Y-m-d H:m:s'), "Register", "CheckEmail", $ex->getMessage());
        }

        return $isExist;
    }
}
