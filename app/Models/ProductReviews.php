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
 * @property int|null $product_id 상품 id
 * @property int|null $user_id 회원 번호
 * @property int|null $review_id 원본 id.
 * @property string|null $title 리뷰 제목.
 * @property string $contents 리뷰 내용.
 * @property string $active 상태
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read ProductReviews|null $answer
 * @property-read \App\Models\ProductMasters|null $product
 * @property-read \App\Models\User|null $user
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
 * @method static Builder|ProductReviews whereProductId($value)
 * @method static Builder|ProductReviews whereReviewId($value)
 * @method static Builder|ProductReviews whereTitle($value)
 * @method static Builder|ProductReviews whereUpdatedAt($value)
 * @method static Builder|ProductReviews whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|ProductReviews withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductReviews withoutTrashed()
 * @mixin Eloquent
 */
class ProductReviews extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'product_id',
        'user_id',
        'review_id',
        'title',
        'contents',
        'active'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function product()
    {
        return $this->hasOne(ProductMasters::class, 'id', 'product_id');
    }

    public function answer() {
        return $this->hasOne(ProductReviews::class, 'review_id', 'id');
    }
}
