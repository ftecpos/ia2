<script language="javascript" type="text/javascript">
	var xmlhttp;
	
	function check_nt(){
    if(document.getElementById("new_type").value==""){
	  document.getElementById("add_type").disabled=true;
	}else{
	  document.getElementById("add_type").disabled=false;
	}
	}
	
	function insert_new_type(){
	if (window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}
	else
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	//alert("submit_new_type:send text");
  	var url = "../../report/testing/staffTypeSQL.php?action=insert&type_Name="+document.getElementById("new_type").value;
  	xmlhttp.open("GET",url,true);
	xmlhttp.send();
	document.getElementById("add_type").disabled=true;
	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	document.getElementById("staff_type_form").innerHTML = xmlhttp.responseText;
	}
	
	}
	
/////////////////////////***********************************//////////////////////

	function check02(){
	if(document.getElementById("mntype").value==""){
	  document.getElementById("ctype").disabled=true;
	}else{
	  document.getElementById("ctype").disabled=false;
	}
	}
	
	function updateStaffType(){
		if (window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}
	else
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	//alert("submit_new_type:send text");
	//alert(document.getElementById("mntype").value+", no: "+document.getElementById("nType").value);
  	var url = "../../report/testing/staffTypeSQL.php?action=update&type_Name="+document.getElementById("mntype").value+"&type_no="+document.getElementById("nType").value;
  	xmlhttp.open("GET",url,true);
	xmlhttp.send();
	document.getElementById("ctype").disabled=true;
	}
	
</script>

<div id="CollapsiblePanel2" class="CollapsiblePanel">
	<div class="CollapsiblePanelTab" tabindex="0">新增職位</div>
	<div class="CollapsiblePanelContent">
		<form method="post">
		輸入職位名稱 : 
		<input type="text" name="new_type" id="new_type" onKeyUp="check_nt()"/>
		<input type="button" name="add_type" id="add_type" value="新增" onClick="insert_new_type()" disabled/>
		</form>
	<?php
	$select_stafftype = "SELECT * FROM stafftype";
	$stafftype = mysql_query($select_stafftype);
	$stafftype_data = mysql_fetch_assoc($stafftype);
	$totalRows_stafftype = mysql_num_rows($stafftype);

	$typeNumber = array();
	$typeString = array();
	$total_type = 0;
	do{
		$typeNumber[$total_type]=$stafftype_data['staffType_no'];
		$typeString[$total_type]=$stafftype_data['typeName'];
		$total_type++;
	}while($stafftype_data = mysql_fetch_assoc($stafftype));
	?>
    <br />
    <form>
	  請選擇需要變更名稱的職位 : <br>
	  <select name="nType" id="nType"><span id="typeselect">
    <?php
	$tString="";
  	for($p=0;$p<$total_type;$p++){
		print('<option value="'.$typeNumber[$p].'">'.$typeString[$p].'</option>');
	}
	echo '</span></select><input type="hidden" id="selectTotal" value="'.$total_type.'"/>';
	for($p2=0;$p2<$total_type;$p2++){
		print('<input type="hidden" id="type'.$typeNumber[$p2].'" value="'.$typeString[$p2].'"/>');
	}
?>
       更改為
	  <input type="text" name="mntype" id="mntype" onkeyup="check02()" />
	  <input type="button" name="ctype" id="ctype" value="修改" onClick="updateStaffType()" disabled />
	</form>
    </div>
</div>


<script type="text/javascript">
var CollapsiblePanel2 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel2");
</script>