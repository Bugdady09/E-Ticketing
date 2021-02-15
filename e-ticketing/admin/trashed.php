<?php require_once('../Connections/neticketing.php'); ?>
<?php
if (!isset($_SESSION)) {
    session_start();
}

$query = "SELECT * FROM launch_info WHERE deleted = 1";
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) {
    $allLaunchInfo[] = $row;
}
?>

<?php include('include/banner.php');
include('include/navigation.php');
?>

  </head>
    <body>

    	<div class="container" style="margin-top: 140px;">
    		<div class="container bg-info text-white text-center p-3">
    			<h4>All Deleted Launch Information</h4>
    		</div>


    		<table  class="table table-striped " >
                    <tr class="text-center">
                        <th>Serial No</th>
                        <th>Launch ID</th>
                        <th>launch Name</th>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Departure Time</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $count = 1;
                    if (!empty($allLaunchInfo)) {
                        foreach ($allLaunchInfo as $value) {
                            ?>
                            <tr bgcolor="#FFF" align="center" >
                                <td><?php echo $count; ?></td>
                                <td><?php echo $value['launch_id']; ?></td>
                                <td><?php echo $value['launch_name'] ?></td>
                                <td><?php echo $value['source'] ?></td>
                                <td><?php echo $value['destination']; ?></td>
                                <td><?php echo $value['dept_time']; ?></td>
                                <td>
                                    <a href="http://localhost/ticketing/admin/view.php?id=<?php echo $value['launch_id']; ?>">View</a> |
                                    <a href="http://localhost/ticketing/admin/model/restore.php?id=<?php echo $value['launch_id']; ?>">Restore</a> 
                                </td>
                            </tr>
                            <?php
                            $count = $count + 1;
                        }
                    } else {
                        echo '<td><h3 class = "text-danger">No Deleted Data</h3></td>';
                    }
                    ?>
                </table>


    	</div>
<div style="margin-top: 196px;">
	<?php include('include/footer.php'); ?>
</div>
    	 