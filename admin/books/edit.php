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
$pagename = "books";

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

if(isset($_GET['msg']) && isset($_GET['samt']) && isset($_GET['famt']) && $_GET['msg'] == 'success' ) {
    $samt = $_GET['samt'];
    $famt = $_GET['famt'];
    $alert_content = nl2br("<strong>SUCCESSFULLY Inserted ($samt), but ($famt) RECORDS FAILED!</strong>");

    $alert_icon="ok-sign"; $alert_type = "success"; $alert_status = "show";
} else if(isset($_GET['msg']) && $_GET['msg'] == 'success') {
    $alert_content = nl2br("<strong>Books File Upload Successfully!</strong>");

    $alert_icon="ok-sign"; $alert_type = "success"; $alert_status = "show";
} else if(isset($_GET['msg']) && $_GET['msg'] == 'failed') {
    $alert_content = nl2br("<strong>Books File Upload Failed!</strong>");

    $alert_icon="remove-sign"; $alert_type = "danger"; $alert_status = "show";
} else if(isset($_GET['msg']) && $_GET['msg'] == 'size') {
    $alert_content = nl2br("<strong>File size larger than 2 MB!</strong>");

    $alert_icon="exclamation-sign"; $alert_type = "warning"; $alert_status = "show";
} else if(isset($_GET['msg']) && $_GET['msg'] == 'format') {
    $alert_content = nl2br("<strong>Invalid File Format! [.csv, .xls]</strong>");

    $alert_icon="exclamation-sign"; $alert_type = "warning"; $alert_status = "show";
} else if(isset($_GET['msg']) && $_GET['msg'] == 'undefined') {
    $alert_content = nl2br("<strong>Please select a spreedsheet! [.csv, .xlxs]</strong>");

    $alert_icon="info-sign"; $alert_type = "warning"; $alert_status = "show";
} else if(isset($_GET['msg']) && $_GET['msg'] == 'insert') {
    $alert_content = nl2br("<strong>Error inserting a record [Make Statistics Page OR Error Report Page]!</strong>");

    $alert_icon="exclamation-sign"; $alert_type = "warning"; $alert_status = "show";
} else if(isset($_GET['msg']) && $_GET['msg'] == 'row') {
    $alert_content = nl2br("<strong>Records OR Rows more than 251!</strong>");

    $alert_icon="remove-sign"; $alert_type = "danger"; $alert_status = "show";
} else {/*DO NOTHING*/}

