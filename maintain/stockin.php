<?php include("../check_login.php");?>
<?php
  require_once('../conn/sqlconnect.php');
  mysql_select_db($database_conn, $conn);
  session_start();//<<---------------Get retail shop number
  $rshopno=$_SESSION['retail_no'];			
//Open table "staff"
	$sel_staffs = "select staff_no from staff";
	$staffs = mysql_query($sel_staffs, $conn) or die(mysql_error());
	$staffs_data = mysql_fetch_assoc($staffs);
//Open table "phone"
	$s_p = "SELECT * FROM phone";
	$p = mysql_query($s_p, $conn) or die(mysql_error());
	$p_data = mysql_fetch_assoc($p);
	$tR_p = mysql_num_rows($p);

//Open table "stockin"
  $select_sin = "SELECT * FROM stockin";
  $sin = mysql_query($select_sin, $conn) or die(mysql_error());
  $totalRows_sin = mysql_num_rows($sin);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Stock In</title>
<h1 align="center">存入貨物</h1>
<script type="text/javascript">
var imei_list_db = new Array();

<?php
$w=0;
if($p_data["IMEI"]!=""){
	do{
		echo "imei_list_db[".$w."] = \"".$p_data["IMEI"]."\";\n";
		$w++; 
	}while($p_data = mysql_fetch_assoc($p));
}
?>
///////////////////////////////////////////////////////////////////////
function showWindow(sname,scolor,sno,sid,tno){
  if(document.getElementById("divWin"))
  {
   con("divWin").style.zIndex=999;
   con("divWin").style.display="";
  }  else  {
   var objWin=document.createElement("div");
   objWin.id="divWin";
   objWin.style.position="absolute";
   objWin.style.width="520px";
   objWin.style.height="300px";
   objWin.style.top = "40%";
   objWin.style.left = "10%";
   objWin.style.border="2px solid #AEBBCA";
   objWin.style.background="#FFF";
   objWin.style.zIndex=999;
   document.body.appendChild(objWin);
  }
 
  if(document.getElementById("win_bg"))
  {
   con("win_bg").style.zIndex=998;
   con("win_bg").style.display="";
  }  else  {
   var obj_bg=document.createElement("div");
   obj_bg.id="win_bg";
   obj_bg.className="win_bg";
   document.body.appendChild(obj_bg);
  }

  var str="";
  str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)">'
  +'<span class="title_left">Edit Recode</span>'
  +'<span class="title_right"><a href="javascript:clearImeiUpList();closeWindow()" title="Close" id="closer">取消</a></span>'
  +'<br style="clear:right" mce_style="clear:right"/></div>';
  str+='<div class="winContent">'
  +'<form id="inputImeiForm" onsubmit="return false">'
  +'<table border="1" id="imei_table2" height="270px" width="510px">'
  +'<tr><td>No.</td><td><input type = "text" readonly = "yes" name="no" id = "no" value = "'+sno+'"/></td><td>IEMI List</td></tr>'
  +'<tr><td>ID</td><td><input type = "text" readonly = "yes"  value = "'+sid+'"/>'
  +'<td rowspan="4"><textarea name="w_ilist" id="w_ilist" style="height:100%" readonly></textarea></td></tr>'
  +'<tr><td>名稱</td><td><input type = "text" readonly = "yes" value = "'+sname+'"/></td></tr>'
  +'<tr><td>顏色</td><td><input type = "text" readonly = "yes" value = "'+scolor+'"/></td></tr>'
  +'<tr><td>IMEI</td><td><input type = "text" maxlength="16" id = "ie" name="ie"/>'
  +'<input type="hidden" id="podNo" name="podNo" value="'+document.getElementById("pod_no"+tno).value+'"/>'
  +'</td></tr>'
  +'<tr><td align="right" colspan = "2">'
  +'<input id="imei_in_button" type = "submit" value = "新增" onclick = "getIMEI('+tno+');checkqty()"/>'
  +'</td><td>輸入數量 : <span id="inputTotal">'+imei_list[tno].length+'</span><input type="button" value="上傳資料" onclick="submit_imei();cbchecker_auto()"/></td></tr></table></form></div>';
  con("divWin").innerHTML=str;
  document.getElementById("ie").focus();
  //document.getElementById("cancel").disabled=true;
}
function closeWindow(){
  con("divWin").style.display="none";
  con("win_bg").style.display="none";
}

