<?php
require_once("../../conn/db_include.php");

class po {
    private $po_no;
    private $po_status;
    private $po;
    private $serialize_po;
    public  $errmsg;
            
    function __construct($pono) {
        global $db;
        $errmsg = null;
        $sql = "SELECT *
                FROM po
                WHERE po_no = $pono";
        if($por = $db->get_record_sql($sql)){
            //then get the po detail
            $podetailsql = "SELECT *
                            FROM podetail
                            WHERE po_no = ".$por->po_no;
            $podetailrs = $db->get_records_sql($podetailsql, 'poDetail_no');
            if($podetailrs){
                $por->podetail = $podetailrs;
                $this->po = $por;
                $this->serialize_po = serialize($por);
            } else {
                $this->errmsg = '[po] no podetail';
            }
        } else {
            $this->errmsg = '[po] po not find';
        }
    }

   
    public function get_po() {
        return $this->po;
    }
    public function get_serialize_po() {
        return $this->serialize_po;
    }
    public function get_errmsg() {
        return $this->errmsg;
    }
    public function delete_po($param) {
        
    }
    
    public function get_postatus($param) {
        
    }
    
}