// For Book List Table
    # Get Total Books in DB
    $booksAmountQuery = mysqli_query($conn,"SELECT book_id FROM $lms_books ORDER BY book_id DESC");
    $total_books = mysqli_num_rows($booksAmountQuery);

    # Book List Limit
    $booksLimitQuery = mysqli_query($conn,"SELECT render_limit FROM $lms_page_setup WHERE page_name='$pagename'");
    $books_limi = mysqli_fetch_assoc($booksLimitQuery);
    $books_limit = $books_limi['render_limit'];

    if($total_books == 0) {
        $max_pgno = 0;
    } else {
        $max_pgno = ceil($total_books/$books_limit); // ceil division to have all results
    }

    // Books pagination
    if( isset($_GET['page']) ) {
        $cur_pgno = $_GET['page'];
    } else {
        $cur_pgno = 1;
    }
    // limit offset
    $limit_offset = (($books_limit*$cur_pgno)-$books_limit);
    if(($total_books-$limit_offset) < $books_limit) {
        $limit_offset = $total_books - $books_limit;
    }

    if( isset($_POST['apl']) ) {
        $apl = $_POST['apl'];
        echo $apl;
    }

    header ("Location: ./?msg=soon");
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
            <div class="well" id="books-well">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills">
                            <li class="active books-1 tabs"><a href="#notify-well"><span class="glyphicon glyphicon-list"></span> List of Books</a></li>
                            <li class="books-2 tabs"><a href="#books-well"><span class="glyphicon glyphicon-plus"></span> Add New Book(s)</a></li>
                            <li class="books-3 tabs"><a href="#books-well"><span class="glyphicon glyphicon-file"></span> Add Books via Upload</a></li>
                        </ul>

                        <hr class="hr-tab">
                        <!-- books tab 1 -->
                        <div id="books-div-1" class="books-div">
                        <div class="table-list">
                        <form action="" method="POST" class="pull-right">
                            <input id="search-table" type="search" name="st" class="form-control" placeholder="Search Table"  />
                            <br>
                            <label class="text-warning">Amount per List</label>
                            <select id="apl" value="<?php echo $books_limit; ?>" name="amount-per-list" style="color:#111;">
                                <?php
                                if(100 == $books_limit) {
                                    echo "<option value='100'>100</option>";
                                } else if(50 == $books_limit) {
                                    echo "<option value='50'>50</option>";
                                } else if(25 == $books_limit) {
                                    echo "<option value='25'>25</option>";
                                } else {
                                    echo "<option value='10'>10</option>";
                                }
                                for($i=10; $i<=100; $i=$i+5) {
                                    if($i == $books_limit) {
                                        continue;
                                    } if(($i == 10) || ($i == 25) || ($i == 50) || ($i == 100)) {
                                        echo "<option value='$i'>$i</option>";
                                    } else {
                                        continue;
                                    }
                                }
                                ?>
                            </select>
                            <span id="jtp">
                                <label class="text-warning">Jump to Page</label>
                                <select id="jtp" name="jump-to-page" style="color:#111;">
                                    <?php
                                    for($i=1; $i<=$max_pgno; $i++) {
                                        echo "<option><a href='$pagination_page?page=$i' title='page $i'><strong>$i</strong></a></option>";
                                    }
                                    ?>
                                </select>
                                <script type='text/javascript'>
                                    $('#jtp').change(function() {
                                        var jtp = $(this).val();

                                        window.location="./?page="+jtp;
                                    });
                                </script>
                            </span>
                        </form>
                        <?php
                        echo "<script type='text/javascript'>
                            $('#apl').change(function() {
                                var apl = $(this).val();
                                var pagename = '$pagename';
                                var curpage = $cur_pgno;

                                //alert(apl + ' ' + pagename + ' ' + curpage);
                                var data = 'apl='+apl+'&pagename='+pagename+'&curpage='+curpage;

                                $.ajax({
                                  type: 'POST',
                                  url: '../../processor/apl.php',
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

                        
                            <table id="tsort" class="table table-responsive table-condensed table-hover">
                                <thead class="sad">
                                <strong>List of Books</strong>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Year</th>
                                    <th>Field</th>
                                    <th>Publisher</th>
                                    <th>Series Title</th>
                                    <th>ISBN</th>
                                    <th>Volume</th>
                                    <th>Edition</th>
                                    <th>Format</th>
                                    <th>Type</th>
                                    <th>Date Added</th>
                                    <th>Copies</th>
                                    <th>Available</th>
                                    <th>Borrowed</th>
                                    <th>EDIT</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php 
                                $booksListQuery = mysqli_query($conn,"SELECT * FROM $lms_books ORDER BY book_id DESC LIMIT $books_limit OFFSET $limit_offset");

                                while($book = mysqli_fetch_array($booksListQuery)) {
                                    $book_id = $book['book_id'];
                                    $book_title = $book['title'];
                                    $book_author = $book['author'];
                                    $book_year = $book['year'];
                                    $book_fic = $book['field_code'];
                                    $book_publisher = $book['publisher'];
                                    $book_st = $book['series_title'];
                                    $book_ISBN = $book['ISBN'];
                                    $book_volume = $book['volume'];
                                    $book_edition = $book['edition'];
                                    $book_fc = $book['format_code'];
                                    $book_fc = fc($book_fc);
                                    $book_tc = $book['type_code'];
                                    $book_tc = tc($book_tc);

                                    $book_da = $book['date_added'];
                                    
                                    $book_copies = $book['copies'];
                                    $book_available = $book['available'];
                                    $book_borrowed = $book['borrowed'];
                                ?>
                                <tr>
                                    <td><?php echo $book_id; ?></td>
                                    <td><?php echo $book_title; ?></td>
                                    <td><?php echo $book_author; ?></td>
                                    <td><?php echo $book_year; ?></td>
                                    <td><?php echo $book_fic; ?></td>
                                    <td><?php echo $book_publisher; ?></td>
                                    <td><?php echo $book_st; ?></td>
                                    <td><?php echo $book_ISBN; ?></td>
                                    <td><?php echo $book_volume; ?></td>
                                    <td><?php echo $book_edition; ?></td>
                                    <td><?php echo $book_fc; ?></td>
                                    <td><?php echo $book_tc; ?></td>
                                    <td><?php echo $book_da; ?></td>
                                    <td><?php echo $book_copies; ?></td>
                                    <td><?php echo $book_available; ?></td>
                                    <td><?php echo $book_borrowed; ?></td>
                                    <td>
                                        <span class='glyphicon glyphicon-pencil icon warning edit edt-<?php echo $book_id; ?>' title="edit">
                                            <span class='hidden'><?php echo $book_id; ?></span>
                                        </span>
                                        <span class='glyphicon glyphicon-remove icon danger delete del-<?php echo $book_id; ?>' title="delete">
                                            <span class='hidden'><?php echo $book_id; ?></span>
                                        </span>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                                <script type='text/javascript'>
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

                                include_once $ld."include/pagination.php";
                            ?>
                        </div>

                        <br>

                        </div>

                        <!-- books tab 2 -->
                        <div id="books-div-2" class="books-div hidden">
                        <form action="" method="POST">
                        <div class="col-sm-2"><label>Title</label></div>
                        <div class="col-sm-10"><input type="password" class="form-control" name="pword"  /></div>
                        <div class="col-sm-2"><label>Author</label></div>
                        <div class="col-sm-10"><input type="text" class="form-control" name="npword" /></div>
                        <div class="col-sm-2"><label>Year</label></div>
                        <div class="col-sm-10"><input type="text" class="form-control" name="cnpword" /></div>
                        <div class="col-sm-2"><label>Field</label></div>
                        <div class="col-sm-10"><select class="form-control" value="NA">
                            <option value="CSC">CSC - Computer Science</option>
                            <option value="NA">NA - Others</option>
                        </select></div>
                        <div class="col-sm-2"><label>Publisher</label></div>
                        <div class="col-sm-10"><input type="text" class="form-control" name="cnpword" /></div>
                        <div class="col-sm-2"><label>ISBN</label></div>
                        <div class="col-sm-10"><input type="text" class="form-control" name="cnpword" /></div>
                        <div class="col-sm-2"><label>Field</label></div>
                        <div class="col-sm-10"><select class="form-control" value="S">
                            <option value="S">S - Soft Copy</option>
                            <option value="H">H -Hard Copy Science</option>
                            <option value="O">O - Others</option>
                        </select></div>
                        <div class="col-sm-2"><label>Copies</label></div>
                        <div class="col-sm-10"><input type="number" class="form-control" name="cnpword" /></div>
                        
                        <div class="clearfix"></div>
                        <br>

                        <button type="submit" class="btn btn-warning center-block"><span class="glyphicon glyphicon-plus"></span> ADD</button>
                        </form>

                        <br>
                        </div>
                        <!-- books tab 3 -->
                        <div id="books-div-3" class="books-div hidden">
                            <form action="<?php echo $ld; ?>processor/upload_booksfile.php" method="POST" enctype="multipart/form-data">
                            <div class="col-sm-2"><label>File</label></div>
                            <div class="col-sm-10"><input type="file" class="form-control" name="bfile" required  /></div>
                            <div class="col-sm-2"><label>File Type</label></div>
                            <div class="col-sm-10">
                                <select class="form-control" name="bformat" value="csv">
                                    <option value="csv">csv - Comma Separated Values</option>
                                    <option value="xls">xls - Excel Stylesheet</option>
                                </select>
                                <strong class="text-info"><strong class="text-warning glyphicon glyphicon-asterisk"></strong> Valid Formats: csv & xls</strong>
                            </div>
                            
                            <div class="clearfix"></div>

                            <button type="submit" class="btn btn-warning center-block"><span class="glyphicon glyphicon-arrow-up"></span> UPLOAD</button>
                        </form>
                        
                            <br>
                        </div>
                        <script type="text/javascript">
                            $(".books-1").click(function() {
                                $(".tabs").removeClass('active');
                                $("#books-div-2").addClass('hidden');
                                $("#books-div-3").addClass('hidden');
                                $(this).addClass('active');
                                $("#books-div-1").removeClass('hidden');
                            });
                            $(".books-2").click(function() {
                                $(".tabs").removeClass('active');
                                $("#books-div-3").addClass('hidden');
                                $("#books-div-1").addClass('hidden');
                                $(this).addClass('active');
                                $("#books-div-2").removeClass('hidden');
                            });
                            $(".books-3").click(function() {
                                $(".tabs").removeClass('active');
                                $("#books-div-1").addClass('hidden');
                                $("#books-div-2").addClass('hidden');
                                $(this).addClass('active');
                                $("#books-div-3").removeClass('hidden');
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
                        </script>
                        <script type="text/javascript" src="<?php echo $ld; ?>assets/js/style.js"></script>
</body>
</html>