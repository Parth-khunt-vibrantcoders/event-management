<?php

namespace App\Http\Controllers\backend\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Config;

class UsersController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

  
}
