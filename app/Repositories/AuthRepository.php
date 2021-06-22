<?php


namespace App\Repositories;


use App\Models\MediaFiles;
use App\Models\UserPhoneVerify;

class AuthRepository implements AuthRepositoryInterface
{

    protected UserPhoneVerify $UserPhoneVerify;

    public function __construct(UserPhoneVerify $userPhoneVerify)
    {
        $this->UserPhoneVerify = $userPhoneVerify;
    }

    public function createUserPhoneVerify(Array $dataObject) : object
    {
        return $this->UserPhoneVerify::create($dataObject);
    }
}
