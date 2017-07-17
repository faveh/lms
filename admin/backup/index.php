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
$pagename = "backup";

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
}

?>

<!DOCTYPE html>
<html lang="en">
<!-- Html Head -->
<?php include_once $ld."include/html_head.php"; ?>
</head>
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
            <div class="well" id="backup-well">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills">
                            <li class="active backup-1 tabs"><a href="#notify-well"><span class="glyphicon glyphicon-upload"></span> Backup</a></li>
                            <li class="backup-2 tabs"><a href="#backup-well"><span class="glyphicon glyphicon-download"></span> Restore</a></li>
                        </ul>

                        <hr class="hr-tab">
                        <!-- backup tab 1 -->
                        <div id="backup-div-1" class="backup-div">
                        
                        <br>
                        </div>

                        <!-- backup tab 2 -->
                        <div id="backup-div-2" class="backup-div hidden">
                        

                        <br>
                        </div>
                        <script type="text/javascript">
                            $(".backup-1").click(function() {
                                $(".tabs").removeClass('active');
                                $("#backup-div-2").addClass('hidden');
                                $(this).addClass('active');
                                $("#backup-div-1").removeClass('hidden');
                            });
                            $(".backup-2").click(function() {
                                $(".tabs").removeClass('active');
                                $("#backup-div-1").addClass('hidden');
                                $(this).addClass('active');
                                $("#backup-div-2").removeClass('hidden');
                            });
                        </script>
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