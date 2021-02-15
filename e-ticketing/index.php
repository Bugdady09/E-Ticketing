<?php require_once('Connections/neticketing.php'); ?>
<?php
if (!isset($_SESSION)) {
session_start();
}
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
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
$query_routelist = "SELECT distinct source FROM launch_info";
$routelist = mysql_query($query_routelist) or die(mysql_error());
$row_routelist = mysql_fetch_assoc($routelist);
$totalRows_routelist = mysql_num_rows($routelist);
?>
<?php include('includes/banner.php');
include('includes/navigation.php');
?>
<script>
function get_stn_to(str)
{
if (str == "")
{
document.getElementById("stn_to_list").innerHTML = "";
return;
}
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp = new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function ()
{
if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
{
document.getElementById("stn_to_list").innerHTML = xmlhttp.responseText;
}
}
xmlhttp.open("GET", "routelist/getStationTo1_index.php?q=" + str, true);
xmlhttp.send();
}
function get_launch()
{
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp = new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function ()
{
if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
{
document.getElementById("train_list").innerHTML = xmlhttp.responseText;
}
}
xmlhttp.open("GET", "routelist/getStationTo_index.php?date=" + document.getElementById("journey_date").value +
"&source=" + document.getElementById("station_from").value +
"&destination=" + document.getElementById("sta_destination").value, true);
xmlhttp.send();
}
//Receiving Information for Seat Catagory
function get_class()
{
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp = new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function ()
{
if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
{
document.getElementById("class_list").innerHTML = xmlhttp.responseText;
}
}
xmlhttp.open("GET", "routelist/getClass.php?launch_name=" + document.getElementById("la_name").value, true);
xmlhttp.send();
}
function get_result()
{
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp = new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function ()
{
if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
{
document.getElementById("fare_info").innerHTML = xmlhttp.responseText;
}
}
xmlhttp.open("GET", "routelist/result.php?date=" + document.getElementById("journey_date").value +
"&source=" + document.getElementById("station_from").value +
"&destination=" + document.getElementById("sta_destination").value +
"&launch_name=" + document.getElementById("la_name").value +
"&seat_catagory=" + document.getElementById("class_name").value +
"&cabin=" + document.getElementById("no_amount").value, true);
xmlhttp.send();
}
</script>
</head>
<body>
<?php
$placeholder = "index";
?>

<!--     Main section      -->
<div class="background">
  <div class="group">
    <div style="margin-top: -50px;">
      <marquee direction="left" scrollamount="6" onmouseover="this.stop()" onmouseout="this.start()">
      <h1 style="color: white;" >
      E-Launch Mobile App Released Soon. Our Emergency Contact Number 16444 ( করোনাভাইরাসের বিস্তার রোধে এখনই ডাউনলোড করুন Corona Tracer BD অ্যাপ। )  </h1>
      </marquee>
    </div>
    <!--            group1 start -->
    <div class="fromGroup1">
      <div class="headinGroup">
        <h1 >Welcome to </h1>
        <h1>Inland Water Transport</h1>
        <h1 >E-Ticketing Service</h1>
      </div>
    </div>
    <!--             group1 end -->
    <!--            group2 start -->
    
    <div class="fromGroup2">   <!-- form Group -->
    
    <form>
      
      <div class="form-group">
        <label for="exampleFormControlSelect1">Route</label>
      </div>
      <div class="form-group">
        <select class="form-control form-control-sm" id= "journey_date">
          <option value="0">SELECT JOURNEY DATE</option>
          <?php for($i=1;$i<=7;$i++){
          $bookingTime = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
          ?>
          <option value="<?php echo date("d", $bookingTime);?>">
            <?php echo date("d-m-Y", $bookingTime);?>
          </option>
          <?php }?>
        </select>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="exampleFormControlSelect1">Station From</label>
          <select class="form-control form-control-sm" id="station_from" onchange="get_stn_to(this.value)">
            <option>SELECT STATION</option>
            <?php
            do { ?>
            <option value="<?php echo $row_routelist['source']?>" <?php if (!(strcmp($row_routelist['source'], $row_routelist['source'])))?>>
              <?php echo $row_routelist['source']?>
            </option>
            <?php } while ($row_routelist = mysql_fetch_assoc($routelist));
            $rows = mysql_num_rows($routelist);
            if($rows > 0) {
            mysql_data_seek($routelist, 0);
            $row_routelist = mysql_fetch_assoc($routelist);
            }
            ?>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="exampleFormControlSelect1">Station To</label>
          <font id="stn_to_list">
          <select class="form-control form-control-sm" id="input_train_info">
            <option value="0">NONE</option>
            
          </select>
          </font>
        </div>
      </div>
      
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="exampleFormControlSelect1">Launch Name</label>
          
          <font id="train_list">
          <select class="form-control form-control-sm" name="train_list">
            <option value="0">NONE</option>
          </select>
          </font>
          
        </div>
        <div class="form-group col-md-6">
          <label for="exampleFormControlSelect1">Trvael Class</label>
          <font id="class_list">
          <select id="no_cabin" class="form-control form-control-sm" name="class_list">
            <option value="0">NONE</option>
          </select>
          </font>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="exampleFormControlSelect1">Number of Passenger(s) (more than 3)</label>
          <label class="mt-3" for="exampleFormControlSelect1"><p class="font-weight-light text-warning">(Give All Information About Your Journey And click Show Fare To See..)</p></label>
        </div>
        <div class="form-group col-md-6">
          <font id="amount_list">
          <select class="form-control form-control-sm" id="no_amount" class="input_train_info" name="amount_list">
            <option value="0">NONE</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </select>
          </font>
          
          <input class="btn btn-outline-success btn-block mt-3" type="button" name="show_fare" value="Show Fare"
          id="button1" tabindex="4" onclick="get_result()" />
        </div>
      </div>
    </form>
  </div>
  <div class="textResult">
    <div id="fare_info">
      <p class="font-weight-light text-white">Currently you choose nothing . . .</p>
    </div>
  </div>
  <!--            group2 end -->
</div>
</div>
<!--       main section end -->
<!--       Grid-3 -->
<div class="">
<div class="row">
  <div class="col-sm">
    <h3>Get Launch Tickets from the comfort of your home</h3>
    <p>Book Launch tickets from anywhere using the robust ticketing platform exclusively built to provide the passengers with pleasant ticketing experience. Also check out the mobile app RailSheba to further extend your pleasure of booking Launch tickets.</p>
  </div>
  <div class="col-sm">
    <h3>Launch & Ticketing related information at your fingertips</h3>
    <p>Checkout available seats, route information, fare information on real time basis with Esheba Platform.</p>
  </div>
  <div class="col-sm">
    <h3>Pay Securely</h3>
    <p>Pay using your convenient payment option. Bangladesh Launch supports Visa, Master, Amex & Nexus Cards, Rocket and bKash Mobile Financial Services for your convenience.</p>
  </div>
  
</div>
</div>
<!-- grid-3 end -->
<!-- payment logo -->
<div class="col-md-12 payment" >
<img src="images/section/1.png">
<img src="images/section/2.png">
<img src="images/section/3.png">
<img src="images/section/4.png">
<img src="images/section/5.png">
<img src="images/section/6.png">
</div>
<!--     payment logo end -->
<!-- small paragraph -->
<div class="paragraph">

<small>*The Tickets are issued by Bangladesh Inland Water Transport’s Centrally Computerized Seat Reservation & Ticketing System (BIWT) and Computer Network Systems Limited is responsible for designing, development, implementation, technical operation & maintenance of the system.</small>

</div>
<!-- small paragraph end -->
<?php
include('includes/footer.php');
?>