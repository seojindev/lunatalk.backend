<?php

namespace App\Http\Controllers\Front\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin/v1/pages/auth/login');
    }
}
