<?php

namespace App\Models;

use Database\Factories\ProductCategoryMastersFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductCategories
 *
 * @property string $id uuid
 * @property string $name
 * @property string $active 상태
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static ProductCategoryMastersFactory factory(...$parameters)
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
 * @method static \Illuminate\Database\Query\Builder|ProductCategoryMasters withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductCategoryMasters withoutTrashed()
 * @mixin Eloquent
 * @property string $uuid uuid
 * @method static Builder|ProductCategoryMasters whereUuid($value)
 * @property-read Collection|ProductMasters[] $products
 * @property-read int|null $products_count
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
}