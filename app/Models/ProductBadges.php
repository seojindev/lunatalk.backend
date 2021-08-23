<?php

namespace App\Models;

use Database\Factories\ProductBadgesFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductBadges
 *
 * @property int $id
 * @property string $product_uuid 상품 uuid
 * @property int $badge_id 뱃지 아이디.
 * @property string $active 상태
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static \Database\Factories\ProductBadgesFactory factory(...$parameters)
 * @method static Builder|ProductBadges newModelQuery()
 * @method static Builder|ProductBadges newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductBadges onlyTrashed()
 * @method static Builder|ProductBadges query()
 * @method static Builder|ProductBadges whereActive($value)
 * @method static Builder|ProductBadges whereBadgeId($value)
 * @method static Builder|ProductBadges whereCreatedAt($value)
 * @method static Builder|ProductBadges whereDeletedAt($value)
 * @method static Builder|ProductBadges whereId($value)
 * @method static Builder|ProductBadges whereProductUuid($value)
 * @method static Builder|ProductBadges whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProductBadges withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductBadges withoutTrashed()
 * @mixin Eloquent
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
