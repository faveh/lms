<?php
session_start();

require_once "../../include/connection.php";
require_once "../../include/functions.php";
require_once "../../include/config.php";

// pagename
$pagename = "dashboard";

// Remember me Code
if( adminLoggedin($conn) ) {
    header("Location: ../");  
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Dashboard</title>

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