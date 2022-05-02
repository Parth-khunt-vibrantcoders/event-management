<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Audittrails;
use DB;
use Hash;
use Route;
use Session;
class Users extends Model
{
    use HasFactory;
    protected $table= 'users';

    public function update_profile($request){
        $countUser = Users::where("email",$request->input('email'))
                        ->where("id",'!=',$request->input('edit_id'))
                        ->count();

        if($countUser == 0){

            $objUsers = Users::find($request->input('edit_id'));
            $objUsers->first_name = $request->input('first_name');
            $objUsers->last_name = $request->input('last_name');
            $objUsers->full_name = $request->input('first_name'). ' '. $request->input('last_name');
            $objUsers->email = $request->input('email');
            if($request->file('userimage')){
                $image = $request->file('userimage');
                $imagename = 'userimage'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/upload/userprofile/');
                $image->move($destinationPath, $imagename);
                $objUsers->userimage  = $imagename ;
            }
            if($objUsers->save()){
                $currentRoute = Route::current()->getName();
                $inputData = $request->input();
                unset($inputData['_token']);
                unset($inputData['profile_avatar_remove']);
                unset($inputData['userimage']);
                if($request->file('userimage')){
                    $inputData['userimage'] = $imagename;
                }
                $objAudittrails = new Audittrails();
                $res = $objAudittrails->add_audit('Update','admin/'. $currentRoute , json_encode($inputData) ,'Update Profile' );
                return true;
            }else{
                return "false";
            }

        }else{
            return "email_exist";
        }
    }

    public function changepassword($request)
    {

        if (Hash::check($request->input('old_password'), $request->input('user_old_password'))) {
            $countUser = Users::where("id",'=',$request->input('editid'))->count();
            if($countUser == 1){
                $objUsers = Users::find($request->input('editid'));
                $objUsers->password =  Hash::make($request->input('new_password'));
                $objUsers->updated_at = date('Y-m-d H:i:s');
                if($objUsers->save()){
                    $currentRoute = Route::current()->getName();
                    $inputData = $request->input();
                    unset($inputData['_token']);
                    unset($inputData['user_old_password']);
                    unset($inputData['old_password']);
                    unset($inputData['new_password']);
                    unset($inputData['new_confirm_password']);
                    $objAudittrails = new Audittrails();
                    $res = $objAudittrails->add_audit('Update','admin/'. $currentRoute , json_encode($inputData) ,'Change Password' );
                    return true;
                }else{
                    return 'false';
                }
            }else{
                return "false";
            }
        }else{
            return "password_not_match";
        }
    }

    public function signup($request){

        $count = Users::where('users.is_deleted','N')->where('users.email', $request->input('email'))->count();
        if($count == 0){
            $objUsers = new Users();
            $objUsers->first_name =  $request->input('firstname');
            $objUsers->last_name =  $request->input('lastname');
            $objUsers->full_name =  $request->input('firstname')." ".$request->input('lastname');
            $objUsers->email  =  $request->input('email');
            $objUsers->email_verified_at = date('Y-m-d H:i:s');
            $objUsers->password =  Hash::make($request->input('password'));
            $objUsers->userimage =  NULL;
            $objUsers->user_type =  'U';
            $objUsers->status =  'A';
            $objUsers->is_deleted =  'N';
            $objUsers->created_at =  date('Y-m-d H:i:s');
            $objUsers->updated_at =  date('Y-m-d H:i:s');
            if($objUsers->save()){
                return 'true';
            }else{
                return 'false';
            }
        }
        return 'email_already_exits';
    }
    
    public function getdatatable()
    {
        // ccd($employee_list);
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'users.id',
            1 => 'users.first_name',
            2 => 'users.last_name',
            3 => 'users.email',
            4 => 'users.created_at',

        );
        $query = Audittrails ::from('users')
                ->where('users.user_type', 'U')
                ->where('users.is_deleted', 'N');

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
                    ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.created_at',)
                    ->get();

        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {
            $actionhtml  = '';

            $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#deleteModel" class="btn btn-icon  delete-users" data-id="' . $row["id"] . '"  title="Delete Place"><i class="fa fa-trash text-danger" ></i></a>';

            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row['first_name'];
            $nestedData[] = $row['last_name'];
            $nestedData[] = $row['email'];
            $nestedData[] = date("d-m-Y",strtotime($row['created_at']));
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
        
        $loginUser = Session::all();
        $objUsers = Users::find($data['id']);        
        $objUsers->is_deleted = "Y";
        $event = 'Delete Place';
        $objUsers->updated_at = date("Y-m-d H:i:s");
        if($objUsers->save()){
            $currentRoute = Route::current()->getName();
            $objAudittrails = new Audittrails();
            $res = $objAudittrails->add_audit($event, 'admin/users/'.$currentRoute, json_encode($data), 'Users');
            return true;
        }else{
            return false ;
        }
    }
}
