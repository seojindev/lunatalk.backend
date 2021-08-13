<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Codes
 *
 * @property int $id
 * @property string $group_id
 * @property string|null $code_id
 * @property string|null $group_name
 * @property string|null $code_name
 * @property string $active 사용 상태(사용중, 비사용)
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Codes newModelQuery()
 * @method static Builder|Codes newQuery()
 * @method static Builder|Codes query()
 * @method static Builder|Codes whereActive($value)
 * @method static Builder|Codes whereCodeId($value)
 * @method static Builder|Codes whereCodeName($value)
 * @method static Builder|Codes whereCreatedAt($value)
 * @method static Builder|Codes whereDeletedAt($value)
 * @method static Builder|Codes whereGroupId($value)
 * @method static Builder|Codes whereGroupName($value)
 * @method static Builder|Codes whereId($value)
 * @method static Builder|Codes whereUpdatedAt($value)
 * @mixin Eloquent
 */
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
