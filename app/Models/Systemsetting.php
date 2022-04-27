<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Route;

class Systemsetting extends Model
{
    use HasFactory;
    protected $table = 'system_setting';

    public function update_system_setting($request){

        $count = Systemsetting::where('system_setting.id', '!=', $request->input('editid'))
               ->count();

        if($count == 0){

            $objSystemsetting = Systemsetting::find($request->input('editid'));
            $objSystemsetting->system_name = $request->input('system_name');
            $objSystemsetting->website_keywords = $request->input('website_keywords');
            $objSystemsetting->author_name = $request->input('author');
            $objSystemsetting->date_formate = $request->input('date_formate');
            $objSystemsetting->decimal_point = $request->input('decimal_point');
            $objSystemsetting->footer_text = $request->input('footer_text');
            $objSystemsetting->footer_link = $request->input('footer_link');
            $objSystemsetting->website_description = $request->input('website_description');


            if($request->file('website_logo')){
                $image = $request->file('website_logo');
                $imagename = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/upload/systemsetting/');
                $image->move($destinationPath, $imagename);
                $objSystemsetting->website_logo = $imagename;

            }
            if($request->file('favicon_icon')){
                $image = $request->file('favicon_icon');
                $imagename = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/upload/systemsetting/');
                $image->move($destinationPath, $imagename);
                $objSystemsetting->favicon_icon = $imagename;

            }

            $objSystemsetting->updated_at = date("Y-m-d H:i:s");
            if($objSystemsetting->save()){

                $currentRoute = Route::current()->getName();
                $inputData = $request->input();
                unset($inputData['_token']);
                $objAudittrails = new Audittrails();
                $res = $objAudittrails->add_audit('Edit','admin/'. $currentRoute , json_encode($inputData) ,' Systemsetting' );
                return "true";
            }
            return "false";
        }
        return "false" ;
    }

    public function get_system_setting_details(){
        return Systemsetting::select('system_setting.id','system_setting.system_name','system_setting.website_keywords','system_setting.author_name','system_setting.footer_text','system_setting.footer_link','system_setting.website_description','system_setting.website_logo','system_setting.favicon_icon','system_setting.decimal_point','system_setting.date_formate')
        ->get()
        ->toArray();
    }

    public function get_system_setting_detail(){
        return Systemsetting::select('system_setting.id','system_setting.system_name','system_setting.website_keywords','system_setting.author_name','system_setting.footer_text','system_setting.footer_link','system_setting.website_description','system_setting.website_logo','system_setting.favicon_icon','system_setting.decimal_point','system_setting.date_formate')
        ->first();
    }
}
