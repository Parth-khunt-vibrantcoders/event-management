<?php

namespace App\Http\Controllers\backend\eventcategory;

use App\Http\Controllers\Controller;
use App\Models\Eventcategory;
use Illuminate\Http\Request;
use Config;

class EventcategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

    public function list(Request $request){

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Event Category List';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Event Category List';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Event Category List';
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
            'eventcategory.js',
        );
        $data['funinit'] = array(
            'Eventcategory.init()'
        );
        $data['header'] = array(
            'title' => 'Event Category List',
            'breadcrumb' => array(
                'Dashboard' => route('dashboard'),
                'Event Category List' => 'Event Category List',
            )
        );
        return view('backend.pages.eventcategory.list', $data);
    }

    public function add(Request $request){

        $data['title'] =  Config::get('constants.SYSTEM_NAME') . ' || Add Event Category';
        $data['description'] =  Config::get('constants.SYSTEM_NAME') . ' || Add Event Category';
        $data['keywords'] =  Config::get('constants.SYSTEM_NAME') . ' || Add Event Category';
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
            'eventcategory.js',
        );
        $data['funinit'] = array(
            'Eventcategory.add()'
        );
        $data['header'] = array(
            'title' => 'Add Event Category',
            'breadcrumb' => array(
                'Dashboard' => route('dashboard'),
                'Event Category List' => route('event-category-list'),
                'Event Category Add' => 'Event Category Add',
            )
        );
        return view('backend.pages.eventcategory.add', $data);
    }

    public function add_save_event_category(Request $request){
        $objEventcategory = new Eventcategory();
        $res = $objEventcategory->add_save_event_category($request);
        if ($res == "true") {
            $return['status'] = 'success';
            $return['message'] = 'Event category successfully added';
            $return['jscode'] = '$("#loader").hide();';
            $return['redirect'] = route('event-category-list');
        }else{
            if ($res == "already_exits") {
                $return['status'] = 'warning';
                $return['message'] = 'Event category already exits.';
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

    public function edit($categoryId){
        $objEventcategory = new Eventcategory();
        $data['event_category_details'] = $objEventcategory->get_event_category_details($categoryId);

        $data['title'] =  Config::get('constants.SYSTEM_NAME') . ' || Edit Event Category';
        $data['description'] =  Config::get('constants.SYSTEM_NAME') . ' || Edit Event Category';
        $data['keywords'] =  Config::get('constants.SYSTEM_NAME') . ' || Edit Event Category';
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
            'eventcategory.js',
        );
        $data['funinit'] = array(
            'Eventcategory.edit()'
        );
        $data['header'] = array(
            'title' => 'Edit Event Category',
            'breadcrumb' => array(
                'Dashboard' => route('dashboard'),
                'Event Category List' => route('event-category-list'),
                'Event Category Edit' => 'Event Category Edit',
            )
        );
        return view('backend.pages.eventcategory.edit', $data);
    }

    public function edit_save_event_category(Request $request){
        $objEventcategory = new Eventcategory();
        $res = $objEventcategory->edit_save_event_category($request);
        if ($res == "true") {
            $return['status'] = 'success';
            $return['message'] = 'Event category successfully updated';
            $return['jscode'] = '$("#loader").hide();';
            $return['redirect'] = route('event-category-list');
        }else{
            if ($res == "already_exits") {
                $return['status'] = 'warning';
                $return['message'] = 'Event category already exits.';
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
                $objEventcategory = new Eventcategory();
                $list = $objEventcategory->getdatatable();

                echo json_encode($list);
                break;
                case 'delete-event-category':

                    $objEventcategory = new Eventcategory();
                    $result = $objEventcategory->common_activity_user($request->input('data'),0);

                    if ($result) {
                        $return['status'] = 'success';
                        $return['message'] = 'Event category successfully deleted';
                        $return['redirect'] = route('event-category-list');
                    } else {
                        $return['status'] = 'error';
                        $return['jscode'] = '$("#loader").hide();';
                        $return['message'] = trans('configuration.something_goes_to_wrong');
                    }
                    echo json_encode($return);
                    exit;


                case 'active-event-category':

                        $objEventcategory = new Eventcategory();
                        $result = $objEventcategory->common_activity_user($request->input('data'),1);

                        if ($result) {
                            $return['status'] = 'success';
                            $return['message'] = 'Event category successfully actived';;
                            $return['redirect'] = route('event-category-list');
                        } else {
                            $return['status'] = 'error';
                            $return['jscode'] = '$("#loader").hide();';
                            $return['message'] = trans('configuration.something_goes_to_wrong');
                        }
                        echo json_encode($return);
                        exit;


                case 'deactive-event-category':

                        $objEventcategory = new Eventcategory();
                        $result = $objEventcategory->common_activity_user($request->input('data'),2);

                        if ($result) {
                            $return['status'] = 'success';
                            $return['message'] = 'Event category successfully deactiveed';;
                            $return['redirect'] = route('event-category-list');
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