function con(o){  return document.getElementById(o);	}

function startMove(o,e){
  var wb;
  if(document.all && e.button==1) wb=true;
  else if(e.button==0) wb=true;
  if(wb)
  {
    var x_pos=parseInt(e.clientX-o.parentNode.offsetLeft);
    var y_pos=parseInt(e.clientY-o.parentNode.offsetTop);
    if(y_pos<=o.offsetHeight)
    {
      document.documentElement.onmousemove=function(mEvent)
      {
        var eEvent=(document.all)?event:mEvent;
        o.parentNode.style.left=eEvent.clientX-x_pos+"px";
        o.parentNode.style.top=eEvent.clientY-y_pos+"px";
      }
    }
  }
}
function stopMove(o,e){
  document.documentElement.onmousemove=null;
}
///////////////////////////////////////////////////////////////////////
</script>
<script type = "text/javascript">
var pi = 0;
function b(ss,number) {
//alert(number);
var r = 0;
var geid;
var gename;
var gecolor;
var geno = ss;
	document.getElementById("stoin_hal").disabled=true;
	document.getElementById("stoin_fin").disabled=true;
    if (!document.getElementsByTagName || !document.createTextNode) return;
   var row = document.getElementById('showdata').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
   var cells = document.getElementById('showdata').getElementsByTagName('tbody')[0].getElementsByTagName('td');
    
    //cells[0].onclick = function(){alert(cellsIndex);}
    
    for (i = 0; i < row.length; i++) {
        row[i].onclick = function() { 
     
			r = this.rowIndex - 1;
			//geid =  row[r].cells[1].innerHTML;
			
			//x(r); 
			
			geid = row[r].cells[1].innerHTML;
			gename  = row[r].cells[2].innerHTML;
			gecolor = row[r].cells[3].innerHTML;
			showWindow(gename,gecolor,geno,geid,number);
        }
    }
}
var types = new Array();
var podnum = new Array();
var total_types = 0;
function submit_imei(){
	if(imei_upload_list.length==0){return;}
	//alert("submit_imei : open");
	var xmlhttp2;    
	if (window.XMLHttpRequest)
	{  	//alert("submit_imei : true");
		xmlhttp2=new XMLHttpRequest();  }
	else
	{	//alert("submit_imei : false");
		xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");  }
	//alert("submit_imei : gen string");
	
	var counter = (imei_upload_list.length/25);
	if(Number(imei_upload_list.length%25)>0)	{	counter = counter-(counter%1)+1;	}
	var imeiString;
	var imeiCount = 25;
	for(var uploCount=1; uploCount<=counter; uploCount++){
		//alert("uploCoun="+uploCount+", counter="+counter);
		if(uploCount==counter && imei_upload_list.length%25>0)
		{	//alert("arrive, imei_upload_list.length="+imei_upload_list.length);
			imeiCount=(Number(imei_upload_list.length)%25);	}
		//alert("imeiCount="+imeiCount+", 25*(uploCount-1)="+(25*(uploCount-1)));
		imeiString="";
		for(var lleng=0; lleng<imeiCount; lleng++){
			imeiString += imei_upload_list[lleng+25*(uploCount-1)]+"/";
		}
		var outtest2 = "../inventory/upload_imei.php?"
					+"imei="+imeiString
					+"&pno="+document.getElementById("no").value
					+"&podno="+document.getElementById("podNo").value
					+"&rshop="+"<?php echo $rshopno;?>"
					+"&date="+"<?php echo date("Y-m-d H:i:s");?>";
		//alert("submit_imei : out test\n"+outtest2);
		xmlhttp2.open("GET",outtest2,false);
		xmlhttp2.send();
	}
	clearImeiUpList();
	for(var llengt=0;llengt<imei_upload_list.length;llengt++){
		//alert("Imei in array : " + imei_upload_list[llengt]);
	}
	//alert("submit_imei : sent");
}
function clearImeiUpList(){imei_upload_list.length=0;}
function update_po(G)
{	//if(G==3)
	//alert("submit_imei : open");
	var xmlhttp3;    
	if (window.XMLHttpRequest)
	{  	//alert("submit_imei : true");
		xmlhttp3=new XMLHttpRequest();  }
	else
	{	//alert("submit_imei : false");
		xmlhttp3=new ActiveXObject("Microsoft.XMLHTTP");  }
	//alert("submit_imei : gen string");
  	var outtest3 = "../inventory/stockin_process.php?"
  				+"x=0"
  				//+"a="+document.getElementById("sin_no").value
  				+"&b="+document.getElementById("poid").value
  				//+"&c="+document.getElementById("consignee").value
  				//+"&d="+"<?php echo date("Y-m-d H:i:s");?>"
  				+"&e="+G;
	//alert("submit_imei : out test\n"+outtest3);
	xmlhttp3.open("GET",outtest3,false);
	xmlhttp3.send();
	//alert("submit_imei : sent");
	reseter();
}
function submit_stockin(D){
	//alert(isNaN(document.getElementById("ass"+D).value));
	if(correctNo(document.getElementById("ass"+D).value)==false){
		document.getElementById("ass"+D).value="輸入錯誤!";
		document.getElementById("ass"+D).select();
		return;
	}
	//alert("submit_imei : open");
	var xmlhttp4;    
	if (window.XMLHttpRequest)
	{  	//alert("submit_imei : true");
		xmlhttp4=new XMLHttpRequest();  }
	else
	{	//alert("submit_imei : false");
		xmlhttp4=new ActiveXObject("Microsoft.XMLHTTP");  }
	//alert("submit_imei : gen string");
  	var outtest4 = "../inventory/stockin_process.php?"
  				+"x=1"
  				+"&a="+document.getElementById("sin_no").value
  				+"&b="+document.getElementById("ass_pod_no"+D).value
  				+"&c="+document.getElementById("consignee").value
  				+"&d="+document.getElementById("assNumber"+D).value
  				+"&e="+document.getElementById("ass"+D).value
  				+"&f="+"<?php echo date("Y-m-d H:i:s");?>"
  				+"&g="+document.getElementById("get_createdate").innerHTML
  				+"&h="+document.getElementById("ass_cos"+D).value
  				+"&rshopno="+"<?php echo $rshopno; ?>";
  	//alert("submit_imei : out test\n"+outtest4);
	xmlhttp4.open("GET",outtest4,false);
	xmlhttp4.send();
	//alert("submit_imei : sent");
	document.getElementById("dsql").innerHTML=xmlhttp4.responseText;
	//alert(document.getElementById("sql").value);
	document.getElementById("ass_confirmer"+D).disabled=true;
	document.getElementById("ass"+D).disabled=true;
	document.getElementById("cancel").disabled=true;
	document.getElementById("stoin_fin").disabled=false;
	document.getElementById("stoin_hal").disabled=false;
	po_select_lock();
}
var staffs_list = new Array();
<?php
	$X=0;
	do{
		echo "\nstaffs_list[".$X."]=".$staffs_data['staff_no'].";";
		$X++;
	}while($staffs_data = mysql_fetch_assoc($staffs));
?>

function getPoDetail(){
  var wrong = false;
  //The 2D Array Creation~
  /*var newArray = new Array();
  newArray[0] = new Array();
  newArray[1] = new Array();
  newArray[0][0]="A";
  newArray[0][1]="B";
  newArray[0][2]="C";
  newArray[1][0]="D";
  newArray[1][1]="E";
  newArray[1][2]="F";
  for(a=0;a<newArray.length;a++)
  { for(b=0;b<newArray[a].length;b++)
	{ alert(newArray[a][b]);  }
  }*/
//alert(isNaN(document.getElementById("consignee").value));
  if(correctNo(document.getElementById("poid").value)==false){
	document.getElementById("poid").value="請輸入正確資料!";
	document.getElementById("poid").select();
	wrong=true;
  }
  if(correctNo(document.getElementById("consignee").value)==false){
	document.getElementById("consignee").value="請輸入正確資料!";
	document.getElementById("consignee").select();
	wrong=true;
  }
  if(wrong){return;}
//alert("staffs_list length = "+staffs_list.length);
for(var X=0;X<staffs_list.length;X++){
	if(document.getElementById("consignee").value==staffs_list[X]){ break; }
	//alert(X+" pass");
	if(X==staffs_list.length-1){
		document.getElementById("consignee").value="用戶不存在!";
		return;
	}
}

var xmlhttp;    
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }	else  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("showPoDetail").innerHTML=xmlhttp.responseText;
	
    document.getElementById("get_name").innerHTML = document.getElementById("staffname").value;
    document.getElementById("get_createdate").innerHTML = document.getElementById("createDate").value;
    document.getElementById("get_supplier_id").innerHTML = document.getElementById("supplier_id").value;
    document.getElementById("get_supplier_name").innerHTML = document.getElementById("supplier_name").value;
    document.getElementById("get_addr").innerHTML = document.getElementById("addr").value;
    document.getElementById("get_phone").innerHTML = document.getElementById("phone").value;
    document.getElementById("total_1").value = document.getElementById("total1").value;
    document.getElementById("total_2").value = document.getElementById("total2").value;
    total_types = document.getElementById("totalrow1").value;
	//alert("Total_types="+total_types);
	if(document.getElementById("state").value==3){
		document.getElementById("IamFine").innerHTML="(已完成存貨)";
		document.getElementById("consignee").disabled=false;
		document.getElementById("cancel").disabled=true;
		for(var loop=0;loop<document.getElementById("total_1").value;loop++){
			document.getElementById("iiiB"+loop).disabled=true;}
		for(var loop2=0;loop<document.getElementById("total_2").value;loop2++){
			document.getElementById("ass_confirmer"+loop2).disabled=true;
			document.getElementById("ass"+loop2).disabled=true;}
	}	else	{
		document.getElementById("IamFine").innerHTML="";
		document.getElementById("consignee").disabled=true;
		document.getElementById("cancel").disabled=false;
	}
	
	for(x=0;x<total_types;x++)
		{
		types[x]=document.getElementById("tn"+x).value;
		podnum[x]=document.getElementById("pod_no"+x).value;
		//alert(types[x]);
		}
	printImei(total_types);
	checkqty();
    }
  }
	xmlhttp.open("GET","../inventory/get_stockin.php?q="+document.getElementById("poid").value+"&act=select",true);
	xmlhttp.send();
	//alert(types.length);
}

