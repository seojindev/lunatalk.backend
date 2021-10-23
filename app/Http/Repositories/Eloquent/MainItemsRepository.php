<?php

namespace App\Http\Repositories\Eloquent;

use App\Models\MainItem;
use Illuminate\Database\Eloquent\Model;
use App\Http\Repositories\Interfaces\MainItemsRepositoryInterface;

class MainItemsRepository extends BaseRepository implements MainItemsRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param MainItem $model
     */
    public function __construct(MainItem $model)
    {
        parent::__construct($model);
    }

    /**
     * 메인 아이템 중복 체크
     * @param Int $product_id
     * @return bool
     */
    public function mainBestItemExits(Int $product_id) : bool {
        return $this->model
            ->where([
                ['category', config('extract.main_item.bestItem.code')],
                ['product_id', $product_id],
            ])
            ->exists();
    }

    /**
     * 메인 뉴아이템 중복 체크
     * @param Int $product_id
     * @return bool
     */
    public function mainNewItemExits(Int $product_id) : bool {
        return $this->model
            ->where([
                ['category', config('extract.main_item.bestItem.code')],
                ['product_id', $product_id],
            ])
            ->exists();
    }

    /**
     * 메인 베스트 아이템 리스트
     * @return array
     */
    public function showMainBestItems() : array {
        return $this->model->where('category', config('extract.main_item.bestItem.code'))
            ->with(['product.repImage.image'])
            ->get()->toArray();
    }

    /**
     * 메인 뉴 아이템 리스트
     * @return array
     */
    public function showMainNewItems() : array {
        return $this->model->where('category', config('extract.main_item.newItem.code'))
            ->with(['product.repImage.image'])
            ->get()->toArray();
    }
}
