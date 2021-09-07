<?php

namespace App\Models;

use Database\Factories\ProductOptionsFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
 * @method static \Database\Factories\ProductOptionsFactory factory(...$parameters)
 * @method static Builder|ProductOptions newModelQuery()
 * @method static Builder|ProductOptions newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductOptions onlyTrashed()
 * @method static Builder|ProductOptions query()
 * @method static Builder|ProductOptions whereActive($value)
 * @method static Builder|ProductOptions whereColor($value)
 * @method static Builder|ProductOptions whereCreatedAt($value)
 * @method static Builder|ProductOptions whereDeletedAt($value)
 * @method static Builder|ProductOptions whereId($value)
 * @method static Builder|ProductOptions whereProductUuid($value)
 * @method static Builder|ProductOptions whereUpdatedAt($value)
 * @method static Builder|ProductOptions whereWired($value)
 * @method static \Illuminate\Database\Query\Builder|ProductOptions withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductOptions withoutTrashed()
 * @mixin Eloquent
 * @property int $product_id 상품 id
 * @property int|null $wireless 유무선.
 * @method static Builder|ProductOptions whereProductId($value)
 * @method static Builder|ProductOptions whereWireless($value)
 */
class ProductOptions extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'product_id',
        'color',
        'wireless',
        'active'
    ];

    /**
     * @return HasOne
     */
    public function color()
    {
        return $this->hasOne(ProductColorOptionMasters::class, 'id', 'color');
    }

    /**
     * @return HasOne
     */
    public function wireless()
    {
        return $this->hasOne(ProductWirelessOptionMasters::class, 'id' , 'wireless');
    }
}