var imei_list = new Array();
var imei_upload_list = new Array();
function printImei(z)
{	//alert(z);
	var listIMEItable="";
	for(y=0;y<z;y++)
		{
		//alert(podnum[y]);
		listIMEItable += 'IEMI of '+ types[y]
		+'<input type="hidden" id="pod_no'+y+'" value="'+podnum[y]+'">'
		+'<table border="1" id="imei_table'+y+'" name="imei_table'+y+'">'
		+'</table>';
		imei_list[y] = new Array();
		}
	//alert(listIMEItable);
	document.getElementById("imei_form").innerHTML=listIMEItable;
}
function checkqty(){
	try{
		//alert ("turn A");
		var qtyC = 0;
		do{
			//alert ("turn B--qtyC="+qtyC);
			//alert (document.getElementById("podQty"+qtyC).value+"=="+imei_list[qtyC].length);
			if(document.getElementById("podQty"+qtyC).value==imei_list[qtyC].length){
				//alert ("turn C");
				document.getElementById("phoneCB"+qtyC).checked=true;
				document.getElementById("phoneCB"+qtyC).disabled=true;
				document.getElementById("iiiB"+qtyC).disabled=true;
			}
			qtyC++;
		}while(true);
	} catch(error){
		//alert ("turn Final");
		return;
	}
}

