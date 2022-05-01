<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use App\Models\Contactus;

class ContactusController extends Controller
{
    public function contact_us (){


        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Contact-us';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Contact-us';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Contact-us';
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
            'contactus.js',
        );
        $data['funinit'] = array(
            'Contactus.init()'
        );
        return view('frontend.pages.contact_us.contact_us', $data);
    }

    public function save_contact_form(Request $request){
        $objContactus = new Contactus();
        $res = $objContactus->save_contact_form($request);
        if ($res) {
            $return['status'] = 'success';
            $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Your details successfully sent to admin.we will contact soon.';
            $return['redirect'] = route('contact-us');
        } else {
            $return['status'] = 'error';
            $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Something goes to wrong';
        }
        echo json_encode($return);
        exit;
    }
}
