<?php
if( !(isset($ld)) ) {
    $ld = "./";
}

for($i=0; $i <= 8; $i++) {
	if($nav_page[$i] == $pagename) {
		include_once "pagealerts/admin/$pagename.php";
	}
}

//$referer = $_SERVER['HTTP_REFERER'];
//header("Location: $referer");

?>