<?php
session_start();

require_once "include/connection.php";
require_once "include/functions.php";
require_once "include/config.php";

// For Date
$dt = new DateTime();
$thisDate = $dt->format('Y-m-d');
$thisYear = $dt->format('Y');

// For Alert-bar
$alert_type = "warning";
$alert_status = "hidden";
$alert_icon = "exclamation-sign";
$alert_content = "A warning!";

// loggedin
$loggedin = 0;

	// login Errors
	if(isset($_GET['msg']) && $_GET['msg'] == 'exists') {
	    $alert_content = "Wrong Password! "."\n"."<a href='forgot/?action=forgot' class='alert-link' target='_blank'>forgot password?</a>";

	    $alert_type = "warning"; $alert_status = "show"; $alert_icon = "exclamation-sign";
	}
	if(isset($_GET['msg']) && $_GET['msg'] == 'failed') {
	    $alert_content = nl2br("Account Does Not Exist! "."\n"."<a href='register/' class='alert-link' target='_blank'>Register now!</a>");

	    $alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
	}
	// for logout
	if(isset($_GET['msg']) && $_GET['msg'] == 'logoutsuccess') {
	    $alert_content = "<strong>You just Signed Out!</strong>";

	    $alert_type = "success"; $alert_status = "show"; $alert_icon = "info-sign";
	}

if(!loggedin($conn)) {
	//header ("Location: user/");
	// For Auto Login
	$user_name = "";
	$user_password = "";

	// Auto Login Code
	if(isset($_COOKIE['lms_username']) && isset($_COOKIE['lms_password'])) {
	    $user_name = $_COOKIE['lms_username'];
	    $user_password = $_COOKIE['lms_password'];
	    
	    // instead now, do Auto Login
	    //header("location: chksignin.php?email-uname=$user_name&pword=$user_password&remember=on");
	    
	} elseif(isset($_COOKIE['lms_username'])) {
	    $user_name = $_COOKIE['lms_username'];
	}

} else {
	$loggedin = 1;

	$user[] = array();
    $user['user_id'] = $_SESSION['user_id'];
	$user['username'] = $_SESSION['username'];
	$user['email'] = $_SESSION['email'];
	$user['name'] = $_SESSION['name'];
	$user['mob_no'] = $_SESSION['mob_no'];
	$user['gender'] = $_SESSION['gender'];
	$user['matric_no'] = $_SESSION['matric_no'];
	$user['department'] = $_SESSION['department'];
	$user['occupation'] = $_SESSION['occupation'];
	$user['downloaded'] = $_SESSION['downloaded'];
	$user['borrowed'] = $_SESSION['borrowed'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>LMS - Home</title>
  <link rel="shortcut icon" href="assets/imgs/lms-favicon.png">

  <!-- CSS  -->
  <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
  <link href="assets/css/superhero.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <!--  Scripts-->
  <script type="text/javascript" src="assets/js/jquery.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

</head>
<body>

	<!-- Navigation -->
    <?php include_once(INC."lms_navigation.php"); ?>

    <!-- alert bar -->
	<?php include_once(INC."lms_alertbar.php"); ?>


	<!-- Content Page -->
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-12">

    			<div class="jumbotron text-center">
    				<?php if(!$loggedin) { ?>

    					<?php include_once(INC."lms_intro_messages.php"); ?>
	    				
	    			<?php } else { ?>

	    			<?php } ?>
    			</div>


	    		<!-- main column 1 -->
	    		<div class="col-md-4">
	    			<div class="well">
	    				<?php if(!$loggedin) { ?>
	    					<?php include_once(INC."lms_login.php"); ?>
		    			<?php } ?>

		    			<h3>Latest Books</h3>
		    			<hr>

		    			<ul class="media-list">
							<li class="media">
							<a class="pull-left" href="#" id="ppp">
							<img class="media-object" src="assets/imgs/book-cover-page.jpg" alt="book 1">
							</a>
							<div class="media-body">
							<h4 class="media-heading">Book 1</h4>
							<p>This is the book description</p>
							</div>
							</li>
						</ul>
	    			</div>
	    		</div>

	    		<!-- main column 2 -->
	    		<div class="col-md-6">
	    			<div class="well">This is well 2</div>
	    		</div>

	    		<!-- main column 3 -->
	    		<div class="col-md-2">
	    			<div class="well">
		    			<?php if(!$loggedin) { ?>
			    			<p class="text-center"><strong>USER PANE</strong></p>
				    		<h4 class="text-center"><strong>[Please Login!]</strong></h4>
		    			<?php } else { ?>
		    				<h4 class="text-center">User <strong class="bg-default"><?php echo strtoupper($user['username']); ?></strong></h4>
			    			<a class="thumbnail prof-pic">
			    				<img src="assets/imgs/prof-pic.jpg" width="100" height="100">
			    			</a>
			    			<span id="logout" class="center-block text-center"><a href="logout/" class="btn btn-xs btn-danger">logout</a></span>
			    			<ul class="list-group user-options">
								<li class="list-group-item" title="update & view profile"><a href="profile/" class="text-info">profile</a></li>
								<li class="list-group-item" title="Last Read Book">
								<!--<a class="text-info list-group-item-heading">last read</a> -->
								<p class="list-group-item-text text-center">none</p>
								</li>
								<li class="list-group-item" title="view borrowed list"><a href="borrow/" class="text-info">Borrowed <strong class="badge pull-right"><?php echo $user['borrowed']; ?></strong></a></li>
								<li class="list-group-item" title="view borrowed list"><a href="borrow/" class="text-info">Returned <strong class="badge pull-right"><?php echo $user['borrowed']; ?></strong></a></li>
								<li class="list-group-item" title="view downloaded list"><a href="downloaded/" class="text-info">Downloaded <strong class="badge pull-right"><?php echo $user['downloaded']; ?></strong></a></li>
								<!--<li class="list-group-item" title="others"><a href="others/" class="text-info">others</a></li>-->
							</ul>
		    			<?php } ?>
	    			</div>
	    		</div>


	    		<div class="clearfix"></div>

		    	<hr>

		    	<!-- Footer Region -->
		    	<?php include_once(INC."lms_footer.php"); ?>

		  	</div>
    	</div>
    </div>

  

  </body>
</html>
