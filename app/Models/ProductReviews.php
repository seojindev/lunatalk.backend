<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProductReviews
 *
 * @property int $id
 * @property string $product_uuid 상품 uuid
 * @property int|null $user_id 회원 번호
 * @property string $contents 리뷰 내용.
 * @property string $active 상태
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\ProductReviewsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviews newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductReviews onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviews query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviews whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviews whereContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviews whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviews whereProductUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviews whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReviews whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|ProductReviews withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductReviews withoutTrashed()
 * @mixin \Eloquent
 */
class ProductReviews extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'product_uuid',
        'contents',
        'active'
    ];
}
