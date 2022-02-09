<?php


namespace App\Repositories;


use App\Models\User;

interface UsersRepositoryInterface
{
    public function create(array $data): User;

    public function getByEmail(string $email): User;

    public function getById(int $id): User;

    public function getByUsername(string $username): User;
}
