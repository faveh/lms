<?php
// Alerts
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
} else if(isset($_GET['upd-books']) && $_GET['upd-books'] == 'failed') {
    $alert_content = nl2br("<strong>Books File Upload Failed!</strong>");

    $alert_icon="remove-sign"; $alert_type = "danger"; $alert_status = "show";
} else if(isset($_GET['del-book']) && $_GET['del-book'] == 'failed') {
    $alert_content = nl2br("<strong>Book Delete Failed!</strong>");

    $alert_icon="remove-sign"; $alert_type = "danger"; $alert_status = "show";
} else if(isset($_GET['msg']) && $_GET['msg'] == 'size') {
    $alert_content = nl2br("<strong>File size larger than 2 MB!</strong>");

    $alert_icon="exclamation-sign"; $alert_type = "warning"; $alert_status = "show";
} else if(isset($_GET['msg']) && $_GET['msg'] == 'soon') {
    $alert_content = nl2br("<strong>Coming Soon!</strong>");

    $alert_icon="info-sign"; $alert_type = "info"; $alert_status = "show";
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
?>