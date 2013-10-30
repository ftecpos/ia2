<?php include("../conn/sqlconnect.php");?>

<script language="javascript">
	/*var xmlHttp;
	
	function createXMLHttpRequest(){
		if(window.XMLHttpRequest){
			xmlHttp = new XMLHttpRequest();
		}else{
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	
	function doRequest(){
		createXMLHttpRequest();
		var send_string="InvoiceNo="+document.getElementById('InvoiceNo').value; 
		send_string= encodeURI(send_string)
		xmlHttp.onreadystatechange =handleStateChange();		
        alert(send_string); 
		//var url = "StockLevelResult.php?" + "productType="+ document.getElementById("productType").value + "&retailShopNo=" + document.getElementById("retailShopID").value;
		//xmlHttp.open("GET",url,false);
		xmlhttp.open("POST","voidformquery.php",true);
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
		xmlHttp.send(send_string);
		
	}
	
	function handleStateChange(){
		if(xmlHttp.readyState==4 && xmlHttp.status==200){
			document.getElementById("voidquery").innerHTML = xmlHttp.responseText;
		}
	}*/
	
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
 
function ajaxFunction() {
  var getdate = new Date();  //Used to prevent caching during ajax call
  if(xmlhttp) { 
  	var InvoiceNo = document.getElementById("InvoiceNo");
	var selvoid = document.getElementById("selvoid");
	//alert(selvoid.checked);
   /*
    xmlhttp.open("POST","voidformquery.php",true); //calling using POST method
    xmlhttp.onreadystatechange  = handleServerResponse;
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //xmlhttp.send("InvoiceNo=" + InvoiceNo.value +"&selvoid="+selvoid.value); 
	    xmlhttp.send("InvoiceNo=" + InvoiceNo.value +"&selvoid=" + selvoid.checked); 
  */
  var url = "../sales/voidformquery.php?InvoiceNo=" + InvoiceNo.value + "&selvoid=" + selvoid.checked;
  xmlhttp.onreadystatechange  = handleServerResponse;
  xmlhttp.open("GET",url,true);
  xmlhttp.send(null);
  
  }
}
 
function handleServerResponse() {
   if (xmlhttp.readyState == 4) {
     if(xmlhttp.status == 200) {
       document.getElementById("voidquery").innerHTML=xmlhttp.responseText; //Update the HTML Form element 
     }
     else {
        alert("Error during AJAX call. Please try again");
     }
   }
}
</script>


<form name="searchform" method="post" action="voidform.php">
單據編號:<input type="text" id="InvoiceNo" name="InvoiceNo" />
<input id="selvoid" name="selvoid"  type="checkbox" value="selvoid" />
Void<br />

<a href="voidform.php">back</a>

<input type="button" name="Search" value="Search" onclick="ajaxFunction()"/>
</form>
<br>

<div id="voidquery">
<?php include("voidformquery.php");?>
</div>

