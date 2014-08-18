<?php 

require ("../conn/db_include.php");

require ("locallib.php");

//must set timezone on the top	
$timezone = "Asia/Hong_Kong";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
//must set timezone on the top	

set_time_limit(300);

global $db;

$action = array();
$output = new stdClass();
if(!$action = optional_param("action",0)){
    $msg = 'No action';
    echo tojson($_SESSION);
    //print_error($msg);
}

switch ($action){
    case 'add_transfer_from_po':
        //check use can use this function
        if(!check_office_staff($_SESSION['staff_no'])){
            print_error('You have no permission');
        }
        $pono_raw = optional_param("pono", 0);
        $dnno_raw = optional_param("dnno", 0);
        if(!$pono_raw){ print_error('No PO No.');   }
        
        $pono_temp = get_numofpo($pono_raw);
        $pono = $pono_temp[1];
        
        if(!add_transfer_from_po($pono, $dnno_raw)){
            print_error('Fail to add transfer');
        }
        
        print_json(array("success"=>"1"));
        
    break;
}


