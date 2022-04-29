<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
class BookingController extends Controller
{
    function __construct()
    {
        $this->middleware('users');
    }

    public function booking(){
        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || My Booking';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || My Booking';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || My Booking';
        $data['css'] = array(
        );
        $data['plugincss'] = array(
        );
        $data['pluginjs'] = array(
        );
        $data['js'] = array(
        );
        $data['funinit'] = array(
        );
        return view('frontend.pages.booking.booking', $data);
    }
}
