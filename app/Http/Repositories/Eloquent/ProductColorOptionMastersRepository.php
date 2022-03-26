<?php

namespace App\Http\Repositories\Eloquent;
use App\Http\Repositories\Interfaces\ProductColorOptionMastersInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductColorOptionMasters;
use Illuminate\Database\Eloquent\Collection;

class ProductColorOptionMastersRepository extends BaseRepository implements ProductColorOptionMastersInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param ProductColorOptionMasters $model
     */
    public function __construct(ProductColorOptionMasters $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function getActiveAll() : Collection
    {
        return $this->model->where('active', 'Y')->get();
    }
}
