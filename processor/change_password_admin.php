<!DOCTYPE html>
<html>
<head>
	<title>Admin - Change Password</title>

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

require_once "../include/connection.php";
require_once "../include/functions.php";
require_once "../include/config.php";

//$admin_id = $_SESSION['admin_id'];
$username = $_SESSION['admin_username'];


// username and password sent from sigin form 
$password = $_REQUEST['pword']; 
$newpassword = $_REQUEST['npword'];
$confirm_newpassword = $_REQUEST['cnpword'];
$refering_url = "../admin/profile/";// $_SERVER['HTTP_REFERER'];


// To protect mysqli injection
$password = test_input($password);
$newpassword = test_input($newpassword);
$confirm_newpassword = test_input($confirm_newpassword);
$password = mysqli_real_escape_string($conn,$password);
$newpassword = mysqli_real_escape_string($conn,$newpassword);
$confirm_newpassword = mysqli_real_escape_string($conn,$confirm_newpassword);

$query = "SELECT username,password FROM $lms_admin WHERE (username='$username' and password='$password')";
$result = mysqli_query($conn,$query);
$count = mysqli_num_rows($result);

if($count == 1) {
	$sql = "UPDATE $lms_admin SET password='$newpassword' WHERE (username='$username' and password='$password')";
	$res = mysqli_query($conn,$sql);
	if($res == 1) {
		// SUCCESS
		header("Location: $refering_url?pword-upd=success");

		// UPDATE $_SESSION['admin_password']
		$_SESSION['admin_password'] = $newpassword;
	} else {
		// FAILED - DB Query FailedDB 
		header("Location: $refering_url?pword-upd=failed");
	}
} else {
	// FAILED - User Verification Failed
	header("Location: $refering_url?pword-upd=failed");
}


?>