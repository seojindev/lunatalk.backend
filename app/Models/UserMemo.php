<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\UserMemo
 *
 * @property int $id
 * @property int|null $user_id 회원 번호
 * @property string|null $memo 사용자 메모
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\UserMemoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMemo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMemo newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserMemo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMemo query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMemo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMemo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMemo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMemo whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMemo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMemo whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|UserMemo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserMemo withoutTrashed()
 * @mixin \Eloquent
 */
class UserMemo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'memo'
    ];
}
