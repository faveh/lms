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
$pagename = "users";

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

// Alerts
if(isset($_GET['msg']) && $_GET['msg'] == 'soon') {
    $alert_content = nl2br("<strong>Coming Soon!</strong>");

    $alert_icon="info-sign"; $alert_type = "info"; $alert_status = "show";
}


// For Users List Table
    # Get Total Users in DB
    $usersAmountQuery = mysqli_query($conn,"SELECT user_id FROM $lms_users ORDER BY user_id DESC");
    $total_users = mysqli_num_rows($usersAmountQuery);

    # Users List Limit
    $usersLimitQuery = mysqli_query($conn,"SELECT render_limit FROM $lms_page_setup WHERE page_name='$pagename'");
    $users_limi = mysqli_fetch_assoc($usersLimitQuery);
    $users_limit = $users_limi['render_limit'];

    if($total_users == 0) {
        $max_pgno = 0;
    } else {
        $max_pgno = ceil($total_users/$users_limit); // ceil division to have all results
    }

    // Users pagination
    if( isset($_GET['page']) ) {
        $cur_pgno = $_GET['page'];
    } else {
        $cur_pgno = 1;
    }
    // Users limit offset
    $users_limit_offset = (($users_limit*$cur_pgno)-$users_limit);
    if($users_limit_offset <= 0) {
    	$users_limit_offset = 0;
    } else if(($total_users-$users_limit_offset) < $users_limit) {
        $users_limit_offset = $total_users - $users_limit;
    } else {}

