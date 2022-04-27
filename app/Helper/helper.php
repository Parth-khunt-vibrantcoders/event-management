<?php

use App\Models\Codenumber;
use App\Models\Systemsetting;

function date_formate($date){
    return date("d-M-Y", strtotime($date));
}


function remaing_days($start_date, $end_date){
    return abs(round((strtotime($start_date) - strtotime($end_date)) / (60 * 60 * 24)));
}

function find_date($days, $start_date){
    return date('Y-m-d', strtotime($days." day", strtotime($start_date)));
}

function ccd($value){
    echo "<pre>"; print_r($value); die();
}

function numberformat($value){
    return number_format((float)$value, Config::get('constants.DECIMAL_POINT'), '.', '');
}

function get_no_by_name($no_for){
    $objCodenumber = new Codenumber();
    return $objCodenumber->get_no_by_name($no_for);
}

function auto_increment_no($no_for){
    $objCodenumber = new Codenumber();
    $res = $objCodenumber->auto_increment_no($no_for);
}

function get_system_setting_detail(){
    $objSystemsetting = new Systemsetting();
    return $objSystemsetting->get_system_setting_detail();
}

?>
