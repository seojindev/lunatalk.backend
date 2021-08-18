<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Passport\Client;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Token;


/**
 * App\Models\User
 *
 * @property int $id
 * @property string $user_uuid 회원 uuid
 * @property Codes|null $user_type 회원 타입
 * @property Codes|null $user_level 회원 레벨
 * @property Codes|null $user_state 회원 상태.
 * @property string $login_id
 * @property string $nickname 회원 닉네임
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string $phone_number 회원 휴대폰 번호.
 * @property string $active 회원 상태
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Client[] $clients
 * @property-read int|null $clients_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereActive($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLoginId($value)
 * @method static Builder|User whereNickname($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhoneNumber($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereUserLevel($value)
 * @method static Builder|User whereUserState($value)
 * @method static Builder|User whereUserType($value)
 * @method static Builder|User whereUserUuid($value)
 * @mixin Eloquent
 * @property string $uuid 회원 uuid
 * @property string $type 회원 타입
 * @property string $level 회원 레벨
 * @property string $login_name 로그인
 * @property string $client 회원 타입
 * @property string $name
 * @property string|null $deleted_at
 * @method static Builder|User whereClient($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereLevel($value)
 * @method static Builder|User whereLoginName($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereType($value)
 * @method static Builder|User whereUuid($value)
 * @property string $user_id 로그인
 * @method static Builder|User whereUserId($value)
 * @property string $status 회원 상태.
 * @method static Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'client',
        'type',
        'level',
        'login_id',
        'name',
        'email',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $login_id
     * @return User|Builder|Model|object|null
     */
    public function findForPassport($login_id) {
        return $this->where('login_id', $login_id)->first();
    }

    /**
     * @return HasOne
     */
    public function user_type(): HasOne
    {
        return $this->hasOne('App\Models\Codes' , 'code_id', 'type');
    }

    /**
     * @return HasOne
     */
    public function user_level(): HasOne
    {
        return $this->hasOne('App\Models\Codes' , 'code_id', 'level');
    }

    /**
     * @return HasOne
     */
    public function user_state(): HasOne
    {
        return $this->hasOne('App\Models\Codes' , 'code_id', 'state');
    }
}
