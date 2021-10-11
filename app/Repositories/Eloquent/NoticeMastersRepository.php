<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\NoticeMastersInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\NoticeMasters;

class NoticeMastersRepository extends BaseRepository implements NoticeMastersInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param NoticeMasters $model
     */
    public function __construct(NoticeMasters $model)
    {
        parent::__construct($model);
    }

    /**
     * @param String $modelUUID
     * @return \Illuminate\Database\Eloquent\Builder|Model
     */
    public function defaultDetail(String $modelUUID) {
        return $this->model
            ->with(['category', 'images', 'images.image'])
            ->where('uuid', $modelUUID)
            ->firstOrFail();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAdminNoticeListMaster() {
        return $this->model
            ->with(['category', 'images', 'images.image'])
            ->orderBy('id', 'desc')
            ->get();
    }
}
