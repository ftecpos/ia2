<?php

require_once("../../conn/db_include.php");
include_once("tr.php");

$tr_action = optional_param('tr_action', 'view');
$tr_no = optional_param('trno', 0);

$string_arr = array();
$string_arr['er001'] = '[!][er001] No shop data, please go sr page';
$string_arr['er002'] = '[!][er002] Please login';
$string_arr['er003'] = '[x][er003] Permission Deny for Retail Shop';
$string_arr['er004'] = '[x][er004] You have no permission';
$string_arr['tr001'] = '[x][tr001] Invalid Transfer number';
$string_arr['tr002'] = '[x][tr002] No TR number';
$string_arr['tr004'] = '[x][tr004] Default Error';
$string_arr['tr005'] = '[x][tr005] No delete log record, delete fail, please call POS Admin';

if(!check_shop_data()){
    print_error($string_arr['er001']);
}
if(!require_login()){
    print_error($string_arr['er002']);
}

if(!is_number($tr_no) or !$tr_no){
    print_error($string_arr['tr001']);
    exit();
}

switch ($tr_action){
    case 'viewtr':
        if(!$tr_no){
            print_error($string_arr['tr002']);
            exit();
        }
        $tr = new tr($tr_no);
        if($tr->get_errmsg()){
            print_error($tr->get_errmsg());
            exit();
        }
        $tr_data = $tr->get_tr();
        print_object($tr_data);
    break;
    
    case 'deletetr':
        //check office can use this function 
        if(!require_office()){
            print_error($string_arr['er003']);
        }
        //check user permission,
        if(!check_office_staff($_SESSION['staff_no'])){
            print_error($string_arr['er004']);
        }
        
        $tr = new tr($tr_no);
        if($tr->get_errmsg()){
            print_error($tr->get_errmsg());
            exit();
        }
        $tr_data = $tr->get_tr();
        if($tr_data->with_po){
            //no handle po with tr
            print_error('[!]not-in handle case (tr with po)');
        }
        $tr_delete_action = $tr->delete_tr();
    break;
    
    case 'viewdeleedtr':
        $data = tr::get_trdeleted_record(5529);
    break;

    default :
        //echo 'here is default po';
        print_error('[x][tr004]Default no action');
    break;
    
}