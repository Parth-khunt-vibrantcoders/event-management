<?php

namespace App\Http\Controllers\backend\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Smtpsetting;
use Config;

class SmtpsettingController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

    public function smtp_setting(Request $request){
        $objSmtpsetting = new Smtpsetting();
        $data['smtp_setting'] = $objSmtpsetting->get_smtp_setting_details();
       
        if ($request->isMethod('post')) {
            $objSmtp = new Smtpsetting();
            $result = $objSmtp->update_smtp_setting($request);
            if ($result) {
                $return['status'] = 'success';
                 $return['jscode'] = '$("#loader").hide();';
                $return['message'] = 'Smtp setting successfully updated.';
                $return['redirect'] = route('smtp-setting');
            } else {
                    $return['status'] = 'error';
                     $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong';
            }
            echo json_encode($return);
            exit;
        }
        $data['title'] =  Config::get('constants.SYSTEM_NAME') . ' ||Smtp Setting';
        $data['description'] =  Config::get('constants.SYSTEM_NAME') . ' ||Smtp Setting';
        $data['keywords'] =  Config::get('constants.SYSTEM_NAME') . ' ||Smtp Setting';
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
            'smtpsetting.js',
        );
        $data['funinit'] = array(
            'Smtpsetting.init()',
        );
        $data['header'] = array(
            'title' => 'Smtp Setting',
            'breadcrumb' => array(
                'Smtp Setting' => 'Smtp Setting',
            )
        );
        return view('backend.pages.dashboard.smtpsetting', $data);
    }
}
