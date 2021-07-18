<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


/**
 * App\Models\User
 *
 * @property int $id
 * @property string $user_uuid 회원 uuid
 * @property \App\Models\Codes|null $user_type 회원 타입
 * @property \App\Models\Codes|null $user_level 회원 레벨
 * @property \App\Models\Codes|null $user_state 회원 상태.
 * @property string $login_id
 * @property string $nickname 회원 닉네임
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string $phone_number 회원 휴대폰 번호.
 * @property string $active 회원 상태
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
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
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_uuid',
        'user_type',
        'user_level',
        'user_state',
        'login_id',
        'nickname',
        'email',
        'password',
        'phone_number',
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
        return $this->hasOne('App\Models\Codes' , 'code_id', 'user_type');
    }

    /**
     * @return HasOne
     */
    public function user_level(): HasOne
    {
        return $this->hasOne('App\Models\Codes' , 'code_id', 'user_level');
    }

    /**
     * @return HasOne
     */
    public function user_state(): HasOne
    {
        return $this->hasOne('App\Models\Codes' , 'code_id', 'user_state');
    }
}
