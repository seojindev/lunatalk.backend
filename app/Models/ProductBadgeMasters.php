<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProductBadgeMasters
 *
 * @property int $id
 * @property string $name 뱃지 이름
 * @property int|null $media_id 메디아 파일 아이디.
 * @property string $active 상태.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\ProductBadgeMastersFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadgeMasters newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadgeMasters newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductBadgeMasters onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadgeMasters query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadgeMasters whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadgeMasters whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadgeMasters whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadgeMasters whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadgeMasters whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadgeMasters whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadgeMasters whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProductBadgeMasters withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductBadgeMasters withoutTrashed()
 * @mixin \Eloquent
 */
class ProductBadgeMasters extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'media_id',
        'active'
    ];
}
