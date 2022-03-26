<?php

namespace App\Http\Controllers\Front;

//use Illuminate\Http\Request;

class HomeController extends RootController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        return view('welcome');
    }
}
