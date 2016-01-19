<?php
	$check_type = mysql_query("select invoiceType_no, invoiceState_no from invoice where invoice_no='".$receipt_No."'");
	$type_no = mysql_result($check_type,0,0).mysql_result($check_type,0,1);
	//$state_no = ;
	switch($type_no){
		case '11':
			echo '<table width="400" border="1">';
    		echo '<tr>';
      		echo '<td height="58"><div align="center">Customer Copy<br>';
        	echo '客戶存單</div></td>';
			echo '<td><div align="center"><b>RECEIPT 銷售單據</b></div></td>';
    		echo '</tr>';
  			echo '</table>';
			break;
		case '12':
			echo '<table width="400" border="1">';
    		echo '<tr>';
      		echo '<td height="58"><div align="center">Customer Copy<br>';
        	echo '客戶存單</div></td>';
      		echo '<td><div align="center"><b>VOID RECEIPT 無效單據</b></div></td>';
    		echo '</tr>';
  			echo '</table>';
			break;
		case '14':
			echo '<table width="400" border="1">';
    		echo '<tr>';
      		echo '<td height="58"><div align="center">Customer Copy<br>';
        	echo '客戶存單</div></td>';
			echo '<td><div align="center"><b>RECEIPT 銷售收據(有退貨)</b></div></td>';
    		echo '</tr>';
  			echo '</table>';
			break;
		case '23':
			echo '<table width="400" border="1">';
    		echo '<tr>';
      		echo '<td height="58"><div align="center">Customer Copy<br>';
        	echo '客戶存單</div></td>';
      		echo '<td><div align="center"><b>SALES RETURN RECEIPT<br>退貨單據</b></div></td>';
    		echo '</tr>';
  			echo '</table>';
			break;
		case '3':
			echo '<table width="400" border="1">';
    		echo '<tr>';
      		echo '<td height="58"><div align="center">Customer Copy<br>';
        	echo '客戶存單</div></td>';
      		echo '<td><div align="center"><b>換貨單據</b></div></td>';
    		echo '</tr>';
  			echo '</table>';
			break;
	}
?>