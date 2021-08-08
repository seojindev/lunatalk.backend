<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CodesRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Codes;

/**
 *
 */
class CodesRepository extends BaseRepository implements CodesRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param Codes $model
     */
    public function __construct(Codes $model)
    {
        parent::__construct($model);
    }
}
