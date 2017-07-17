<!DOCTYPE html>
<html>
<head>
    <title>Admin - Process Books</title>

    <style type="text/css">
        body {
          font-family: "Lato", "Helvetica Neue", Helvetica, Arial, sans-serif;
          font-size: 15px;
          line-height: 1.42857143;
          color: #ebebeb;
          background-color: #2b3e50;
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
    header ("Location: $refering_url");
} else {
    $admin_id = $_SESSION['admin_id'];
    //$username = $_SESSION['admin_username'];

    
    if( isset($_POST['books_amount']) ) {
        $books_amount = $_POST['books_amount'];
        $success_amount = 0;
        $failed_amount = 0;

        for($i=1; $i<=$books_amount; $i++) {
            // check required ones
            if(empty($_POST["title$i"]) && empty($_POST["field$i"]) && empty($_POST["format$i"]) && empty($_POST["type$i"])) {
                continue;
            } else {
                //echo "Book Entry $i Details";
                $title = $_POST["title$i"]; // most required
                if(empty($_POST["author$i"])) {
                    $author = "";
                } else { $author = $_POST["author$i"]; }
                if(empty($_POST["year$i"])) {
                    $year = "";
                } else { $year = $_POST["year$i"]; }
                $field = $_POST["field$i"]; // a required
                if(empty($_POST["publisher$i"])) {
                    $publisher = "";
                } else { $publisher = $_POST["publisher$i"]; }
                if(empty($_POST["series_title$i"])) {
                    $series_title = "";
                } else { $series_title = $_POST["series_title$i"]; }
                if(empty($_POST["ISBN$i"])) {
                    $ISBN = "";
                } else { $ISBN = $_POST["ISBN$i"]; }
                if(empty($_POST["volume$i"])) {
                    $volume = 0;
                } else { $volume = $_POST["volume$i"]; }
                if(empty($_POST["edition$i"])) {
                    $edition = 0;
                } else { $edition = $_POST["edition$i"]; }
                $format = $_POST["format$i"]; // a required
                $type = $_POST["type$i"]; // a required
                if(empty($_POST["copies$i"])) {
                    $copies = 1;
                } else { $copies = $_POST["copies$i"]; }

                /*echo "<br>";
                echo "<strong>Title:</strong> ".$title;
                echo "<br>";
                echo "<strong>Author:</strong> "$author;
                echo "<br>";
                echo "<strong>Year:</strong> "$year;
                echo "<br>";
                echo "<strong>Field:</strong> "$field;
                echo "<br>";
                echo "<strong>Publisher:</strong> "$publisher;
                echo "<br>";
                echo "<strong>Title:</strong> "$series_title;
                echo "<br>";
                echo "<strong>ISBN:</strong> "$ISBN;
                echo "<br>";
                echo "<strong>Volume:</strong> "$volume;
                echo "<br>";
                echo "<strong>Edition:</strong> "$edition;
                echo "<br>";
                echo "<strong>Format:</strong> "$format;
                echo "<br>";
                echo "<strong>Type:</strong> "$type;
                echo "<br>";
                echo "<strong>Copies:</strong> "$copies;
                echo "<br>";*/

                $inputBookQuery = "INSERT INTO $lms_books (admin_id, title, author, year, field_code, publisher, series_title, ISBN, volume, edition, format_code, type_code, date_added, copies, available) VALUES ('$admin_id', '$title', '$author', '$year', '$field', '$publisher', '$series_title', '$ISBN', '$volume', '$edition', '$format', '$type', CURRENT_TIMESTAMP, '$copies', '$copies')";
                $result = mysqli_query($conn, $inputBookQuery);

                if($result) {
                    //echo "<p class='green'>ROW ".$i." DATA SUCCESSFULLY INSERTED!</p>";
                    $success_amount++;
                } else {
                    echo "<p class='red'>Book Entry ".$i." FAILED!</p>";
                    $failed_amount++;
                    $failed_rows[$i] = $i;
                }

                    /*echo "<h4>Statistics</h4>";
                    echo "<p class='green'>SUCCESSFULLY INSERTED: <strong>$success_amount</strong></p>";
                    echo "<p class='red'>FAILED TO INSERT: <strong>$failed_amount</strong></p> <br>";
                    
                    echo "<a href='$refering_url?msg=success&samt=$success_amount&famt=$failed_amount' target='_blank'>GO BACK To Books Management</a> <br>";

                    echo "<br><strong>NOTE:</strong> You have just <strong>45 seconds</strong> to go through the report here!";

                    sleep(15);
                    */

                    if($failed_amount != 0) {
                        header("location: $refering_url?msg=success&samt=$success_amount&famt=$failed_amount");
                    } else {
                        header("location: $refering_url?msg=success");
                    }
            }

        }
        
        
    } else { header ("Location: $refering_url"); }

}

?>