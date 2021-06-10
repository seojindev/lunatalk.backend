<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codes extends Model
{
    use HasFactory;

    /**
     * 공통 코드 테이블
     * @var string
     */
    protected $table = 'codes';

    /**
     * fillable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'group_id',
        'code_id',
        'group_name',
        'code_name'
    ];
}
