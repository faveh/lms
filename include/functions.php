<?php

// UI Functions
function fc($data) {
	$data = trim($data);
	$data = strtoupper($data);
	$data = "<span class='lbl fc' title='FORMAT'>$data</span>";
	return $data;
}
function tc($data) {
	$data = trim($data);
	$data = strtoupper($data);
	$data = "<span class='lbl tc' title='TYPE'>$data</span>";
	return $data;
}
function stats($data) {
	if($data == 0) {
		$data = "<span class='lbl danger' title='OFFLINE'>$data</span>";
	} else {
		$data = "<span class='lbl success' title='ONLINE'>$data</span>";
	}
	return $data;
}
function edition($data) {
	if(empty($data)) {
		// Do Nothing
	} else {
		$dataLength = strlen($data);

		if($dataLength != 1) {
			if($data[$dataLength-2] == 1) {
				$data = $data."th";
			} else if($data[$dataLength-1] == 1) {
				$data = $data."st";
			} else if($data[$dataLength-1] == 2) {
				$data = $data."nd";
			} else if($data[$dataLength-1] == 3) {
				$data = $data."rd";
			} else {
				$data = $data."th";
			}
		} else if($data[$dataLength-1] == 1) {
			$data = $data."st";
		} else if($data[$dataLength-1] == 2) {
			$data = $data."nd";
		} else if($data[$dataLength-1] == 3) {
			$data = $data."rd";
		} else {
			$data = $data."th";
		}
	}
	return $data;
}
function uid($data) {
	$data = trim($data);
	$data = strtoupper($data);
	$data = "<span class='lbl fc' title='UNIQUE ID'>$data</span>";
	return $data;
}
function uid_gen($uid) {
	$char = strtoupper(substr(str_shuffle('abcdefghjkmnpqrstuvwxyz'), 0, 5));
    // Concatenate the random string onto the random numbers
    // '0' is left out to avoid confusion with 'O'
    $uid = rand(1, 8) . rand(1, 8) . $char;
    return $uid;
}


// Function to protect MySQL Injection
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = strtolower($data);
	return $data;
}

// Validation Functions
function validateUsername($usernam) {
	if(preg_match('/^[a-z\d_-]{5,15}$/i', $usernam)) {
		return true;
	} else { return false; }
}
function validatePasswordLength($pwrd) {
	$pwrdLen = strlen($pwrd);
	if(($pwrdLen >= 5) && ($pwrdLen <= 20)) {
		return true;
	} else { return false; }
}
function validateNameLT2($nam) {
	$namLen = strlen($nam);
	if($namLen < 5) {
		return false;
	} else { return true; }
}
function validateNameGT20($nam) {
	$namLen = strlen($nam);
	if($namLen > 50) {
		return false;
	} else { return true; }
}
function validateName($nam) {
	if(preg_match('/^[a-z\d- ]{5,50}$/i', $nam)) {
		return true;
	} else { return false; }
}
function validateMobileNum($num) {
	if (preg_match('/^[0-9]{8,18}$/', $num)) {
		return true;
	} else { return false; }
}

// Check if Logged IN
function loggedin($con) {
	$user_status = 0;
	if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];

		$result = mysqli_query($con,"SELECT status FROM `lms_users` WHERE (user_id='$user_id')");
		$user = mysqli_fetch_array($result);
		$user_status = $user['status'];	
	}
	if($user_status == 1) {
		return true;
	} else { return false; }
}
function adminLoggedin($con) {
	$admin_status = 0;
	if (isset($_SESSION['admin_id'])) {
		$admin_id = $_SESSION['admin_id'];

		$result = mysqli_query($con,"SELECT status FROM `lms_admin` WHERE (admin_id='$admin_id')");
		$admin = mysqli_fetch_array($result);
		$admin_status = $admin['status'];
	}
	if($admin_status == 1) {
		return true;
	} else { return false; }
}

// Level [Deepness] Conversion
function getLevelDeep($ld) {
	$lvl_deep = "";
	for($i=0; $i<$ld; $i++) {
  		$lvl_deep .= "../";
	}
	return $lvl_deep;
}

?>