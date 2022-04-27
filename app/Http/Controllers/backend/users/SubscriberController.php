<?php

namespace App\Http\Controllers\backend\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Imports\UsersImport;
use Config;
use Excel;

class SubscriberController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

    public function import(){

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Import Subscriber';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Import Subscriber';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Import Subscriber';
        $data['css'] = array(
            'toastr/toastr.min.css'
        );
        $data['plugincss'] = array(
        );
        $data['pluginjs'] = array(
            'toastr/toastr.min.js',
            'plugins/validate/jquery.validate.min.js',
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'subscriber.js',
        );
        $data['funinit'] = array(
            'Subscriber.importdata()'
        );
        $data['header'] = array(
            'title' => 'Import Subscriber',
            'breadcrumb' => array(
                'My Dashboard' => route('dashboard'),
                'Import Subscriber' => 'Import Subscriber',
            )
        );
        return view('backend.pages.subscriber.import', $data);
    }



    public function save_import(Request $request){
        // $path = $request->file('file')->getRealPath();
        $path = $request->file('file')->store('temp');
        $data = \Excel::import(new UsersImport($request->input('quiz')),$path);
        $return['status'] = 'success';
        $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");';
        $return['message'] = 'Question added successfully.';
        $return['redirect'] = route('subscriber-list');

        echo json_encode($return);
        exit;
    }


    public function list(){
        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Subscriber List' ;
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Subscriber List' ;
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Subscriber List' ;
        $data['css'] = array(
        );
        $data['plugincss'] = array(
            'plugins/custom/datatables/datatables.bundle.css'
        );
        $data['pluginjs'] = array(
            'plugins/custom/datatables/datatables.bundle.js',
            'js/pages/crud/datatables/data-sources/html.js'
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'subscriber.js',
        );
        $data['funinit'] = array(
            'Subscriber.init()',
        );
        $data['header'] = array(
            'title' => 'Subscriber List',
            'breadcrumb' => array(
                'My Dashboard' => route('dashboard'),
                'Subscriber List' => 'Subscriber List',
            )
        );
        return view('backend.pages.subscriber.list', $data);
    }

    public function add(){
        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Add Subscriber';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Add Subscriber';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Add Subscriber';
        $data['css'] = array(
            'toastr/toastr.min.css'
        );
        $data['plugincss'] = array(
        );
        $data['pluginjs'] = array(
            'toastr/toastr.min.js',
            'plugins/validate/jquery.validate.min.js',
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'subscriber.js',
        );
        $data['funinit'] = array(
            'Subscriber.add()'
        );
        $data['header'] = array(
            'title' => 'Add Subscriber',
            'breadcrumb' => array(
                'My Dashboard' => route('dashboard'),
                'Subscriber List' => route('subscriber-list'),
                'Add Subscriber' => 'Add Subscriber',
            )
        );
        return view('backend.pages.subscriber.add', $data);
    }

    public function save_subscriber_add(Request $request){
        $objSubscriber = new Subscriber();
        $result = $objSubscriber->add_subscriber($request);

        if ($result == "true") {
            $return['status'] = 'success';
            $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Subscriber successfully added.';
            $return['redirect'] = route('subscriber-list');
        }else{
            if ($result == "cr_number") {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Subscriber sr no already exits';
            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
               $return['message'] = 'Something goes to wrong';
            }

        }
        echo json_encode($return);
        exit;
    }

    public function edit($editId){
        $objSubscriber = new Subscriber();
        $data['subscriber_details'] = $objSubscriber->get_subscriber_details($editId);


        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Edit Subscriber';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Edit Subscriber';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Edit Subscriber';
        $data['css'] = array(
            'toastr/toastr.min.css'
        );
        $data['plugincss'] = array(
        );
        $data['pluginjs'] = array(
            'toastr/toastr.min.js',
            'plugins/validate/jquery.validate.min.js',
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'subscriber.js',
        );
        $data['funinit'] = array(
            'Subscriber.edit()'
        );
        $data['header'] = array(
            'title' => 'Edit Subscriber',
            'breadcrumb' => array(
                'My Dashboard' => route('dashboard'),
                'Subscriber List' => route('subscriber-list'),
                'Edit Subscriber' => 'Edit Subscriber',
            )
        );
        return view('backend.pages.subscriber.edit', $data);
    }

    public function save_subscriber_edit(Request $request){
        $objSubscriber = new Subscriber();
        $result = $objSubscriber->edit_subscriber($request);

        if ($result == "true") {
            $return['status'] = 'success';
            $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Subscriber successfully updated.';
            $return['redirect'] = route('subscriber-list');
        }else{
            if ($result == "cr_number") {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Subscriber sr no already exits';
            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
               $return['message'] = 'Something goes to wrong';
            }

        }
        echo json_encode($return);
        exit;
    }

    public function view($id){
        $objSubscriber = new Subscriber();
        $data['subscriber_details'] = $objSubscriber->get_subscriber_details($id);


        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || View Subscriber';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || View Subscriber';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || View Subscriber';
        $data['css'] = array(
            'toastr/toastr.min.css'
        );
        $data['plugincss'] = array(
        );
        $data['pluginjs'] = array(
            'toastr/toastr.min.js',
            'plugins/validate/jquery.validate.min.js',
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'subscriber.js',
        );
        $data['funinit'] = array(
            'Subscriber.view()'
        );
        $data['header'] = array(
            'title' => 'View Subscriber',
            'breadcrumb' => array(
                'My Dashboard' => route('dashboard'),
                'Subscriber List' => route('subscriber-list'),
                'View Subscriber' => 'View Subscriber',
            )
        );
        return view('backend.pages.subscriber.view', $data);
    }
    public function ajaxcall(Request $request){
        $action = $request->input('action');

        switch ($action) {

            case 'getdatatable':

                $objSubscriber = new Subscriber();
                $list = $objSubscriber->getdatatable();

                echo json_encode($list);
                break;

            case 'delete-subscriber':

                $objSubscriber = new Subscriber();
                $result = $objSubscriber->common_activity_user($request->input('data'), 0);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Subscriber successfully deleted';
                    $return['redirect'] = route('subscriber-list');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                exit;
        }
    }
}
