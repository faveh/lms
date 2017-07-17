<?php
function newLine() {
	echo "<br>";
}

require_once("conn.php");

if( isset($_POST['user_id']) && isset($_POST['password']) ) {
	$uid = $_POST['user_id'];
	$pword = $_POST['password'];

	$uid = trim($uid);
	$pword = trim($pword);

	$uid = mysql_escape_string($uid);
	$pword = mysql_escape_string($pword);

	echo "User id: ".$uid;
	newLine();
	echo "Password: ".$pword;

	$q = "SELECT * FROM $usr_tbl WHERE uid='$uid' AND password='$pword'";
	$result = mysql_query($q);
	$count = mysql_num_rows($result);

	if($count == 1) {
		echo "LOGIN SUCCESS!";
	}


} else {
	header("location: index.html");
}

?>