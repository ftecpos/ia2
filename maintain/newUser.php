<?php include("../check_login.php");?>
<?php 
  require_once('../conn/sqlconnect.php');
  mysql_select_db($database_conn, $conn);
    
//Open table "stafftype"
  $select_stafftype = "SELECT * FROM stafftype";
  $stafftype = mysql_query($select_stafftype, $conn) or die(mysql_error());
  $stafftype_data = mysql_fetch_assoc($stafftype);
  $totalRows_stafftype = mysql_num_rows($stafftype);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add user</title>
<script type="text/javascript">
  var checker00=/^[0-9,A-z]*/;
  var name_checked=false;
  var id_checked=false;
  var pw_checked=false;
  var idlist=new Array();
  <?php
	//Open table "staff"
    $select_staf = "SELECT * FROM staff";
    $staf = mysql_query($select_staf, $conn) or die(mysql_error());
    $staf_data = mysql_fetch_assoc($staf);
	$num = 0;
	do{
	  print("idlist[".$num."]=\"".$staf_data['staff_id']."\";
  ");
	  $num=$num+1;
	}while($staf_data = mysql_fetch_assoc($staf));?>
	
//check the name of the new user
  function messagerN(){
    var n = document.getElementById("uName").value;
	if (n.length < 2){
	  document.getElementById("uNm").value = "*<--名稱必須有2字或以上";
	  name_checked=false;
	  }
	else{
	  document.getElementById("uNm").value = "*";
	  name_checked=true;
	  check();
	}
  }
//check the id of the new user
  function messagerI(){
    var i = document.getElementById("uID").value;
	if (i.length<0){
	  document.getElementById("uIDm").value = "*<--ID必須輸入";
      id_checked=false;
      return;
	}	
	if (i==i.match(checker00)){
	  var no = 0;
      do{
        if(i==idlist[no].toString()){
          document.getElementById("uIDm").value = "*<--ID已被其他職員使用";
          id_checked=false;
          return;}
        no = no+1;
      }while(no<idlist.length);
      document.getElementById("uIDm").value = "*";
      id_checked=true;
      check();
    }
    else{
      document.getElementById("uIDm").value = "*<--不可使用其他字元";
      id_checked=false;
    }
  }
//check the password of the new user
  function messagerP(){
    var pw = document.getElementById("uPWord").value;
	if (pw.length >5 && pw==pw.match(checker00)){
	  document.getElementById("uPm").value = "*";
	  pw_checked=true;
	  check();
	}
	else{
	  document.getElementById("uPm").value = "*<--密碼有不當字元或6字以下";
	  pw_checked=false;
	}
  }
//check if every data is correct
  function check(){
    if ( name_checked && id_checked && pw_checked ){
	  document.getElementById("inPut").disabled = false;
	  return;
	}
  document.getElementById("inPut").disabled = true;
  }
</script>
</head>
<body>
<?php
 extract ($_POST);
 if (isset($uName)){
 
  //input data to table staff
    settype($uName, "String");
	settype($uID, "String");
    settype($uPWord, "String");
    settype($sType, "String");
   
  //connection for insert
	$ins_conn=mysql_connect($hostname_conn, $username_conn, $password_conn);
	if (!$ins_conn){die('Could not connect : ' . mysql_error());}
    mysql_select_db($database_conn, $ins_conn);
	
	//insert data
	$sql="Insert Into staff Values(null,'$_POST[uID]','$_POST[uPWord]','$_POST[uName]',null,$_POST[sType],null)";
	mysql_query("SET NAMES 'utf8'");
	if(!mysql_query($sql,$ins_conn)) {die('Error: '.mysql_error());}
	mysql_close($ins_conn);
	
  //Open table "staff"
    $select_staff = "SELECT * FROM staff order by staff_no desc";
    $staff = mysql_query($select_staff, $conn) or die(mysql_error());
    $staff_data = mysql_fetch_assoc($staff);
    $totalRows_staff = mysql_num_rows($staff);
  }?>
  <div id="CollapsiblePanel1" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab">新增用戶</div>
  <div class="CollapsiblePanelContent">
   <form action="modStaff.php" method="post">
     <table width="650" height="10" border="0">
	   <tr>
	     <td width = "350">名稱 <font size="2">(2~45字)</font>:</td>
	     <td width = "*"><input type="text" name="uName" maxlength="46" id="uName" onKeyUp="messagerN()" /></td>
		 <td width = "*"><input type="text" name="uNm" id="uNm" size="30" style="border: none;color:#FF0000" value="*" readonly/></td>
	   </tr>
	   
	   <tr>
	     <td>ID <font size="2">(4位文字, 英文及數字)</font>:</td>
	     <td><input type="text" name="uID" maxlength="4" id="uID" onKeyUp="messagerI()"/></td>
		 <td><input type="text" name="uIDm" id="uIDm" size="30" style="border: none;color:#FF0000" value="*" readonly/></td>
	   </tr>
	   
	   <tr>
	     <td>密碼 <font size="2">(6~14字, 不能使用符號如 \&, #, *)</font>:</td>
	     <td><input type="password" name="uPWord" maxlength="15" id="uPWord" onKeyUp="messagerP()"/></td>
		 <td><input type="text" name="uPm" id="uPm" size="30" style="border: none;color:#FF0000" value="*" readonly/></td>
	   </tr>
	   
	   <tr>
	     <td>職位:</td>
	     <td><select name="sType">
		 <?php
		 do {
		   printf("<option value=\"%d\">%s</option>",$stafftype_data['staffType_no'],$stafftype_data['typeName']);
		 }while($stafftype_data = mysql_fetch_assoc($stafftype));
		 ?>
		 
		 </select></td>
	    </tr>
      </table>
      <input type = "submit" name = "inPut" id="inPut" value = "輸入" disabled/>
      <input type = "reset" name = "reset" value = "重設" />
    </form>
  </div>
</div>
<script src="SpryCollapsiblePanel.js" type = "text/javascript"></script>
<script type="text/javascript">
  var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
</script>
</body>
</html>