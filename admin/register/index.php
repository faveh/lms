<?php

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

//$page_name = "register";

require_once "../../include/signuperrors_admin.php";

if(isset($_GET['msg']) && $_GET['msg'] == 'success') {
    $alert_content = nl2br("Account Registration Successful! "."\n"."<kbd>Check Your Email to ACTIVATE ACCOUNT</kbd>"." "."<strong><a href='../'>Goto ADMIN Login</a></strong>");

    $alert_type = "success"; $alert_status = "show"; $alert_icon = "info-sign";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'failed') {
    $alert_content = nl2br("Account Registration Failed! "."\n"."<kbd>Try Again</kbd>");

    $alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}

?>

<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Admin - Register</title>

    <!-- CSS  -->
      <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
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
                        <?php if( !($alert_type == "success") ) { ?>
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <!--Sign Up-->
                            <h2 class="text-info text-center">ADMIN Registration Form <small class="text-danger">(Fill All)</small></h2>
                            <form action="<?php echo $ld; ?>processor/register_admin.php" method="POST">
                                <fieldset>
                                    <legend>Login Details</legend>
                                    <label>Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="uname" placeholder="User Name" required />
                                    <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" placeholder="Your Email" required />
                                    <label>Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="pword" placeholder="Your Password" required />
                                    <label>Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="cpword" placeholder="Confirm Password" required />


                                    
                                    <br><br>

                                    <legend>Also Compulsory</legend>
                                    <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Full Name" required />
                                    <label>Mobile NUmber <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mobno" placeholder="Mobile Number" required />
                                    
                                </fieldset>
                                <br>

                                <p class="text-info text-center"><strong>Other User details can be completed later</strong></p>

                                <input type="submit" class="btn btn-sm btn-warning pull-right" value="REGISTER">
                            </form>

                            <!-- For AJAX Validation  coming soon-->
                            <!--<script type="text/javascript" src="../js/signupvalidator.js"></script>-->
                        </div>
                        <div class="col-lg-3"></div>

                        <?php } ?>


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