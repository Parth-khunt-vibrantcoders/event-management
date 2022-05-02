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
        $objBooking->advance_payment = $request->input('advance_payment');
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
                    ->select('booking.price', 'booking.id', 'booking.status','booking.advance_payment', 'packages.name as packages', 'event_category.name as event_category', 'places.name as places', 'booking.startdate', 'booking.enddate')
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

    public function getdatatable($type)
    {
        // ccd($employee_list);
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'booking.id',
            1 => 'users.full_name',
            2 => 'packages.name',
            3 => 'places.name',
            4 => 'event_category.name',
            5 => 'booking.startdate',
            6 => 'booking.enddate',
            7 => 'booking.advance_payment',
        );
        $query = Audittrails ::from('booking')
                ->join('packages', 'packages.id', '=', 'booking.package')
                ->join('users', 'users.id', '=', 'booking.userid')
                ->join('event_category', 'event_category.id', '=', 'packages.category')
                ->join('places', 'places.id', '=', 'packages.places')
                ->where('booking.status', $type);

        if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $searchVal = $requestData['search']['value'];
            $query->where(function($query) use ($columns, $searchVal, $requestData) {
                $flag = 0;
                foreach ($columns as $key => $value) {
                    $searchVal = $requestData['search']['value'];
                    if ($requestData['columns'][$key]['searchable'] == 'true') {
                        if ($flag == 0) {
                            $query->where($value, 'like', '%' . $searchVal . '%');
                            $flag = $flag + 1;
                        } else {
                            $query->orWhere($value, 'like', '%' . $searchVal . '%');
                        }
                    }
                }
            });
        }

        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                    ->take($requestData['length'])
                    ->select('booking.id', 'packages.name', 'users.full_name', 'places.name as places', 'event_category.name as event_category', 'booking.startdate',
                    'booking.enddate', 'booking.advance_payment',)
                    ->get();

        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {
            $actionhtml  = '';

            $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#deleteModel" class="btn btn-icon  delete-contact-us" data-id="' . $row["id"] . '"  title="Delete Place"><i class="fa fa-trash text-danger" ></i></a>';

            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row['full_name'];
            $nestedData[] = $row['name'];
            $nestedData[] = $row['places'];
            $nestedData[] = $row['event_category'];
            $nestedData[] = date_formate($row['startdate']);
            $nestedData[] = date_formate($row['enddate']);
            $nestedData[] = $row['advance_payment'];
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        return $json_data;
    }

}
