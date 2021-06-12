<?php

namespace App\Http\Controllers\Front\v1;

use App\Http\Controllers\Front\RootController;
use Illuminate\Http\Request;

class AdminController extends RootController
{
    //

    public function blank()
    {
        return view('admin/v1/pages/blank');
    }

    public function dashboard()
    {
        return view('admin/v1/pages/blank');
    }
}
