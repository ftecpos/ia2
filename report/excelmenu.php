<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Excel MENU</title>
<script type="text/javascript">
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
<?php
$check_year = date("Y");
$check_month = date("M");

if(isset($_GET["excel_type"])) {
	$excel_type = $_GET["excel_type"];
} else {
	$excel_type = "";
}

?>
<?php 
	switch($excel_type){
		case "saleEX":
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
			break;
			
		case "incomeEX":
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
			break;
			
		case "stockinEX":
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
			break;
			
		case "transferEX":
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
			break;
			
		case "inventoryEX":
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
			
			/*echo '<tr><td><div align="right">店鋪：</div></td><td></td>';
			echo '</tr>';*/
			
			echo '<tr>
    				<td></td><td></td>
        			<td><div align="center"><input type="button" width="80px" id="genEX" value="輸出" onclick="genReport()" /></div></td>
					</tr>';
			echo '</table>';
			break;
			
		default:
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
			break;
	}
?>

</body>
</html>

