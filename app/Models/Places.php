<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use App\Models\Audittrails;
use Route;

class Places extends Model
{
    use HasFactory;
    protected $table = 'places';

    public function getdatatable()
    {
        // ccd($employee_list);
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'places.id',
            1 => 'places.name',
            2 => DB::raw('(CASE WHEN places.status = "A" THEN "Active" ELSE "Deactive" END)'),

        );
        $query = Audittrails ::from('places')
                ->where('places.is_deleted', 'N');

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
                    ->select('places.id', 'places.name', 'places.status')
                    ->get();

        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {
            $actionhtml  = '';


            $actionhtml =  $actionhtml. '<a href="' . route('places-edit', $row['id']) . '" class="btn btn-icon"><i class="fa fa-edit text-warning" title="Edit Place"> </i></a>';
            if($row['status'] == 'A'){
                $status = '<span class="label label-lg label-success label-inline">Active</span>';
                $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#deactiveModel" class="btn btn-icon  deactive-places" data-id="' . $row["id"] . '" title="Deactive Place" ><i class="fa fa-times text-danger" ></i></a>';
            }else{
                $status = '<span class="label label-lg label-danger  label-inline">Deactive</span>';
                $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#activeModel" class="btn btn-icon  active-places" data-id="' . $row["id"] . '" title="Active Place" ><i class="fa fa-check text-success" ></i></a>';
            }
            $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#deleteModel" class="btn btn-icon  delete-places" data-id="' . $row["id"] . '"  title="Delete Place"><i class="fa fa-trash text-danger" ></i></a>';

            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row['name'];
            $nestedData[] = $status;
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

    public function add_save_places($request){

        $count = Places::where('places.name', $request->input('place'))
                        ->where('places.is_deleted', 'N')
                        ->count();

        if($count == 0){
            $objPlaces = new Places();
            $objPlaces->name = $request->input('place');
            $objPlaces->status = $request->input('status');
            $objPlaces->is_deleted = 'N';
            $objPlaces->created_at = date('Y-m-d H:i:s');
            $objPlaces->updated_at = date('Y-m-d H:i:s');
            if($objPlaces->save()){
                $currentRoute = Route::current()->getName();
                $inputData = $request->input();
                unset($inputData['_token']);
                $objAudittrails = new Audittrails();
                $res = $objAudittrails->add_audit('Insert','admin/places/'. $currentRoute , json_encode($inputData) ,'Places' );
                return 'true';
            }else{
                return 'false';
            }
        }
        return 'places_exits';
    }

    public function get_places_details($placeId){
        return Places::where('places.id',$placeId)->select('places.id', 'places.name', 'places.status')->get()->toArray();
    }
    public function common_activity_user($data,$type){
        $loginUser = Session::all();

        $objPlaces = Places::find($data['id']);
        if($type == 0){
            $objPlaces->is_deleted = "Y";
            $event = 'Delete Place';
        }
        if($type == 1){
            $objPlaces->status = "A";
            $event = 'Active Place';
        }
        if($type == 2){
            $objPlaces->status = "I";
            $event = 'Deactive Place';
        }

        $objPlaces->updated_at = date("Y-m-d H:i:s");
        if($objPlaces->save()){
            $currentRoute = Route::current()->getName();
            $objAudittrails = new Audittrails();
            $res = $objAudittrails->add_audit($event, 'admin/places/'.$currentRoute, json_encode($data), 'Place');
            return true;
        }else{
            return false ;
        }
    }

    public function edit_save_places($request){
        $count = Places::where('places.name', $request->input('place'))
                        ->where('places.is_deleted', 'N')
                        ->where('places.id', '!=', $request->input('editId'))
                        ->count();

        if($count == 0){
            $objPlaces = Places::find($request->input('editId'));
            $objPlaces->name = $request->input('place');
            $objPlaces->status = $request->input('status');
            $objPlaces->is_deleted = 'N';
            $objPlaces->updated_at = date('Y-m-d H:i:s');
            if($objPlaces->save()){
                $currentRoute = Route::current()->getName();
                $inputData = $request->input();
                unset($inputData['_token']);
                $objAudittrails = new Audittrails();
                $res = $objAudittrails->add_audit('Update','admin/places/'. $currentRoute , json_encode($inputData) ,'Places' );
                return 'true';
            }else{
                return 'false';
            }
        }
        return 'places_exits';
    }

    public function get_places_list(){
        return Places::where('places.is_deleted', 'N')
                    ->where('places.status', 'A')
                    ->select('places.id', 'places.name')
                    ->get()
                    ->toArray();
    }
}
