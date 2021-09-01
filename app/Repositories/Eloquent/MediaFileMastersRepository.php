<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\MediaFileMastersInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\MediaFileMasters;

class MediaFileMastersRepository extends BaseRepository implements MediaFileMastersInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param MediaFileMasters $model
     */
    public function __construct(MediaFileMasters $model)
    {
        parent::__construct($model);
    }
}
