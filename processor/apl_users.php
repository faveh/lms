<!DOCTYPE html>
<html>
<head>
	<title>Admin - Books Upload</title>

	<style type="text/css">
		body {
		  font-family: "Lato", "Helvetica Neue", Helvetica, Arial, sans-serif;
		  font-size: 15px;
		  line-height: 1.42857143;
		  color: #ebebeb;
		  background-color: #2b3e50;
		}
	</style>
</head>
<body>

</body>
</html>

<?php
session_start();

require_once "../include/connection.php";
require_once "../include/functions.php";
require_once "../include/config.php";

$refering_url = "../admin/users/";

if (!adminLoggedin($conn)) {
	header ("Location: $refering_url");
} else {
	$admin_id = $_SESSION['admin_id'];
	//$username = $_SESSION['admin_username'];

	if( isset($_POST['apl']) && isset($_POST['pagename']) && isset($_POST['curpage'])  ) {
		$apl = $_POST['apl'];
		$pagename = $_POST['pagename'];
		$cur_pgno = $_POST['curpage'];

		$sqlUpdate = "UPDATE $lms_page_setup SET render_limit='$apl' WHERE page_name='$pagename'";
		$result = mysqli_query($conn, $sqlUpdate);

		if($result) {
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

            // Users limit offset
            $users_limit_offset = (($users_limit*$cur_pgno)-$users_limit);
            if($users_limit_offset <= 0) {
                $users_limit_offset = 0;
            } else if(($total_users-$users_limit_offset) < $users_limit) {
                $users_limit_offset = $total_users - $users_limit;
            } else {}
		    ?>
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

                <table id="tsort-users" class="table table-condensed table-hover">
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
                    $user_uuid = fc($user_uuid);
                    $user_stats = $user['status'];
                    $user_stats = tc($user_stats);
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
                <script type="text/javascript">
                    $("#user-div-3").removeClass('hidden');
                </script>
                </table>

                <!-- List Pagination -->
                <?php
                    $pagination_page = "index.php"; // that-is page name

                    include "../include/pagination.php";
            
		}
	} else { header ("Location: $refering_url"); }

}

?>