<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProductCategory
 *
 * @property string $id uuid
 * @property string $name
 * @property string $active 상태
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\ProductCategoriesFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategories newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductCategories onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategories query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategories whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategories whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategories whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategories whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProductCategories withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductCategories withoutTrashed()
 * @mixin \Eloquent
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
