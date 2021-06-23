<?php

namespace App\Repositories;

use App\Models\UserPhoneVerify;
use App\Models\User;

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
     * @var User
     */
    protected User $user;

    /**
     * AuthRepository constructor.
     * @param UserPhoneVerify $userPhoneVerify
     * @param User $user
     */
    public function __construct(UserPhoneVerify $userPhoneVerify, User $user)
    {
        $this->UserPhoneVerify = $userPhoneVerify;
        $this->user = $user;
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

    /**
     * 사용자 id 필드 업데이트
     * @param Int $id
     * @param String $user_id
     * @return bool
     */
    public function updateUserPhoneVerifyUserId(Int $id, String $user_id) : bool
    {
        return $this->UserPhoneVerify::where('id', $id)->update([
            'user_id' => $user_id
        ]);
    }

    /**
     * 회원 가입.
     * @param array $dataObject
     * @return object
     */
    public function createUser(Array $dataObject) : object
    {
        return $this->user::create($dataObject);
    }

    /**
     * 로그인 아이디로 사용자 검색.
     * @param String $login_id
     * @return object
     */
    public function findUserByLoginId(String $login_id) : object
    {
        return $this->user::where('login_id', $login_id)->firstOrFail();
    }
}
