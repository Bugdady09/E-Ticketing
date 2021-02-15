<?php

require_once '../../Connections/neticketing.php';

echo "<pre>";
print_r($_POST);
echo "<pre>";
$flag = $_POST['flag'];

if ($flag == 0) {
    $launch_id = $_POST['launch_id'];
    $launch_name = $_POST['launch_name'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $dept_time = $_POST['dept_time'];


    $query = "UPDATE launch_info SET launch_name= '" . $launch_name . "',source='" . $source . "',destination='" . $destination . "',dept_time='" . $dept_time . "' WHERE launch_info.launch_id = '" . $launch_id . "'";
    if (mysql_query($query)) {
		session_start();
        header("Location:http://localhost/ticketing/admin/dashboard.php");
    }
}

if ($flag == 1) {
    $launch_id = $_POST['launch_id'];
    $catagory_id = $_POST['catagory_id'];
    $catagory_name = $_POST['catagory_name'];
    $price = $_POST['price'];
    $capacity_amount = $_POST['capacity_amount'];

    $query = "UPDATE seat_catagory SET catagory_name= '" . $catagory_name . "',price='" . $price . "',capacity_amount='" . $capacity_amount . "' WHERE seat_catagory.catagory_id = '" . $catagory_id . "'";
    if (mysql_query($query)) {
        header("Location:http://localhost/ticketing/admin/view.php?id=" . $launch_id);
    }
}
