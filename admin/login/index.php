<?php
session_start();

require_once "../../include/connection.php";
require_once "../../include/functions.php";
require_once "../../include/config.php";

$ld = 2;
$ld = getLevelDeep($ld);

// For Date
$dt = new DateTime();
$thisDate = $dt->format('Y-m-d');
$thisYear = $dt->format('Y');

// For Alert-bar
$alert_type = "warning";
$alert_status = "hidden";
$alert_icon = "exclamation-sign";
$alert_content = "A warning!";

// For Remember me
$admin_name = "";

// Remember me Code
if( isset($_COOKIE['lms_admin_username']) ) {
    $admin_name = $_COOKIE['lms_admin_username'];   
}
// Login Errors
if(isset($_GET['msg']) && $_GET['msg'] == 'exists') {
    $alert_content = "Wrong Password! "."\n"."<a href='../forgot/?action=forgot' class='alert-link' target='_blank'>forgot password?</a>";

    $alert_type = "warning"; $alert_status = "show"; $alert_icon = "exclamation-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'failed') {
    $alert_content = nl2br("Account Does Not Exist! "."\n"."<a href='../register/' class='alert-link' target='_blank'>Register now!</a>");

    $alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}

// for logout
if(isset($_GET['msg']) && $_GET['msg'] == 'logoutsuccess') {
    $alert_content = "<strong>You just Signed Out!</strong>";

    $alert_type = "success"; $alert_status = "show"; $alert_icon = "info-sign";
}

if( adminLoggedin($conn) ) {
    header("Location: ../");
}

?>

<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>LMS - Admin Login</title>

    <!-- CSS  -->
      <link href="<?php echo $ld; ?>assets/css/superhero.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link href="<?php echo $ld; ?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

      <!--  Scripts-->
      <script type="text/javascript" src="<?php echo $ld; ?>assets/js/jquery.js"></script>
      <script type="text/javascript" src="<?php echo $ld; ?>assets/js/bootstrap.min.js"></script>
</head>
<body>

    <!-- Navigation -->
    <?php include_once($ld.INC."lms_navigation.php"); ?>

    <!-- alert bar -->
    <?php include_once($ld.INC."lms_alertbar.php"); ?>

            
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <!--Admin Login-->
                            <?php include_once($ld.INC."lms_login_admin.php"); ?>
                        </div>
                        <div class="col-lg-3"></div>


                        <div class="clearfix"></div>

                        <hr>

                        <div class="footer">
                            <p>&copy; 2016</p>
                        </div>
                    </div>
                </div>
            </div>

</body>
</html>