<?php


namespace App\Repositories;

use App\Models\Codes;

class ServiceRepository implements ServiceRepositoryInterface
{
    protected Codes $codes;

    public function __construct(Codes $codes)
    {
        $this->codes = $codes;
    }

    public function getCommonCodeList() : object
    {
        return $this->codes::where('active', 'Y')
            ->orderBy('id')
            ->get();
    }
}
