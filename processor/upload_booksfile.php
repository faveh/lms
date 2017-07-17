<!DOCTYPE html>
<html>
<head>
	<title>Admin - Books Upload</title>

	<style type="text/css">
		/*body {
		  font-family: "Lato", "Helvetica Neue", Helvetica, Arial, sans-serif;
		  font-size: 15px;
		  line-height: 1.42857143;
		  color: #ebebeb;
		  background-color: #2b3e50;
		}*/

table.excel {
	border-style:ridge;
	border-width:1;
	border-collapse:collapse;
	font-family:sans-serif;
	font-size:12px;
}
table.excel thead th, table.excel tbody th {
	background:#CCCCCC;
	border-style:ridge;
	border-width:1;
	text-align: center;
	vertical-align:bottom;
}
table.excel tbody th {
	text-align:center;
	width:20px;
}
table.excel tbody td {
	vertical-align:bottom;
}
table.excel tbody td {
    padding: 0 3px;
	border: 1px solid #EEEEEE;
}
.red {
	color: red;
}
.green {
	color: green;
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
	header ("Location: $refering_url?upd-books=failed");
} else {
	$admin_id = $_SESSION['admin_id'];
	//$username = $_SESSION['admin_username'];

	// Books File Upload
	$path = "../uploads/books/";

	$valid_formats = array(".csv", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel", "application/ms-excel");

	if( isset($_POST['bformat']) ) {
		$bformat = $_POST['bformat'];
	} else { header("location: $refering_url?upd-books=failed"); }

	if($bformat == "csv") {
		if( isset($_FILES['bfile']) && $_SERVER['REQUEST_METHOD'] == "POST" ) {
			$bFile_name = $_FILES['bfile']['name'];
			$bFile_size = $_FILES['bfile']['size'];
			$bFile_type = $_FILES['bfile']['type'];
			$bFile_tmp = $_FILES['bfile']['tmp_name'];

			/*echo $bFile_type;
			echo $bFile_tmp;
			echo $bFile_name;
			echo $bFile_size;
			exit();*/

			if(in_array($bFile_type, $valid_formats)) {
				if($bFile_size<(1024*1024*2)) {
					$up_fname = time().substr(str_replace(" ", "_", $bFile_name), 5);

					if(move_uploaded_file($bFile_tmp, $path.$up_fname)) {
						$file_handler = fopen($path.$up_fname, 'r+');
						$l = 0;

						echo "<center><table class='excel'";
						while (!feof($file_handler)) {
							//print_r(fgetcsv($file_handler));
							$line = fgetcsv($file_handler);
							$size = count($line);
							?>
							<tr>
							<?php for($i=0; $i<$size; $i++) {
								if($l == 0) {
									echo "<th>$line[$i]</th>";
								} else {
									echo "<td>$line[$i]</td>";
								}
							} ?>
							</tr>
							<?php
							$l++;
						}
						echo "</table><strong>$l lines found in Total</strong></center>";

						fclose($file_handler);
						/*
						$userUpdate =  mysqli_query($conn,"SELECT * FROM $tbl_name WHERE id='$user_id'");
						if($userUpdate){
							$up_info = mysqli_fetch_array($userUpdate);
							$_SESSION['profilepic'] = $up_info['profilepic'];
							$user_profpic = $_SESSION['profilepic'];

							$alert_content = "Profile Picture Upload Successfully!";
							header("location: edit_profile.php?msg=success");
						}
						*/
						exit();


					} else { $alert_content = "books List Upload Failed!"; header("location: $refering_url?msg=failed"); }
				} else { $alert_content = "File size larger than 2 MB"; header("location: $refering_url?msg=size"); }
			} else { $alert_content = "Invalid File Format!"; header("location: $refering_url?msg=format"); }
		} else { $alert_content = "Please select a valid spreedsheet! [.csv, .xlxs]"; header("location: $refering_url?msg=undefined"); }
	} else if($bformat == "xls") {
		error_reporting(E_ALL ^ E_NOTICE);
		require_once "../".ASSETS_PHP."excel_reader2.php";

		if( isset($_FILES['bfile']) && $_SERVER['REQUEST_METHOD'] == "POST" ) {
			$bFile_name = $_FILES['bfile']['name'];
			$bFile_size = $_FILES['bfile']['size'];
			$bFile_type = $_FILES['bfile']['type'];
			$bFile_tmp = $_FILES['bfile']['tmp_name'];

			/*echo $bFile_type;
			echo $bFile_tmp;
			echo $bFile_name;
			echo $bFile_size;
			exit();*/

			if(in_array($bFile_type, $valid_formats)) {
				if($bFile_size<(1024*1024*2)) {
					$up_fname = time().substr(str_replace(" ", "_", $bFile_name), 5);

					if(move_uploaded_file($bFile_tmp, $path.$up_fname)) {
						$ses = new Spreadsheet_Excel_Reader($path.$up_fname);

						$row = $ses->rowcount();
						$col = $ses->colcount();
						//echo $ses->dump(true,true);
						//$ses->dump(true,true);

						if($row > 251) {
							// Row OR Records more than 251
							header("location: $refering_url?msg=row");
						}

						$sheethead = array();
						$sheetvalue = array(array());

						for($i=1; $i<=1; $i++) {
							for($j=1; $j<=$col; $j++) {
								$sheethead[$j] = $ses->val($i,$j);
							}
						}

						mysqli_query($conn,"ALTER TABLE $lms_books AUTO_INCREMENT = 1;"); // reset auto increment
						$success_amount = 0;
						$failed_amount = 0;
						$failed_rows = array();

						for($i=2; $i<=$row; $i++) {
							for($j=1; $j<=1; $j++) {
								$sheetvalue1 = $ses->val($i,1);
								$sheetvalue2 = $ses->val($i,2);
								$sheetvalue3 = $ses->val($i,3);
								$sheetvalue4 = $ses->val($i,4);
								$sheetvalue5 = $ses->val($i,5);
								$sheetvalue6 = $ses->val($i,6);
								$sheetvalue7 = $ses->val($i,7);
								$sheetvalue8 = $ses->val($i,8);
								$sheetvalue9 = $ses->val($i,9);
								$sheetvalue10 = $ses->val($i,10);
								$sheetvalue11 = $ses->val($i,11);
								$sheetvalue12 = $ses->val($i,12);

								$sql = "INSERT INTO $lms_books (admin_id, $sheethead[1], $sheethead[2], $sheethead[3], $sheethead[4], $sheethead[5], $sheethead[6], $sheethead[7], $sheethead[8], $sheethead[9], $sheethead[10], $sheethead[11], date_added, $sheethead[12], available) VALUES ('$admin_id', '$sheetvalue1', '$sheetvalue2', '$sheetvalue3', '$sheetvalue4', '$sheetvalue5', '$sheetvalue6', '$sheetvalue7', '$sheetvalue8', '$sheetvalue9', '$sheetvalue10', '$sheetvalue11', CURRENT_TIMESTAMP, '$sheetvalue12', '$sheetvalue12')";
								echo $i." ".$sql."<br><br>";
								$result = mysqli_query($conn, $sql);
								if($result) {
									//echo "<p class='green'>ROW ".$i." DATA SUCCESSFULLY INSERTED!</p>";
									$success_amount++;
								} else {
									echo "<p class='red'>ROW ".$i." DATA NOT INSERTED!</p>";
									$failed_amount++;
									$failed_rows[$i] = $i;
								}
							}
						}

						echo "<h4>Statistics</h4>";
						echo "<p class='green'>SUCCESSFULLY INSERTED: <strong>$success_amount</strong></p>";
						echo "<p class='red'>FAILED TO INSERT: <strong>$failed_amount</strong></p> <br>";
						
						echo "<a href='$refering_url?msg=success&samt=$success_amount&famt=$failed_amount' target='_blank'>GO BACK To Books Management</a> <br>";

						echo "<br><strong>NOTE:</strong> You have just <strong>45 seconds</strong> to go through the report here!";

						sleep(45);

						if($failed_amount != 0) {
							header("location: $refering_url?msg=success&samt=$success_amount&famt=$failed_amount");
						} else {
							header("location: $refering_url?msg=success");
						}

					} else { $alert_content = "books List Upload Failed!"; header("location: $refering_url?upd-books=failed"); }
				} else { $alert_content = "Image File size larger than 2 MB"; header("location: $refering_url?msg=size"); }
			} else { $alert_content = "Invalid File Format!"; header("location: $refering_url?msg=format"); }
		} else { $alert_content = "Please select a valid spreedsheet! [.csv, .xlxs]"; header("location: $refering_url?msg=undefined"); }

	} else {}
}

?>