<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Route;
class Subscriber extends Model
{
    use HasFactory;
    protected $table = 'subscriber';


    public function getdatatable(){
        $requestData = $_REQUEST;

        $columns = array(
            0 => 'subscriber.id',
            1 => 'subscriber.sr_no',
            2 => 'subscriber.name',
            3 => DB::raw('CONCAT(address_1, address_2, address_3)'),
            4 => 'subscriber.pincode',
            5 => 'subscriber.contactno',
            6 => 'subscriber.landline',
            7 => 'subscriber.email',
            8 => 'subscriber.start_date',
            9 => 'subscriber.end_date',
        );

        $query = Subscriber ::from('subscriber')
                ->where('subscriber.is_deleted', 'N');


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
                        ->select('subscriber.id', 'subscriber.sr_no', 'subscriber.name', DB::raw('CONCAT(address_1, address_2, address_3) AS address'), 'subscriber.pincode', 'subscriber.contactno', 'subscriber.landline', 'subscriber.email', 'subscriber.start_date', 'subscriber.end_date')
                        ->get();
        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {

            $actionhtml = '';
            $actionhtml =  $actionhtml. '<a href="' . route('subscriber-view', $row['id']) . '" class="btn btn-icon"><i class="fa fa-eye text-info" title="View Subscriber Details"> </i></a>';
            $actionhtml =  $actionhtml. '<a href="' . route('subscriber-edit', $row['id']) . '" class="btn btn-icon"><i class="fa fa-edit text-warning" title="Edit Subscriber Details"> </i></a>';
            $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#deleteModel" class="btn btn-icon  delete-subscriber" data-id="' . $row["id"] . '"  title="Delete Subscriber"><i class="fa fa-trash text-danger" ></i></a>';

            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            if($row['sr_no'] == '' || $row['sr_no'] == null){
                $nestedData[] = '-';
            }else{
                $nestedData[] = $row['sr_no'];
            }

            if($row['name'] == '' || $row['name'] == null){
                $nestedData[] = '-';
            }else{
                $nestedData[] = $row['name'];
            }

            if($row['address'] == '' || $row['address'] == null){
                $nestedData[] = '-';
            }else{
                $nestedData[] = $row['address'];
            }

            if($row['pincode'] == '' || $row['pincode'] == null){
                $nestedData[] = '-';
            }else{
                $nestedData[] = $row['pincode'];
            }

            if($row['contactno'] == '' || $row['contactno'] == null){
                $nestedData[] = '-';
            }else{
                $nestedData[] = $row['contactno'];
            }

            if($row['landline'] == '' || $row['landline'] == null){
                $nestedData[] = '-';
            }else{
                $nestedData[] = $row['landline'];
            }

            if($row['email'] == '' || $row['email'] == null){
                $nestedData[] = '-';
            }else{
                $nestedData[] = $row['email'];
            }

            if(($row['start_date']) == '' || ($row['start_date']) == null){
                $nestedData[] = '-';
            }else{
                $nestedData[] = date_formate($row['start_date']);
            }

            if(($row['end_date']) == '' || ($row['end_date']) == null){
                $nestedData[] = '-';
            }else{
                $nestedData[] = date_formate($row['end_date']);
            }

            $nestedData[] = $actionhtml;
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

    public function add_subscriber($request){

        $checkCrnumber = Subscriber::from('subscriber')
        ->where('subscriber.is_deleted', 'N')
        ->where('subscriber.sr_no' , $request->input('sr_no'))
        ->count();

        if($checkCrnumber == 0){

            $codeNumber = get_no_by_name('subscriber');

            if($codeNumber->number > 0 && $codeNumber->number < 10){
                $code = "SUB0000".$codeNumber->number;
            } else{
                if($codeNumber->number > 9 && $codeNumber->number < 100){
                    $code = "SUB000".$codeNumber->number;
                }else{
                    if($codeNumber->number > 99 && $codeNumber->number < 1000){
                        $code = "SUB00".$codeNumber->number;
                    }else{
                        if($codeNumber->number > 999 && $codeNumber->number < 10000){
                            $code = "SUB0".$codeNumber->number;
                        }else{
                            $code = "SUB".$codeNumber->number;
                        }
                    }
                }
            }
            $countcode = Subscriber::where('subscriber.is_deleted', 'N')
                    ->where('subscriber.subscriber_no', $code)
                    ->count();

            if($countcode == 0){

                $objSubscriber = new Subscriber();
                $objSubscriber->subscriber_no = $code;
                $objSubscriber->sr_no = $request->input('sr_no');
                $objSubscriber->name = $request->input('name');
                $objSubscriber->address_1 = $request->input('address_1');
                $objSubscriber->address_2 = $request->input('address_2');
                $objSubscriber->address_3 = $request->input('address_3');
                $objSubscriber->area = $request->input('area');
                $objSubscriber->city = $request->input('city');
                $objSubscriber->state = $request->input('state');
                $objSubscriber->pincode = $request->input('pincode');
                $objSubscriber->contactno = $request->input('contactno');
                if($request->input('start_date') != '' || $request->input('start_date') != null){
                    $objSubscriber->start_date = date("Y-m-d", strtotime($request->input('start_date')));

                }
                if($request->input('end_date') != '' || $request->input('end_date') != null){
                    $objSubscriber->end_date = date("Y-m-d", strtotime($request->input('end_date')));

                }
                $objSubscriber->landline = $request->input('landline');
                $objSubscriber->email = $request->input('email');
                $objSubscriber->type = $request->input('type');
                $objSubscriber->price = $request->input('price');
                $objSubscriber->created_at = date('Y-m-d H:i:s');
                $objSubscriber->updated_at = date('Y-m-d H:i:s');

                if($objSubscriber->save()){
                    auto_increment_no('subscriber');
                    $currentRoute = Route::current()->getName();
                    $inputData = $request->input();
                    unset($inputData['_token']);
                    $objAudittrails = new Audittrails();
                    $res = $objAudittrails->add_audit('Insert','admin/users/'. $currentRoute , json_encode($inputData) ,'Subsciber' );
                    return 'true';
                }else{
                    return 'false';
                }
            }
            auto_increment_no('subscriber');
            $this->add_subscriber($request);
        }
        return 'cr_number';
    }

    public function get_subscriber_details($editid){
        return Subscriber::from('subscriber')
                         ->where('subscriber.id', $editid)
                         ->where('subscriber.is_deleted', 'N')
                         ->select('subscriber.id', 'subscriber.sr_no', 'subscriber.area', 'subscriber.city', 'subscriber.state', 'subscriber.name', 'subscriber.address_1', 'subscriber.address_2', 'subscriber.address_3', 'subscriber.pincode', 'subscriber.contactno', 'subscriber.landline', 'subscriber.email', 'subscriber.start_date', 'subscriber.end_date', 'subscriber.type', 'subscriber.price')
                         ->get()
                         ->toArray();
    }

    public function edit_subscriber($request){
        $checkCrnumber = Subscriber::from('subscriber')
        ->where('subscriber.is_deleted', 'N')
        ->where('subscriber.id', '!=', $request->input('editid'))
        ->where('subscriber.sr_no' , $request->input('sr_no'))
        ->count();

        if($checkCrnumber == 0){
            $objSubscriber =Subscriber::find($request->input('editid'));
                $objSubscriber->sr_no = $request->input('sr_no');
                $objSubscriber->name = $request->input('name');
                $objSubscriber->address_1 = $request->input('address_1');
                $objSubscriber->address_2 = $request->input('address_2');
                $objSubscriber->address_3 = $request->input('address_3');
                $objSubscriber->area = $request->input('area');
                $objSubscriber->city = $request->input('city');
                $objSubscriber->state = $request->input('state');
                $objSubscriber->pincode = $request->input('pincode');
                $objSubscriber->contactno = $request->input('contactno');
                if($request->input('start_date') != '' || $request->input('start_date') != null){
                    $objSubscriber->start_date = date("Y-m-d", strtotime($request->input('start_date')));

                }
                if($request->input('end_date') != '' || $request->input('end_date') != null){
                    $objSubscriber->end_date = date("Y-m-d", strtotime($request->input('end_date')));

                }
                $objSubscriber->landline = $request->input('landline');
                $objSubscriber->email = $request->input('email');
                $objSubscriber->type = $request->input('type');
                $objSubscriber->price = $request->input('price');
                $objSubscriber->updated_at = date('Y-m-d H:i:s');

                if($objSubscriber->save()){
                    auto_increment_no('subscriber');
                    $currentRoute = Route::current()->getName();
                    $inputData = $request->input();
                    unset($inputData['_token']);
                    $objAudittrails = new Audittrails();
                    $res = $objAudittrails->add_audit('Edit','admin/users/'. $currentRoute , json_encode($inputData) ,'Subsciber' );
                    return 'true';
                }else{
                    return 'false';
                }
        }
        return 'cr_number';
    }

    public function common_activity_user($data,$type){

        $objSubscriber = Subscriber::find($data['id']);
        if($type == 0){
            $objSubscriber->is_deleted = "Y";
            $event = 'Delete Subscriber';
        }

        $objSubscriber->updated_at = date("Y-m-d H:i:s");
        if($objSubscriber->save()){
            $currentRoute = Route::current()->getName();
            $objAudittrails = new Audittrails();
            $res = $objAudittrails->add_audit($event, 'admin/users/'.$currentRoute, json_encode($data), 'Subsciber');
            return true;
        }else{
            return false ;
        }
    }
}
