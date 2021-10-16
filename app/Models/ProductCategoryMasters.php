<?php

namespace App\Models;

use Database\Factories\ProductCategoryMastersFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductCategoryMasters
 *
 * @property int $id
 * @property string $uuid uuid
 * @property string $name
 * @property string $active 상태
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|\App\Models\ProductMasters[] $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\ProductCategoryMastersFactory factory(...$parameters)
 * @method static Builder|ProductCategoryMasters newModelQuery()
 * @method static Builder|ProductCategoryMasters newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductCategoryMasters onlyTrashed()
 * @method static Builder|ProductCategoryMasters query()
 * @method static Builder|ProductCategoryMasters whereActive($value)
 * @method static Builder|ProductCategoryMasters whereCreatedAt($value)
 * @method static Builder|ProductCategoryMasters whereDeletedAt($value)
 * @method static Builder|ProductCategoryMasters whereId($value)
 * @method static Builder|ProductCategoryMasters whereName($value)
 * @method static Builder|ProductCategoryMasters whereUpdatedAt($value)
 * @method static Builder|ProductCategoryMasters whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|ProductCategoryMasters withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductCategoryMasters withoutTrashed()
 * @mixin Eloquent
 */
class ProductCategoryMasters extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'uuid',
        'code',
        'name',
    ];

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(ProductMasters::class, 'category' , 'id');
    }

    /**
     * @return HasOne
     */
    public function random_products(): HasOne {
        return $this->hasOne(ProductMasters::class, 'category', 'id')->inRandomOrder();
    }
}
