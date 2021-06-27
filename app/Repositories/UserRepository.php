<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function selectTotalUserList() : object
    {
        return $this->user::all();
    }
}
