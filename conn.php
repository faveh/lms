<?php

$host="localhost:3306"; 
$db_username="root"; 
$db_password=""; 
$db_name="lms";

# List of DB Tables
$usr_tbl="users";
$stf_tbl = "staff";
$mat_tbl = "materials";
$bks_tbl = "books";

$conn = mysql_connect("$host", "$db_username", "$db_password","$db_name");

// Check connection
if( mysql_error() ) {
	echo "Failed to connect to SERVER! ".mysql_error();
}
/*mysql_connect("$host", "$db_username", "$db_password") or die ("could not connect to SERVER!");
mysql_select_db("$db_name") or die("could not locate DB!");*/

?>