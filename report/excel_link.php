<?php
session_start();
if(!$_SESSION['retail_no']){
    die();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Excel MENU</title>
<script type="text/javascript">

function menu() {
	var excel_type = document.getElementById("reportType").value;
	//alert(excel_type);
	var xmlhttp;
	var url = '../report/excelmenu.php?excel_type=' + excel_type;
	//alert(url);
	if(window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("excel_menu").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("get",url,true);
	xmlhttp.send();
}

function genReport(){
	//alert("a");
	/*var xmlhttp;
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}*/
	var to = document.getElementById("datepicker_to").value;
	var from = document.getElementById("datepicker_from").value;
	if(document.getElementById("reportType").value=="saleEX"){
	  	//var url = "../../report/testing/saleExcelReport.php";
		location.href = "../report/testing/saleExcelReport.php?to="+to+"&from="+from;
	}
	if(document.getElementById("reportType").value=="inventoryEX"){
	  	//var url = "../../report/testing/saleExcelReport.php";
		location.href = "../report/testing/inventoryExcelReport.php";
	}
	if(document.getElementById("reportType").value=="incomeEX"){
		location.href = "../report/testing/incomeExcelReport.php?to="+to+"&from="+from;
	}
	if(document.getElementById("reportType").value=="stockinEX"){
		location.href = "../report/testing/stockinExcelReport.php?to="+to+"&from="+from;
	}
	if(document.getElementById("reportType").value=="transferEX"){
		location.href = "../report/testing/transferExcelReport.php?to="+to+"&from="+from;
	}
	//alert("b");
	//xmlhttp.open("GET",url,true);
	//xmlhttp.send();
	//alert("c");
}

function call_datepicker(){
	$( "#datepicker_from" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat:"yy-mm-dd",
		showButtonPanel: true
	});
	$( "#datepicker_to" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat:"yy-mm-dd",
		showButtonPanel: true
	});

}
call_datepicker();

</script>

<style>
	.ui-datepicker-month{border: 1px solid #000000;}
	.ui-datepicker-year{border: 1px solid #000000;}
	.ui-multiselect-filter {height:25px;}
	.ui-multiselect-filter input {height:20px;}
</style>
</head>

<body>
<table>
	<tr height="10px">
    	<td width="100px"></td>
    	<td width="10px"></td>
    	<td width="120px"></td>
    </tr>
	<tr>
    	<td><div align="right">報表類型：</div></td>
    	<td></td>
        <td><div align="center"><select id="reportType">
    <?php
        switch ($_SESSION['retail_no']){
            case 1:
                echo '<option id="saleEX" value="saleEX">銷售報表</option>';
                echo '<option id="inventoryEX" value="inventoryEX">存庫報表</option>';
                echo '<option id="transferEX" value="transferEX">轉貨報表</option>';
                echo '<option id="stockinEX" value="stockinEX">進貨報表</option>';
                echo '<option id="incomeEX" value="incomeEX">收入報表</option>';
            break;
            case 10001:
                echo '<option id="saleEX" value="saleEX">銷售報表</option>';
                echo '<option id="inventoryEX" value="inventoryEX">存庫報表</option>';
                echo '<option id="transferEX" value="transferEX">轉貨報表</option>';
                echo '<option id="stockinEX" value="stockinEX">進貨報表</option>';
            break;
        }
    ?>
        </select></div></td>
	</tr>
</table>

<div id="excel_menu">

<?php
	echo "<table>";
			echo '<tr height="10px">
    				<td width="100px"></td>
    				<td width="30px"></td>
    				<td width="120px"></td>
    				</tr>';
			echo '<tr>
    				<td><div align="right">日期範圍：</div></td>
    				<td>由</td>';
			
    		echo '<td><input id="datepicker_from" type="text"></td>';
			echo '</tr>';
			echo '<tr><td></td><td>至</td>';
			echo '<td><input id="datepicker_to" type="text"></td></tr>';
			
			echo '<tr>
    				<td></td><td></td>
        			<td><div align="center"><input type="button" width="80px" id="genEX" value="輸出" onclick="genReport()" /></div></td>
					</tr>';
			echo '</table>';
?>

</div>


</body>
</html>

