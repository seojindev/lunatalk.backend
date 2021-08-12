<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProductImages
 *
 * @property int $id
 * @property string $product_uuid 상품 uuid
 * @property string|null $media_category 이미지 카테고리.
 * @property int|null $media_id 제품 썸네일 이미지.
 * @property string $active 상태.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\ProductImagesFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductImages onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereMediaCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereProductUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProductImages withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductImages withoutTrashed()
 * @mixin \Eloquent
 */
class ProductImages extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'product_uuid',
        'media_category',
        'media_id',
        'active'
    ];
}
