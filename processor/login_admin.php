<!DOCTYPE html>
<html>
<head>
	<title>Admin - Login</title>

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


// username and password sent from sigin form 
$username = $_REQUEST['email-uname']; 
$password = $_REQUEST['pword'];
$remember = $_REQUEST['remember'];
$refering_url = "../admin/";// $_SERVER['HTTP_REFERER'];

$loginok = false;


// To protect mysqli injection
$username = test_input($username);
$password = test_input($password);
$remember = test_input($remember);
$username = mysqli_real_escape_string($conn,$username);
$password = mysqli_real_escape_string($conn,$password);


$sql = "SELECT * FROM $lms_admin WHERE (username='$username' AND password='$password') OR (email='$username' AND password='$password')";
$result = mysqli_query($conn,$sql);
$admin_info = mysqli_fetch_array($result);

$count = mysqli_num_rows($result);

if( $count==1 ) {
	// Start user SESSION

	$_SESSION['admin_id'] = $admin_info['admin_id'];
	$_SESSION['admin_username'] = $admin_info['username'];
	$_SESSION['admin_email'] = $admin_info['email'];
	$_SESSION['admin_password'] = $admin_info['password'];
	$_SESSION['admin_name'] = $admin_info['name'];
	$_SESSION['admin_mob_no'] = $admin_info['mob_no'];
	$_SESSION['admin_gender'] = $admin_info['gender'];
	$_SESSION['admin_address'] = $admin_info['address'];
	$_SESSION['admin_status'] = $admin_info['status'];

	//$_SESSION['others'] = $admin_info['others'];  // depends
	
	$loginok = true;
} else { $loginok = false; }
	
if($loginok == true) {
	// change status to 1 (ONLINE)
	mysqli_query($conn,"UPDATE $lms_admin SET status=1 WHERE (username='$username' AND password='$password')");

	if($remember == "on") {
		setcookie("lms_admin_username", $username, time()+60*60*24*100, "/");
		
		header("Location: $refering_url"); // remember password on (adds cookies)
	} elseif($remember == "") {
		if(isset($_COOKIE['lms_admin_username'])){
			setcookie("lms_admin_username", "", time()-60*60*24*100, "/");
		}
		
		header("Location: $refering_url"); // remember password off (removes cookies)
	}
} else {
	// Check if username or email already exist
	$userExistsQuery = mysqli_query($conn,"SELECT username FROM $lms_admin WHERE (username='$username') OR (email='$username')");
	$countExist = mysqli_num_rows($userExistsQuery);
	
	if($countExist == 1) {
		header("location: $refering_url?msg=exists");
	} else {
		header("location: $refering_url?msg=failed");
	}
}



?>