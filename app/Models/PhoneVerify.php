<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PhoneVerify
 *
 * @method static \Database\Factories\PhoneVerifyFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerify newQuery()
 * @method static \Illuminate\Database\Query\Builder|PhoneVerify onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerify query()
 * @method static \Illuminate\Database\Query\Builder|PhoneVerify withTrashed()
 * @method static \Illuminate\Database\Query\Builder|PhoneVerify withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $user_id 회원 번호
 * @property string $phone_number 인증 전화 번호
 * @property string $auth_code 인증 코드
 * @property string|null $verified 인증 상태
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerify whereAuthCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerify whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerify wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerify whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerify whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerify whereVerified($value)
 */
class PhoneVerify extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'phone_number',
        'auth_code',
        'verified',
    ];
}
