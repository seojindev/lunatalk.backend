<?php

namespace App\Models;

use Database\Factories\ProductCategoriesFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductCategory
 *
 * @property string $id uuid
 * @property string $name
 * @property string $active 상태
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static ProductCategoriesFactory factory(...$parameters)
 * @method static Builder|ProductCategories newModelQuery()
 * @method static Builder|ProductCategories newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductCategories onlyTrashed()
 * @method static Builder|ProductCategories query()
 * @method static Builder|ProductCategories whereActive($value)
 * @method static Builder|ProductCategories whereCreatedAt($value)
 * @method static Builder|ProductCategories whereDeletedAt($value)
 * @method static Builder|ProductCategories whereId($value)
 * @method static Builder|ProductCategories whereName($value)
 * @method static Builder|ProductCategories whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProductCategories withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductCategories withoutTrashed()
 * @mixin Eloquent
 */
class ProductCategories extends Model
{
    use HasFactory, SoftDeletes;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'code',
        'name',
    ];
}
