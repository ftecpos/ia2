<?php require_once('conn/sqlconnect.php');
	function login_OK($staff_LoginName, $staff_Passwd){
		$authorized = false;
		global $database_conn,$conn,$staff_no,$staff_id,$staff_type;
		mysql_select_db($database_conn,$conn);
		$SQL = sprintf("SELECT * FROM staff WHERE staff_id = '%s' AND pwd = '%s'", $staff_LoginName,$staff_Passwd);
		$rs = mysql_query($SQL,$conn) or die(mysql_error());
		$rsStaff = mysql_fetch_assoc($rs);
		if(mysql_num_rows($rs) == 1){
			$authorized = true;
			$staff_no = $rsStaff['staff_no'];
	        $staff_id = $rsStaff['staff_id'];
			//$staff_type = $rsStaff['staff_type'];
            
		}
		return $authorized;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登入頁面</title>
<link href="css.css" type="text/css" rel="stylesheet" />
<style type="text/css">
.mainbody {
	width: 800px;
	height: 300px;
	margin-left: 400px;
	margin-top: 150px;
	overflow: hidden;
}
body {
	background-image: url(img/bg.jpg);
	background-repeat: no-repeat;
	background-position: center;
}
</style>
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/access.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<script>
$(function() {
	setShopInfoSess();
});

</script>
</head>

<body>
<?php
	$form = <<<EOD
<div class="mainbody" align="center">
<font color="red">POS System</font><br />
<form method="post" action="login.php">
<table border="0">
<tr>
<td>店號:</td>
<td><div id="shohID"></div></td>
</tr>
<tr>
<td>帳號:</td>
<td><input type="text" name="id" id="id" /></td>
</tr>
<tr>
<td>密碼:</td>
<td><input type="password" name="pw" id="pw" onkeypress="checkLoginEvent(event)" /></td>
</tr>
<tr>
<td colspan="2" align="right">
 <input type="submit" value="登入" />
 <input type="button" value="重設" onclick="reset1()" />
 </td>
</tr>
<tr><td colspan="2"><label id="error"></label></td></tr>

</table>
</form>



</div>
EOD;
	if (!isset($_POST['id'])) {
    	print $form;
		if (isset($_GET['msg']))
			print "<h2>".$_GET['msg']."</h2>";
	}
	else{
		if (login_OK($_POST['id'], $_POST['pw'] )){
      		session_start();
      		$_SESSION['staff_no'] = $staff_no;
            $_SESSION['staff_id'] = $staff_id;
		$_SESSION['staff_type']=$staff_type;
			header("location:main/main.php");
	 	}
		else{
			$query_string = sprintf("?msg=%s",urlencode("Invaild Login Name or Password!"));
			header("Location:".$_SERVER['PHP_SELF'].$query_string);
		}		
	 }
?>
<div id="loadSession"></div>
</body>
</html>
