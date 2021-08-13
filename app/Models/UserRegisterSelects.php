<?php

namespace App\Models;

use Database\Factories\UserRegisterSelectsFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserRegisterSelects
 *
 * @property int $id
 * @property int|null $user_id 회원 번호
 * @property string|null $email 이메일 수신 동의 여부.
 * @property string|null $message 문자 수신 동의 여부.
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|UserRegisterSelects newModelQuery()
 * @method static Builder|UserRegisterSelects newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserRegisterSelects onlyTrashed()
 * @method static Builder|UserRegisterSelects query()
 * @method static Builder|UserRegisterSelects whereCreatedAt($value)
 * @method static Builder|UserRegisterSelects whereDeletedAt($value)
 * @method static Builder|UserRegisterSelects whereEmail($value)
 * @method static Builder|UserRegisterSelects whereId($value)
 * @method static Builder|UserRegisterSelects whereMessage($value)
 * @method static Builder|UserRegisterSelects whereUpdatedAt($value)
 * @method static Builder|UserRegisterSelects whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|UserRegisterSelects withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserRegisterSelects withoutTrashed()
 * @mixin Eloquent
 * @method static UserRegisterSelectsFactory factory(...$parameters)
 */
class UserRegisterSelects extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'email',
        'message',
    ];
}
