<?php

namespace App\Models;

use Database\Factories\ProductBadgeMastersFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductBadgeMasters
 *
 * @property int $id
 * @property string $name 뱃지 이름
 * @property int|null $media_id 메디아 파일 아이디.
 * @property string $active 상태.
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static \Database\Factories\ProductBadgeMastersFactory factory(...$parameters)
 * @method static Builder|ProductBadgeMasters newModelQuery()
 * @method static Builder|ProductBadgeMasters newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductBadgeMasters onlyTrashed()
 * @method static Builder|ProductBadgeMasters query()
 * @method static Builder|ProductBadgeMasters whereActive($value)
 * @method static Builder|ProductBadgeMasters whereCreatedAt($value)
 * @method static Builder|ProductBadgeMasters whereDeletedAt($value)
 * @method static Builder|ProductBadgeMasters whereId($value)
 * @method static Builder|ProductBadgeMasters whereMediaId($value)
 * @method static Builder|ProductBadgeMasters whereName($value)
 * @method static Builder|ProductBadgeMasters whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProductBadgeMasters withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductBadgeMasters withoutTrashed()
 * @mixin Eloquent
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
