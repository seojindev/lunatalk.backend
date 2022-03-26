<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\ProductReviewsInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductReviews;
use phpDocumentor\Reflection\Types\Boolean;

class ProductReviewsRepository extends BaseRepository implements ProductReviewsInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param ProductReviews $model
     */
    public function __construct(ProductReviews $model)
    {
        parent::__construct($model);
    }

    /**
     * 리뷰 리스트.
     * @return Collection
     */
    public function getReviewForAdmin() : Collection {
        return $this->model->where('review_id', null)
            ->with(['user', 'product'])
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * 리뷰 상세.
     * @param Int $id
     * @return Collection
     */
    public function getReviewDetailForAdmin(Int $id) : Collection {
        return $this->model->where('id', $id)
            ->with(['user', 'product', 'answer.user'])
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * 리뷰 등록 있는지 체크.
     * @param Int $product_id
     * @param Int $review_id
     * @return bool
     */
    public function exitsAnswer(Int $product_id, Int $review_id) : bool {
        return $this->model->where('product_id', $product_id)
            ->where('review_id', $review_id)
            ->exists();
    }

    /**
     * 리뷰 업데이트
     * @param Int $product_id
     * @param Int $review_id
     * @param Int $user_id
     * @param string $title
     * @param string $contents
     * @return mixed
     */
    public function updateAnswer(Int $product_id, Int $review_id, Int $user_id, string $title, string $contents) : Collection {
        return $this->model->where('product_id', $product_id)
            ->where('review_id', $review_id)
            ->update([
                'user_id' => $user_id,
                'title' => $title,
                'contents' => $contents
            ]);
    }

    /**
     * 상품 리뷰 리스트.
     * @param Int $product_id
     * @return Collection
     */
    public function getReview(Int $product_id) : Collection {
        return $this->model->where('product_id', $product_id)
            ->with(['user', 'answer'])
            ->get();
    }
}
