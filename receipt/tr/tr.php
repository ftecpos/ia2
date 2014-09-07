<?php
require_once("../../conn/db_include.php");

class tr {
    private $tr_no;
    private $tr_status;
    private $tr;
    private $serialize_tr;
    public  $errmsg;
            
    function __construct($trno) {
        global $db;
        $errmsg = null;
        $sql = "SELECT *
                FROM transfer
                WHERE transfer_no = $trno";
        if($trr = $db->get_record_sql($sql)){  //trr = transfer record
            //then get the transfer detail
            $trdetailsql = "SELECT *
                            FROM transdetail
                            WHERE transfer_no = $trr->transfer_no";
            $trdetailrs = $db->get_records_sql($trdetailsql, 'transDetail_no');
            $this->tr_no = $trr->transfer_no;
            if($trdetailrs){
                $trr->trdetail = $trdetailrs;
                $this->tr = $trr;
                $this->serialize_tr = serialize($trr);
            } else {
                $this->errmsg = '[tr] no trdetail';
            }
        } else {
            $this->errmsg = '[tr] tr not find';
        }
    }

   
    public function get_tr() {
        return $this->tr;
    }
    public function get_serialize_tr() {
        return $this->serialize_tr;
    }
    public function get_errmsg() {
        return $this->errmsg;
    }
    public function delete_tr() {
        global $db;
        $tr_data = $this->tr;
        switch($tr_data->transstate_no){
            //after get tr data, check the transstate_no is = 1, is mean 未收貨,
            //with can delete it directly, and update the stock after delete
            case 1: //未收貨
                //save the data to db and delete the record
                $serialize_tr = '';
                $serialize_tr = $this->get_serialize_tr();
                if(!empty($serialize_tr)){
                    $insert_obj = new stdClass();
                    $insert_obj->receipttype = 'tr';
                    $insert_obj->receiptno = $tr_data->transfer_no;
                    $insert_obj->staffno = $_SESSION['staff_no'];
                    $insert_obj->date = time();
                    $insert_obj->staffid = $_SESSION['staff_id'];
                    $insert_obj->data = $serialize_tr;
                    $delete_log_no = $db->insert_record('delete_log', $insert_obj);
                    
                    if($delete_log_no){
                        $this->do_delete_tr($tr_data, $delete_log_no);
                        //print out deleted po msg
                        $msgarray = array();
                        $msgarray["msg"] = "TR $tr_data->transfer_no has been delete";
                        $msgarray["ok"] = 1;
                        echo tojson($msgarray);
                    }
                }
            break;
            case 2: //已收貨
                print_error('[x][tr003]TR cannot delete, TR num : '.$tr_data->transfer_no.', TR state num : '.$tr_data->transstate_no);
            break;
            default:
                print_error($string_arr['tr004']);
            break;
        }
    }
    
    private function do_delete_tr($tr_data, $delete_log_no) {
        global $db;
        if(!$tr_data){
            return false;
        }
        //check is opject? or array

        $sql = "SELECT id, data
                FROM delete_log
                WHERE id = $delete_log_no";
        $stockin_rec = array();
        $delete_log_record = array();
        $can_delete_tr = false;
        if($delete_log_record = $db->get_record_sql($sql)){
            $delete_log_id = $delete_log_record->id;
            $receipt_data = unserialize($delete_log_record->data);
            $trdetail = $receipt_data->trdetail;
            //add old stock record in delete_log_record
            $trd_no_arr = array();
            foreach ($trdetail as $trd){
                $trd_no_arr[] = $trd->stockin_no;
            }
            $sql = "SELECT *
                   FROM stockin
                   WHERE stockIn_no in (".implode(',', $trd_no_arr).")";
            $stockin_rec = $db->get_records_sql($sql, 'stockIn_no');

            $receipt_data->oldstockdetail = $stockin_rec;
            //perpar for update
            $update_obj = new stdClass();
            $update_obj->id = $delete_log_id;
            $update_obj->data = serialize($receipt_data);
            $db->update_record('delete_log', $update_obj, 'id');
            //unserialize($sql);
            $can_delete_tr = true;
        }
        if(!$delete_log_record && !$can_delete_tr && !$stockin_rec){
            print_error($string_arr['tr005']);
        }
        //two parts needed to delete, first is trdetail and second is tr
        //later update stock bal
        //1. delete trdetail
        $trdetail = $tr_data->trdetail;
        foreach ($trdetail as $key => $detail){
            $del_trdetail_sql ="DELETE FROM transdetail WHERE transDetail_no = $key ";
            $db->query($del_trdetail_sql);
            if(isset($stockin_rec[$detail->stockin_no])){
                $stockin_record = $stockin_rec[$detail->stockin_no];
                $ava_bal_add = $detail->trans_qty;
                $trans_qty_reduce = $detail->trans_qty;

                $sql = "UPDATE stockin 
                        SET ava_bal = ava_bal+$ava_bal_add ,
                            trans_qty = trans_qty-$trans_qty_reduce
                        WHERE stockIn_no ='$detail->stockin_no' ";
                $db->query($sql);
            }
        }
        //2. delete tr
        $db->query("DELETE FROM transfer WHERE transfer_no = $this->tr_no ");
    }
    
    public function get_trdeleted_record($trno) {
        global $db;
        $sql = "SELECT *
                FROM delete_log
                WHERE receipttype = 'tr'
                AND receiptno = $trno
                ";
        $data = $db->get_records_sql($sql, 'id');
        
        foreach ($data as $d){
            print_object(unserialize($d->data));
        }
    }
    
}