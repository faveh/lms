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

// pagename
$pagename = "profile";

// loggedin
$loggedin = 0;

if(!adminLoggedin($conn)) {
    if(isset($_GET['msg'])) {
        $query = $_GET['msg'];
        header ("Location: ../login/?msg=$query");
    } else {
        header ("Location: ../login/");
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

// For Password Update - Alerts
if(isset($_GET['pword-upd']) && $_GET['pword-upd'] == 'success') {
    $alert_content = "Password Successfully Changed!";

    $alert_type = "success"; $alert_status = "show"; $alert_icon = "info-sign";
}
if(isset($_GET['pword-upd']) && $_GET['pword-upd'] == 'failed') {
    $alert_content = "Password Update Failed!";

    $alert_type = "danger"; $alert_status = "show"; $alert_icon = "remove-sign";
}

?>

<!DOCTYPE html>
<html lang="en">
<!-- Html Head -->
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
            <div class="well" id="profile-well">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills">
                            <li class="active profile-1 tabs"><a href="#notify-well"><span class="glyphicon glyphicon-arrow-up"></span> Update Profile</a></li>
                            <li class="profile-2 tabs"><a href="#profile-well"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>
                        </ul>

                        <hr class="hr-tab">
                        
                        <!-- profile tab 1 -->
                        <div id="profile-div-1" class="profile-div">
                        <form action="" method="POST">
                        <div class="col-sm-2"><label>Username</label></div>
                        <div class="col-sm-10"><input type="text" class="form-control" value="<?php echo $admin['username']; ?>" readonly /></div>
                        <div class="col-sm-2"><label>Email</label></div>
                        <div class="col-sm-10"><input type="text" class="form-control" value="<?php echo $admin['email']; ?>" name="email" /></div>
                        <div class="col-sm-2"><label>Name</label></div>
                        <div class="col-sm-10"><input type="text" class="form-control" value="<?php echo $admin['name']; ?>" name="name" /></div>
                        <div class="col-sm-2"><label>Mobile Number</label></div>
                        <div class="col-sm-10"><input type="text" class="form-control" value="<?php echo $admin['mob_no']; ?>" name="mobno" /></div>
                        <div class="col-sm-2"><label>Gender</label></div>
                        <div class="col-sm-10">
                        <select class="form-control" name="gender" value="<?php echo $admin['gender']; ?>">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                        </div>
                        <div class="col-sm-2"><label>Address</label></div>
                        <div class="col-sm-10"><input type="text" class="form-control" value="<?php echo $admin['address']; ?>" name="address" /></div>
                        
                        <div class="clearfix"></div>
                        <br>
                        <p class="text-info text-center"><strong>Where NA means NOT ASSIGNED</strong></p>

                        <button type="submit" class="btn btn-warning center-block"><span class="glyphicon glyphicon-ok"></span> UPDATE</button>
                        <br>
                        </form>

                        </div>
                        <!-- profile tab 2 -->
                        <div id="profile-div-2" class="profile-div hidden">
                        <form action="<?php echo $ld; ?>processor/change_password_admin.php" method="POST">
                        <div class="col-sm-2"><label>Current Password</label></div>
                        <div class="col-sm-10"><input type="password" class="form-control" name="pword"  /></div>
                        <div class="col-sm-2"><label>New Password</label></div>
                        <div class="col-sm-10"><input type="password" class="form-control" name="npword" /></div>
                        <div class="col-sm-2"><label>Confirm New Password</label></div>
                        <div class="col-sm-10"><input type="password" class="form-control" name="cnpword" /></div>
                        
                        <div class="clearfix"></div>
                        <br>

                        <button type="submit" class="btn btn-warning center-block"><span class="glyphicon glyphicon-ok"></span> CHANGE</button>
                        <br>
                        </form>

                        </div>
                        <script type="text/javascript">
                            $(".profile-1").click(function() {
                                $(".tabs").removeClass('active');
                                $("#profile-div-2").addClass('hidden');
                                $(this).addClass('active');
                                $("#profile-div-1").removeClass('hidden');
                            });
                            $(".profile-2").click(function() {
                                $(".tabs").removeClass('active');
                                $("#profile-div-1").addClass('hidden');
                                $(this).addClass('active');
                                $("#profile-div-2").removeClass('hidden');
                            });
                        </script>
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