<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\ProductWirelessOptionMastersInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductWirelessOptionMasters;

class ProductWirelessOptionMastersRepository extends BaseRepository implements ProductWirelessOptionMastersInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param ProductWirelessOptionMasters $model
     */
    public function __construct(ProductWirelessOptionMasters $model)
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
