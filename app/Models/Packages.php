<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use App\Models\Audittrails;
use Route;

class Packages extends Model
{
    use HasFactory;
    protected $table = 'packages';

    public function getdatatable()
    {
        // ccd($employee_list);
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'packages.id',
            1 => 'packages.photo',
            2 => 'packages.name',
            3 => 'places.name',
            4 => 'event_category.name',
            5 => 'packages.price',
            6 => 'packages.details',
            7 => DB::raw('(CASE WHEN packages.status = "A" THEN "Active" ELSE "Deactive" END)'),

        );
        $query = Audittrails ::from('packages')
                ->join('event_category', 'event_category.id', '=', 'packages.category')
                ->join('places', 'places.id', '=', 'packages.places')
                ->where('packages.is_deleted', 'N');

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
                    ->select('packages.id', 'packages.name', 'packages.status', 'packages.photo', 'places.name as places', 'event_category.name as event_category', 'packages.price', 'packages.details')
                    ->get();

        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {
            $actionhtml  = '';

            if(file_exists( public_path().'/upload/packages/'.$row['photo']) && $row['photo'] != ''){
                $packages = url("public/upload/packages/".$row['photo']);
            }else{
                $packages = url("public/upload/packages/no-image.png");
            }

            $actionhtml =  $actionhtml. '<a href="' . route('packages-edit', $row['id']) . '" class="btn btn-icon"><i class="fa fa-edit text-warning" title="Edit packages"> </i></a>';
            if($row['status'] == 'A'){
                $status = '<span class="label label-lg label-success label-inline">Active</span>';
                $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#deactiveModel" class="btn btn-icon  deactive-packages" data-id="' . $row["id"] . '" title="Deactive Packages" ><i class="fa fa-times text-danger" ></i></a>';
            }else{
                $status = '<span class="label label-lg label-danger  label-inline">Deactive</span>';
                $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#activeModel" class="btn btn-icon  active-packages" data-id="' . $row["id"] . '" title="Active Packages" ><i class="fa fa-check text-success" ></i></a>';
            }
            $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#deleteModel" class="btn btn-icon  delete-packages" data-id="' . $row["id"] . '"  title="Delete Packages"><i class="fa fa-trash text-danger" ></i></a>';

            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = '<img src="'.$packages.'" class="rounded-circle table-image"  style="width:70px;height:70px">';
            $nestedData[] = $row['name'];
            $nestedData[] = $row['places'];
            $nestedData[] = $row['event_category'];
            $nestedData[] = $row['price'];
            $nestedData[] = $row['details'];
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

    public function common_activity_user($data,$type){
        $loginUser = Session::all();

        $objPackages = Packages::find($data['id']);
        if($type == 0){
            $objPackages->is_deleted = "Y";
            $event = 'Delete Packages';
        }
        if($type == 1){
            $objPackages->status = "A";
            $event = 'Active Packages';
        }
        if($type == 2){
            $objPackages->status = "I";
            $event = 'Deactive Packages';
        }

        $objPackages->updated_at = date("Y-m-d H:i:s");
        if($objPackages->save()){
            $currentRoute = Route::current()->getName();
            $objAudittrails = new Audittrails();
            $res = $objAudittrails->add_audit($event, 'admin/packages/'.$currentRoute, json_encode($data), 'Packages');
            return true;
        }else{
            return false ;
        }
    }


}
