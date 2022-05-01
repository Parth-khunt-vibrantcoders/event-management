<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    use HasFactory;
    protected $table = 'contact_us' ;

    public function save_contact_form($request){
        $objContactus = new Contactus();
        $objContactus->name = $request->input('name');
        $objContactus->lastname = $request->input('lastname');
        $objContactus->email = $request->input('email');
        $objContactus->message = $request->input('message');
        $objContactus->is_deleted = 'N';
        $objContactus->created_at = date('Y-m-d H:i:s');
        $objContactus->updated_at = date('Y-m-d H:i:s');
        return $objContactus->save();
    }

    public function getdatatable()
    {
        // ccd($employee_list);
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'contact_us.id',
            1 => 'contact_us.name',
            2 => 'contact_us.lastname',
            3 => 'contact_us.email',
            4 => 'contact_us.message',
        );
        $query = Audittrails ::from('contact_us')
                ->where('contact_us.is_deleted', 'N');

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
                    ->select('contact_us.id', 'contact_us.name', 'contact_us.lastname', 'contact_us.email', 'contact_us.message')
                    ->get();

        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {
            $actionhtml  = '';

            $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#deleteModel" class="btn btn-icon  delete-contact-us" data-id="' . $row["id"] . '"  title="Delete Place"><i class="fa fa-trash text-danger" ></i></a>';

            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row['name'];
            $nestedData[] = $row['lastname'];
            $nestedData[] = $row['email'];
            $nestedData[] = $row['message'];
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

    public function common_activity_user($data){

        $objContactus = Contactus::find($data['id']);
        $objContactus->is_deleted = "Y";
        $objContactus->updated_at = date("Y-m-d H:i:s");
        if($objContactus->save()){
            return true;
        }else{
            return false ;
        }
    }
}
