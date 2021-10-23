<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\NoticeMastersInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
     * @return Builder|Model
     */
    public function defaultDetail(String $modelUUID) {
        return $this->model
            ->with(['category', 'images', 'images.image'])
            ->where('uuid', $modelUUID)
            ->firstOrFail();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAdminNoticeListMaster() {
        return $this->model
            ->with(['category', 'images', 'images.image'])
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * @return Collection
     */
    public function getMainNoticeList() : Collection {
        return $this->model
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();
    }
}
