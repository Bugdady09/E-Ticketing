<?php require_once('../Connections/neticketing.php'); ?>
<?php
$q=$_GET["q"];

//mysql_select_db($database_neticketing, $neticketing);

$sql="SELECT distinct destination FROM launch_info WHERE source = '".$q."'";
$result = mysql_query($sql);
?>
<select class="form-control form-control-sm" name="station_to">
	<option value="0">SELECT DESTINATION</option>
<?php
while ($row = mysql_fetch_array($result)) {
?>
	<option value="<?php echo $row['destination']; ?>"><?php echo $row['destination']; ?></option>
<?php } ?>
</select>