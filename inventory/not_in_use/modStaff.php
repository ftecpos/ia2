<?php 
  require_once('../conn/sqlconnect.php');
  
  //Open table "staff"
    $select_stf = "SELECT * FROM staff order by staff_no";
    $stf = mysql_query($select_stf, $conn) or die(mysql_error());
    $stf_data = mysql_fetch_assoc($stf);
	$totalRows_stf = mysql_num_rows($stf);
?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modify user</title>
<style type="text/css">
tr.w{color:#FFFFFF;}
</style>
<script type="text/javascript">
  var checker2=/^[0-9,A-z]*/;
  var idlist2=new Array();
  <?php
	do{
	  print("
  idlist2[".$stf_data['staff_no']."]=\"".$stf_data['staff_id']."\";");
	}while($stf_data = mysql_fetch_assoc($stf));
?>
  
  function total(no){document.getElementById("total").value="--資料共有"+no+"項--";}

  function check_nt(){
    if(document.getElementById("new_type").value==""){
	  document.getElementById("add_type").disabled=true;
	}else{
	  document.getElementById("add_type").disabled=false;
	}
  }

  //check if every data is correct
  function check2(sno){
    var i = document.getElementById("modId"+sno).value;
    var n = document.getElementById("modName"+sno).value;
    var pw = document.getElementById("modPW"+sno).value;
    if (i.length==0){
	  document.getElementById("error"+sno).value = "<--ID必須輸入";
	  document.getElementById(sno).disabled = true;
      return;
	}
	if (i==i.match(checker2)){
      var no = 1;
      do{
        if(i==idlist2[no].toString() && no!=sno){
          document.getElementById("error"+sno).value = "<--ID已被其他職員使用";
          document.getElementById(sno).disabled = true;
          return;
        }
        no = no+1;
      }while(no<idlist2.length);
      if (n.length < 2){
        document.getElementById("error"+sno).value = "<--名稱必須有2字或以上";
        document.getElementById(sno).disabled = true;
        return;
      }
      else{
        if ((pw.length > 5 && pw==pw.match(checker2))||pw==""){
          document.getElementById("error"+sno).value = "";
          document.getElementById(sno).disabled = false;
          return;
        }
        else{
          document.getElementById("error"+sno).value = "<--密碼不當或字數不足";
          document.getElementById(sno).disabled = true;
          return;
        }
      }
    }
    else{
      document.getElementById("error"+sno).value = "<--ID不可使用其他字元";
      document.getElementById(sno).disabled = true;
      return;
    }
  }
  function submit_new_type(){
  //alert("submit_new_type:Open");
  var xmlhttp1;    
	if (window.XMLHttpRequest)
	{  xmlhttp1=new XMLHttpRequest();  }
	else
	{  xmlhttp1=new ActiveXObject("Microsoft.XMLHTTP");  }
	//alert("submit_new_type:send text");
  	var outtest1 = "submit_mod_staff2.php?"
  				+"x=1"
  				+"&a="+document.getElementById("new_type").value;
  	//alert("submit_new_type:out text\n"+outtest1);
  	xmlhttp1.open("GET",outtest1,false);
	xmlhttp1.send();
	document.getElementById("submit_mod2").innerHTML=xmlhttp1.responseText;
	refresh();
	//alert("submit_new_type:sent");
}
function search_staff(){
	//alert("search_staff : open");
	var xmlhttp2;    
	if (window.XMLHttpRequest)
	{  	//alert("search_staff : true");
		xmlhttp2=new XMLHttpRequest();  }
	else
	{	//alert("search_staff : false");
		xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");  }
	//alert("search_staff : gen string");
  	var outtest2 = "submit_mod_staff.php?"
  				+"x=4"
  				+"&a="+document.getElementById("key").value
  				+"&b="+document.getElementById("keytype").value;
	//alert("search_staff : out test\n"+outtest2);
	xmlhttp2.open("GET",outtest2,false);
	xmlhttp2.send();
	//alert("search_staff : sent");
	document.getElementById("submit_mod").innerHTML=xmlhttp2.responseText;
}
function submit_mod_type(){
	//alert("search_mod_type : open");
	var xmlhttp3;
	if (window.XMLHttpRequest)
	{	//alert("search_mod_type : true");
		xmlhttp3=new XMLHttpRequest();  }
	else
	{	//alert("search_mod_type : false");
		xmlhttp3=new ActiveXObject("Microsoft.XMLHTTP");  }
	//alert("search_mod_type : gen string");
  	var outtest3 = "submit_mod_staff2.php?"
  				+"x=2"
  				+"&a="+document.getElementById("nType").value
  				+"&b="+document.getElementById("mntype").value;
	//alert("search_mod_type : out text\n"+outtest3);
	xmlhttp3.open("GET",outtest3,false);
	xmlhttp3.send();
	//alert("search_mod_type : sent");
	document.getElementById("submit_mod2").innerHTML=xmlhttp3.responseText;
	refresh();
}
function submit_mod_staff(x){
  var xmlhttp4;
  //alert("submit_mod_staff : open");
	if (window.XMLHttpRequest)
	{	//alert("submit_mod_staff : true");
		xmlhttp4=new XMLHttpRequest();  }
	else
	{	//alert("submit_mod_staff : false");
		xmlhttp4=new ActiveXObject("Microsoft.XMLHTTP");  }
  	var outtext4 = "submit_mod_staff.php?"
  				+"x=3"
  				+"&a="+document.getElementById("modNo"+x).value
  				+"&b="+document.getElementById("modId"+x).value
  				+"&c="+document.getElementById("modName"+x).value
  				+"&d="+document.getElementById("modPW"+x).value
  				+"&e="+document.getElementById("modType"+x).value;
  	//alert("submit_mod_staff : out text\n"+outtext4);
	xmlhttp4.open("GET",outtext4,false);
	xmlhttp4.send();
	//alert("submit_mod_staff : sent");
	document.getElementById("submit_mod").innerHTML=xmlhttp4.responseText;
}
</script>
<script type="text/javascript">
  var checker00=/^[0-9,A-z]*/;
  var name_checked=false;
  var id_checked=false;
  var pw_checked=false;
  var idlist=new Array();	
  //Open table "staff"
  <?php
    $select_staf = "SELECT * FROM staff";
    $staf = mysql_query($select_staf, $conn) or die(mysql_error());
    $staf_data = mysql_fetch_assoc($staf);
	$num = 0;
	do{
	  print("idlist[".$num."]=\"".$staf_data['staff_id']."\";");
	  $num=$num+1;
	}while($staf_data = mysql_fetch_assoc($staf));
  ?>
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
  function submiter(){
  var xmlhttp;    
if (window.XMLHttpRequest)
{  xmlhttp=new XMLHttpRequest();  }
else
{  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");  }
  	var outtext = "submit_user.php?a="+document.getElementById("uName").value
  				+"&b="+document.getElementById("uID").value
  				+"&c="+document.getElementById("uPWord").value
  				+"&d="+document.getElementById("sType").value;
	xmlhttp.open("GET",outtext,true);
	xmlhttp.send();
	idlist[idlist.length]=document.getElementById("uID").value;
	//alert("run");
	refresh();
	//alert("runed");
	document.getElementById("reset1").click();
	
}
function refresh(){
	var xmlhttpb;
	if (window.XMLHttpRequest)
	{	xmlhttpb=new XMLHttpRequest();  }
	else
	{	xmlhttpb=new ActiveXObject("Microsoft.XMLHTTP");  }
  	var outtext = "submit_mod_staff.php";
	xmlhttpb.open("POST",outtext,false);
	xmlhttpb.send();
	document.getElementById("submit_mod").innerHTML=xmlhttpb.responseText;
}
</script>
</head>
<body>
	<h1 align="center">系統用戶資料</h1>
  <div id="CollapsiblePanel1" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab">新增用戶</div>
  <div class="CollapsiblePanelContent">
  	<span id="display_user" >
  	<?php require_once("submit_user.php");?>
	</span>
  </div>
</div>
<script src="SpryCollapsiblePanel.js" type = "text/javascript"></script>
<script type="text/javascript">
  var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
</script>
<div id="CollapsiblePanel2" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab">新增職位</div>
  <div class="CollapsiblePanelContent">
  	<span id="submit_mod2">
		<?php	require_once('submit_mod_staff2.php');	?>
  	</span>
  </div>
</div>
<script src="SpryCollapsiblePanel.js" type = "text/javascript"></script>
<script type="text/javascript">
  var CollapsiblePanel2 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel2");
</script>
<span id="submit_mod">
<?php	require_once('submit_mod_staff.php');	?>
</span>
</table>
</body>
</html>