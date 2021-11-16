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
        }, 'colors', 'colors.color', 'wireless', 'wireless.wireless', 'bestItem', 'newItem'])->orderBy('id', 'desc')->get();
    }

    /**
     * 상품 전체 리스트.
     * @return Collection
     */
    public function getProductListMasters() : Collection
    {
        return $this->model->with(['category' => function($query){
            $query->select(['id', 'uuid', 'name'])->where('active', 'Y');
        }, 'colors', 'colors.color', 'wireless', 'wireless.wireless', 'bestItem', 'newItem', 'repImages' => function($query) {
            $query->where('media_id', '>', 0);
        },'repImages.image', 'detailImages' => function($query) {
            $query->where('media_id', '>', 0);
        }, 'detailImages.image'])->orderBy('id', 'desc')->get();
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
        }, 'detailImages.image'])->where('uuid' , $uuid)->firstOrFail();
    }

    /**
     * front 용 상품 상세 정보.
     * @param String $uuid
     * @return mixed
     */
    public function getProductDetailInfo(String $uuid) {
        return $this->model
            ->where([['uuid', $uuid], ['active', 'Y']])
            ->with(['category', 'options.color', 'options.wireless', 'repImages.image', 'detailImages.image'])
            ->get();
    }
}
