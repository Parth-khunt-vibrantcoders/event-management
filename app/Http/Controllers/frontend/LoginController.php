<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Config;
use Auth;
use Session;
use Hash;

class LoginController extends Controller
{
    public function signin (Request $request){
        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Sign In';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Sign In';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Sign In';
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
            'login.js',
        );
        $data['funinit'] = array(
            'Login.init()'
        );
        return view('frontend.pages.signin.signin', $data);
    }

    public function check_sign_in(Request $request){
        if (Auth::guard('users')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'user_type' => 'U', 'is_deleted'=>'N'])) {
            $loginData = '';
            $request->session()->forget('logindata');
            $loginData = array(
                'first_name' => Auth::guard('users')->user()->first_name,
                'last_name' => Auth::guard('users')->user()->last_name,
                'email' => Auth::guard('users')->user()->email,
                'userimage' => Auth::guard('users')->user()->userimage,
                'usertype' => Auth::guard('users')->user()->user_type,
                'id' => Auth::guard('users')->user()->id
            );
            Session::push('logindata', $loginData);
            $return['status'] = 'success';
            $return['message'] = 'You have successfully logged in.';
            $return['redirect'] = route('my-dashboard');
        } else {
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Invalid Login Id/Password';
        }
        return json_encode($return);
        exit();
    }

    public function signup_save(Request $request){
        $objUsers= new Users();
        $res = $objUsers->signup($request);
        if ($res == "true") {
            $return['status'] = 'success';
             $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Your profile successfully created.';
            $return['redirect'] = route('sign-in');
        } else {
            if ($res == "email_already_exits") {
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

    public function signup(){

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Sign Up';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Sign Up';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Sign Up';
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
            'login.js',
        );
        $data['funinit'] = array(
            'Login.signup()'
        );
        return view('frontend.pages.signin.signup', $data);
    }

    public function logout(Request $request) {
        $this->resetGuard();
        $request->session()->forget('logindata');
        return redirect()->route('sign-in');
    }

    public function resetGuard() {
        Auth::logout();
        Auth::guard('users')->logout();
    }
}
