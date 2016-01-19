<?php include("../check_login.php");?>
<?PHP
$con = mysql_connect("localhost","root","");
if (!$con){die('Could not connect: ' . mysql_error());}
mysql_select_db("3shop", $con);
$state=1;
$phone=$_REQUEST["product"];
if(isset($_GET['create'])){
	mysql_query($sql="insert into transfer(transfer_no,transDate,fromRetail_no,toRetail_no,transState_no) values('".$_POST["t_no"]."','".$_POST["date"]."','".$_POST["from_shop"]."','".$_POST["to_shop"]."','".$state."')");
header('Location: transfer.php');
	}
?>