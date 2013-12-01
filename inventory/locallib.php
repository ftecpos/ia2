<?php

function add_transfer_from_po($pono, $dnno){
    global $db;
    //1. get back the po
    $sql = "SELECT *
            FROM po
            WHERE po_no = $pono";
    $po_record = $db->get_record_sql($sql);
    if(!$po_record){
        return FALSE;
    }
    $sql = "SELECT *
            FROM podetail
            WHERE po_no = $po_record->po_no
            AND phonetype_no is null";  //we dont handle phone transfer here
    $podetail_record = $db->get_records_sql($sql, 'poDetail_no');
    if(!$podetail_record){
        print_error('No po detail record');
    }
    //print_r($podetail_record);
    $podetailno = array_keys($podetail_record);
    $fromretail_no = $_SESSION['retail_no'];
    $toretail_no = $po_record->forshop;
    if(!$stockin_record = get_stockin_record_by_podetailno($podetailno, array("isforshop !=$fromretail_no"))){
        print_error('No stockin record');
    }
    
    foreach ($stockin_record as $record){
        $podetail_record[$record->podetail_no]->stockin_ava_bal += $record->ava_bal;
        $podetail_record[$record->podetail_no]->stockin_trans_qty += $record->trans_qty;
        
        $forpodetail_stockin_record = new stdClass();
        $forpodetail_stockin_record->stockin_no = $record->stockin_no;
        $forpodetail_stockin_record->ava_bal = $record->ava_bal;
        $forpodetail_stockin_record->po_date = $record->po_date;
        
        $podetail_record[$record->podetail_no]->stockin_records[] = $forpodetail_stockin_record;
    }
    unset($stockin_record);
    //start the checking
    $transfer_detail = array();
    foreach ($podetail_record as $key => $podetail){
        if($podetail->qty != $podetail->stockin_ava_bal){
            print_error('Ava bal of stockin is not enough, ref pod:'.$key);
        }
        if($podetail->stockin_trans_qty != 0){
            print_error('Trans qty of stockin must be 0 , ref pod:'.$key);
        }
        //if all ok, perpare data for transfer detail
        
        foreach($podetail->stockin_records as $psr){
            $transfer_detail_obj = new stdClass();
            $transfer_detail_obj->trans_qty = $psr->ava_bal;
            $transfer_detail_obj->acc_no = $podetail->acc_no;
            $transfer_detail_obj->po_date = $psr->po_date;
            $transfer_detail_obj->stockIn_no = $psr->stockin_no;
            $transfer_detail[] = $transfer_detail_obj;
        }
    }
    
    //if no error, create transfer
    $new_transfer = new stdClass();
    $new_transfer->transDate = get_date();
    $new_transfer->fromRetail_no = $fromretail_no;
    $new_transfer->toRetail_no = $toretail_no;
    $new_transfer->staff_no = $_SESSION['staff_no'];
    $new_transfer->transState_no = 1;
    $new_transfer->tranReson = '普通轉貨(PO to TRANSFER)';
    $new_transfer->ftec_dnno = $dnno;
    
    if(!$new_transferid = $db->insert_record('transfer', $new_transfer)){
        print_error("Cannot create transfer note!");
    }
    $transfer_detail_no = array();
    foreach ($transfer_detail as $trans_detail){
        $trans_detail->transfer_no = $new_transferid;
        //update stockin trans_qty also
        $update_stockin_rec = new stdClass();
        $update_stockin_rec->stockIn_no = $trans_detail->stockIn_no;
        $update_stockin_rec->trans_qty = $trans_detail->trans_qty;
        $update_stockin_rec->ava_bal = 0; //ava_bal must set to 0
        $db->update_record('stockin', $update_stockin_rec,'stockIn_no');
        $transfer_detail_no[] = $db->insert_record('transdetail', $trans_detail);
    }
    //also update po status
    $update_po_rec = new stdClass();
    $update_po_rec->po_no = $po_record->po_no;
    $update_po_rec->transfed = 1;
    $update_po_rec->poState_no = 5;
    $db->update_record('po', $update_po_rec,'po_no');
    
    return TRUE;
    
}

function get_stockin_record_by_podetailno($podetailno, $condition = null){
    global $db;
    if(is_array($podetailno)){
        $podetailno_list = implode(",", $podetailno);
    } else {
        $podetailno_list = $podetailno;
    }
    if($condition){
        if(!is_array($condition)){
            print_error("Condition is not array");
        }
        $condition_list = implode(" AND ", $condition);
    }
    $sql = "SELECT *
            FROM stockin
            WHERE poDetail_no in ($podetailno_list)
            AND $condition_list";
    $record = $db->get_records_sql($sql,"stockIn_no");
    return $record;
}
function check_office_staff($staff_no){
    global $db;
    $sql = "SELECT *
            FROM staff
            WHERE staff_no = $staff_no
            AND canLogin = 1
            AND staffType_no = 1"; //please change to 1 later
    $record = $db->get_record_sql($sql);
    return $record;
}


function get_numofpo($pono_raw){
    return explode('-', $pono_raw);
}
function get_date(){
    return date("Y-m-d H:i:s");
}