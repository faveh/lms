<!DOCTYPE html>
<html>
<head>
	<title>Admin - Register</title>

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
require_once "../include/connection.php";
require_once "../include/config.php";
require_once "../include/functions.php";

$errMsg = "";
$successMessage ="";
$hostname = "localhost/lms";

$refering_url = "../admin/register/";//$_SERVER['HTTP_REFERER'];

// signup details
$username=$_POST['uname'];
$email=$_POST['email'];
$password=$_POST['pword'];
$cpassword=$_POST['cpword'];
$name=$_POST['name'];
$mobileno=$_POST['mobno'];


// Signup Form Validation
// Check for EMPTY required fields.
if(empty($username)) {
header("location: $refering_url?msg=unameReq");
} elseif(empty ($email)) {	
	header("location: $refering_url?msg=emailReq");
} elseif(empty($password)) {
	header("location: $refering_url?msg=pwordReq");
} elseif(empty($cpassword)) {
	header("location: $refering_url?msg=cpwordReq");
} elseif(empty($name)) {
	header("location: $refering_url?msg=nameReq");
} elseif(empty($mobileno)) {
	header("location: $refering_url?msg=mobnoReq");
}
// Required ends here

// Other validations
# password
elseif($password != $cpassword) {
	header("location: $refering_url?msg=pwordNotEqualErr");
} elseif(!validatePasswordLength($password)) {
	header("location: $refering_url?msg=invalidPwordLength");
} 
# username
elseif(strlen($username) <= 5) {
	header("location: $refering_url?msg=invalidUnameLength1");
} elseif(strlen($username) > 15) {
	header("location: $refering_url?msg=invalidUnameLength2");
} elseif(!validateUsername($username)) {
	header("location: $refering_url?msg=invalidUname");
}
# email
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 	header("location: $refering_url?msg=emailErr");
}
# firstname && lastname
elseif(!validateNameLT2($name)) {
	header("location: $refering_url?msg=invalidNameLength1");
} elseif(!validateNameGT20($name)) {
	header("location: $refering_url?msg=invalidNameLength2");
} elseif(!validateName($name)) {
	header("location: $refering_url?msg=invalidName");
}
# mobileno
elseif(!is_numeric($mobileno)) {
	header("location: $refering_url?msg=invalidMobnoErr1");
} elseif(!validateMobileNum($mobileno)) {
	header("location: $refering_url?msg=invalidMobnoErr2");
} else {

	// To protect MySQL injection
$username = test_input($username);
$email = test_input($email);
$password = test_input($password);
$cpassword = test_input($cpassword);
$name = test_input($name);
$mobileno = test_input($mobileno);
$admin_uid = md5($username.time()); // coming soon

// Check if username already exist
$userExistsQuery = mysqli_query($conn,"SELECT username FROM $lms_admin WHERE username='$username'");
if(mysqli_num_rows($userExistsQuery) != 0) {
	header("location: $refering_url?msg=exists1");
}
// Check if email already exist
$emailExistsQuery = mysqli_query($conn,"SELECT email FROM $lms_admin WHERE email='$email'");
if(mysqli_num_rows($emailExistsQuery) != 0) {
	header("location: $refering_url?msg=exists2");
}
// Check if mobile number already exist
$mobilenoExistsQuery = mysqli_query($conn,"SELECT mob_no FROM $lms_admin WHERE mob_no='$mobileno'");
if(mysqli_num_rows($mobilenoExistsQuery) != 0) {
	header("location: $refering_url?msg=exists3");
}

//INSERT INTO `users`(`id`, `username`, `email`, `password`, `firstname`, `lastname`, `mobileno`, 'activation link')
mysqli_query($conn,"ALTER TABLE $lms_admin AUTO_INCREMENT = 1;"); // reset auto increment

$sql= "INSERT INTO $lms_admin (username,email,password,name,mob_no,admin_uid) 
VALUES('$username','$email','$password','$name','$mobileno','$admin_uid')";
$result = mysqli_query($conn,$sql) or die("Error description: ".mysqli_error($conn));

if ($result) {
	# Sending Mail

	$to = $email; // Send email to our user
	$subject = 'LMS - Registration Email Verification'; // Give the email a subject 
$message = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta content='width=device-width, initial-scale=1' name='viewport' />
    <title>LMS - Email Verification</title>

<style>
body {
width: 100%;
}

.head, img.hd {
display: inline;
}

.head > span > strong {
font-size: 24px;
font-weight: 600;
}

.msg {
border: 2px solid #FF9800;
padding: 20px;
}

.foot {
font-size: 14px;
font-weight: 600;
}
</style>
</head>
<body>

<span class='head'><strong>LMS Account Registration Success!</strong></span>
	
	<br /><hr /><br />

	<div class='msg'>
	Your account has been created, you can login with the following credentials <br/>
	------------------------ <br/>
	<strong>Username:</strong> '$username'<br/>
	<strong>Password:</strong> '$password'<br/>
	------------------------ <br/>
	
	</div>

	Please click the link below to activate your <em>nvyta</em> account:<br/>
	<a href='$hostname/admin/?activation_code=$activation_code&email=$email&uname=$username&pword=$password'>Activate Now</a><br/>
	</div>

	<br /><hr /><br />

	<div class='foot'>
	<a href='$hostname'>LMS</a> - Library Management System.
	</div>
	
</div>

</body>
</html>
";

$headers = "From: lms_admin info <admin@lms.com> \r\n";
$headers .= "Reply-To: lms_admin info <admin@lms.com> \r\n";

$headers .= "MIME-Version: 1.0 \r\n";
$headers .= "Content-type: text/html; charset=utf-8 \r\n";
$headers .= "X-Priority: 3 \n";
$headers .= "X-Mailer: PHP".phpversion()." \n";

	@mail($to, $subject, $message, $headers); // Send our email


	//echo "Account successfully Created!";
	header("location: $refering_url?msg=success");
} else {
	//echo "Couldn't create account, Try Again!"; reason QUERY FAILED
	header("location: $refering_url?msg=failed");
}

}// end of else
?>