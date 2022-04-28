<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use App\Models\Audittrails;
use Route;

class Eventcategory extends Model
{
    use HasFactory;
    protected $table = 'event_category';

    public function getdatatable($employee_list = "")
    {
        // ccd($employee_list);
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'event_category.id',
            1 => 'event_category.name',
            2 => 'event_category.image',
            3 => DB::raw('(CASE WHEN event_category.status = "A" THEN "Active" ELSE "Deactive" END)'),

        );
        $query = Audittrails ::from('event_category')
                ->where('event_category.is_deleted', 'N');

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
                    ->select('event_category.id', 'event_category.name', 'event_category.image', 'event_category.status')
                    ->get();

        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {
            $actionhtml  = '';
            if(file_exists( public_path().'/upload/event_image/'.$row['image']) && $row['image'] != ''){
                $event_image = url("public/upload/event_image/".$row['image']);
            }else{
                $event_image = url("public/upload/event_image/no-image.png");
            }

            $actionhtml =  $actionhtml. '<a href="' . route('event-category-edit', $row['id']) . '" class="btn btn-icon"><i class="fa fa-edit text-warning" title="'.trans('configuration.edit_level_management').'"> </i></a>';
            if($row['status'] == 'A'){
                $status = '<span class="label label-lg label-success label-inline">Active</span>';
                $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#deactiveModel" class="btn btn-icon  deactive-event-category" data-id="' . $row["id"] . '" title="'.trans('configuration.deactive_level_management').'" ><i class="fa fa-times text-danger" ></i></a>';
            }else{
                $status = '<span class="label label-lg label-danger  label-inline">Deactive</span>';
                $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#activeModel" class="btn btn-icon  active-event-category" data-id="' . $row["id"] . '" title="'.trans('configuration.active_level_management').'" ><i class="fa fa-check text-success" ></i></a>';
            }
            $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#deleteModel" class="btn btn-icon  delete-event-category" data-id="' . $row["id"] . '"  title="'.trans('configuration.delet_level_management').'"><i class="fa fa-trash text-danger" ></i></a>';

            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = '<img src="'.$event_image.'" class="rounded-circle table-image"  style="width:70px;height:70px">';
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

    public function add_save_event_category($request){

        $count = Eventcategory::where('event_category.name', $request->input('event_category'))->where('event_category.is_deleted', 'N')->count();

        if($count == 0){
            $objEventcategory = new Eventcategory();
            $objEventcategory->name = $request->input('event_category');

            if($request->file('event_image')){
                $image = $request->file('event_image');
                $imagename = 'event_image'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/upload/event_image/');
                $image->move($destinationPath, $imagename);
                $objEventcategory->image  = $imagename ;
            }
            $objEventcategory->status = $request->input('status');
            $objEventcategory->is_deleted = 'N';
            $objEventcategory->created_at = date('Y-m-d H:i:s');
            $objEventcategory->updated_at = date('Y-m-d H:i:s');
            if($objEventcategory->save()){
                $currentRoute = Route::current()->getName();
                $inputData = $request->input();
                unset($inputData['_token']);
                $objAudittrails = new Audittrails();
                $res = $objAudittrails->add_audit('Insert','admin/event-category/'. $currentRoute , json_encode($inputData) ,'Event Category' );
                return 'true';
            }else{
                return 'false';
            }
        }
        return 'already_exits';
    }

    public function get_event_category_details($categoryId){
        return Eventcategory::where('event_category.id',$categoryId)
                    ->select('event_category.id', 'event_category.image', 'event_category.name', 'event_category.status')
                    ->get()->toArray();
    }

    public function edit_save_event_category($request){
        $count = Eventcategory::where('event_category.name', $request->input('event_category'))
                            ->where('event_category.is_deleted', 'N')
                            ->where('event_category.id', '!=', $request->input('editId'))
                            ->count();

        if($count == 0){
            $objEventcategory = Eventcategory::find($request->input('editId'));
            $objEventcategory->name = $request->input('event_category');

            if($request->file('event_image')){
                $image = $request->file('event_image');
                $imagename = 'event_image'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/upload/event_image/');
                $image->move($destinationPath, $imagename);
                $objEventcategory->image  = $imagename ;
            }
            $objEventcategory->status = $request->input('status');
            $objEventcategory->is_deleted = 'N';
            $objEventcategory->created_at = date('Y-m-d H:i:s');
            $objEventcategory->updated_at = date('Y-m-d H:i:s');
            if($objEventcategory->save()){
                $currentRoute = Route::current()->getName();
                $inputData = $request->input();
                unset($inputData['_token']);
                $objAudittrails = new Audittrails();
                $res = $objAudittrails->add_audit('Update','admin/event-category/'. $currentRoute , json_encode($inputData) ,'Event Category' );
                return 'true';
            }else{
                return 'false';
            }
        }
        return 'already_exits';
    }

    public function common_activity_user($data,$type){
        $loginUser = Session::all();

        $objEventcategory = Eventcategory::find($data['id']);
        if($type == 0){
            $objEventcategory->is_deleted = "Y";
            $event = 'Delete Event Category';
        }
        if($type == 1){
            $objEventcategory->status = "A";
            $event = 'Active Event Category';
        }
        if($type == 2){
            $objEventcategory->status = "I";
            $event = 'Deactive Event Category';
        }

        $objEventcategory->updated_at = date("Y-m-d H:i:s");
        if($objEventcategory->save()){
            $currentRoute = Route::current()->getName();
            $objAudittrails = new Audittrails();
            $res = $objAudittrails->add_audit($event, 'admin/event-category/'.$currentRoute, json_encode($data), 'Event Category');
            return true;
        }else{
            return false ;
        }
    }

    public function get_event_category_list(){
        return Eventcategory::where('event_category.is_deleted', 'N')
                    ->where('event_category.status', 'A')
                    ->select('event_category.id', 'event_category.name')
                    ->get()
                    ->toArray();
    }
}
