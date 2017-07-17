<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Books</title>

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

require_once "../../include/connection.php";
require_once "../../include/functions.php";
require_once "../../include/config.php";

$ld = 2;
$ld = getLevelDeep($ld);

$refering_url = "./";

if (!adminLoggedin($conn)) {
    header ("Location: $refering_url");
} else {

    if( isset($_REQUEST['del']) ) {
        $del = $_REQUEST['del'];
        echo $del;

        header ("Location: $refering_url?msg=soon");
    } else { header ("Location: $refering_url?del-book=failed"); }
}

?>