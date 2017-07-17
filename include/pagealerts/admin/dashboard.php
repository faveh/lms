<?php
if( !(isset($ld)) ) {
    $ld = "./";
}

$nav_page = array(0=>"dashboard",1=>"profile",2=>"books",3=>"users",4=>"catalogue",5=>"borrowed",
    6=>"downloaded",7=>"settings",8=>"backup");
$nav_webname = array(0=>"Dashboard",1=>"Profile",2=>"Manage Books",3=>"Manage Users",4=>"Manage Catalogue",5=>"Borrowed List",
    6=>"Downloaded List",7=>"LMS Settings",8=>"Backup & Restore");

for($i=0; $i <= 8; $i++) {
	if($nav_page[$i] == $pagename) {
		$page_title = $nav_webname[$i];
	}
}

$referer = $_SERVER['HTTP_REFERER'];
header("Location: $referer");


?>