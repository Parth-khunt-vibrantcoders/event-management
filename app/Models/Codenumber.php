<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codenumber extends Model
{
    use HasFactory;
    protected $table = 'code_number';

    public function get_no_by_name($no_for){
        $res =  Codenumber::select('code_number.number', 'code_number.id')
                        ->where('code_number.no_for',$no_for)
                        ->orderBy('code_number.id', 'DESC')
                        ->first();
        if($res){
            return $res;
        }else{
            $objCodenumber = new Codenumber();
            $objCodenumber->no_for = $no_for;
            $objCodenumber->number = 1;
            $objCodenumber->created_at = date("Y-m-d H:i:s");
            $objCodenumber->updated_at = date("Y-m-d H:i:s");
            $objCodenumber->save();

            return $this->get_no_by_name($no_for);
        }
    }

    public function auto_increment_no($no_for){
        $number = $this->get_no_by_name($no_for);
        $objCodenumber = Codenumber::find($number->id);
        $objCodenumber->number = (int)$number->number + 1 ;
        $objCodenumber->updated_at = date("Y-m-d H:i:s");
        $objCodenumber->save();
    }
}
