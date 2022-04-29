<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use App\Models\Packages;
use App\Models\Places;
use App\Models\Eventcategory;

class HomeController extends Controller
{
    public function home(){

        $objPackages = new Packages();
        $data['packages_list'] = $objPackages->packages_list(3);

        $objPlaces = new Places();
        $data['place_list'] = $objPlaces->get_places_list(3);

        $objEventcategory = new Eventcategory();
        $data['event_category_list'] = $objEventcategory->get_event_category_list(3);

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
