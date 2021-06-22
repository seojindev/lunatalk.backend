<?php


namespace App\Repositories;


use App\Models\MediaFiles;
use App\Models\UserPhoneVerify;

/**
 * Class AuthRepository
 * @package App\Repositories
 */
class AuthRepository implements AuthRepositoryInterface
{
    /**
     * @var UserPhoneVerify
     */
    protected UserPhoneVerify $UserPhoneVerify;

    /**
     * AuthRepository constructor.
     * @param UserPhoneVerify $userPhoneVerify
     */
    public function __construct(UserPhoneVerify $userPhoneVerify)
    {
        $this->UserPhoneVerify = $userPhoneVerify;
    }

    /**
     * 인증 생성.
     * @param array $dataObject
     * @return object
     */
    public function createUserPhoneVerify(Array $dataObject) : object
    {
        return $this->UserPhoneVerify::create($dataObject);
    }

    /**
     * 인증 정보 확인.
     * @param Int $id
     * @return object
     */
    public function findUserPhoneVerify(Int $id) : object
    {
        return $this->UserPhoneVerify::where('id', $id)->firstOrFail();
    }

    /**
     * 인증 완료 처리.
     * @param Int $id
     * @param String $verified
     * @return bool
     */
    public function updateUserPhoneVerifyVerified(Int $id, String $verified) : bool
    {
        return $this->UserPhoneVerify::where('id', $id)->update([
            'verified' => $verified
        ]);
    }
}
