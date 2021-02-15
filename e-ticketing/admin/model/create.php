<?php require_once('neticketing.php'); ?>
<?php
if (isset($_POST['Save'])) {
    $launch_id =uniqid(MV_);
    $launch_name = $_POST['launch_name'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $dept_time = $_POST['dept_time'];


    $query = "INSERT INTO launch_info (launch_id,launch_name,source,destination,dept_time)
    values ('".$launch_id."','" . $launch_name . "','" . $source . "','" . $destination . "','" . $dept_time . "')";
	
	 mysql_select_db($database_neticketing);
	 $r=mysql_query($query,$conn);
 if(!$r)
 {
	 die('C'.mysql_error());
 }
    if ($r) {
        header("Location:http://localhost/ticketing/admin/view.php?id=" . $launch_id);
    }
}

if (isset($_POST['adminLogin'])) {
	$id=uniqid();
    $launch_id =$_POST['launch_id'];
    $cat_name = $_POST['catagory_name'];
    $price = $_POST['price'];
    $capacity = $_POST['capacity_amount'];
	
	
	
	
    //$dept_time = 


    $query = "INSERT INTO seat_catagory (catagory_id,launch_name,catagory_name,price,capacity_amount)
    values ('". $id ."','". $launch_id."','" . $cat_name . "','" . $price . "','" . $capacity . "')";
	
	 mysql_select_db($database_neticketing);
	 $r=mysql_query($query,$conn);


     $q = "INSERT INTO launch_category (launch_id,catagory_id)
    values ('".$launch_id."','" . $id . "')";
    
     mysql_select_db($database_neticketing);
     mysql_query($q,$conn);
 if(!$r)
 {
	 die('C'.mysql_error());
 }
    if ($r) {
        header("Location:http://localhost/ticketing/admin/dashboard.php");
    }
}
?>