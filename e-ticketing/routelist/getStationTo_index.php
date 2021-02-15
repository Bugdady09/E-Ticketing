<?php require_once('../Connections/neticketing.php'); ?>
<?php
$q=$_GET['destination'];
$r=$_GET['date'];
$s = $_GET['source'];
		
		
		$sql="SELECT distinct launch_name 
		FROM launch_info 
		
		where source = '".$s."'
		AND destination = '".$q."'";

$result = mysql_query($sql);
?>
<select class="form-control form-control-sm" id="la_name" name="station_to" onchange="get_class()">
	<option value="0">SELECT LAUNCH</option>
<?php
while ($row = mysql_fetch_array($result)) {
?>
	<option value="<?php echo $row['launch_name']; ?>"><?php echo $row['launch_name']; ?></option>
<?php } ?>
</select>