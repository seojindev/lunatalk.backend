<?php

namespace App\Models;

use Database\Factories\PhoneVerifiesFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\PhoneVerifies
 *
 * @property int $id
 * @property string $uuid uuid
 * @property int|null $user_id 회원 번호
 * @property string $phone_number 인증 전화 번호
 * @property string $auth_code 인증 코드
 * @property string|null $verified 인증 상태
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static \Database\Factories\PhoneVerifiesFactory factory(...$parameters)
 * @method static Builder|PhoneVerifies newModelQuery()
 * @method static Builder|PhoneVerifies newQuery()
 * @method static \Illuminate\Database\Query\Builder|PhoneVerifies onlyTrashed()
 * @method static Builder|PhoneVerifies query()
 * @method static Builder|PhoneVerifies whereAuthCode($value)
 * @method static Builder|PhoneVerifies whereCreatedAt($value)
 * @method static Builder|PhoneVerifies whereDeletedAt($value)
 * @method static Builder|PhoneVerifies whereId($value)
 * @method static Builder|PhoneVerifies wherePhoneNumber($value)
 * @method static Builder|PhoneVerifies whereUpdatedAt($value)
 * @method static Builder|PhoneVerifies whereUserId($value)
 * @method static Builder|PhoneVerifies whereUuid($value)
 * @method static Builder|PhoneVerifies whereVerified($value)
 * @method static \Illuminate\Database\Query\Builder|PhoneVerifies withTrashed()
 * @method static \Illuminate\Database\Query\Builder|PhoneVerifies withoutTrashed()
 * @mixin Eloquent
 */
class PhoneVerifies extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'phone_number',
        'auth_code',
        'verified',
        'created_at',
    ];
}
