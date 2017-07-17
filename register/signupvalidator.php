<?php
require_once "../includez/funcz.php";

$icon_remove = "<span class='glyphicon glyphicon-remove text-danger'></span>";
$icon_ok = "<span class='glyphicon glyphicon-ok text-warning'></span>";

if( isset($_POST['uname']) ) {
	$username=$_POST['uname'];

	if(empty($username)) { echo json_encode(array('txt' => "User Name is required!", 'icon' => $icon_remove)); }

	# username (validate if not empty)
	else {
		if(strlen($username) <= 5) {
			echo json_encode(array('txt' => "Invalid User Name! <br/> ( length must be greater than 5 )!", 'icon' => $icon_remove));
		} elseif(strlen($username) > 15) {
			echo json_encode(array('txt' => "Invalid User Name! <br/> ( User Name can only be 15 characters long )!", 'icon' => $icon_remove));
		} elseif(!validateUsername($username)) {
			echo json_encode(array('txt' => "Invalid User Name! <br/> ( Field must be Alphanumeric "."\n"."(with - AND _ as optional) Only )!", 'icon' => $icon_remove));
		} else {
			require_once "../includez/connection.php";

			$username = test_input($username); // against MySQL Injection
			// Check if username already exist
			$userExistsQuery = mysqli_query($conn,"SELECT username FROM users WHERE username='$username'");
			if(mysqli_num_rows($userExistsQuery) != 0) {
				echo json_encode(array('txt' => "User Name Exists!", 'icon' => $icon_remove));
			} else { echo json_encode(array('txt' => "<strong class='text-warning'>User Name is OK!</strong>", 'icon' => $icon_ok)); }
		}
	}

} else if( isset($_POST['email']) ) {
	$email=$_POST['email'];

	if(empty($email)) { echo json_encode(array('txt' => "Email is required!", 'icon' => $icon_remove)); }

	# email (validate if not empty)
	else {
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo json_encode(array('txt' => "Invalid Email Address!", 'icon' => $icon_remove));
		} else {
			require_once "../includez/connection.php";

			$email = test_input($email); // against mysqli Injection
			// Check if email already exist
			$emailExistsQuery = mysqli_query($conn,"SELECT email FROM users WHERE email='$email'");
			if(mysqli_num_rows($emailExistsQuery) != 0) {
				echo json_encode(array('txt' => "Email Already Registered!", 'icon' => $icon_remove));
			} else { echo json_encode(array('txt' => "<strong class='text-warning'>Email is OK!</strong>", 'icon' => $icon_ok)); }
		}
	}

} else if( isset($_POST['pword']) ) {
	$password=$_POST['pword'];

	if( isset($_POST['cpword']) ) {
		$cpassword=$_POST['cpword'];

		if(!validatePasswordLength($password)) {
			echo json_encode(array('txt' => "Invalid Password Length! <br/> ( mininum Length = 5 & maximum Length = 20 )!", 'icon' => $icon_remove));
		} else if(empty($cpassword)) { echo json_encode(array('txt' => "Confirmed password is required!", 'icon' => $icon_remove)); }

		# password && cpassword (validate if not empty)
		else {
			if($password != $cpassword) {
				echo json_encode(array('txt' => "Password AND Confirmed password are not the same!", 'icon' => $icon_remove));
			} else {
				echo json_encode(array('txt' => "<strong class='text-warning'>Password CONFIRMED!</strong>", 'icon' => $icon_ok));
			}
		}
	} else {

		if(empty($password)) { echo json_encode(array('txt' => "Password is required!", 'icon' => $icon_remove)); }

		# password (validate if not empty)
		else {
			if(!validatePasswordLength($password)) {
				echo json_encode(array('txt' => "Invalid Password Length! <br/> ( mininum Length = 5 & maximum Length = 20 )!", 'icon' => $icon_remove));
			} else {
				echo json_encode(array('txt' => "<strong class='text-warning'>Password is OK please Confirm below!</strong>", 'icon' => $icon_ok));
			}
		}
	}

} else if( isset($_POST['fname']) || isset($_POST['lname']) ) {
	if( isset($_POST['fname']) ) {
		$firstname=$_POST['fname'];
		$lastname="lastname";

		if(empty($firstname)) { echo json_encode(array('txt' => "First Name is required!", 'icon' => $icon_remove)); }

		# firstname (validate if not empty)
		else {
			if(!validateNameLT2($firstname, $lastname)) {
				echo json_encode(array('txt' => "Invalid First Name! <br/> ( length must be greater than 1 )!", 'icon' => $icon_remove));
			} elseif(!validateNameGT20($firstname, $lastname)) {
				echo json_encode(array('txt' => "Invalid First Name! <br/> ( character length above 20 )!", 'icon' => $icon_remove));
			} elseif(!validateName($firstname)) {
				echo json_encode(array('txt' => "Invalid First Name! <br/> ( Field must be Alphanumeric "."\n"."(with - as optional) Only )!", 'icon' => $icon_remove));
			} else {
				echo json_encode(array('txt' => "<strong class='text-warning'>First Name is OK!</strong>", 'icon' => $icon_ok));
			}
		}

	} else {
		$firstname="firstname";
		$lastname=$_POST['lname'];

		if(empty($lastname)) { echo json_encode(array('txt' => "Last Name is required!", 'icon' => $icon_remove)); }

		# lastname (validate if not empty)
		else {
			if(!validateNameLT2($firstname, $lastname)) {
				echo json_encode(array('txt' => "Invalid Last Name! <br/> ( length must be greater than 1 )!", 'icon' => $icon_remove));
			} elseif(!validateNameGT20($firstname, $lastname)) {
				echo json_encode(array('txt' => "Invalid Last Name! <br/> ( character length above 20 )!", 'icon' => $icon_remove));
			} elseif(!validateName($lastname)) {
				echo json_encode(array('txt' => "Invalid Last Name! <br/> ( Field must be Alphanumeric "."\n"."(with - as optional) Only )!", 'icon' => $icon_remove));
			} else {
				echo json_encode(array('txt' => "<strong class='text-warning'>Last Name is OK!</strong>", 'icon' => $icon_ok));
			}
		}

	}

} else if( isset($_POST['mobno']) ) {
	$mobileno=$_POST['mobno'];

	if(empty($mobileno)) { echo json_encode(array('txt' => "Mobile Number is required!", 'icon' => $icon_remove)); }

	# mobileno (validate if not empty)
	else {
		if(!is_numeric($mobileno)) {
			echo json_encode(array('txt' => "Invalid Mobile Number! <br/> ( Mobile number not numeric )!", 'icon' => $icon_remove));
		} elseif(!validateMobileNum($mobileno)) {
			echo json_encode(array('txt' => "Invalid Mobile Number! <br/> ( Length Error )!", 'icon' => $icon_remove));
		} else {
			echo json_encode(array('txt' => "<strong class='text-warning'>Mobile Number is OK!</strong>", 'icon' => $icon_ok));
		}
	}

} else {
	// Do Nothing
}