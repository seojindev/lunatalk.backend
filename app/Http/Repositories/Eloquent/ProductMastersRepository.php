<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\ProductMastersInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductMasters;

class ProductMastersRepository extends BaseRepository implements ProductMastersInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param ProductMasters $model
     */
    public function __construct(ProductMasters $model)
    {
        parent::__construct($model);
    }

    /**
     * 상품 전체 리스트 ( 어드민 )
     * @return Builder[]|Collection
     */
    public function getAdminProductMasters() : Collection
    {
        return $this->model->with(['category' => function($query){
            $query->select(['id', 'uuid', 'name'])->where('active', 'Y');
        }, 'colors', 'colors.color', 'wireless', 'wireless.wireless', 'bestItem', 'newItem', 'badge.badge.image'])->orderBy('id', 'desc')->get();
    }

    /**
     * 상품 전체 리스트.
     * @return Collection
     */
    public function getProductListMasters() : Collection
    {
        return $this->model->where('active', 'Y')
            ->with(['category' => function($query){
            $query->select(['id', 'uuid', 'name'])->where('active', 'Y');
        }, 'colors', 'colors.color', 'wireless', 'wireless.wireless', 'bestItem', 'newItem', 'repImages' => function($query) {
            $query->where('media_id', '>', 0);
        },'repImages.image', 'detailImages' => function($query) {
            $query->where('media_id', '>', 0);
        }, 'detailImages.image', 'badge.badge.image'])->orderBy('id', 'desc')->get();
    }

    /**
     * 상품 상세. (어드민)
     * @param string $uuid
     * @return Builder|Model
     */
    public function getAdminDetailProductMasters(string $uuid)
    {
        return $this->model->with(['category' => function($query){
            $query->select(['id', 'uuid', 'name'])->where('active', 'Y');
        }, 'colors', 'colors.color', 'wireless', 'wireless.wireless', 'repImages' => function($query) {
            $query->where('media_id', '>', 0);
        },'repImages.image', 'detailImages' => function($query) {
            $query->where('media_id', '>', 0);
        }, 'detailImages.image', 'badge.badge.image'])->where('uuid' , $uuid)->firstOrFail();
    }

    /**
     * front 용 상품 상세 정보.
     * @param String $uuid
     * @return mixed
     */
    public function getProductDetailInfo(String $uuid) {
        return $this->model
            ->where([['uuid', $uuid], ['active', 'Y']])
            ->with(['category', 'options.color', 'options.wireless', 'repImages.image', 'detailImages.image', 'reviews' => function($query) {
                $query->where('review_id', null);
                $query->orderBy('id', 'desc');
            }, 'reviews.user', 'reviews.answer'])
            ->get();
    }


    /**
     * 상품 검색
     * @param String $search
     * @return Collection
     */
    public function getProductListSearchMasters(String $search) : Collection
    {
        return $this->model
            ->where('name', 'like', '%'.$search.'%')
            ->where('active', 'Y')
            ->with(['category' => function($query){
            $query->select(['id', 'uuid', 'name'])->where('active', 'Y');
        }, 'colors', 'colors.color', 'wireless', 'wireless.wireless', 'bestItem', 'newItem', 'repImages' => function($query) {
            $query->where('media_id', '>', 0);
        },'repImages.image', 'detailImages' => function($query) {
            $query->where('media_id', '>', 0);
        }, 'detailImages.image'])->orderBy('id', 'desc')->get();
    }

    /**
     * 상품 검색.
     * @param String $search
     * @return Collection
     */
    public function getProductListSearchSub(String $search) : Collection
    {
        return $this->model
            ->where('name', 'like', '%'.$search.'%')
            ->where('active', 'Y')
            ->with(['category' => function($query){
                $query->select(['id', 'uuid', 'name'])->where('active', 'Y');
            }, 'colors', 'colors.color', 'wireless', 'wireless.wireless', 'bestItem', 'newItem', 'repImage' => function($query) {
                $query->where('media_id', '>', 0);
            },'repImage.image', 'detailImages' => function($query) {
                $query->where('media_id', '>', 0);
            }, 'detailImages.image', 'badge.badge.image', 'reviews'])->orderBy('id', 'desc')->get();
    }

    /**
     * 상품 검색 추천 상품용.
     * @param Int $id
     * @param Int $cateogry
     * @return Collection
     */
    public function getRecommendSearch(Int $id, Int $cateogry) : Collection
    {
        return $this->model
            ->where('id', '<>', $id)
            ->where('category', $cateogry)
            ->where('active', 'Y')
            ->with(['category' => function($query){
                $query->select(['id', 'uuid', 'name'])->where('active', 'Y');
            }, 'colors', 'colors.color', 'wireless', 'wireless.wireless', 'bestItem', 'newItem', 'repImage' => function($query) {
                $query->where('media_id', '>', 0);
            },'repImage.image', 'detailImages' => function($query) {
                $query->where('media_id', '>', 0);
            }, 'detailImages.image', 'badge.badge.image', 'reviews'])->orderBy('id', 'desc')->get();
    }
}
