<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\ProductBadgeMastersInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductBadgeMasters;

class ProductBadgeMastersRepository extends BaseRepository implements ProductBadgeMastersInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param ProductBadgeMasters $model
     */
    public function __construct(ProductBadgeMasters $model)
    {
        parent::__construct($model);
    }

    /**
     * 전체 리스트용.
     * @return Collection
     */
    public function getList() : Collection{
        return $this->model
            ->where('id', '>', 0)
            ->with(['image'])
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * 기본 리스트용
     * @return Collection
     */
    public function getDefaultList() : Collection{
        return $this->model
            ->where('active', 'Y')
            ->with(['image'])
            ->orderBy('id', 'asc')
            ->get();
    }

    /**
     * 상세.
     * @param Int $id
     * @return Collection
     */
    public function getDetail(Int $id) : Collection{
        return $this->model
            ->where('id', $id)
            ->with(['image'])
            ->get();
    }
}
