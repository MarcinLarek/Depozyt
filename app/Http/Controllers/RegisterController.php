<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\ConfirmEmail;
use App\Models\User;
use App\Services\UsersService;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PharIo\Manifest\Email;

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
            $failstatus = 0;
        } catch (\Exception $ex) {
            $failstatus = 1;
            var_dump($ex->getMessage());
            die;
            saveException(sqlDateTime(), "Register", "Register", $ex->getMessage(), $request->ip());
        }
        return view("/frontend/register/index", compact('failstatus'));
    }


    public function checkEmail(Request $request)
    {
        $isExist = false;
        $email = $request->input->post('email');
        try {
            if (User::where('email', $email)->count()) {
                $isExist = true;
            }
        } catch (\Exception $ex) {
            saveException(date('Y-m-d H:m:s'), "Register", "CheckEmail", $ex->getMessage());
        }

        return $isExist;
    }
}
