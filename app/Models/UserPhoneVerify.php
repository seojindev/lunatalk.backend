<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'verified_at'
    ];
}
