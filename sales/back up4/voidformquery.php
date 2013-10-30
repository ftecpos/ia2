<?php include("../conn/sqlconnect.php");?>

<script>
	var time_variable;
 
function getXMLObject()  //XML OBJECT
{
   var xmlHttp = false;
   try {
     xmlHttp = new ActiveXObject("Msxml2.XMLHTTP")  // For Old Microsoft Browsers
   }
   catch (e) {
     try {
       xmlHttp = new ActiveXObject("Microsoft.XMLHTTP")  // For Microsoft IE 6.0+
     }
     catch (e2) {
       xmlHttp = false   // No Browser accepts the XMLHTTP Object then false
     }
   }
   if (!xmlHttp && typeof XMLHttpRequest != 'undefined') {
     xmlHttp = new XMLHttpRequest();        //For Mozilla, Opera Browsers
   }
   return xmlHttp;  // Mandatory Statement returning the ajax object created
}
 
var xmlhttp = new getXMLObject();	//xmlhttp holds the ajax object
 
function dovoid() {
  var getdate = new Date();  //Used to prevent caching during ajax call
  if(xmlhttp) { 
  var invoiceid=document.getElementsByName('chkbInoiveNo');
  var arrayid = new Array();
  for(i=0 ; i<invoiceid.length ; i++){
		if(invoiceid[i].checked==true){
			
		arrayid[arrayid.length]=invoiceid[i].value;
		}
  }
  //alert(arrayid.length);
   for(i=0 ; i<arrayid.length ; i++){
	//alert(arrayid[i]);
   }
   // xmlhttp.open("POST","../sales/voidformquery.php",true); //calling using POST method
  //  xmlhttp.onreadystatechange  = handleServerResponse;
   // xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //xmlhttp.send("InvoiceNo=" + InvoiceNo.value +"&selvoid="+selvoid.value); 
	
 //alert(arrayid.length);
 /*
 xmlhttp.open("POST","../sales/voidformquery.php",true); //calling using POST method
 xmlhttp.onreadystatechange  = handleServerResponse;
 xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
 xmlhttp.send("invoiceid=" + arrayid); 
*/
  var url = "../sales/voidformquery.php?invoiceid=" + arrayid;
  xmlhttp.onreadystatechange  = handleServerResponse;
  xmlhttp.open("GET",url,true);
  xmlhttp.send(null);
	

  }
}
 
function handleServerResponse() {
   if (xmlhttp.readyState == 4) {
     if(xmlhttp.status == 200) {
       document.getElementById("showresult").innerHTML=xmlhttp.responseText; //Update the HTML Form element 
     }
     else {
        alert("Error during AJAX call. Please try again");
     }
   }
}	
</script>
<?php
$query_rs=
"SELECT invoice_no, typeName, retail_id, invoiceStateName, createDate, createBy, total, remark, `invoicestate`.`invoiceState_no` , `invoicetype`.`invoiceType_no`
FROM `invoice` , `invoicetype` , `invoicestate` , `retailshop`
WHERE `invoice`.`invoiceType_no` = `invoicetype`.`invoiceType_no`
AND `invoice`.`retailShop_no` = `retailshop`.`retailShop_no`
AND `invoice`.`invoiceState_no` = `invoicestate`.`invoiceState_no`
AND `invoice`.`invoiceState_no` = '1'
ORDER BY `invoice`.`invoice_no` DESC"
;
//echo $query_rs;
if(isset($_GET['selvoid'])){
	if($_GET['selvoid']=="true"){
		$query_rs=
"SELECT invoice_no, typeName, retail_id, invoiceStateName, createDate, createBy, total, remark, `invoicestate`.`invoiceState_no` , `invoicetype`.`invoiceType_no`
FROM `invoice` , `invoicetype` , `invoicestate` , `retailshop`
WHERE `invoice`.`invoiceType_no` = `invoicetype`.`invoiceType_no`
AND `invoice`.`retailShop_no` = `retailshop`.`retailShop_no`
AND `invoice`.`invoiceState_no` = `invoicestate`.`invoiceState_no`
AND `invoice`.`invoiceState_no` = '2'
ORDER BY `invoice`.`invoice_no` DESC
";
		}
	}
?>
<?php 
if(isset($_GET['InvoiceNo'])){
	if($_GET['InvoiceNo']){
		$query_rs=
"SELECT invoice_no, typeName, retail_id, invoiceStateName, createDate, createBy, total, remark, `invoicestate`.`invoiceState_no` , `invoicetype`.`invoiceType_no`
FROM `invoice` , `invoicetype` , `invoicestate` , `retailshop`
WHERE `invoice`.`invoiceType_no` = `invoicetype`.`invoiceType_no`
AND `invoice`.`retailShop_no` = `retailshop`.`retailShop_no`
AND `invoice`.`invoiceState_no` = `invoicestate`.`invoiceState_no`
AND `invoice`.`invoice_no` = ".$_GET['InvoiceNo']." 
";
if(isset($_GET['selvoid'])){
	if($_GET['selvoid']=="true"){$query_rs.= " AND `invoice`.`invoiceState_no` = '2'";}
	}else{$query_rs.= " AND `invoice`.`invoiceState_no` = '1'";}
$query_rs.="ORDER BY `invoice`.`invoice_no` DESC";
//echo $query_rs;
		}
	}
