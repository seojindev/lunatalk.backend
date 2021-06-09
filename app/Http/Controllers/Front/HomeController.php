<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

class HomeController extends RootController
{
    public function home()
    {
        return view('welcome');
    }
}
