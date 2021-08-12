<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProductBadges
 *
 * @property int $id
 * @property string $product_uuid 상품 uuid
 * @property int $badge_id 뱃지 아이디.
 * @property string $active 상태
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\ProductBadgesFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadges newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadges newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductBadges onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadges query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadges whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadges whereBadgeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadges whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadges whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadges whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadges whereProductUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBadges whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProductBadges withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductBadges withoutTrashed()
 * @mixin \Eloquent
 */
class ProductBadges extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'product_uuid',
        'badge_id',
        'active'
    ];
}
