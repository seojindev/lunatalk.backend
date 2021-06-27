<?php


namespace App\Services\Front;

use App\Repositories\UserRepository;
use Helper;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserServices
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * 휴대폰 번호 복호화.
     * @param String $encrptString
     * @return string
     */
    protected static function phoneNumberDecrypt(String $encrptString) : string
    {
        return Crypt::decryptString($encrptString);
    }

    /**
     * 사용자 리스트 생성.
     * @param array $userList
     * @return array
     */
    public function gneratorUsersList(Array $userList) : array
    {
        return array_map(function($user) {
            $phoneNumber = self::phoneNumberDecrypt($user['phone_number']);
            return [
                'user_uuid' => $user['user_uuid'],
                'user_type' => [
                    'code_id' => $user['user_type']['code_id'],
                    'code_name' => $user['user_type']['code_name'],
                ],
                'user_level' => [
                    'code_id' => $user['user_level']['code_id'],
                    'code_name' => $user['user_level']['code_name'],
                ],
                'user_state' => [
                    'code_id' => $user['user_state']['code_id'],
                    'code_name' => $user['user_state']['code_name'],
                ],
                'login_id' => $user['login_id'],
                'nickname' => $user['nickname'],
                'email' => $user['email'],
                'phone_number' => [
                    'step1' => $phoneNumber,
                    'step2' => Helper::phoneNumberAddHyphen($phoneNumber),
                ],
                'user_date' => [
                    'create_at' => Carbon::parse($user['created_at'])->format('Y년 m월 d일'),
                    'create_at_time' => $user['created_at'],
                    'update_at' => Carbon::parse($user['updated_at'])->format('Y년 m월 d일'),
                    'update_at_time' => $user['updated_at'],
                ]
            ];
        }, $userList);
    }

    /**
     * 회원 리스트 처리.
     * @return array
     */
    public function usersList() : array
    {
        return $this->gneratorUsersList($this->userRepository->selectTotalUserList());
    }
}
