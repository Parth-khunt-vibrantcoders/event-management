<?php

namespace App\Http\Controllers\backend\booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use App\Models\Booking;

class BookingcancelController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

    public function list(Request $request){

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Booking List';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Booking List';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Booking List';
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
            'bookingcancel.js',
        );
        $data['funinit'] = array(
            'Bookingcancel.init()'
        );
        $data['header'] = array(
            'title' => 'Booking List',
            'breadcrumb' => array(
                'Dashboard' => route('dashboard'),
                'Booking List' => 'Booking List',
            )
        );
        return view('backend.pages.booking.list', $data);
    }

    public function ajaxcall(Request $request){

        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objBooking = new Booking();
                $list = $objBooking->getdatatable('C');

                echo json_encode($list);
                break;

            case  'delete-contact-us' :

                $objBooking = new Booking();
                $result = $objBooking->common_activity_user($request->input('data'),0);

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
