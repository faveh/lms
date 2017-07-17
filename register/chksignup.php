<?php
require_once "../includez/connection.php";
require_once "../includez/funcz.php";

$errMsg = "";
$successMessage ="";
$hostname = $_SERVER['HTTP_HOST'];
if( $hostname != "nvyta.com" ) {
	$hostname = "localhost/nvyta";
} else {
	$hostname = "http://nvyta.com";
}
$base_url = $hostname."/activate";

// signup details
$username=$_POST['uname'];
$email=$_POST['email'];
$password=$_POST['pword'];
$cpassword=$_POST['cpword'];
$firstname=$_POST['fname'];
$lastname=$_POST['lname'];
$mobileno=$_POST['mobno'];


// Signup Form Validation
if (isset($_POST['signup']))  {

// Check for EMPTY required fields.
if(empty($username)) {
header("location:signup.php?msg=unameReq");
} elseif(empty ($email)) {	
	header("location:signup.php?msg=emailReq");
} elseif(empty($password)) {
	header("location:signup.php?msg=pwordReq");
} elseif(empty($cpassword)) {
	header("location:signup.php?msg=cpwordReq");
} elseif(empty($firstname)) {
	header("location:signup.php?msg=fnameReq");
} elseif(empty($lastname)) {
	header("location:signup.php?msg=lnameReq");
} elseif(empty($mobileno)) {
	header("location:signup.php?msg=mobnoReq");
}
// Required ends here

// Other validations
# password
elseif($password != $cpassword) {
	header("location:signup.php?msg=pwordNotEqualErr");
} elseif(!validatePasswordLength($password)) {
	header("location:signup.php?msg=invalidPwordLength");
} 
# username
elseif(strlen($username) <= 5) {
	header("location:signup.php?msg=invalidUnameLength1");
} elseif(strlen($username) > 15) {
	header("location:signup.php?msg=invalidUnameLength2");
} elseif(!validateUsername($username)) {
	header("location:signup.php?msg=invalidUname");
}
# email
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 	header("location:signup.php?msg=emailErr");
}
# firstname && lastname
elseif(!validateNameLT2($firstname, $lastname)) {
	header("location:signup.php?msg=invalidNameLength1");
} elseif(!validateNameGT20($firstname, $lastname)) {
	header("location:signup.php?msg=invalidNameLength2");
} elseif(!validateName($firstname)) {
	header("location:signup.php?msg=invalidFname");
} elseif(!validateName($lastname)) {
	header("location:signup.php?msg=invalidLname");
}
# mobileno
elseif(!is_numeric($mobileno)) {
	header("location:signup.php?msg=invalidMobnoErr1");
} elseif(!validateMobileNum($mobileno)) {
	header("location:signup.php?msg=invalidMobnoErr2");
} else {

	// To protect MySQL injection
$username = test_input($username);
$email = test_input($email);
$password = test_input($password);
$cpassword = test_input($cpassword);
$firstname = test_input($firstname);
$lastname = test_input($lastname);
$mobileno = test_input($mobileno);
$activation_code = md5($email.time()); // coming soon

// Check if username already exist
$userExistsQuery = mysqli_query($conn,"SELECT username FROM users WHERE username='$username'");
if(mysqli_num_rows($userExistsQuery) != 0) {
	header("location: signup.php?msg=exists1");
}
// Check if email already exist
$emailExistsQuery = mysqli_query($conn,"SELECT email FROM users WHERE email='$email'");
if(mysqli_num_rows($emailExistsQuery) != 0) {
	header("location: signup.php?msg=exists2");
}
// Check if mobile number already exist
$mobilenoExistsQuery = mysqli_query($conn,"SELECT mobileno FROM users WHERE mobileno='$mobileno'");
if(mysqli_num_rows($mobilenoExistsQuery) != 0) {
	header("location: signup.php?msg=exists3");
}

//INSERT INTO `users`(`id`, `username`, `email`, `password`, `firstname`, `lastname`, `mobileno`, 'activation link')
mysqli_query($conn,"ALTER TABLE $tbl_name AUTO_INCREMENT = 1;"); // reset auto increment

$sql= "INSERT INTO $tbl_name (username,email,password,firstname,lastname,mobileno,activation_code) 
VALUES('$username','$email','$password','$firstname','$lastname','$mobileno','$activation_code')";
$result = mysqli_query($conn,$sql) or die("Error description: ".mysqli_error($conn));

if ($result) {
	# Sending Mail

	$to = $email; // Send email to our user
	$subject = 'nvyta | Sign Up Email Verification'; // Give the email a subject 
$message = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta content='width=device-width, initial-scale=1' name='viewport' />
    <title>nvyta | Sign Up Verification</title>
    <link rel='shortcut icon' href='http://nvyta.com/workspace/imgs/logo.jpg' />

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

<img src='http://nvyta.com/imgs/logo.jpg' alt='nvyta logo' width='20' height='20' class='hd' />
<span class='head'><strong> Thanks for signing up!</strong></span>
	
	<br /><hr /><br />

	<div class='msg'>
	Your account has been created, you can login with the following credentials <br/>
	------------------------<br/>
	<strong>Username:</strong> '$username'<br/>
	<strong>Password:</strong> '$password'<br/>
	------------------------ <br/>
	 
	Please click the link below to activate your <em>nvyta</em> account:<br/>
	<a href='$base_url?activation_code=$activation_code&email=$email&uname=$username&pword=$password'>Activate Now</a><br/>
	</div>

	<br /><hr /><br />

	<div class='foot'>
	<a href='$hostname'>nvyta</a> | Use Html Pages to Broadcast your events, ceremony and occasions.
	</div>
	
</div>

</body>
</html>
";

$headers = "From: nvyta info <info@nvyta.com> \r\n";
$headers .= "Reply-To: nvyta info <info@nvyta.com> \r\n";
$headers .= "Cc: nvytadmin@nvyta.com \r\n";

$headers .= "MIME-Version: 1.0 \r\n";
$headers .= "Content-type: text/html; charset=utf-8 \r\n";
$headers .= "X-Priority: 3 \n";
$headers .= "X-Mailer: PHP".phpversion()." \n";

	@mail($to, $subject, $message, $headers); // Send our email


	//echo "Account successfully Created!";
	header("location:signupresult.php?msg=success");
} else {
	//echo "Couldn't create account, Try Again!"; reason QUERY FAILED
	header("location:signupresult.php?msg=failed");
}

}// end of else
}// end of mother if
?>