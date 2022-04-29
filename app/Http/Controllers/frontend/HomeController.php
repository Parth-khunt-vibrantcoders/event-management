<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;

class HomeController extends Controller
{
    public function home(){

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Home';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Home';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Home';
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
        return view('frontend.pages.home.home', $data);
    }
}
