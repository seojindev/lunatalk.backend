<?php

namespace App\Models;

use Database\Factories\ProductReviewsFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductReviews
 *
 * @property int $id
 * @property string $product_uuid 상품 uuid
 * @property int|null $user_id 회원 번호
 * @property string $contents 리뷰 내용.
 * @property string $active 상태
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static \Database\Factories\ProductReviewsFactory factory(...$parameters)
 * @method static Builder|ProductReviews newModelQuery()
 * @method static Builder|ProductReviews newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductReviews onlyTrashed()
 * @method static Builder|ProductReviews query()
 * @method static Builder|ProductReviews whereActive($value)
 * @method static Builder|ProductReviews whereContents($value)
 * @method static Builder|ProductReviews whereCreatedAt($value)
 * @method static Builder|ProductReviews whereDeletedAt($value)
 * @method static Builder|ProductReviews whereId($value)
 * @method static Builder|ProductReviews whereProductUuid($value)
 * @method static Builder|ProductReviews whereUpdatedAt($value)
 * @method static Builder|ProductReviews whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|ProductReviews withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductReviews withoutTrashed()
 * @mixin Eloquent
 * @property int|null $product_id 상품 uuid
 * @method static Builder|ProductReviews whereProductId($value)
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
