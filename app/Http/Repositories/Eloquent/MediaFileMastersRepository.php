<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\MediaFileMastersInterface;
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

    /**
     * 모델 체크.
     * @param Int $id
     * @return mixed
     */
    public function checkExits(Int $id) {
        return $this->model
            ->findOrFail($id);
    }
}
