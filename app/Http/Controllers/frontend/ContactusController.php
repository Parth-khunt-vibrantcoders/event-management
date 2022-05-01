<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
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
        ccd($request->input());
    }
}
