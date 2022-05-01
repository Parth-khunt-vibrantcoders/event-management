<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
class Booking extends Model
{
    use HasFactory;
    protected $table = 'booking';

    public function add_booking($request){
        $loginUser = Session::all();
        $objBooking = new Booking();
        $objBooking->userid = $loginUser['logindata'][0]['id'];
        $objBooking->package = $request->input('package');
        $objBooking->price = $request->input('price');
        $objBooking->startdate = date("Y-m-d", strtotime($request->input('startdate')));
        $objBooking->enddate = date("Y-m-d", strtotime($request->input('enddate')));
        $objBooking->status = 'A';
        $objBooking->created_at = date("Y-m-d H:i:s");
        $objBooking->updated_at = date("Y-m-d H:i:s");
        return $objBooking->save();
    }

    public function get_booking_list($userId){
        return Booking::from('booking')
                    ->join('packages', 'packages.id', '=', 'booking.package')
                    ->join('users', 'users.id', '=', 'booking.userid')
                    ->join('event_category', 'event_category.id', '=', 'packages.category')
                    ->join('places', 'places.id', '=', 'packages.places')
                    ->where('booking.userid', $userId)
                    ->orderBy('booking.id', 'DESC')
                    ->select('booking.price', 'booking.id', 'booking.status', 'packages.name as packages', 'event_category.name as event_category', 'places.name as places', 'booking.startdate', 'booking.enddate')
                    ->get()->toArray();
    }

    public function common_activity_user($data){

        $objBooking = Booking::find($data['id']);
        $objBooking->status = "C";
        $objBooking->updated_at = date("Y-m-d H:i:s");
        if($objBooking->save()){
            return true;
        }else{
            return false ;
        }
    }
}
