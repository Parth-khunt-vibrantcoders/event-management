<?php

namespace App\Http\Controllers\backend\places;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use App\Models\Places;

class PlacesController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

    public function list(Request $request){

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Places List';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Places List';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Places List';
        $data['css'] = array(
            'toastr/toastr.min.css'
        );
        $data['plugincss'] = array(
            'plugins/custom/datatables/datatables.bundle.css'
        );
        $data['pluginjs'] = array(
            'toastr/toastr.min.js',
            'plugins/custom/datatables/datatables.bundle.js',
            'pages/crud/datatables/data-sources/html.js'
        );
        $data['js'] = array(
            'comman_function.js',
            'places.js',
        );
        $data['funinit'] = array(
            'Places.init()'
        );
        $data['header'] = array(
            'title' => 'Places List',
            'breadcrumb' => array(
                'Dashboard' => route('dashboard'),
                'Places List' => 'Places List',
            )
        );
        return view('backend.pages.places.list', $data);
    }

    public function add(Request $request){

        $data['title'] =  Config::get('constants.SYSTEM_NAME') . ' || Add Place';
        $data['description'] =  Config::get('constants.SYSTEM_NAME') . ' || Add Place';
        $data['keywords'] =  Config::get('constants.SYSTEM_NAME') . ' || Add Place';
        $data['css'] = array(
        );
        $data['plugincss'] = array(
        );
        $data['pluginjs'] = array(
            'plugins/validate/jquery.validate.min.js',

        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'places.js',
        );
        $data['funinit'] = array(
            'Places.add()'
        );
        $data['header'] = array(
            'title' => 'Add Place',
            'breadcrumb' => array(
                'Dashboard' => route('dashboard'),
                'Place List' => route('places-list'),
                'Place Add' => 'Place Add',
            )
        );
        return view('backend.pages.places.add', $data);
    }

    public function add_save_places(Request $request){
        $objPlaces = new Places();
        $res = $objPlaces->add_save_places($request);
        if ($res == "true") {
            $return['status'] = 'success';
            $return['message'] = 'Place successfully added';
            $return['jscode'] = '$("#loader").hide();';
            $return['redirect'] = route('places-list');
        }else{
            if ($res == "already_exits") {
                $return['status'] = 'warning';
                $return['message'] = 'Place already exits.';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Something goes to wrong';
            }

        }
        echo json_encode($return);
        exit;
    }

    public function edit($placesId){
        $objPlaces = new Places();
        $data['places_details'] = $objPlaces->get_places_details($placesId);

        $data['title'] =  Config::get('constants.SYSTEM_NAME') . ' || Edit Place';
        $data['description'] =  Config::get('constants.SYSTEM_NAME') . ' || Edit Place';
        $data['keywords'] =  Config::get('constants.SYSTEM_NAME') . ' || Edit Place';
        $data['css'] = array(
        );
        $data['plugincss'] = array(
        );
        $data['pluginjs'] = array(
            'plugins/validate/jquery.validate.min.js',

        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'places.js',
        );
        $data['funinit'] = array(
            'Places.edit()'
        );
        $data['header'] = array(
            'title' => 'Edit Place',
            'breadcrumb' => array(
                'Dashboard' => route('dashboard'),
                'Place List' => route('places-list'),
                'Place Edit' => 'Place Edit',
            )
        );
        return view('backend.pages.places.edit', $data);
    }

    public function edit_save_places(Request $request){
        $objPlaces = new Places();
        $res = $objPlaces->edit_save_places($request);
        if ($res == "true") {
            $return['status'] = 'success';
            $return['message'] = 'Place successfully added';
            $return['jscode'] = '$("#loader").hide();';
            $return['redirect'] = route('places-list');
        }else{
            if ($res == "already_exits") {
                $return['status'] = 'warning';
                $return['message'] = 'Place already exits.';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Something goes to wrong';
            }

        }
        echo json_encode($return);
        exit;
    }
    public function ajaxcall(Request $request){

        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objPlaces = new Places();
                $list = $objPlaces->getdatatable();

                echo json_encode($list);
                break;
            case 'delete-places':

                $objPlaces = new Places();
                $result = $objPlaces->common_activity_user($request->input('data'),0);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Places successfully deleted';
                    $return['redirect'] = route('places-list');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = trans('configuration.something_goes_to_wrong');
                }
                echo json_encode($return);
                exit;


            case 'active-places':

                $objPlaces = new Places();
                $result = $objPlaces->common_activity_user($request->input('data'),1);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Places successfully actived';;
                    $return['redirect'] = route('places-list');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = trans('configuration.something_goes_to_wrong');
                }
                echo json_encode($return);
                exit;


            case 'deactive-places':

                $objPlaces = new Places();
                $result = $objPlaces->common_activity_user($request->input('data'),2);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Places successfully deactiveed';;
                    $return['redirect'] = route('places-list');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = trans('configuration.something_goes_to_wrong');
                }
                echo json_encode($return);
                exit;
        }
    }
}
