<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use App\Models\Packages;

class PackagesController extends Controller
{

    public function packages_list(){

        $objPackages = new Packages();
        $data['packages_list'] = $objPackages->packages_list();

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
        return view('frontend.pages.packages_list.packages_list', $data);
    }

    public function packages_details ($packagesId){
        $objPackages = new Packages();
        $data['packages_list_details'] = $objPackages->get_packages_list_details($packagesId);

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
        return view('frontend.pages.packages_list.packages_details', $data);
    }
}
