<?php require_once('neticketing.php'); ?>
<?php
if (!isset($_SESSION)) {
session_start();
$user_email=$_SESSION['user_email'];
$_SESSION['user_email']=$user_email;
}


$query = "SELECT * FROM launch_info WHERE deleted = '0'";
$result = mysql_query($query,$conn);
while ($row = mysql_fetch_assoc($result)) {
    $allLaunchInfo[] = $row;
}
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
    	<div class="bg-info text-white text-center p-2">
				<h2 >All Launch Information</h2>
			</div>

			<div class="container mt-5">
				<table class="table text-center table-striped">
					<thead class="thead-dark ">
						<tr>
							<th scope="col"><h4>Serial No</h4></th>
							<th scope="col"><h4>Launch ID</h4></th>
							<th scope="col"><h4>Launch Name</h4></th>
							<th scope="col"><h4>Source</h4></th>
							<th scope="col"><h4>Destination</h4></th>
							<th scope="col"><h4>Departure Time</h4></th>
							<th scope="col"><h4>Action</h4></th>
						</tr>
						</tr>
					</thead>
					<tbody>
						<?php
                    $count = 1;
                    foreach ($allLaunchInfo as $value) {
                        ?>
						<tr>
							<td><?php echo $count; ?></td>
                            <td><?php echo $value['launch_id']; ?></td>
                            <td><?php echo $value['launch_name'] ?></td>
                            <td><?php echo $value['source'] ?></td>
                            <td><?php echo $value['destination']; ?></td>
                            <td><?php echo $value['dept_time']; ?></td>
                            <td>
                                <a href="view.php?id=<?php echo $value['launch_id'];  ?>">View</a> |
                                <a href="model/delete.php?id=<?php echo $value['launch_id']; ?>">Delete</a> 
                            </td>
						</tr>
						<?php
                        $count = $count + 1;
                    }
                    ?>
					</tbody>
				</table>
			</div>

    </div>

    
    <?php 
     include('include/footer.php');
?>