?>

<?php 
if(isset($_GET['invoiceid'])){
//echo $_GET['invoiceid'];
$query_rs="UPDATE `invoice` SET `invoiceState_no` = 2 WHERE `invoice`.`invoice_no` IN (".$_GET['invoiceid'].')';
//echo $query_rs;
$rs = mysql_query($query_rs) or die(mysql_error());
$msg = "已經取消單據";

$query_rs=
"SELECT invoice_no, typeName, retail_id, invoiceStateName, createDate, createBy, total, remark, `invoicestate`.`invoiceState_no` , `invoicetype`.`invoiceType_no`
FROM `invoice` , `invoicetype` , `invoicestate` , `retailshop`
WHERE `invoice`.`invoiceType_no` = `invoicetype`.`invoiceType_no`
AND `invoice`.`retailShop_no` = `retailshop`.`retailShop_no`
AND `invoice`.`invoiceState_no` = `invoicestate`.`invoiceState_no`
AND `invoice`.`invoice_no` IN (".$_GET['invoiceid'].')'.
"ORDER BY `invoice`.`invoice_no` DESC"; 
$rs = mysql_query($query_rs) or die(mysql_error());
}
?>
<?php
$rs= mysql_query($query_rs); 

$sumpage = mysql_num_rows($rs);
$per = 20;
$pages = ceil($sumpage/$per); 
if(!isset($_GET['page'])){
	$page = 1;
	}else{
		$page = intval($_GET['page']);
		$page = ($page > 0) ? $page : 1;
		$page = ($pages > $page) ? $page : $pages;
		}
		//echo $page;
$start = ($page-1)*$per; 
?>
<?php 
$query_rs.=" LIMIT ".$start.", ".$per;

$rs= mysql_query($query_rs); 
?>

<?php if(mysql_num_rows($rs)>0){?>
<div id="showresult">
<table border="1">
<tr>
<td><div align="center">單據編號</div></td>
<td><div align="center">單據種類</div></td>
<td><div align="center">日期</div></td>
<td><div align="center">分店</div></td>
<td><div align="center">總數</div></td>
<td><div align="center">remark</div></td>
<td><div align="center">單據State</div></td>
<td><div align="center">開單者</div></td>
<td><div align="center">修改的職員</div></td>
<td><div align="center">修改日期</div></td>
<?php if(!isset($_GET['invoiceid'])){?>

<?php // if($_GET['selvoid']!='true'){?>
<td><input type="button" value="Void"  onclick="dovoid()" name="btnvoid" id="btnvoid"/></td>

<?php //}?>
<?php }?>
</tr>
<?php while($row_rs=mysql_fetch_assoc($rs)){?>
<tr>
<td><div align="center"><?php echo $row_rs['invoice_no'];?></div></td>

<td><div align="center">
  <?php echo $row_rs['typeName'];?>
</div></td>
<td><div align="center"><?php echo $row_rs['createDate'];?></div></td>
<td><div align="center"><?php echo $row_rs['retail_id'];?></div></td>
<td><div align="center"><?php echo $row_rs['total'];?></div></td>
<td><div align="center"><?php echo $row_rs['remark'];?></div></td>
<td><div align="center"><?php echo $row_rs['invoiceStateName'];?></div></td>
<td><div align="center"><?php echo $row_rs['createBy'];?></div></td>

<td><div align="center"></div>&nbsp;</td>
<td><div align="center"></div>&nbsp;</td>
<?php if(($row_rs['invoiceType_no']== 1)&&($row_rs['invoiceState_no']== 1)){?>
<td><div align="center">
  
   <input type="checkbox" name="chkbInoiveNo" value="<?php echo $row_rs['invoice_no'];?>"/>
 &nbsp;</div></td> <?php }?>
</tr>
<?php }?>
</table>

<?php }else{
$msg =  "<font color='#FF0000'>沒有紀錄</font>";
}
?>
    
<?php

if(isset($_GET['page'])){
	$nowpage = $_GET['page'];
	}else{$nowpage = 1;}
echo '<'.($start+1)." - ".($per*$nowpage)." of ".$sumpage.'>'.'<br />';
for($i=1;$i<=$pages;$i++){
	if(isset($_GET['selvoid'])){
		if($_GET['selvoid']=="true")
		echo '<a href="?page='.$i.'&selvoid=true">'.$i.'</a>'." ";
		}else{
	echo '<a href="?page='.$i.'">'.$i.'</a>'." ";
		}
	}
	


?>
<br /><br />
    
<?php 
if(isset($msg))echo $msg;
?>
</div>