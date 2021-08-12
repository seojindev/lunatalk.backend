<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PhoneVerify
 *
 * @method static \Database\Factories\PhoneVerifiesFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerifies newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerifies newQuery()
 * @method static \Illuminate\Database\Query\Builder|PhoneVerifies onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerifies query()
 * @method static \Illuminate\Database\Query\Builder|PhoneVerifies withTrashed()
 * @method static \Illuminate\Database\Query\Builder|PhoneVerifies withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $user_id 회원 번호
 * @property string $phone_number 인증 전화 번호
 * @property string $auth_code 인증 코드
 * @property string|null $verified 인증 상태
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerifies whereAuthCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerifies whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerifies whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerifies whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerifies wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerifies whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerifies whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneVerifies whereVerified($value)
 */
class PhoneVerifies extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'phone_number',
        'auth_code',
        'verified',
    ];
}
