<?php

namespace App\Http\Controllers\backend\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Systemsetting;
use Config;
use DB;
use Session;

class SystemsettingController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

    public function system_setting(Request $request){
        $objSystemsetting = new Systemsetting();
        $data['system_details'] = $objSystemsetting->get_system_setting_details();

        if ($request->isMethod('post')) {
            $objSystem = new Systemsetting();
            $result = $objSystem->update_system_setting($request);
            if ($result) {
                $return['status'] = 'success';
                 $return['jscode'] = '$("#loader").hide();';
                $return['message'] = 'System setting successfully updated.';
                $return['redirect'] = route('admin-system-setting');
            } else {
                    $return['status'] = 'error';
                     $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong';
            }
            echo json_encode($return);
            exit;
        }
        $data['title'] =  Config::get('constants.SYSTEM_NAME') . ' || System Setting';
        $data['description'] =  Config::get('constants.SYSTEM_NAME') . ' || System Setting';
        $data['keywords'] =  Config::get('constants.SYSTEM_NAME') . ' || System Setting';
        $data['css'] = array(
        );
        $data['plugincss'] = array(
        );
        $data['pluginjs'] = array(
            'plugins/validate/jquery.validate.min.js',
            'pages/crud/file-upload/image-input.js',
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'systemsetting.js',
        );
        $data['funinit'] = array(
            'Systemsetting.init()',
            'Systemsetting.edit()',
        );
        $data['header'] = array(
            'title' => 'System Setting',
            'breadcrumb' => array(
                'System Setting' => 'System Setting',
            )
        );
        return view('backend.pages.dashboard.systemsetting', $data);
    }

}
