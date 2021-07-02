<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\HomeMains
 *
 * @property int $id
 * @property int $product_id 상품 고유값.
 * @property int|null $media_id 이미지 아이디.
 * @property string $status 상태.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains query()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Database\Factories\HomeMainsFactory factory(...$parameters)
 * @property-read \App\Models\MediaFiles|null $media_file
 * @property-read \App\Models\Products|null $product
 * @property \App\Models\Codes|null $gubun 구분.
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains whereGubun($value)
 */
class HomeMains extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'gubun',
        'product_id',
        'media_id',
        'status'
    ];

    /**
     * 구분값 관계.
     * @return HasOne
     */
    public function gubun() : HasOne
    {
        return $this->hasOne('App\Models\Codes', 'code_id', 'gubun');
    }

    /**
     * 상품 관계.
     * @return HasOne
     */
    public function product() : HasOne
    {
        return $this->hasOne('App\Models\Products', 'id', 'product_id');
    }

    /**
     * 이미지 관계.
     * @return HasOne
     */
    public function media_file() : HasOne
    {
        return $this->hasOne('App\Models\MediaFiles', 'id', 'media_id');
    }
}
