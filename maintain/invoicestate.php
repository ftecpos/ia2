<?php include("../check_login.php");?>
<script type="text/javascript">
//var time_variable;

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
 
function GetKey(e){	
  if(e.which == '13'){
	addinv_state();
  }	
} 

function resettxt(){
	document.getElementById("inv_state_Name").value="";
	}

function addinv_state() {
  var getdate = new Date();  //Used to prevent caching during ajax call
  if(xmlhttp) { 
  var inv_state_name = document.getElementById("inv_state_Name");
  if(inv_state_name.value==""){
  alert("請輸入單據分類名稱");
  return false;
  }else{
  var url = "../maintain/invoicestatequery.php?invoicestate=" + inv_state_name.value+"&type=insert";
	  }
  xmlhttp.onreadystatechange  = handleServerResponse;
  xmlhttp.open("GET",url,true);
  xmlhttp.send(null);
  
  }
}

function handleServerResponse() {
   if (xmlhttp.readyState == 4) {
     if(xmlhttp.status == 200) {
       document.getElementById("inv_state").innerHTML=xmlhttp.responseText; //Update the HTML Form element 
     }
     else {
        alert("Error during AJAX call. Please try again");
     }
   }
}
</script>


<div id="inv_state">
<?php include("invoicestatequery.php");?>
</div>

<div id="CollapsiblePanel1" class="CollapsiblePanel">
<div class="CollapsiblePanelTab" tabindex="0">新増單據分類</div>
<div class="CollapsiblePanelContent">
<table width="354" border="1">
<tr>
<td width="124">單據分類名稱</td>
<td width="214"><input type="text" id="inv_state_Name" onKeyUp="GetKey(event);"/></td>
</tr>
<tr>
  <td colspan="2"><div align="right">
    <input type="button" name="add" value="新増" onClick="addinv_state()"/>
     <input type="button" id="btnreset" value="重設" onClick="resettxt()"/>
  </div></td>
  </tr>
</table>
    </div>
</div>
<script type="text/javascript">
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
</script>