function ass_check_qty(Q){
	if(Number(document.getElementById("ass_qty"+Q).value)<Number(document.getElementById("ass"+Q).value))
	{	document.getElementById("ass"+Q).value="數量過多!";
		document.getElementById("ass"+Q).select();	}
}

function getIMEI(table_no){
  //alert(document.getElementById("ie").value.length);
  //check the null input and input lenght of imei.
  if(document.getElementById("ie").value=="" || document.getElementById("ie").value.length<15){
  	document.getElementById("ie").value="錯誤輸入!";
  	document.getElementById("ie").select();
  	return;
  }
  document.getElementById("cancel").disabled=true;
  var html_String = "";
  //check the imei if it is a repeat number.
  for(var x=0;x<imei_list_db.length;x++){
  	if(document.getElementById("ie").value==imei_list_db[x])
  	{	document.getElementById("ie").value=null;
  		return;	}
  }
  //put the imei into a array box
  imei_list_db[imei_list_db.length]=document.getElementById("ie").value;
  imei_upload_list[imei_upload_list.length]=document.getElementById("ie").value;
  imei_list[table_no][imei_list[table_no].length]=document.getElementById("ie").value;
  //for(var mx = 0; mx<imei_list_db.length; mx++){ alert(imei_list_db[mx]);}
  document.getElementById("w_ilist").value=document.getElementById("ie").value+"\n"+document.getElementById("w_ilist").value;
  
  for(x=0;x<imei_list[table_no].length;x++){
    if(x%5==0 && x!=0){
      html_String+="<tr><td>"+imei_list[table_no][x]+"</td>";
    } else if(x%5==4){
      html_String+="<td>"+imei_list[table_no][x]+"</td></tr>";
    } else {
      html_String+="<td>"+imei_list[table_no][x]+"</td>";
    }
  }
  document.getElementById("imei_table"+table_no).innerHTML=html_String;
  //document.getElementById("imei_table2").innerHTML+="<tr><td>"+document.getElementById("ie").value+"</td></tr>";
  document.getElementById("ie").value=null;
  document.getElementById("inputTotal").innerHTML=imei_list[table_no].length;
	if(document.getElementById("podQty"+table_no).value==document.getElementById("mobileqty"+table_no).value){
		document.getElementById("closer").click();
	}
  //alert(document.getElementById("podQty"+table_no).value+"=="+document.getElementById("mobileqty"+table_no).value);
  //alert(document.getElementById("w_ilist").value);
    
	/*
var xmlhttp;    
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("imei").innerHTML=xmlhttp.responseText;

 }*/
}
function cbchecker_auto(){
	for(var l01=0; Number(l01)<Number(document.getElementById("total_1").value);l01++){
		if(document.getElementById("phoneCB"+l01).checked==false){
			//alert("false A--document.getElementById(\"phoneCB\"+l01).checked="+document.getElementById("phoneCB"+l01).checked);
			return;
		}
	}
	for(var l02=0; Number(l02)<Number(document.getElementById("total_2").value);l02++){
		if(Number(document.getElementById("ass"+l02).value)!=Number(document.getElementById("ass"+l02).value)){
			//alert("false B---"+document.getElementById("ass"+l02).value+"=="+document.getElementById("ass"+l02).value);
			return;
		}
	}
	update_po(3);
}
function cbchecker(){
	if(document.getElementById("stoin_fin").value!="確定繼續?"){
		for(var l01=0; Number(l01)<Number(document.getElementById("total_1").value);l01++){
			if(document.getElementById("phoneCB"+l01).checked==false){
				document.getElementById("stoin_fin").value="確定繼續?";
				return;
			}
		}
		for(var l02=0; Number(l02)<Number(document.getElementById("total_2").value);l02++){
		//alert("ass_confirmer"+l02+" selected, total_2 "+ document.getElementById("total_2").value);
			if(document.getElementById("ass"+l02).value==document.getElementById("ass"+l02).value){
				document.getElementById("stoin_fin").value="確定繼續?";
				return;
			}
		}
	}
	document.getElementById("stoin_fin").value="完成所有存貨";
	update_po(3);
}
function reseter(){
	document.getElementById("sin_no").value++;
	canceler();
}
function canceler(){
	document.getElementById("stoin_hal").disabled=true;
	document.getElementById("stoin_fin").disabled=true;
	document.getElementById("cancel").disabled=true;
	//alert("a");
	document.getElementById("poid").value="";
	//alert("b");
	document.getElementById("get_name").innerHTML="";
	//alert("c");
	document.getElementById("get_createdate").innerHTML="";
	//alert("d");
	document.getElementById("consignee").value="";
	document.getElementById("consignee").disabled=false;
	//alert("e");
	document.getElementById("get_supplier_id").innerHTML="";
	//alert("f");
	document.getElementById("get_supplier_name").innerHTML="";
	//alert("g");
	document.getElementById("get_addr").innerHTML="";
	//alert("h");
	document.getElementById("get_phone").innerHTML="";
	//alert("i");
	document.getElementById("get_remark").innerHTML="";
	//alert("j");	
	document.getElementById("showPoDetail").innerHTML="";
	//alert("k");
	document.getElementById("showIEME").innerHTML="";
	//alert("l");
	document.getElementById("imei_form").innerHTML="";
	//alert("m");
	po_select_unlock();
}
function po_select_lock(){
	document.getElementById("poid").disabled=true;
	document.getElementById("find_po").disabled=true;
}
function po_select_unlock(){
	document.getElementById("poid").disabled=false;
	document.getElementById("find_po").disabled=false;
}
function correctNo(numbe){
	if( numbe=="" || isNaN(numbe) ){return false;}
	//lert("Number%1="+(Number(numbe)%1)+""+(Number(numbe)<0));
	if( (Number(numbe)%1)>0.0 || Number(numbe)<0 ){return false;}
	return true;
}
</script>
</head>
<body>
<form>
<table width="100%" border="1">
	<tbody>
		<tr>
			<td width = "10%">收貨人</td>
			<td colspan="3"><input type = "text" name = "consignee" id = "consignee"/></td>
			
		</tr>
		<tr>
			<td>購貨單編號</td>
			<td width="40%">
				<input type="hidden" name="sin_no" id="sin_no" value="<?php echo ($totalRows_sin+1);?>">
				<input type = "text" id = "poid" name = "poid"/>
				<input type = "button" value= "尋找" id="find_po" onclick = "getPoDetail()"/>
				<span id="IamFine"></span>
			</td>
			<td width = "10%">供應商編號</td>
			<td><label id ="get_supplier_id"></label></td>
		</tr>
		<tr>
			<td>制單人名稱</td>
			<td><label id ="get_name"></label></td>
			<td>供應商名稱</td>
			<td><label id ="get_supplier_name"></label></td>
		</tr>
		<tr>
			<td>訂貨日期</td>
			<td><label id ="get_createdate" value = "DD-MM-YYYY"></label></td>
			<td>供應商電話</td>
			<td><label id ="get_phone"></label></td>
		</tr>
		<!--tr>
			<td width = "10%">收貨日期</td>
			<td><label id ="date"><?php //echo date("Y-m-d H:i:s");?></label></td>
		</tr-->
		<tr>
			<td width = "10%">供應商地址</td>
			<td colspan="3"><label id ="get_addr"></label></td>
		</tr>		
		<tr>
			<td>數期</td>
			<td colspan="3"><label id ="get_remark"></label></td>
		</tr>
	</tbody>
</table>
<input type="hidden" id="total_1" name="total_1"/>
<input type="hidden" id="total_2" name="total_2"/>
<input type="button" id="stoin_hal" name="stoin_hal" onclick="update_po(2);po_select_unlock();document.getElementById('IamFine').innerHTML='';" value="完成部份存貨" disabled="true"/>
<input type="button" id="stoin_fin" name="stoin_fin" onclick="cbchecker();po_select_unlock();document.getElementById('IamFine').innerHTML='';" value="完成所有存貨" disabled="true"/>
<input type="button" id="cancel" name="cancel" onclick="canceler()" value="取消" disabled="true"/>
<br>
<p>貨物資料
<span id = "showPoDetail">
	<!--
<?php
include("get_stockin.php");
?>-->
</span>
<span id = "showIEME">
</span>
<span id = "imei">
</span>
</p>
<!--
<table border="1" width="100%">
	<tr align="right">
		<td>
<input  type = "button" value = "保存"/><input type = "button" value = "取消"/>
		</td>
	</tr>
</table>
-->
</form>
<form id="imei_form">
</form>
<span id="dsql"></span>
</body>
</html>