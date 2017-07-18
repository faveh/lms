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

$refering_url = "../admin/books/";

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

		    // limit offset
		    $limit_offset = (($books_limit*$cur_pgno)-$books_limit);
		    if($limit_offset <= 0) {
		        $limit_offset = 0;
		    } else if(($total_books-$limit_offset) < $books_limit) {
		        $limit_offset = $total_books - $books_limit;
		    }
		    ?>
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
                <span>
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

            <table id="tsort" class="table table-condensed table-hover">
                <thead class="sad">
                <strong>List of Books</strong>
                <tr>
                	<th title='select'>S</th>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year</th>
                    <th>Department</th>
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
                    $book_fic = $book['department_code'];
                    $book_publisher = $book['publisher'];
                    $book_st = $book['series_title'];
                    $book_ISBN = $book['ISBN'];
                    $book_volume = $book['volume'];
                    $book_edition = $book['edition'];
                    $book_edition = edition($book_edition);
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
                	<td>
                        <input class='chk' type='checkbox' value='<?php echo $book_id; ?>' />
                    </td>
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
            <!-- Table Sorter ReInitialization -->
            <script type="text/javascript">
                $("table").tableSort({
                    animation: 'fade'
                });
            </script>
            
            <!-- List Pagination -->
            <?php
                $pagination_page = "index.php"; // that-is page name

                include_once "../include/pagination.php";
            
		}
	} else { header ("Location: $refering_url"); }

}

?>