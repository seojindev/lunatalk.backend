<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CodesRepositoryInterface;
use App\Models\Codes;
use Illuminate\Database\Eloquent\Model;

class CodesRepository extends BaseRepository implements CodesRepositoryInterface
{
    protected Model $model;

    public function __construct(Codes $model)
    {
        parent::__construct($model);
    }
}
