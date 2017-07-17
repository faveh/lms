<?php
session_start();

require_once "../include/connection.php";
require_once "../include/functions.php";
require_once "../include/config.php";

$ld = 1;
$ld = getLevelDeep($ld);

// For Date
$dt = new DateTime();
$thisDate = $dt->format('Y-m-d');
$thisYear = $dt->format('Y');

// For Alert-bar
$alert_type = "warning";
$alert_status = "hide";
$alert_icon = "exclamation-sign";
$alert_content = "A warning!";

// pagename
$pagename = "dashboard";

// loggedin
$loggedin = 0;

if(!adminLoggedin($conn)) {
	if(isset($_GET['msg'])) {
		$query = $_GET['msg'];
		header ("Location: login/?msg=$query");
	} else {
		header ("Location: login/");
	}
} else {
	$loggedin = 1;

	$admin[] = array();
    $admin['admin_id'] = $_SESSION['admin_id'];
    $admin['username'] = $_SESSION['admin_username'];
    $admin['email'] = $_SESSION['admin_email'];
    $admin['name'] = $_SESSION['admin_name'];
    $admin['mob_no'] = $_SESSION['admin_mob_no'];
    $admin['gender'] = $_SESSION['admin_gender'];
    $admin['address'] = $_SESSION['admin_address'];
    $admin['status'] = $_SESSION['admin_status'];
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include_once $ld."include/html_head.php"; ?>
<body>

	<!-- Navigation -->
    <?php include_once($ld.INC."lms_navigation.php"); ?>

	<!-- Admin Side Bar -->
	<?php include_once($ld.INC."lms_admin_sidebar.php"); ?>

	<!-- Content Page -->
	<div class="col-md-10 content-page">
		<div class="container-fluid">
			<!-- alert bar -->
			<?php include_once($ld.INC."lms_alertbar.php"); ?>

			<!-- Notification Well -->
			<?php include_once($ld.INC."lms_admin_notifications.php"); ?>

			<!-- Operation Well [Dashboard] -->
			<div class="well">
				<div class="row">
					<div class="col-md-12 text-center">
						<?php
						$admin_operations = array(0=>"Dashboard",1=>"Profile",2=>"Manage Books",3=>"Manage User",4=>"Manage Catalogue",5=>"Borrowed List",
    6=>"Downloaded List",7=>"LMS Settings");

						 for($i=1; $i<=6; $i++) { ?>
						<div class="col-md-2"><a href="./" class="operation-thumb"><img src="<?php echo $ld.ASSETS_IMGS; ?>book-cover-page.jpg" width="100px" class="thumbnail frame center-block" /></a> <strong><a href="./" class="text-warning operation"><?php echo $admin_operations[$i]; ?></a></strong></div>

						<?php } ?>
					</div>
				</div>
			</div>

			<div class="clearfix"></div>

	    	<hr>

	    	<div class="footer">
	  			<p>&copy; 2016</p>
	  		</div>
		</div>
	</div>

	<script type="text/javascript" src="<?php echo $ld; ?>assets/js/style.js"></script>
  </body>
</html>
