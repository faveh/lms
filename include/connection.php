<?php

$host="localhost"; 
$db_username="root"; 
$db_password="Spellingbee@1";
$db_name="lms";

/*Default time zone ,to be able to send mail */
date_default_timezone_set("Africa/Lagos");

$conn = mysqli_connect("$host", "$db_username", "$db_password","$db_name");

// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to SERVER! ".mysqli_connect_error();
}

?>