// For Admin List Table
    # Get Total Admin in DB
    $adminAmountQuery = mysqli_query($conn,"SELECT admin_id FROM $lms_admin ORDER BY admin_id DESC");
    $total_admin = mysqli_num_rows($adminAmountQuery);

    if($total_admin == 0) {
        $max_pgno = 0;
    } else {
        $max_pgno = ceil($total_admin/$users_limit); // ceil division to have all results
    }

    // Admin pagination
    if( isset($_GET['page']) ) {
        $cur_pgno = $_GET['page'];
    } else {
        $cur_pgno = 1;
    }
    // Admin limit offset
    $admin_limit_offset = (($users_limit*$cur_pgno)-$users_limit);
    if($admin_limit_offset <= 0) {
    	$admin_limit_offset = 0;
    } else if(($total_admin-$admin_limit_offset) < $users_limit) {
        $admin_limit_offset = $total_admin - $users_limit;
    } else {}
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
            <div class="well" id="user-well">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills">
                            <li class="active user-1 tabs"><a href="#l"><span class="glyphicon glyphicon-list"></span> List of Users</a></li>
                            <li class="user-2 tabs"><a href="#"><span class="glyphicon glyphicon-plus"></span> Add New User(s)</a></li>
                            <li class="user-3 tabs"><a href="#"><span class="glyphicon glyphicon-list"></span> Admin List</a></li>
                        </ul>

                        <hr class="hr-tab">

                        <!-- user tab 1 -->
                        <div id="user-div-1" class="user-div">
                        <div class="table-list-users">
                        <form action="" method="POST" class="pull-right">
                            <input id="search-table" type="search" name="st" class="form-control" placeholder="Search Table"  />
                            <br>
                            <label class="text-warning">Amount per List</label>
                            <select id="apl" class="users" value="<?php echo $users_limit; ?>" name="amount-per-list" style="color:#111;">
                                <?php
                                if(100 == $users_limit) {
                                    echo "<option value='100'>100</option>";
                                } else if(50 == $users_limit) {
                                    echo "<option value='50'>50</option>";
                                } else if(25 == $users_limit) {
                                    echo "<option value='25'>25</option>";
                                } else {
                                    echo "<option value='10'>10</option>";
                                }
                                for($i=10; $i<=100; $i=$i+5) {
                                    if($i == $users_limit) {
                                        continue;
                                    } if(($i == 10) || ($i == 25) || ($i == 50) || ($i == 100)) {
                                        echo "<option value='$i'>$i</option>";
                                    } else {
                                        continue;
                                    }
                                }
                                ?>
                            </select>
                            <span>
                                <label class="text-warning">Jump to Page</label>
                                <select id="jtp" class="users" name="jump-to-page" style="color:#111;">
                                    <?php
                                    for($i=1; $i<=$max_pgno; $i++) {
                                        echo "<option><a href='$pagination_page?page=$i' title='page $i'><strong>$i</strong></a></option>";
                                    }
                                    ?>
                                </select>
                                <script type='text/javascript'>
                                    $('#jtp.users').change(function() {
                                        var jtp = $(this).val();

                                        window.location="./?page="+jtp;
                                    });
                                </script>
                            </span>
                        </form>
                        <?php
                        echo "<script type='text/javascript'>
                            $('#apl.users').change(function() {
                                var apl = $(this).val();
                                var pagename = '$pagename';
                                var curpage = $cur_pgno;

                                //alert(apl + ' ' + pagename + ' ' + curpage);
                                var data = 'apl='+apl+'&pagename='+pagename+'&curpage='+curpage;

                                $.ajax({
                                  type: 'POST',
                                  url: '../../processor/apl_users.php',
                                  data: data,
                                  //dataType: 'json',
                                  cache: false,
                                
                                    beforeSend: function() {
                                        $('#tsort tbody tr td').text('...');
                                    },
                                
                                    success: function(result) {
                                        $('.table-list').html(result);
                                    }
                                });
                            });
                        </script>";
                        ?>

                        <div class="clearfix"></div>

                            <table id="tsort-users" class="table table-responsive table-condensed table-hover">
                            <thead>
                            	<strong>List of Users</strong>
                                <tr>
                                	<th title='select'>S</th>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Mobile No.</th>
                                    <th>Gender</th>
                                    <th>Matric No.</th>
                                    <th>Department</th>
                                    <th>Occupation</th>
                                    <th>Downloaded</th>
                                    <th>Borrowed</th>
                                    <th>User_uid</th>
                                    <th>status</th>
                                    <th>EDIT</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $usersListQuery = mysqli_query($conn,"SELECT * FROM $lms_users ORDER BY user_id DESC LIMIT $users_limit OFFSET $users_limit_offset");

                            while($user = mysqli_fetch_array($usersListQuery)) {
                                $user_id = $user['user_id'];
                                $user_username = $user['username'];
                                $user_email = $user['email'];
                                $user_name = $user['name'];
                                $user_mob_no = $user['mob_no'];
                                $user_gender = $user['gender'];
                                $user_matric_no = $user['matric_no'];
                                $user_department = $user['department'];
                                $user_occupation = $user['occupation'];
                                $user_downloaded = $user['downloaded'];
                                $user_borrowed = $user['borrowed'];

                                $user_uuid = $user['user_uid'];
                                $user_uuid = uid($user_uuid);
                                $user_stats = $user['status'];
                                $user_stats = stats($user_stats);
                            ?>
                            <tr>
                            	<td>
                                    <input class='chk' type='checkbox' value='<?php echo $user_id; ?>' />
                                </td>
                                <td><?php echo $user_id; ?></td>
                                <td><?php echo $user_username; ?></td>
                                <td><?php echo $user_email; ?></td>
                                <td><?php echo $user_name; ?></td>
                                <td><?php echo $user_mob_no; ?></td>
                                <td><?php echo $user_gender; ?></td>
                                <td><?php echo $user_matric_no; ?></td>
                                <td><?php echo $user_department; ?></td>
                                <td><?php echo $user_occupation; ?></td>
                                <td><?php echo $user_downloaded; ?></td>
                                <td><?php echo $user_borrowed; ?></td>
                                <td><?php echo $user_uuid; ?></td>
                                <td><?php echo $user_stats; ?></td>
                                <td>
                                    <span class='glyphicon glyphicon-pencil icon warning edit edt-<?php echo $user_id; ?>' title="edit">
                                        <span class='hidden'><?php echo $user_id; ?></span>
                                    </span>
                                    <span class='glyphicon glyphicon-remove icon danger delete del-<?php echo $user_id; ?>' title="delete">
                                        <span class='hidden'><?php echo $user_id; ?></span>
                                    </span>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                            <script type='text/javascript'>
                                $('.chk').click(function() {
                                    $(this).toggleClass('selected');
                                    var chk = $(this).val();

                                    //var num = $('.chk').is('.selected');
                                    //alert(num);
                                });
                                $('.edit').click(function() {
                                    var edt = $(this).find('span').text();

                                    //alert("EDIT (Coming Soon!) "+edt);
                                    //var data = 'edt='+edt;

                                    window.location="./edit.php?page="+edt;
                                });
                                $('.delete').click(function() {
                                    var del = $(this).find('span').text();

                                    //alert("DELETE (Coming Soon!) "+del);
                                    //var data = 'del='+del;

                                    window.location="./delete.php?del="+del;
                                });
                            </script>
                            </table>

                        	<!-- List Pagination -->
                            <?php
                                $pagination_page = "index.php"; // that-is page name

                                include $ld."include/pagination.php";
                            ?>
                        </div>

                        <br>
                        </div>

                        <!-- user tab 2 -->
                        <div id="user-div-2" class="user-div hidden">
                        <form action="" method="POST">
                        <div class="col-sm-2"><label>Username</label></div>
                        <div class="col-sm-10"><input type="text" class="form-control" name="pword"  /></div>
                        <div class="col-sm-2"><label>Email</label></div>
                        <div class="col-sm-10"><input type="email" class="form-control" name="npword" /></div>
                        <div class="col-sm-2"><label>Password</label></div>
                        <div class="col-sm-10"><input type="password" class="form-control" name="cnpword" /></div>
                        <div class="col-sm-2"><label>Confirm Password</label></div>
                        <div class="col-sm-10"><input type="password" class="form-control" name="cnpword" /></div>
                        <div class="col-sm-2"><label>Name</label></div>
                        <div class="col-sm-10"><input type="text" class="form-control" name="pword"  /></div>
                        <div class="col-sm-2"><label>Gender</label></div>
                        <div class="col-sm-10"><select class="form-control" value="NA">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select></div>
                        <div class="col-sm-2"><label>Matric Number</label></div>
                        <div class="col-sm-10"><input type="text" class="form-control" name="cnpword" /></div>
                        <div class="col-sm-2"><label>Department</label></div>
                        <div class="col-sm-10"><input type="text" class="form-control" name="cnpword" /></div>
                        <div class="col-sm-2"><label>Occupation</label></div>
                        <div class="col-sm-10"><select class="form-control" value="STUDENT">
                            <option value="STUDENT">STUDENT</option>
                            <option value="WORKER">WORKER</option>
                        </select></div>
                        
                        <div class="clearfix"></div>
                        <br>

                        <button type="submit" class="btn btn-warning center-block"><span class="glyphicon glyphicon-plus"></span> ADD</button>
                        <br>
                        </form>

                        </div>

                        <!-- user tab 3 -->
                        <div id="user-div-3" class="user-div">
                            <div class="table-list-admin">
	                        <form action="" method="POST" class="pull-right">
	                            <input id="search-table" type="search" name="st" class="form-control" placeholder="Search Table"  />
	                            <br>
	                            <label class="text-warning">Amount per List</label>
	                            <select id="apl" class="admin" value="<?php echo $users_limit; ?>" name="amount-per-list" style="color:#111;">
	                                <?php
	                                if(100 == $users_limit) {
	                                    echo "<option value='100'>100</option>";
	                                } else if(50 == $users_limit) {
	                                    echo "<option value='50'>50</option>";
	                                } else if(25 == $users_limit) {
	                                    echo "<option value='25'>25</option>";
	                                } else {
	                                    echo "<option value='10'>10</option>";
	                                }
	                                for($i=10; $i<=100; $i=$i+5) {
	                                    if($i == $users_limit) {
	                                        continue;
	                                    } if(($i == 10) || ($i == 25) || ($i == 50) || ($i == 100)) {
	                                        echo "<option value='$i'>$i</option>";
	                                    } else {
	                                        continue;
	                                    }
	                                }
	                                ?>
	                            </select>
	                            <span>
	                                <label class="text-warning">Jump to Page</label>
	                                <select id="jtp" class="admin" name="jump-to-page" style="color:#111;">
	                                    <?php
	                                    for($i=1; $i<=$max_pgno; $i++) {
	                                        echo "<option><a href='$pagination_page?page=$i' title='page $i'><strong>$i</strong></a></option>";
	                                    }
	                                    ?>
	                                </select>
	                                <script type='text/javascript'>
	                                    $('#jtp.admin').change(function() {
	                                        var jtp = $(this).val();

	                                        window.location="./?page="+jtp;
	                                    });
	                                </script>
	                            </span>
	                        </form>
	                        <?php
	                        echo "<script type='text/javascript'>
	                            $('#apl.admin').change(function() {
	                                var apl = $(this).val();
	                                var pagename = '$pagename';
	                                var curpage = $cur_pgno;

	                                //alert(apl + ' ' + pagename + ' ' + curpage);
	                                var data = 'apl='+apl+'&pagename='+pagename+'&curpage='+curpage;

	                                $.ajax({
	                                  type: 'POST',
	                                  url: '../../processor/apl_admin.php',
	                                  data: data,
	                                  //dataType: 'json',
	                                  cache: false,
	                                
	                                    beforeSend: function() {
	                                        $('#tsort tbody tr td').text('...');
	                                    },
	                                
	                                    success: function(result) {
	                                        $('.table-list-admin').html(result);
	                                    }
	                                });
	                            });
	                        </script>";
	                        ?>

	                        <div class="clearfix"></div>

	                            <table id="tsort-users" class="table table-condensed table-hover">
	                            <thead>
	                            	<strong>List of Admin</strong>
	                                <tr>
	                                	<th title='select'>S</th>
	                                    <th>#</th>
	                                    <th>Username</th>
	                                    <th>Email</th>
	                                    <th>Name</th>
	                                    <th>Mobile No.</th>
	                                    <th>Gender</th>
	                                    <th>Address</th>
	                                    <th>Admin_uid</th>
	                                    <th>status</th>
	                                    <th>EDIT</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            <?php 
	                            $adminListQuery = mysqli_query($conn,"SELECT * FROM $lms_admin ORDER BY admin_id DESC LIMIT $users_limit OFFSET $admin_limit_offset");

	                            while($admin = mysqli_fetch_array($adminListQuery)) {
	                                $admin_id = $admin['admin_id'];
	                                $admin_username = $admin['username'];
	                                $admin_email = $admin['email'];
	                                $admin_name = $admin['name'];
	                                $admin_mob_no = $admin['mob_no'];
	                                $admin_gender = $admin['gender'];
	                                $admin_address = $admin['address'];

	                                $admin_auid = $admin['admin_uid'];
	                                $admin_auid = fc($admin_auid);
	                                $admin_stats = $admin['status'];
	                                $admin_stats = stats($admin_stats);
	                            ?>
	                            <tr>
	                            	<td>
	                                    <input class='chk' type='checkbox' value='<?php echo $admin_id; ?>' />
	                                </td>
	                                <td><?php echo $admin_id; ?></td>
	                                <td><?php echo $admin_username; ?></td>
	                                <td><?php echo $admin_email; ?></td>
	                                <td><?php echo $admin_name; ?></td>
	                                <td><?php echo $admin_mob_no; ?></td>
	                                <td><?php echo $admin_gender; ?></td>
	                                <td><?php echo $admin_address; ?></td>
	                                <td><?php echo $admin_auid; ?></td>
	                                <td><?php echo $admin_stats; ?></td>
	                                <td>
	                                    <span class='glyphicon glyphicon-pencil icon warning edit edt-<?php echo $admin_id; ?>' title="edit">
	                                        <span class='hidden'><?php echo $admin_id; ?></span>
	                                    </span>
	                                    <span class='glyphicon glyphicon-remove icon danger delete del-<?php echo $admin_id; ?>' title="delete">
	                                        <span class='hidden'><?php echo $admin_id; ?></span>
	                                    </span>
	                                </td>
	                            </tr>
	                            <?php } ?>
	                            </tbody>
	                            <script type='text/javascript'>
	                                $('.chk').click(function() {
	                                    $(this).toggleClass('selected');
	                                    var chk = $(this).val();

	                                    //var num = $('.chk').is('.selected');
	                                    //alert(num);
	                                });
	                                $('.edit').click(function() {
	                                    var edt = $(this).find('span').text();

	                                    //alert("EDIT (Coming Soon!) "+edt);
	                                    //var data = 'edt='+edt;

	                                    window.location="./edit.php?page="+edt;
	                                });
	                                $('.delete').click(function() {
	                                    var del = $(this).find('span').text();

	                                    //alert("DELETE (Coming Soon!) "+del);
	                                    //var data = 'del='+del;

	                                    window.location="./delete.php?del="+del;
	                                });
	                            </script>
	                            </table>

	                        	<!-- List Pagination -->
	                            <?php
	                                $pagination_page = "index.php"; // that-is page name

	                                include $ld."include/pagination.php";
	                            ?>
	                        </div>
                        
                            <br>
                        </div>
                        <script type="text/javascript">
                            $(".user-1").click(function() {
                                $(".tabs").removeClass('active');
                                $("#user-div-2").addClass('hidden');
                                $("#user-div-3").addClass('hidden');
                                $(this).addClass('active');
                                $("#user-div-1").removeClass('hidden');
                            });
                            $(".user-2").click(function() {
                                $(".tabs").removeClass('active');
                                $("#user-div-3").addClass('hidden');
                                $("#user-div-1").addClass('hidden');
                                $(this).addClass('active');
                                $("#user-div-2").removeClass('hidden');
                            });
                            $(".user-3").click(function() {
                                $(".tabs").removeClass('active');
                                $("#user-div-1").addClass('hidden');
                                $("#user-div-2").addClass('hidden');
                                $(this).addClass('active');
                                $("#user-div-3").removeClass('hidden');
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
                            $("#user-div-3").addClass('hidden');
                        </script>
                        <script type="text/javascript" src="<?php echo $ld; ?>assets/js/style.js"></script>

</body>
</html>