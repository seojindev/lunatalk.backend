<?php

namespace App\Models;

use Database\Factories\ProductOptionMastersFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductOptionMasters
 *
 * @property int $id
 * @property string $product_uuid 상품 uuid
 * @property int $color 상품 색.
 * @property int|null $wired 유무선.
 * @property string $active 상태
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static \Database\Factories\ProductOptionMastersFactory factory(...$parameters)
 * @method static Builder|ProductOptionMasters newModelQuery()
 * @method static Builder|ProductOptionMasters newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductOptionMasters onlyTrashed()
 * @method static Builder|ProductOptionMasters query()
 * @method static Builder|ProductOptionMasters whereActive($value)
 * @method static Builder|ProductOptionMasters whereColor($value)
 * @method static Builder|ProductOptionMasters whereCreatedAt($value)
 * @method static Builder|ProductOptionMasters whereDeletedAt($value)
 * @method static Builder|ProductOptionMasters whereId($value)
 * @method static Builder|ProductOptionMasters whereProductUuid($value)
 * @method static Builder|ProductOptionMasters whereUpdatedAt($value)
 * @method static Builder|ProductOptionMasters whereWired($value)
 * @method static \Illuminate\Database\Query\Builder|ProductOptionMasters withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductOptionMasters withoutTrashed()
 * @mixin Eloquent
 */
class ProductOptionMasters extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'product_uuid',
        'color',
        'wireless',
        'active'
    ];
}
