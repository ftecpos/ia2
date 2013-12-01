<?php include ("conn/db_include.php")?>
<?php
//must set timezone on the top	
$timezone = "Asia/Hong_Kong";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
//must set timezone on the top	
?>
<?php

switch($_GET['action']){

	
	case 'getShopDetail':
		
		if(isset($_GET['pwd'])){
			if($_GET['pwd']!='GCI')
				exit(0);
		}
        $num = 0;
		if(isset($_GET['shopid'])){
			$shopid = $_GET['shopid'];
			if($shopid == 'GCI'){
				$sql="select retail_id,addr,phone,fax,email,location from retailshop where retail_id = '$shopid'";
			$num = $db->num_rows($db->select($sql));
			} else 
            exit(0); 
			if($num!=0){
				$row = $db->getrow($sql);
				$r_id = $row['retail_id'];
				$addr = $row['addr'];
				$phone = $row['phone'];
				$fax = $row['fax'];
				$email = $row['email'];
				$location = $row['location'];
				
				echo "<table border=\"0\">";
				echo "<tr><td style=\"width:100px;\">Retail id</td><td>$r_id</td></tr>";
				echo "<tr><td>Address</td><td>$addr</td></tr>";
				echo "<tr><td>Phone</td><td>$phone</td></tr>";
				echo "<tr><td>Fax</td><td>$fax</td></tr>";
				echo "<tr><td>Email</td><td>$email</td></tr>";
				echo "<tr><td>Location</td><td>$location</td></tr>";
				echo "</table>";
				echo "<span><input type=\"button\" value=\"Confirm\" id=\"conf\" onclick=\"setShopNum()\"/></span>";
				echo "<script>";
				echo "function setShopNum(){ $('#shopAddDetail').load(\"shopRegister.php?action=setShopNum&shopid=$r_id\"); }";
				echo "</script>";
			} else
				echo "<span style=\"color:RED;\">Record not find</span>";
			echo "<script>";
			echo "$('#regShopID').val(null);";
			echo "</script>";
			
		}
		break;
	case 'setShopNum':
		if(isset($_GET['shopid'])){
			$shopid = $_GET['shopid'];
			$sql="select retailShop_no,retail_id,addr,phone,fax,email,location from retailshop where retail_id = '$shopid'";
			$row = $db->getrow($sql);
				$r_id = $row['retail_id'];
				$r_no = $row['retailShop_no'];	
				$addr = $row['addr'];
				$phone = $row['phone'];
				$fax = $row['fax'];
				$email = $row['email'];
				$location = $row['location'];
			
			
		echo "<script>";
		echo "if (typeof(localStorage) == 'undefined' ){ ";
		echo "	alert('Your browser does not this POS application, please contact the system administratopr.');";
		echo "	$('#shopAddDetail').html('<span style=\"color:RED;\">Shop cannot registed</span>')";
		echo "}else{";
		echo "	try{";
		echo "		localStorage.setItem(\"shopid\", \"$r_id\"); ";
		echo "		localStorage.setItem(\"shopno\", \"$r_no\"); ";
		echo "		localStorage.setItem(\"addr\", \"$addr\"); ";
		echo "		localStorage.setItem(\"phone\", \"$phone\"); ";
		echo "		localStorage.setItem(\"fax\", \"$fax\"); ";
		echo "		localStorage.setItem(\"email\", \"$email\"); ";
		echo "		localStorage.setItem(\"location\", \"$location\");";
		echo "	} catch(e) {";
		echo "		if (e == QUOTA_EXCEEDED_ERR){";
		echo "			alert('Quota exceeded!'); ";
		echo "		}";
		echo "	}"; //end of catch
		echo "	$('#shopAddDetail').html('<span style=\"color:RED;\">Shop registed</span>')";
		echo "}"; //end of else	
		echo "</script>";

		}
		break;
}
?>