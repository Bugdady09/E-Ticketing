<?php require_once('neticketing.php'); ?>

<?php
include('neticketing.php');
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['user_email'])) {
	//session_start();

$id = $_GET['id'];


$query = "SELECT * FROM launch_info WHERE launch_id = '" . $id . "'";
$r = mysql_query($query);

$allLaunchInfo=mysql_fetch_assoc($r) ;

?>

<?php include('include/banner.php');
include('include/navigation.php');
?>

  </head>
    <body>


    	<?php
    $placeholder = "dashboard";
    ?>

    <div style="margin-top: 83px">

    	<div class="container">
    		<div class="card">
  <div class="card-header bg-info text-white">
    <h4>Launch (<?php echo $allLaunchInfo['launch_name'] ;?>) Information</h4>
  </div>
  <div class="card-body">
    <table  class="table">
                    <tr class="bg-dark text-white">                      
                        <td>Launch ID</td>
                        <td>launch Name</td>
                        <td>Source</td>
                        <td>Destination</td>
                        <td>Departure Time</td>
                        <td>Action</td>
                    </tr>
					
                    <tr>
                        <td><?php echo $allLaunchInfo['launch_id']; ?></td>
                        <td><?php echo $allLaunchInfo['launch_name'] ?></td>
                        <td><?php echo $allLaunchInfo['source'] ?></td>
                        <td><?php echo $allLaunchInfo['destination']; ?></td>
                        <td><?php echo $allLaunchInfo['dept_time']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $allLaunchInfo['launch_id']; ?>&flag=0">
                                Edit
                            </a> |
                            <a href="model/delete.php?id=<?php echo $allLaunchInfo['launch_id']; ?>">Delete</a> 
                        </td>
                    </tr>

                </table>
</div>
    	</div>
    	
    	<div class="card mt-5">
  <div class="card-header bg-info text-white">
   <h4>Seat Information</h4>
  </div>
  
<div class="card-body">
  <table  class="table">
                    <tr class="bg-dark text-white">                      
                        <td>Serial</td>
                        <td>Category Name</td>
                        <td>Price</td>
                        <td>Seat Amount</td>
                        <td>Action</td>
                    </tr>
                    <?php
                    $count = 1;
					$query_seat = "SELECT * FROM launch_category, seat_catagory WHERE "
        . "launch_category.launch_id = '" . $id . "' AND "
        . "launch_category.catagory_id = seat_catagory.catagory_id";
$result_seat = mysql_query($query_seat,$conn);

while ($row = mysql_fetch_array($result_seat)) {
 ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $row['catagory_name']; ?></td>
                            <td><?php echo $row['price'] ?></td>
                            <td><?php echo $row['capacity_amount'] ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['catagory_id']; ?>&flag=1&launch_id=<?php echo $row['launch_id'];?>">Edit</a> |
                                <a href="">Delete</a> 
                            </td>
                        </tr>
                        <?php
                        $count = $count + 1;
                    }
					
                    ?>
                </table>
            </div>
</div>

    </div>
<?php 
     include('include/footer.php');
?>

<?php 
}

  else {
    header("Location:http://ttp://localhost/ticketing/admin/");
}
?>

