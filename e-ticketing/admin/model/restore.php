<?php

require_once '../../Connections/neticketing.php';

if (isset($_GET)) {
    $id = $_GET['id'];
}

$query = "UPDATE launch_info SET deleted = '0' WHERE launch_info.launch_id = '" . $id . "'";
if (mysql_query($query)) {
    header("location:http://localhost/ticketing/admin/dashboard.php");
} else {
    header("location:http://localhost/ticketing/admin/trashed.php");
}

