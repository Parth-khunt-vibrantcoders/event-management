<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use App\Models\Packages;
use App\Models\Booking;
class BookingController extends Controller
{
    function __construct()
    {
        $this->middleware('users');
    }

    public function my_booking(){
        $userId = Auth()->guard('users')->user()['id'];
        $objBooking = new Booking();
        $data['booking_list'] = $objBooking->get_booking_list($userId);

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || My Booking';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || My Booking';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || My Booking';
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
            'booking.js',
        );
        $data['funinit'] = array(
            'Booking.list()'
        );
        return view('frontend.pages.booking.booking', $data);
    }

    public function booking(Request $request){
        if($request->get('package-id')){
            $objPackages = new Packages();
            $data['packages_list_details'] = $objPackages->get_packages_list_details($request->get('package-id'));
        }else{
            $data['packages_list_details'][0]['id'] = '';
            $data['packages_list_details'][0]['places'] = '';
            $data['packages_list_details'][0]['event_category'] = '';
            $data['packages_list_details'][0]['price'] = 0;
        }

        $objPackages = new Packages();
        $data['packages_list'] = $objPackages->packages_list();

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Booking';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Booking';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Booking';
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
            'booking.js',
        );
        $data['funinit'] = array(
            'Booking.init()'
        );
        return view('frontend.pages.booking.new_booking', $data);
    }

    public function save_booking(Request $request){
        $objBooking = new Booking();
        $res = $objBooking->add_booking($request);
        if ($res) {
            $return['status'] = 'success';
             $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Event successfully booked.';
            $return['redirect'] = route('my-booking');
        } else {
            $return['status'] = 'error';
            $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Something goes to wrong';
        }
        echo json_encode($return);
        exit;
    }
    public function ajaxcall(Request $request){
        $action = $request->input('action');
        switch ($action) {
            case 'change-package':

                $objPackages = new Packages();
                $packages_list_details = $objPackages->get_packages_list_details($request->input('value'));

                echo json_encode($packages_list_details);
                break;

            case 'cancel-booking':

                $objBooking = new Booking();
                $result = $objBooking->common_activity_user($request->input('data'),0);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Booking successfully canceled';
                    $return['redirect'] = route('my-booking');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = 'Something goees to wrong.';
                }
                echo json_encode($return);
                exit;
        }
    }
}
