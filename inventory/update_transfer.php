<?php include("../check_login.php");?>
<?php
$count=0;
$con = mysql_connect("localhost","root","");
if (!$con){die('Could not connect: ' . mysql_error());}
mysql_select_db("3shop", $con);
if(isset($_GET["change"])){
if((isset($_POST["f"]))&&(isset($_POST["to"]))&&(isset($_POST["state"]))&&(isset($_POST["date"]))){
if(($_POST["f"]!="")&&($_POST["to"]!="")&&($_POST["state"]!="")&&($_POST["date"]!="")){
echo "update transfer set fromRetail_no='".$_POST["f"]."',toRetail_no='".$_POST["to"]."',transState_no=".$_POST ["state"].",transdate='".$_POST["date"]."' where transfer_no=".$_GET["change"];


	mysql_query("update transfer set fromRetail_no='".$_POST["f"]."',toRetail_no='".$_POST["to"]."',transState_no=".$_POST["state"].",transdate='".$_POST["date"]."' where transfer_no=".$_GET["change"]);
	header('Location: transfer.php?update=1');
}
else
	header('Location: transfer.php?update=2');
}
else
	header('Location: transfer.php?update=2');
}
else
	header('Location: transfer.php?update=2');
?>
<?php
$state=2;
$count=0;
$con = mysql_connect("localhost","root","");
if (!$con){die('Could not connect: ' . mysql_error());}
mysql_select_db("3shop", $con);

if(isset($_GET["confirm"])){
	mysql_query("update transfer set transState_no='".$state."'where transfer_no=".$_GET["confirm"]);
	header('Location: transfer.php');
	}
?>
<?PHP
$con = mysql_connect("localhost","root","");
if (!$con){die('Could not connect: ' . mysql_error());}
mysql_select_db("3shop", $con);
$state=1;

if(isset($_GET['create'])){
	$sql="insert into transfer(transfer_no,transDate,fromRetail_no,toRetail_no,transState_no) values('".$_POST["t_no"]."','".$_POST["date"]."','".$_POST["from_shop"]."','".$_POST["from_shop"]."','".$state."');'";
	echo $sql;
	}
?>