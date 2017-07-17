<?php

# List of modules paths as Constants
define("INC", "include/");
define("ASSETS_IMGS", "assets/imgs/");
define("ASSETS_CSS", "assets/css/");
define("ASSETS_JS", "assets/js/");
define("ASSETS_PHP", "assets/php/");

# List of DB Tables
$DB_addon = "lms_";

$lms_admin = $DB_addon."admin";
$lms_approval = $DB_addon."approval";
$lms_books = $DB_addon."books";
$lms_books_format = $DB_addon."books_format";
$lms_books_type_relation = $DB_addon."books_type_relation";
$lms_books_type_settings = $DB_addon."books_type_settings";
$lms_borrowed = $DB_addon."borrowed";
$lms_downloaded = $DB_addon."downloaded";
$lms_fields = $DB_addon."fields";
$lms_lib_info = $DB_addon."lib_info";
$lms_lib_type = $DB_addon."lib_type";
$lms_page_setup = $DB_addon."page_setup";
$lms_users = $DB_addon."users";

if( isset($conn) ) {
	$totalUsersAmount = mysqli_query($conn, "SELECT user_id FROM $lms_users");
	$totalUsers = mysqli_num_rows($totalUsersAmount);

	$onlineUsersAmount = mysqli_query($conn, "SELECT user_id FROM $lms_users WHERE status=1");
	$onlineUsers = mysqli_num_rows($onlineUsersAmount);

	$booksAmount = mysqli_query($conn, "SELECT book_id FROM $lms_books");
	$books_amount = mysqli_num_rows($booksAmount);
} else {
	$books_amount = 0;
}

# Array for Admin Pages
$nav_page = array(0=>"dashboard",1=>"profile",2=>"books",3=>"users",4=>"catalogue",5=>"borrowed",
    6=>"downloaded",7=>"settings",8=>"backup");
$nav_webname = array(0=>"Dashboard",1=>"Profile",2=>"Manage Books",3=>"Manage Users",4=>"Manage Catalogue",5=>"Borrowed List",
    6=>"Downloaded List",7=>"LMS Settings",8=>"Backup & Restore");
$nav_glyphicon = array(0=>"dashboard",1=>"edit",2=>"book",3=>"user",4=>"th",5=>"list",
    6=>"list-alt",7=>"cog",8=>"repeat");


# Making Some DB query to avoid redundancy
//lms_field_code, lms_field
$fieldQuery = "SELECT * FROM $lms_fields";
//$fieldResult = mysqli_query($conn, $fieldQuery);

// book_format_code, book_format
$booksFormatQuery = "SELECT * FROM $lms_books_format";
//$booksFormatResult = mysqli_query($conn, $booksFormatQuery);

// book_type_code, book_type
$booksTypeQuery = "SELECT * FROM $lms_books_type_settings WHERE enabled=1";
//$booksTypeResult = mysqli_query($conn, $booksTypeQuery);