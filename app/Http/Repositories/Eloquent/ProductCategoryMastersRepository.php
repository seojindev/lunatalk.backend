<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\ProductCategoryMastersInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategoryMasters;

class ProductCategoryMastersRepository extends BaseRepository implements ProductCategoryMastersInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param ProductCategoryMasters $model
     */
    public function __construct(ProductCategoryMasters $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function getWithProductCount() : Collection
    {
        return $this->model->withCount('products')->get();
    }

    /**
     * @return Collection
     */
    public function getActiveAll() : Collection
    {
        return $this->model->where('active' , 'Y')->get();
    }

    /**
     * @return Collection
     */
    public function getRandomCategoryProduct() : Collection {
        return $this->model
            ->where('active', 'Y')
            ->with(['random_products', 'random_products.repImage.image'])
            ->get();
    }

    /**
     * @param String $category_uuid
     * @return mixed
     */
    public function getProductCategoryList(String $category_uuid) : Collection {
        return $this->model
            ->where([['active', 'Y'], ['uuid', $category_uuid]])
            ->with(['products', 'products.repImage.image', 'products.color.color', 'products.badge.badge.image'])
            ->get();
    }


}
