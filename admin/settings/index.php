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
$pagename = "settings";

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
            <div class="well" id="lms_settings-well">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills">
                            <li class="active lms_settings-1 tabs"><a href="#lms_settings-well"><span class="glyphicon glyphicon-wrench"></span> Settings</a></li>
                            <li class="lms_settings-2 tabs"><a href="#notify-well"><span class="glyphicon glyphicon-info-sign"></span> Library Information</a></li>
                        </ul>

                        <hr class="hr-tab">
                        <!-- lms_settings tab 1 -->
                        <div id="lms_settings-div-1" class="lms_settings-div">
                            <form action="" method="POST">
                                <fieldset>
                                    <div class="col-md-6">
                                        <legend>General Settings</legend>
                                        <div class="col-sm-2"><label>Borrow Limit</label></div>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" name="lib-name" value="5" min="3" max="20"  />
                                            <span class="text-info">Maximum Number of Books a User can borrow OR hold (min=3,max=20)</span>
                                        </div>
                                        <div class="col-sm-2"><label>Borrowed Period</label></div>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" name="lib-loc" value="2" min="1" max="4"  />
                                            <span class="text-info">in weeks (min=1,max=4)</span>
                                        </div>
                                        <div class="col-sm-2"><label>Download Limit</label></div>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" name="lib-email" value="10" min="5" max="50"  />
                                            <span class="text-info">Daily Limit (min=5,max=50)</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <legend>Material Type Settings</legend>
                                        <h5 class="text-warning">Book [HardCopy & SoftCopy] Types (10)</h5>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="news" class="switch" checked />
                                            </span>
                                            <input type="text" class="form-control" value="Newspapers & Magazines" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="pamp" class="switch" checked />
                                            </span>
                                            <input type="text" class="form-control" value="Pamphlets" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="nonf" class="switch" checked />
                                            </span>
                                            <input type="text" class="form-control" value="Non-Fiction (Textbooks)" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="fict" class="switch" checked />
                                            </span>
                                            <input type="text" class="form-control" value="Fiction (Story Books)" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="refe" class="switch" checked />
                                            </span>
                                            <input type="text" class="form-control" value="Reference Materials" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="seri" class="switch" />
                                            </span>
                                            <input type="text" class="form-control" value="Serials" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="gove" class="switch" />
                                            </span>
                                            <input type="text" class="form-control" value="Government Publications" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="ephe" class="switch" />
                                            </span>
                                            <input type="text" class="form-control" value="Ephemerals (Culture Related)" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="thes" class="switch" />
                                            </span>
                                            <input type="text" class="form-control" value="Thesis (Dissertation)" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="rare" class="switch" />
                                            </span>
                                            <input type="text" class="form-control" value="Rare Books" readonly>
                                        </div>

                                        <h5 class="text-warning">Other Types (5)</h5>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="grap" class="switch" checked />
                                            </span>
                                            <input type="text" class="form-control" value="Graphics" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="maps" class="switch" checked />
                                            </span>
                                            <input type="text" class="form-control" value="Maps & Atlases" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="arti" class="switch" />
                                            </span>
                                            <input type="text" class="form-control" value="Artifacts" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="audv" class="switch" checked />
                                            </span>
                                            <input type="text" class="form-control" value="Audio Visuals (Youtube & Uploaded)" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="audi" class="switch" checked />
                                            </span>
                                            <input type="text" class="form-control" value="Audio" readonly>
                                        </div>

                                    </div>
                                </fieldset>
                                <br>
                                <button class="btn btn-warning center-block"><span class="glyphicon glyphicon-ok"></span> Save</button>
                            </form>

                        <br>
                        </div>

                        <!-- lms_settings tab 2 -->
                        <div id="lms_settings-div-2" class="lms_settings-div hidden">
                            <form action="" method="POST">
                                <fieldset>
                                    <legend>Library Information</legend>
                                    <div class="col-sm-2"><label>Library Name</label></div>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="lib-name" /></div>
                                    <div class="col-sm-2"><label>Library Location</label></div>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="lib-loc" /></div>
                                    <div class="col-sm-2"><label>Library Email</label></div>
                                    <div class="col-sm-10"><input type="email" class="form-control" name="lib-email" /></div>
                                    <div class="col-sm-2"><label>Library Telephone</label></div>
                                    <div class="col-sm-10"><input type="tel" class="form-control" name="lib-tel" /></div>
                                    <div class="col-sm-2"><label>Library Description</label></div>
                                    <div class="col-sm-10"><textarea class="form-control" name="lib-desc" rows="3"></textarea></div>
                                    <div class="col-sm-2"><label>Library Type</label></div>
                                    <div class="col-sm-10">
                                        <select class="form-control" value="sch" name="lib-type">
                                            <option value="sch">SCHOOL</option>
                                            <option value="pub">PUBLIC</option>
                                        </select>
                                    </div>

                                    <legend>Head Librarian Information</legend>
                                    <div class="col-sm-2"><label>Name</label></div>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="hlib-name"  /></div>
                                    <div class="col-sm-2"><label>Contact Email</label></div>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="hlib-email"  /></div>
                                    <div class="col-sm-2"><label>Contact Number</label></div>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="hlib-no"  /></div>
                                    <div class="col-sm-2"><label>Degree</label></div>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="hlib-deg"  /></div>

                                </fieldset>
                                <br>
                                <button class="btn btn-warning center-block"><span class="glyphicon glyphicon-ok"></span> Save</button>
                            </form>

                        <br>
                        </div>
                        <script type="text/javascript">
                            $(".lms_settings-1").click(function() {
                                $(".tabs").removeClass('active');
                                $("#lms_settings-div-2").addClass('hidden');
                                $(this).addClass('active');
                                $("#lms_settings-div-1").removeClass('hidden');
                            });
                            $(".lms_settings-2").click(function() {
                                $(".tabs").removeClass('active');
                                $("#lms_settings-div-1").addClass('hidden');
                                $(this).addClass('active');
                                $("#lms_settings-div-2").removeClass('hidden');
                            });

                            $(".switch").bootstrapSwitch({
                                size: 'mini',
                                onColor: 'primary',
                                offColor: 'danger',
                                onText: 'YES',
                                offText: 'NO'
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