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
     * @return Builder[]|Collection
     */
    public function getAdminProductMasters() : Collection
    {
        return $this->model->with(['category' => function($query){
            $query->select(['id', 'uuid', 'name'])->where('active', 'Y');
        }, 'color', 'color.color', 'wireless', 'wireless.wireless'])->orderBy('id', 'desc')->get();
    }

    /**
     * @param string $uuid
     * @return Builder|Model
     */
    public function getAdminDetailProductMasters(string $uuid)
    {
        return $this->model->with(['category' => function($query){
            $query->select(['id', 'uuid', 'name'])->where('active', 'Y');
        }, 'color', 'color.color', 'wireless', 'wireless.wireless', 'repImages' => function($query) {
            $query->where('media_id', '>', 0);
        },'repImages.image', 'detailImages' => function($query) {
            $query->where('media_id', '>', 0);
        }, 'detailImages.image'])->where('uuid' , $uuid)->firstOrFail();

    }
}
