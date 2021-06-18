<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductImages
 *
 * @package App\Models
 * @property int $id
 * @property int $product_id 상품 고유값.
 * @property int|null $product_image 제품 이미지.
 * @property int|null $product_thumbnail_image 제품 썸네일 이미지.
 * @property int|null $product_detail_image 제품 상세 이미지.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereProductDetailImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereProductImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereProductThumbnailImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductImages extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'products_images';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'product_id',
        'media_category',
        'media_id'
    ];
}
