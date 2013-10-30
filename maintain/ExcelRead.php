<?php include("../check_login.php");?>
<?php
/*
$filename = "Senator.xlsx";
$destination_file = 'Upload/';
$max_file_size = '10000000000000000';
echo 'file_name : '.$filename;

if(!is_uploaded_file($_FILES[$filename]['tmp_name'])){
echo "请选择你想要上传的文件";
exit;		
}
$files = $_FILES[$filename];
echo $files['name'];
//echo 'file_name : '.$filename;
if(!file_exists($destination_file)){
mkdir($destination_file);
}
$filename=$files["tmp_name"];
echo " temp : ".$filename;
$destination = $destination_file.$files['name'];
echo 'dir : '.$destination;
 if (file_exists($destination)){
echo "同名文件已经存在了";
exit;
}
if(!move_uploaded_file ($files['tmp_name'], $destination_file.$files['name'])){
echo "移动文件出错";
exit;
}
*/


sleep(2);
$fileTypes = array('xlsx');
$result = null;
$uploadDir = 'Upload/';
$maxSize = 1 * pow(2,20);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sub'])) {
$myfile = $_FILES['myfile'];
$myfileType = substr($myfile['name'], strrpos($myfile['name'], ".") + 1);
if ($myfile['size'] > $maxSize) {
$result = 1;
} else if (!in_array($myfileType, $fileTypes)) {
$result = 2;
} elseif (is_uploaded_file($myfile['tmp_name'])) {
$toFile = $uploadDir . '/' . $myfile['name'];
if (@move_uploaded_file($myfile['tmp_name'], $toFile)) {
$result = 0;
} else {
$result = -1;
}
} else {
$result = 1;
}
}


?>
<script type="text/javascript">
window.top.window.stopUpload(<?php echo $result; ?>);
</script>
<?php

require_once 'Excel/reader.php';
$data = new Spreadsheet_Excel_Reader();
$data->read('Upload/Senator.xlsx');

error_reporting(E_ALL ^ E_NOTICE);
echo "<table border='1'>";
echo "<tr><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Email ID</th></tr>";

for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++)
		 {
echo "<tr>";
		
		
echo "<td>";
		echo $data->sheets[0]['cells'][$j+1][1];
echo "</td>";	
echo "<td>";	
		echo $data->sheets[0]['cells'][$j+1][2];
echo "</td>";

echo "<td>";
	
		echo $data->sheets[0]['cells'][$j+1][3];
echo "</td>";

echo "<td>";

		echo $data->sheets[0]['cells'][$j+1][4];
echo "</td>";
		//echo "<br>";

echo "</tr>";
		
		}

echo "</table>";
?>
