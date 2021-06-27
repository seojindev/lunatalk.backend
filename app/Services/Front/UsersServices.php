<?php


namespace App\Services\Front;

use App\Repositories\UserRepository;

class UsersServices
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function gneratorUsersList()
    {

    }

    public function usersList() : array
    {
        return [];
    }
}
