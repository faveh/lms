<!DOCTYPE html>
<html>
<head>
	<title>LMS - Login</title>

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
$refering_url = "../";// $_SERVER['HTTP_REFERER'];

$loginok = false;


// To protect mysqli injection
$username = test_input($username);
$password = test_input($password);
$remember = test_input($remember);
$username = mysqli_real_escape_string($conn,$username);
$password = mysqli_real_escape_string($conn,$password);


$sql = "SELECT * FROM $lms_users WHERE (username='$username' and password='$password') OR (email='$username' and password='$password')";
$result = mysqli_query($conn,$sql);
$user_info = mysqli_fetch_array($result);

$count = mysqli_num_rows($result);

if( $count==1 ) {
	// Start user SESSION

	$_SESSION['user_id'] = $user_info['user_id'];
	$_SESSION['username'] = $user_info['username'];
	$_SESSION['email'] = $user_info['email'];
	$_SESSION['password'] = $user_info['password'];
	$_SESSION['name'] = $user_info['name'];
	$_SESSION['mob_no'] = $user_info['mob_no'];
	$_SESSION['gender'] = $user_info['gender'];
	$_SESSION['matric_no'] = $user_info['matric_no'];
	$_SESSION['department'] = $user_info['department'];
	$_SESSION['occupation'] = $user_info['occupation'];
	$_SESSION['downloaded'] = $user_info['downloaded'];
	$_SESSION['borrowed'] = $rank = $user_info['borrowed'];

	//$_SESSION['others'] = $user_info['others'];  // depends
	
	$loginok = true;
} else { $loginok = false; }
	
if($loginok == true) {
	// change status to 1 (ONLINE)
	mysqli_query($conn,"UPDATE $lms_users SET status=1 WHERE (username='$username' AND password='$password')");

	if($remember == "on") {
		setcookie("lms_username", $username, time()+60*60*24*100, "/");
		setcookie("lms_password", $password, time()+60*60*24*100, "/");
		
		header("Location: $refering_url"); // remember password on (adds cookies)
	} elseif($remember == "") {
		if(isset($_COOKIE['lms_username']) || isset($_COOKIE['lms_password'])){
			setcookie("lms_username", "", time()-60*60*24*100, "/");
			setcookie("lms_password", "", time()-60*60*24*100, "/");
		}
		
		header("Location: $refering_url"); // remember password off (removes cookies)
	}
} else {
	// Check if username or email already exist
	$userExistsQuery = mysqli_query($conn,"SELECT username FROM $lms_users WHERE (username='$username') OR (email='$username')");
	$countExist = mysqli_num_rows($userExistsQuery);
	
	if($countExist == 1) {
		header("location: $refering_url?msg=exists");
	} else {
		header("location: $refering_url?msg=failed");
	}
}



?>