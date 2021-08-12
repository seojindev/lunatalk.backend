<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\UserRegisterSelects
 *
 * @property int $id
 * @property int|null $user_id 회원 번호
 * @property string|null $email 이메일 수신 동의 여부.
 * @property string|null $message 문자 수신 동의 여부.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegisterSelects newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegisterSelects newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserRegisterSelects onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegisterSelects query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegisterSelects whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegisterSelects whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegisterSelects whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegisterSelects whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegisterSelects whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegisterSelects whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegisterSelects whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|UserRegisterSelects withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserRegisterSelects withoutTrashed()
 * @mixin \Eloquent
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
