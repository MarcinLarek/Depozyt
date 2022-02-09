<?php


namespace App\Services;


use App\Models\User;
use App\Notifications\ConfirmEmailNotification;
use App\Repositories\UsersRepositoryInterface;
use App\Utilities\PersonalCodeGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UsersService
{
    private $usersRepository;

    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function create(array $data)
    {
        $data['token'] = Hash::make($data['username'] . date('Ymdhmms') . config('app.name'));
        $generator = new PersonalCodeGenerator(1);
        $data['personal_code'] = Crypt::encryptString($generator->generate());
        $data['password'] = Hash::make($data['password']);
        $user = $this->usersRepository->create($data);
        $user->notify(new ConfirmEmailNotification($user));
    }

    public function loginUser(array $data): User
    {
        $user = $this->usersRepository->getByUsername($data['username']);
        $user->can('login');
        if (!Hash::check($data['password'], $user->getPassword())) {
            throw new \Exception('Invalid password');
        }
        return $user;
    }

    public function updateClientData(User $user, array $data)
    {
        $clientData = $user->clientData();
        if ($clientData->count() !== 0) {
            $clientData->update($data);
        } else {
            $clientData->create($data);
        }
    }
}
