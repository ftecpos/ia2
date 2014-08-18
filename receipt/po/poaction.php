<?php

require_once("../../conn/db_include.php");
include_once("po.php");

$po_action = optional_param('po_action', 'view');
$po_no = optional_param('pono', 0);

if(!check_shop_data()){
    print_error('[!][er001] No shop data, please go sr page');
}
if(!require_login()){
    print_error('[!][er002]Please login');
}

if(!is_number($po_no)){
    print_error('[x][po001]Invalid PO number');
    exit();
}

switch ($po_action){
    case 'deletepo':
        //check user permission, and this function is for office
        if(!require_office()){
            print_error('[x][er003]Permission Deny for Retail Shop');
        }

        //get po detail
        if(!$po_no){
            print_error('[x][po002]No PO number');
            exit();
        }
        $po = new po($po_no);
        if($po->get_errmsg()){
            print_error($po->get_errmsg());
            exit();
        }
        $po_data = $po->get_po();
        //print_object(unserialize($po_data_sered));
        
        switch($po_data->postate_no){
            //after get po data, check the poState_no is = 1, is mean 開啟 -- 等待到貨, with can delete it directly
            case 1:
                //save the data to db and delete the record
                $serialize_po = '';
                $serialize_po = $po->get_serialize_po();
                if(!empty($serialize_po)){
                    $insert_obj = new stdClass();
                    $insert_obj->receipttype = 'po';
                    $insert_obj->receiptno = $po_data->po_no;
                    $insert_obj->staffno = $_SESSION['staff_no'];
                    $insert_obj->date = time();
                    $insert_obj->staffid = $_SESSION['staff_id'];
                    $insert_obj->data = $po->get_serialize_po();
                    $delete_log_no = $db->insert_record('delete_log', $insert_obj);
                    if($delete_log_no){
                        delete_po($po_data);
                        //print out deleted po msg
                        $msgarray = array();
                        $msgarray["msg"] = "PO $po_data->po_no has been delete";
                        $msgarray["ok"] = 1;
                        echo tojson($msgarray);
                    }
                }
            break;
            default:
                print_error('[x][po003]PO cannot delete, PO num : '.$po_data->po_no.', PO state num : '.$po_data->postate_no);
            break;
        }
    break;
    
    case 'viewdeleedpo':
        
    break;

    default :
        //echo 'here is default po';
        print_error('[x][po004]Default no action');
    break;
    
}


function delete_po($po_data){
    global $db;
    if(!$po_data){
        return false;
    }
    //check is opject? or array
    
    //two parts needed to delete, first is podetail and second is po
    //1. delete podetail
    $podetail = $po_data->podetail;
    foreach ($podetail as $key => $detail){
        $del_podetail_sql ="DELETE FROM podetail WHERE poDetail_no = $key ";
        $db->query($del_podetail_sql);
    }
    //2. delete po
    $db->query("DELETE FROM po WHERE po_no = $po_data->po_no ");
}