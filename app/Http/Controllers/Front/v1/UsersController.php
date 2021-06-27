<?php

namespace App\Http\Controllers\Front\v1;

use App\Http\Controllers\Front\RootController;
use Illuminate\Http\Request;

class UsersController extends RootController
{
    public function list()
    {
        return view('admin/v1/pages/users/users-list', [
            'pages' => [
                'pageStep' => 'users',
            ],
            'users' => []
        ]);
    }
}
