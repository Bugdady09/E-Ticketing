<?php
require_once '../../Connections/neticketing.php';

//echo "<pre>";
//print_r($_GET);
//echo "<pre>";
if (isset($_GET)) {
    $id = $_GET['id'];
}

$query = "UPDATE launch_info SET deleted = '1' WHERE launch_info.launch_id = '" . $id . "'";
if (mysql_query($query)) {
    header("location:http://localhost/ticketing/admin/dashboard.php");
} else {
    header("location:http://localhost/ticketing/admin/dashboard.php");
}

