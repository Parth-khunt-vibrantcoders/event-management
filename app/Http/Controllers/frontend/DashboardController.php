<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware('users');
    }

    public function dashboard(){
        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || My Dashboard';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || My Dashboard';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || My Dashboard';
        $data['css'] = array(
        );
        $data['plugincss'] = array(
        );
        $data['pluginjs'] = array(
        );
        $data['js'] = array(
        );
        $data['funinit'] = array(
        );
        return view('frontend.pages.dashboard.dashboard', $data);
    }
}
