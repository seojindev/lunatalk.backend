<?php

namespace App\Models;

use Database\Factories\ProductImagesFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductImages
 *
 * @property int $id
 * @property string $product_uuid 상품 uuid
 * @property string|null $media_category 이미지 카테고리.
 * @property int|null $media_id 제품 썸네일 이미지.
 * @property string $active 상태.
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static \Database\Factories\ProductImagesFactory factory(...$parameters)
 * @method static Builder|ProductImages newModelQuery()
 * @method static Builder|ProductImages newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductImages onlyTrashed()
 * @method static Builder|ProductImages query()
 * @method static Builder|ProductImages whereActive($value)
 * @method static Builder|ProductImages whereCreatedAt($value)
 * @method static Builder|ProductImages whereDeletedAt($value)
 * @method static Builder|ProductImages whereId($value)
 * @method static Builder|ProductImages whereMediaCategory($value)
 * @method static Builder|ProductImages whereMediaId($value)
 * @method static Builder|ProductImages whereProductUuid($value)
 * @method static Builder|ProductImages whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProductImages withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductImages withoutTrashed()
 * @mixin Eloquent
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
