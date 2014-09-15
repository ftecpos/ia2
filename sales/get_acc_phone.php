<?php require ("../conn/db_include.php")?>
<?php
//must set timezone on the top	
$timezone = "Asia/Hong_Kong";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
//must set timezone on the top	

global $db;
//session_start();

//$action='';
if(isset($_GET['action'])){

	$action = $_GET['action'];
} else {
	$action = $_POST['action'];
}

	switch($action){
		case 'get_acc': //last update at 2012-11-12
		get_acc();
		break;
	}


function get_acc(){
	global $db;
	$shopInfoObj = (isset($_POST['shopInfoObj']))? $_POST['shopInfoObj'] : $_GET['shopInfoObj'];
	$keywords = (isset($_POST['keywords']))? $_POST['keywords'] : $_GET['keywords'];
	
	$shopno = $shopInfoObj['shopno'];
	
	$sql = "SELECT si.acc_no,acc_id,manufacturer,accName,typeName,color,
				oprice,sprice,stateName,retail_id,sum(ava_bal) as ava_bal
				FROM stockin si, accessories acc, retailShop rs, acctype act ,productstate pd
				WHERE si.acc_no = acc.acc_no
				AND si.retailShop_no = rs.retailShop_no
				AND acc.productState_no = pd.productState_no
				AND acc.accType_no = act.accType_no";
				
	$sql .=" and si.retailShop_no = $shopno ";
	$sql .=" and acc.acc_id like '$keywords%' ";
	 
	$sql .=" group by si.retailShop_no,si.acc_no";
	//$result = $db->selectLimit($sql, '14',$pageNo);
	$result = $db->query($sql);
	
	$data_arr = array();
	
	if ($result) {
		while ($row = $db->fetch_array($result)) {
			$data_arr[] = $row;
		}
	}
	print_r(json_encode($data_arr));
	
}
?>