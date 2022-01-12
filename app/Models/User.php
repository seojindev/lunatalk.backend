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
 * @property string $uuid 회원 uuid
 * @property \App\Models\Codes|null $client 회원 타입
 * @property \App\Models\Codes|null $type 회원 타입
 * @property \App\Models\Codes|null $level 회원 레벨
 * @property string $login_id 로그인 아이디
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \App\Models\Codes|null $status 회원 상태.
 * @property string $active 회원 상태
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \App\Models\UserMemo|null $memo
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\PhoneVerifies|null $phone_verifies
 * @property-read Collection|Token[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\UserRegisterSelects|null $user_select
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static Builder|User query()
 * @method static Builder|User whereActive($value)
 * @method static Builder|User whereClient($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLevel($value)
 * @method static Builder|User whereLoginId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereType($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin Eloquent
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
    public function type(): HasOne {
        return $this->hasOne('App\Models\Codes' , 'code_id', 'type');
    }

    /**
     * @return HasOne
     */
    public function level(): HasOne {
        return $this->hasOne('App\Models\Codes' , 'code_id', 'level');
    }

    /**
     * @return HasOne
     */
    public function status(): HasOne {
        return $this->hasOne('App\Models\Codes' , 'code_id', 'status');
    }

    /**
     * @return HasOne
     */
    public function client(): HasOne {
        return $this->hasOne('App\Models\Codes' , 'code_id', 'client');
    }

    /**
     * @return HasOne
     */
    public function user_select(): HasOne {
        return $this->hasOne('App\Models\UserRegisterSelects', 'user_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function phone_verifies(): HasOne {
        return $this->hasOne('App\Models\PhoneVerifies', 'user_id', 'id')->where('verified', 'Y')->orderBy('id', 'desc');
    }

    /**
     * @return HasOne
     */
    public function memo(): HasOne {
        return $this->hasOne('App\Models\UserMemo', 'user_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function address(): HasOne {
        return $this->hasOne('App\Models\UserAddress', 'user_id', 'id');
    }
}
