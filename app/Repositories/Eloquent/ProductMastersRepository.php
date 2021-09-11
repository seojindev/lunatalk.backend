<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\ProductMastersInterface;
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
     * @return Builder[]|Collection
     */
    public function getAdminProductMasters()
    {
        return $this->model->with(['category' => function($query){
            $query->select(['id', 'uuid', 'name'])->where('active', 'Y');
        }, 'options' => function($query) {
            $query->select(['id', 'product_id', 'color', 'wireless']);
        }, 'options.color' => function($query) {
            $query->select(['id', 'name']);
        }, 'options.wireless' => function($query) {
            $query->select(['id','wireless']);
        }])->get();
    }

    /**
     * @param string $uuid
     * @return Builder|Model
     */
    public function getAdminDetailProductMasters(string $uuid)
    {
        return $this->model->with(['category' => function($query){
            $query->select(['id', 'uuid', 'name'])->where('active', 'Y');
        }, 'options' => function($query) {
            $query->select(['id', 'product_id', 'color', 'wireless']);
        }, 'options.color' => function($query) {
            $query->select(['id', 'name']);
        }, 'options.wireless' => function($query) {
            $query->select(['id','wireless']);
        }])->where('uuid' , $uuid)->firstOrFail();
    }
}
