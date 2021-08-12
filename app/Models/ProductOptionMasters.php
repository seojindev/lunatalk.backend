<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProductOptionMasters
 *
 * @method static \Database\Factories\ProductOptionMastersFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptionMasters newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptionMasters newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductOptionMasters onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptionMasters query()
 * @method static \Illuminate\Database\Query\Builder|ProductOptionMasters withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductOptionMasters withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptionMasters whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptionMasters whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptionMasters whereUpdatedAt($value)
 * @property string $product_uuid 상품 uuid
 * @property int $color 상품 색.
 * @property int|null $wired 유무선.
 * @property string $active 상태
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptionMasters whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptionMasters whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptionMasters whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptionMasters whereProductUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptionMasters whereWired($value)
 */
class ProductOptionMasters extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'product_uuid',
        'color',
        'wired',
        'active'
    ];
}
