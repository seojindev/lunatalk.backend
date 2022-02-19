<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\PhoneVerifyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\PhoneVerifies;

class PhoneVerifyRepository extends BaseRepository implements PhoneVerifyRepositoryInterface
{
    protected Model $model;


    public function __construct(PhoneVerifies $model)
    {
        parent::__construct($model);
    }

    /**
     * @param String $phoneHash
     * @param String $date
     * @return Collection
     */
    public function getPhoneAuth(String $phoneHash, String $date) : Collection
    {
        return $this->model->whereBetween('created_at', [$date.' 00:00:00', $date.' 23:59:59'])->get();
    }



}
