<?php

namespace App\Http\Controllers\backend\contactus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use App\Models\Contactus;

class ContactusController extends Controller
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
            'contactus.js',
        );
        $data['funinit'] = array(
            'Contactus.init()'
        );
        $data['header'] = array(
            'title' => 'Event Category List',
            'breadcrumb' => array(
                'Dashboard' => route('dashboard'),
                'Event Category List' => 'Event Category List',
            )
        );
        return view('backend.pages.contactus.list', $data);
    }

    public function ajaxcall(Request $request){

        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objContactus = new Contactus();
                $list = $objContactus->getdatatable();

                echo json_encode($list);
                break;

            case  'delete-contact-us' :

                $objContactus = new Contactus();
                $result = $objContactus->common_activity_user($request->input('data'),0);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Contact us successfully deleted';
                    $return['redirect'] = route('contact-us-list');
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
