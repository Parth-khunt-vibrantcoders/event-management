<?php

namespace App\Http\Controllers\backend\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Config;
class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard(Request $request){

        $data['title'] =  Config::get('constants.SYSTEM_NAME') . ' || dashboard';
        $data['description'] =  Config::get('constants.SYSTEM_NAME') . ' || dashboard';
        $data['keywords'] =  Config::get('constants.SYSTEM_NAME') . ' || dashboard';
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
            'dashboard.js',
        );
        $data['funinit'] = array(
            'Dashboard.init()'
        );
        $data['header'] = array(
            'title' => 'My Dashboard',
            'breadcrumb' => array(
                'My Dashboard' => 'My Dashboard',
            )
        );
        return view('backend.pages.dashboard.dashboard', $data);
    }


    public function update_profile(Request $request){

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Update Profile';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Update Profile';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Update Profile';
        $data['css'] = array(
            'toastr/toastr.min.css'
        );
        $data['plugincss'] = array(
        );
        $data['pluginjs'] = array(
            'toastr/toastr.min.js',
            'plugins/validate/jquery.validate.min.js',
            'pages/crud/file-upload/image-input.js'
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'dashboard.js',
        );
        $data['funinit'] = array(
            'Dashboard.edit_profile()'
        );
        $data['header'] = array(
            'title' => 'Update Profile',
            'breadcrumb' => array(
                'My Dashboard' => route('dashboard'),
                'Update Profile' => 'Update Profile',
            )
        );
        return view('backend.pages.dashboard.update_profile', $data);
    }

    public function save_profile(Request $request){

        $objUsers = new Users();
        $result = $objUsers->update_profile($request);
        if ($result == "true") {
            $return['status'] = 'success';
             $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Your profile successfully updated.';
            $return['redirect'] = route('admin-update-profile');
        } else {
            if ($result == "email_exist") {
                $return['status'] = 'error';
                 $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'The email address has already been registered.';
            }else{
                $return['status'] = 'error';
                 $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Something goes to wrong';
            }
        }
        echo json_encode($return);
        exit;
    }

    public function change_password(Request $request){
        $data['title'] = 'Petrol Station Web Software || Change Password';
        $data['description'] = 'Petrol Station Web Software || Change Password';
        $data['keywords'] = 'Petrol Station Web Software || Change Password';
        $data['css'] = array(
            'toastr/toastr.min.css'
        );
        $data['plugincss'] = array(
        );
        $data['pluginjs'] = array(
            'toastr/toastr.min.js',
            'plugins/validate/jquery.validate.min.js',
            'pages/crud/file-upload/image-input.js'
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'dashboard.js',
        );
        $data['funinit'] = array(
            'Dashboard.change_password()'
        );
        $data['header'] = array(
            'title' => 'Change Password',
            'breadcrumb' => array(
                'My Dashboard' => route('dashboard'),
                'Change Password' => 'Change Password',
            )
        );
        return view('backend.pages.dashboard.change_password', $data);
    }

    public function save_password(Request $request){
        $objUsers = new Users();
        $result = $objUsers->changepassword($request);

        if ($result == "true") {
            $return['status'] = 'success';
            $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Your password has been updated successfully.';
            $return['redirect'] = route('admin-change-password');
        } else {
            if ($result == "password_not_match") {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Your old password is not match.';

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
}
