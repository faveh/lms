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


?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
<title>Admin - <?php echo $page_title; ?></title>

<!-- CSS  -->
<!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
<link href="<?php echo $ld; ?>assets/css/superhero.css" type="text/css" rel="stylesheet" media="screen,projection"/>
<link rel="stylesheet" type="text/css" href="<?php echo $ld; ?>assets/css/bootstrap-switch.css">
<link href="<?php echo $ld; ?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
<link rel="stylesheet" type="text/css" href="<?php echo $ld; ?>assets/css/tsort.css">

<!--  Scripts-->
<script type="text/javascript" src="<?php echo $ld; ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $ld; ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $ld; ?>assets/js/tsort.min.js"></script>
<script type="text/javascript" src="<?php echo $ld; ?>assets/js/bootstrap-switch.min.js"></script>

<style type="text/css">
body{
	margin-top: 42px;
}
.col-md-2, .col-md-10 {
    padding: 0;
}
</style>
</head>