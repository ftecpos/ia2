<?php
	// Initialize the session.
	// If you are using session_name("something"), don't forget it now!
	require_once('conn/sqlconnect.php');
		session_start();
	if(!isset($_SESSION['staff_no'])){
		header('location:no_login.html');
	} else if(!isset($_SESSION['staff_id'])){
		header('location:no_login.html');
	} else if(!isset($_SESSION['retail_id'])){
		header('location:no_login.html');
	} else if(!isset($_SESSION['retail_no'])){
		header('location:no_login.html');
	}
?>
<?php



// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!

	
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
	
	
	echo "<span style=\"size:30px;\" >Logout success</span><br><br><br>";
	
	session_destroy();

?>

<script type="text/javascript" src="js/access.js"></script>
<html>
<body onLoad="setTimeout('goTologin()',1500)">

<span style="font-size:24px;">Please login <a href="login.php">here</a></span>

</body>

</html>