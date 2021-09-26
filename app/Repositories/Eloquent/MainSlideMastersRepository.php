<?php

namespace App\Repositories\Eloquent;

use App\Models\MainSlideMasters;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\MainSlideMastersInterface;

class MainSlideMastersRepository extends BaseRepository implements MainSlideMastersInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param MainSlideMasters $model
     */
    public function __construct(MainSlideMasters $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function getAdminMainSlideMasters() : Collection
    {
        return $this->model->get();
    }

    /**
     * @param string $uuid
     * @return \Illuminate\Database\Eloquent\Builder|Model
     */
    public function getAdminDetailMainSlideMasters(string $uuid)
    {
        return $this->model->with(['image','image.image'])->where('uuid',$uuid)->firstOrFail();
    }
}
