<?php require_once('Connections/neticketing.php'); ?>
<?php
if (!isset($_SESSION)) {
	session_start();
}
$usresEmail = $_SESSION['user_email'];
if (!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
	{
		if (PHP_VERSION < 6) {
			$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
		}
		$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
		switch ($theType) {
			case "text":
			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			break;
			case "long":
			case "int":
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			break;
			case "double":
			$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
			break;
			case "date":
			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			break;
			case "defined":
			$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
			break;
		}
		return $theValue;
	}
}
//mysql_select_db($database_neticketing, $neticketing);
$query_userForpur = "SELECT user_name, user_email, user_phone
FROM user_info
where user_email = '".$usresEmail."'";
$userForpur = mysql_query($query_userForpur) or die(mysql_error());
$row_userForpur = mysql_fetch_assoc($userForpur);
$totalRows_userForpur = mysql_num_rows($userForpur);
?>
<?php
$placeholder = "purchaseticket";
include('includes/banner.php');
include('includes/navigation.php');
?>
</head>
<body>
<!-- body start -->
<div style="margin-top: 83px">
	<div  id="trainroute">
		<div id="train_route_div">
			<div class="bg-info text-white text-center p-2">
				<h2 >Travel Info : <?php echo $_POST['source']; ?> to <?php echo $_POST['destination']; ?> /
				<?php $mydate=strtotime($_POST['date']);
				$d = date("l F j, Y",$mydate);
				echo $d.", ".$_POST['time']; ?>
				</h2>
			</div>
			<div class="container mt-5">
				<table class="table text-center table-bordered">
					<thead class="thead-dark ">
						<tr>
							<th scope="col"><h4>Launch</h4></th>
							<th scope="col"><h4>Source</h4></th>
							<th scope="col"><h4>Destination</h4></th>
							<th scope="col"><h4>Seat Catagory</h4></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $_POST['launch_name']; ?></td>
							<td><?php echo $_POST['source']; ?></td>
							<td><?php echo $_POST['destination']; ?></td>
							<td><?php echo $_POST['seat_catagory']; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="container mt-5">
				<h2>Contact Information</h2>
				<table class="table text-center table-bordered">
					<thead class="bg-danger text-white ">
						<tr>
							<th scope="col"><h4>Name</h4></th>
							<th scope="col"><h4>E-mail</h4></th>
							<th scope="col"><h4>Contact</h4></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $row_userForpur['user_name']; ?></td>
							<td><?php echo $row_userForpur['user_email']; ?></td>
							<td><?php echo $row_userForpur['user_phone']; ?></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="container mt-5">
				<h2>Payment</h2>
				<table class="table text-center table-bordered">
					<thead class="bg-info text-white ">
						
									<tr>
										<th>Item</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Price per person</td>
										<td><?php echo $_POST['eachPrice']; ?></td>
									</tr>
									<tr>
										<td>Pessengers</td>
										<td><?php echo $_POST['cabin']; ?></td>
									</tr>
									<tr>
										<td>Fare Price</td>
										<td><?php echo $_POST['eachPrice']." * ".$_POST['cabin']." = ".$_POST['cost'];?> BDT</td>
									</tr>
									<tr>
										<td>Taxes and Crrier-imposed Fees</td>
										<td>100 BDT</td>
									</tr>
								
					</tbody>
				</table>
<h4>
Total price to be paid :
<span>
	<?php
	$totalCost = ($_POST['eachPrice']*$_POST['cabin'])+100;
	echo $totalCost;
	?>
</span>
</h4>
<img src="images/payment.png" width="1115px" class="mt-5">
			</div>

		<div class="container mt-5">
<form action="print.php" method="post">
						<fieldset>
							<legend>Fare Rules</legend>
							<label class="checkbox">
								<input type="checkbox"> 
								I have read and agree to the <u><b>Terms &amp; Conditions</b></u>, 
								the <u><b>Fare Rules</b></u> and <u><b>general conditions of carriages</b></u>
								applicable to my departure(s) and accepts that my card will be debited
								immediately.
							</label>
							<input type="hidden" name="date" value="<?php echo $d; ?>">
							<input type="hidden" name="source" value="<?php echo $_POST['source']; ?>">
							<input type="hidden" name="destination" value="<?php echo $_POST['destination']; ?>">
							<input type="hidden" name="launch_name" value="<?php echo $_POST['launch_name']; ?>">
							<input type="hidden" name="time" value="<?php echo $_POST['time']; ?>">
							<input type="hidden" name="seat_catagory" value="<?php echo $_POST['seat_catagory']; ?>">
							<input type="hidden" name="cabin" value="<?php echo $_POST['cabin']; ?>">
							<input type="hidden" name="cost" value="<?php echo $totalCost; ?>">
							<input type="submit" class="btn btn-success"></input>
						</fieldset>
					</form>
					</div>
			

		</div>
	</div>
</div>

<?php 
     include('includes/footer.php');
?>