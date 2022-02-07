<?php


namespace App\Utilities;


use App\Models\User;

class PersonalCodeGenerator
{
    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function generate(): string
    {
        return $this->userId . date('md');
    }
}
