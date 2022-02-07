<?php


namespace App\Repositories;


use App\Models\User;

class UsersRepository implements UsersRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function getByEmail(string $email): User
    {
        $user = User::where('email', $email)->first();
        if (is_null($user)) {
            throw new \Exception('User with email address ' . $email . ' not exists');
        }
        return $user;
    }

    public function getById(int $id): User
    {
        $user = User::find($id);
        if (is_null($user)) {
            throw new \Exception('User with id ' . $id . ' not exists');
        }
        return $user;
    }

    public function getByUsername(string $username): User
    {
        $user = User::where('username', $username)->first();
        if (is_null($user)) {
            throw new \Exception('User with email address ' . $email . ' not exists');
        }
        return $user;
    }
}
