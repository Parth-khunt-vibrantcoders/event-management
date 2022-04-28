<?php

namespace App\Http\Controllers\backend\packages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use App\Models\Packages;
use App\Models\Places;
use App\Models\Eventcategory;

class PackagesController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

    public function list(Request $request){

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Packages List';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Packages List';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Packages List';
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
            'packages.js',
        );
        $data['funinit'] = array(
            'Packages.init()'
        );
        $data['header'] = array(
            'title' => 'Packages List',
            'breadcrumb' => array(
                'Dashboard' => route('dashboard'),
                'Packages List' => 'Packages List',
            )
        );
        return view('backend.pages.packages.list', $data);
    }

    public function add(Request $request){
        $objPlaces = new Places();
        $data['place_list'] = $objPlaces->get_places_list();

        $objEventcategory = new Eventcategory();
        $data['event_category_list'] = $objEventcategory->get_event_category_list();

        $data['title'] =  Config::get('constants.SYSTEM_NAME') . ' || Add Packages';
        $data['description'] =  Config::get('constants.SYSTEM_NAME') . ' || Add Packages';
        $data['keywords'] =  Config::get('constants.SYSTEM_NAME') . ' || Add Packages';
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
            'packages.js',
        );
        $data['funinit'] = array(
            'Packages.add()'
        );
        $data['header'] = array(
            'title' => 'Add Packages',
            'breadcrumb' => array(
                'Dashboard' => route('dashboard'),
                'Packages List' => route('packages-list'),
                'Packages Add' => 'Packages Add',
            )
        );
        return view('backend.pages.packages.add', $data);
    }

    public function edit(Request $request){
        $objPlaces = new Places();
        $data['place_list'] = $objPlaces->get_places_list();

        $objEventcategory = new Eventcategory();
        $data['event_category_list'] = $objEventcategory->get_event_category_list();

        $data['title'] =  Config::get('constants.SYSTEM_NAME') . ' || Edit Packages';
        $data['description'] =  Config::get('constants.SYSTEM_NAME') . ' || Edit Packages';
        $data['keywords'] =  Config::get('constants.SYSTEM_NAME') . ' || Edit Packages';
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
            'packages.js',
        );
        $data['funinit'] = array(
            'Packages.edit()'
        );
        $data['header'] = array(
            'title' => 'Edit Packages',
            'breadcrumb' => array(
                'Dashboard' => route('dashboard'),
                'Packages List' => route('packages-list'),
                'Packages Edit' => 'Packages Edit',
            )
        );
        return view('backend.pages.packages.edit', $data);
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

    public function ajaxcall(Request $request){

        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objPackages = new Packages();
                $list = $objPackages->getdatatable();

                echo json_encode($list);
                break;
            case 'delete-packages':

                $objPackages = new Packages();
                $result = $objPackages->common_activity_user($request->input('data'),0);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Packages successfully deleted';
                    $return['redirect'] = route('packages-list');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = trans('configuration.something_goes_to_wrong');
                }
                echo json_encode($return);
                exit;


            case 'active-packages':

                $objPackages = new Packages();
                $result = $objPackages->common_activity_user($request->input('data'),1);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Packages successfully actived';;
                    $return['redirect'] = route('packages-list');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = trans('configuration.something_goes_to_wrong');
                }
                echo json_encode($return);
                exit;


            case 'deactive-packages':

                $objPackages = new Packages();
                $result = $objPackages->common_activity_user($request->input('data'),2);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Packages successfully deactiveed';;
                    $return['redirect'] = route('packages-list');
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
