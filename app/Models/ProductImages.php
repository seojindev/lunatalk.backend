<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductImages
 *
 * @property int $id
 * @property int $product_id 상품 고유값.
 * @property string|null $media_category 이미지 카테고리.
 * @property int|null $media_id 제품 썸네일 이미지.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Codes|null $category
 * @property-read \App\Models\MediaFiles|null $mediafile
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereMediaCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereProductId($value)
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

    public function category()
    {
        return $this->hasOne('App\Models\Codes', 'code_id', 'media_category');
    }

    public function mediafile()
    {
        return $this->hasOne('App\Models\MediaFiles', 'id', 'media_id');
    }
}
