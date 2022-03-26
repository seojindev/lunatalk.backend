<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\Facade;

class CustomFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'helperclass';
    }
}
