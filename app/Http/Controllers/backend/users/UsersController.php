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

    public function list(Request $request){

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Users List';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Users List';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Users List';
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
            'users.js',
        );
        $data['funinit'] = array(
            'Users.init()'
        );
        $data['header'] = array(
            'title' => 'Users List',
            'breadcrumb' => array(
                'Dashboard' => route('dashboard'),
                'Users List' => 'Users List',
            )
        );
        return view('backend.pages.users.list', $data);
    }

    public function ajaxcall(Request $request){

        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objUsers = new Users();
                $list = $objUsers->getdatatable();

                echo json_encode($list);
                break;

            case  'delete-users' :

                $objUsers = new Users();
                $result = $objUsers->common_activity_user($request->input('data'));

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Contact us successfully deleted';
                    $return['redirect'] = route('users-list');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong.';
                }
                echo json_encode($return);
                exit;

        }
    }
}
