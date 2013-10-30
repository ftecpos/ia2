<?php 
  require('../../conn/sqlconnect.php');	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>職員管理</title>

</head>

<body onload="selectAllStaff()">
  <h1 align="center">系統用戶資料</h1>
  
  <div id="show_staff">
  <?php include_once("../../report/testing/showStaff.php"); ?>
  </div>
  
  	<div><span id="staff_form">
    <?php include_once("../../report/testing/staffForm.php"); ?>
</span></div>

<div><span id="staff_type_form">
	<?php include_once("../../report/testing/staffTypeForm.php"); ?>
</span></div>


</body>
</html>
