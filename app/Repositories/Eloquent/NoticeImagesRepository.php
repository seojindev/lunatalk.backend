<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\NoticeImagesInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\NoticeImages;

class NoticeImagesRepository extends BaseRepository implements NoticeImagesInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param NoticeImages $model
     */
    public function __construct(NoticeImages $model)
    {
        parent::__construct($model);
    }
}
