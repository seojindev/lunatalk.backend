<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\ProductWirelessOptionMastersInterface;
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
}
