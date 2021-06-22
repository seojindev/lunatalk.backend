<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserPhoneVerify
 *
 * @property int $id
 * @property int|null $user_id 회원 번호
 * @property string $phone_number 인증 전화 번호
 * @property string $auth_code 인증 코드
 * @property string|null $verified_at 인증 시간
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\UserPhoneVerifyFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify whereAuthCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify whereVerifiedAt($value)
 * @mixin \Eloquent
 */
class UserPhoneVerify extends Model
{
    use HasFactory;

    protected $table = 'users_phone_verify';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'user_id',
        'phone_number',
        'auth_code',
        'verified'
    ];
}
