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
$pagename = "downloaded";

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
            <div class="well" id="downloaded-well">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills">
                            <li class="active downloaded-1 tabs"><a href="#notify-well"><span class="glyphicon glyphicon-list"></span> Downloaded List</a></li>
                            <li class="downloaded-2 tabs"><a href="#downloaded-well"><span class="glyphicon glyphicon-asterisk"></span> Most Downloaded List</a></li>
                        </ul>

                        <hr class="hr-tab">
                        <!-- downloaded tab 1 -->
                        <div id="downloaded-div-1" class="downloaded-div">
                        <form action="" method="POST" class="pull-right">
                            <input id="search-table" type="search" name="st" class="form-control" placeholder="Search Table"  />
                            <br>
                            <label class="text-warning">Amount per List</label>
                            <select value="10" name="amount-per-list" style="color:#111;">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </form>

                        <div class="clearfix"></div>

                            <table class="table table-condensed table-hover">
                            <thead><strong>Downloaded List</strong></thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Year</th>
                                    <th>Department</th>
                                    <th>Publisher</th>
                                    <th>ISBN</th>
                                    <th>Type</th>
                                    <th>Date Added</th>
                                    <th>Copies</th>
                                    <th>Available</th>
                                    <th>downloaded</th>
                                </tr>
                                <?php for($i=1; $i<=10; $i++) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>Title</td>
                                    <td>Author<?php echo $i; ?></td>
                                    <td>Year</td>
                                    <td>Department</td>
                                    <td>Publisher<?php echo $i; ?></td>
                                    <td>ISBN</td>
                                    <td>Type</td>
                                    <td>Date Added</td>
                                    <td>Copies<?php echo $i; ?></td>
                                    <td>Available</td>
                                    <td>downloaded</td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td>0</td>
                                    <td>jsd</td>
                                    <td>aef</td>
                                    <td>sad</td>
                                    <td>Department</td>
                                    <td>Publisher</td>
                                    <td>ISBN</td>
                                    <td>Type</td>
                                    <td>lof</td>
                                    <td>asd</td>
                                    <td>cdv</td>
                                    <td>ads</td>
                                </tr>
                            </table>
                        <!-- List Pagination -->
                        <div class="text-right">
                            <ul class="pagination pagination-sm" style="margin: 0;">
                                <li class="active"><a href="#">First</a></li>
                                <li><a href="#">Prev</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">Next</a></li>
                                <li class="active"><a href="#">Last</a></li>
                            </ul>
                        </div>
                        <br>

                        </div>

                        <!-- downloaded tab 2 -->
                        <div id="downloaded-div-2" class="downloaded-div">
                        <form action="" method="POST" class="pull-right">
                            <label class="text-warning">Amount per List</label>
                            <select value="10" name="amount-per-list" style="color:#111;">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </form>

                        <div class="clearfix"></div>

                            <table class="table table-condensed table-hover">
                            <thead><strong>Most Downloaded List</strong></thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Year</th>
                                    <th>Department</th>
                                    <th>Publisher</th>
                                    <th>ISBN</th>
                                    <th>Type</th>
                                    <th>Date Added</th>
                                    <th>Copies</th>
                                    <th>Available</th>
                                    <th>downloaded</th>
                                </tr>
                                <?php for($i=1; $i<=10; $i++) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>Title</td>
                                    <td>Author<?php echo $i; ?></td>
                                    <td>Year</td>
                                    <td>Department</td>
                                    <td>Publisher<?php echo $i; ?></td>
                                    <td>ISBN</td>
                                    <td>Type</td>
                                    <td>Date Added</td>
                                    <td>Copies<?php echo $i; ?></td>
                                    <td>Available</td>
                                    <td>downloaded</td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td>0</td>
                                    <td>jsd</td>
                                    <td>aef</td>
                                    <td>sad</td>
                                    <td>Department</td>
                                    <td>Publisher</td>
                                    <td>ISBN</td>
                                    <td>Type</td>
                                    <td>lof</td>
                                    <td>asd</td>
                                    <td>cdv</td>
                                    <td>ads</td>
                                </tr>
                            </table>
                        <!-- List Pagination -->
                        <div class="text-right">
                            <ul class="pagination pagination-sm" style="margin: 0;">
                                <li class="active"><a href="#">First</a></li>
                                <li><a href="#">Prev</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">Next</a></li>
                                <li class="active"><a href="#">Last</a></li>
                            </ul>
                        </div>
                        <br>
                        </div>
                        <script type="text/javascript">
                            $(".downloaded-1").click(function() {
                                $(".tabs").removeClass('active');
                                $("#downloaded-div-2").addClass('hidden');
                                $(this).addClass('active');
                                $("#downloaded-div-1").removeClass('hidden');
                            });
                            $(".downloaded-2").click(function() {
                                $(".tabs").removeClass('active');
                                $("#downloaded-div-1").addClass('hidden');
                                $(this).addClass('active');
                                $("#downloaded-div-2").removeClass('hidden');
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


                        <script type="text/javascript">
                            $("table").tableSort({
                                animation: 'fade'
                            });
                            $("#downloaded-div-2").addClass('hidden');
                        </script>
                        <script type="text/javascript" src="<?php echo $ld; ?>assets/js/style.js"></script>
</body>
</html>