<?php

// Required Errors
if(isset($_GET['msg']) && $_GET['msg'] == 'unameReq') {
    $alert_content = "User Name is required";

	$alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'emailReq') {
	$alert_content = "Email is required!";

	$alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'pwordReq') {
    $alert_content = "Password is required!";

	$alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'cpwordReq') {
    $alert_content = "Password is not confirmed!";

	$alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'nameReq') {
    $alert_content = "Name is required!";

    $alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'mobnoReq') {
    $alert_content = "Mobile Number is required!";

    $alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}

// Other Errors
if(isset($_GET['msg']) && $_GET['msg'] == 'pwordNotEqualErr') {
	$alert_content = "Password AND Confirmed password are not the same!";

	$alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'invalidPwordLength') {
	$alert_content = nl2br("Invalid Password Length! "."\n"."( mininum Length = 5 & maximum Length = 20 )!");

	$alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'invalidUnameLength1') {
	$alert_content = nl2br("Invalid User Name! "."\n"."( length must be greater than 5 )!");

	$alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'invalidUnameLength2') {
	$alert_content = nl2br("Invalid User Name! "."\n"."( User Name can only be 15 characters long )!");

	$alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'invalidUname') {
	$alert_content = nl2br("Invalid User Name! "."\n"."( Field must be Alphanumeric "."\n"."(with - AND _ as optional) Only )!");

	$alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'emailErr') {
    $alert_content = "Invalid Email Address!";

    $alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'invalidNameLength1') {
	$alert_content = nl2br("Invalid Name! "."\n"."( length must be greater than 5 )!");

	$alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'invalidNameLength2') {
	$alert_content = nl2br("Invalid Name! "."\n"."( character length above 50 )!"); // 50 might be small

	$alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'invalidName') {
	$alert_content = nl2br("Invalid Name! "."\n"."( Field must be Alphanumeric "."\n"."(with - as optional) Only )!");

	$alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'invalidMobnoErr1') {
	$alert_content = nl2br("Invalid Mobile Number! "."\n"."( Mobile number not numeric )!");

	$alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'invalidMobnoErr2') {
	$alert_content = nl2br("Invalid Mobile Number! "."\n"."( Length Error )!");

	$alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}


// Exist in DB Errors
if(isset($_GET['msg']) && $_GET['msg'] == 'exists1') {
	$alert_content = "User Name Exists!";

	$alert_type = "warning"; $alert_status = "show"; $alert_icon = "exclamation-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'exists2') {
	$alert_content = "Email Already Registered!";

	$alert_type = "warning"; $alert_status = "show"; $alert_icon = "exclamation-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'exists3') {
	$alert_content = "Mobile Number Already Registered!";

	$alert_type = "warning"; $alert_status = "show"; $alert_icon = "exclamation-sign";
}

?>