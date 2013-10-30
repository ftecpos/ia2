<?php include("../check_login.php");?>
<?php
sleep(2);
$fileTypes = array("xls","xlsx");
$result = null;
$uploadDir = '../uploads/';
$maxSize = 1 * pow(2,20);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sub'])) {
	if($_POST['upType'] == "1") {
		$myfile = $_FILES['exTypeIn'];
	} else if($_POST['upType'] == "2") {
		$myfile = $_FILES['exCustIn'];
	}
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