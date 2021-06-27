<?php


namespace App\Repositories;

use App\Models\User;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    protected User $user;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * 회원 상세 리스트.
     * @return array
     */
    public function selectTotalUserList() : array
    {
        return $this->user::with(['user_type', 'user_level', 'user_state'])->get()->toArray();
    }
}
