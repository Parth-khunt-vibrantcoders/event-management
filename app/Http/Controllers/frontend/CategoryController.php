<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Eventcategory;
use Config;

class CategoryController extends Controller
{
    public function category_details($eventcategoryId){

        $objEventcategory = new Eventcategory();
        $data['event_category_details'] = $objEventcategory->get_event_category_details($eventcategoryId);

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
        return view('frontend.pages.category.category_details', $data);
    }

    public function category_list (){

        $objEventcategory = new Eventcategory();
        $data['event_category_list'] = $objEventcategory->get_event_category_list();

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Category List';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Category List';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Category List';
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
        return view('frontend.pages.category.category_list', $data);
    }
}
