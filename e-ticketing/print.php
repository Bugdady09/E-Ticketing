<?php
require_once('Connections/neticketing.php');
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
session_start();
}
$user_id = $_SESSION['user_id'];
$date = $_POST['date'];
$EditedDate = strtotime($_POST['date']);
$journey_date = date("Y-m-d",$EditedDate );
$purchase_date = date("Y-m-d");
$departure_time = $_POST['time'];
$source = $_POST['source'];
$destination = $_POST['destination'];
$launch_name = $_POST['launch_name'];
$seat_catagory = $_POST['seat_catagory'];
$cabin = $_POST['cabin'];
$cost = $_POST['cost'];
$tnr = rand(1000,1000000);
mysql_select_db($database_neticketing, $conn);
$query_insertData = "INSERT into purchase_info (user_id, purchase_date, journey_date, dept_time, source, destination, launch_name, catagory, amount, tnr)
VALUES ('$user_id', '$purchase_date', '$journey_date', '$departure_time', '$source', '$destination', '$launch_name', '$seat_catagory', '$cabin', '$tnr')";
$success_insertData = mysql_query($query_insertData, $conn) or die(mysql_error());
?>
<?php include('includes/banner.php');
?>
<script src="printing/jquery-1.9.0.js" type="text/JavaScript"
language="javascript"></script>
<script src="printing/jquery.PrintArea.js" type="text/JavaScript"
language="javascript"></script>
<link type="text/css" rel="stylesheet" href="printing/PrintArea.css" />
<?php
include('includes/navigation.php');
?>
</head>
<body>
<div class="container" style="margin-top: 100px;">
	<div class="row justify-content-center">
		<div class="col-md-8 mt-n10">
			<div class="border card">
				<div class="card-header bg-info text-white">
					<h4>Purchase Ticket Info</h4>
				</div>
				<div class="card-body" >
					<div id="trainroute" style="margin-top: 30px;">
						<div id="train_route_div">
							<fieldset class="signup_fieldset">
								<div class="p1">
									<P style="font-size: 18px;"><b>Ticket No: </b><?php echo $tnr; ?></P>
									<P style="font-size: 18px;"><b>Station To: </b><?php echo $source; ?></P>
									<P style="font-size: 18px;"><b>Station From: </b><?php echo $destination; ?></P>
									<P style="font-size: 18px;"><b>Launce Name: </b><?php echo $launch_name; ?></P>
									<P style="font-size: 18px;"><b>Catagory: </b><?php echo $seat_catagory; ?></P>
									<P style="font-size: 18px;"><b>Date: </b><?php echo $date; ?></P>
									<p style="font-size: 18px;"><b>Time: </b><?php echo $departure_time; ?></p>
									<P style="font-size: 18px;"><b>No of </b><?php echo $seat_catagory; ?>: <?php echo $cabin; ?></P>
									<P style="font-size: 18px;"><b>Cost: </b><?php echo $cost; ?> TK</P>
								</div>
								<div class="b1">
									<input type="button" class="btn btn-success b1" value="Print">
								</div>
								<script>
								$(document).ready(function(){
								$("div.b1").click(function(){
								var mode = $("input[name='mode']:checked").val();
								var close = mode == "popup" && $("input#closePop").is(":checked")
								var options = { mode : mode, popClose : close };
								$("div.p1").printArea( options );
								});
								$("input[name='mode']").click(function(){
								if ( $(this).val() == "iframe" ) $("#closePop").attr( "checked", false );
								});
								});
								</script>
							</fieldset>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<footer class="footerBackground">
	<div class="row">
		<div class="col-6" style="margin-top: 10px; margin-bottom: 10px;">
			<h6 class="h6-margin">To Download the app</h6>
			<a class="btn btn-outline-info" href="#" role="button">Google Play</a>
			<a class="btn btn-outline-info" href="#" role="button">App Stor</a>
			<h6 class="h6-margin">Soon Available...</h6>
			
		</div>
		<div class="col-6" style="margin-top: 45px; margin-left: -40px;">
			<h6 class="h6-margin float-right">© 2020 Copyright: Jonayed & Zakir</h6>
		</div>
		
	</div>
</footer>