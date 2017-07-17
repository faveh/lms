<!DOCTYPE html>
<html>
<head>
	<title>Admin - Logout</title>

	<style type="text/css">
		body {
		  font-family: "Lato", "Helvetica Neue", Helvetica, Arial, sans-serif;
		  font-size: 15px;
		  line-height: 1.42857143;
		  color: #ebebeb;
		  background-color: #2b3e50;
		}
	</style>
</head>
<body>

</body>
</html>

<?php
session_start();

require "../include/connection.php";
require "../include/config.php";

$user_id = $_SESSION['user_id'];

// change status to 0 (OFFLINE)
mysqli_query($conn,"UPDATE $lms_users SET status=0 WHERE (user_id='$user_id')");

//$_SESSION = array(); // reset session array
//session_destroy();


//unset password cookies
if(isset($_COOKIE['password'])) {
    setcookie("password", "", time()-60*60*24*100, "/");
}

header ("Location: ../?msg=logoutsuccess");
?>