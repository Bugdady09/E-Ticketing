<?php require_once('Connections/neticketing.php'); ?>
<?php
if (!isset($_SESSION)) {
session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";
// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) {
// For security, start by assuming the visitor is NOT authorized.
$isValid = False;
// When a visitor has logged into this site, the Session variable MM_Username set equal to their username.
// Therefore, we know that a user is NOT logged in if that Session variable is blank.
if (!empty($UserName)) {
// Besides being logged in, you may restrict access to only certain users based on an ID established when they login.
// Parse the strings into arrays.
$arrUsers = Explode(",", $strUsers);
$arrGroups = Explode(",", $strGroups);
if (in_array($UserName, $arrUsers)) {
$isValid = true;
}
// Or, you may restrict access to only certain users based on their username.
if (in_array($UserGroup, $arrGroups)) {
$isValid = true;
}
if (($strUsers == "") && true) {
$isValid = true;
}
}
return $isValid;
}
$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {
$MM_qsChar = "?";
$MM_referrer = $_SERVER['PHP_SELF'];
if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0)
$MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
$MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
header("Location: ". $MM_restrictGoTo);
exit;
}
?>
<?php
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
if (str=="")
{
document.getElementById("stn_to_list").innerHTML="";
return;
}
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("stn_to_list").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","routelist/getStationTo_1.php?q="+str,true);
xmlhttp.send();
}
function get_time()
{
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("train_list1").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","routelist/getTime.php?date="+document.getElementById("journey_date").value+
"&source="+document.getElementById("station_from").value+
"&destination="+document.getElementById("sta_destination").value,true);
xmlhttp.send();
}
//Receiving Information for Launch Name
function get_launch()
{
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("train_list").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","routelist/getStation_2.php?date="+document.getElementById("journey_date").value+
"&source="+document.getElementById("station_from").value+
"&destination="+document.getElementById("sta_destination").value+
"&time="+document.getElementById("sta_time").value,true);
xmlhttp.send();
}
//Receiving Information for Seat Catagory
function get_class()
{
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("class_list").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","routelist/getClass.php?launch_name="+document.getElementById("la_name").value,true);
xmlhttp.send();
}
//Get Number Of Cabin
function get_numberOfcabin()
{
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("amount_list").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","routelist/getnumofcabin.php?date="+document.getElementById("journey_date").value+
"&source="+document.getElementById("station_from").value+
"&destination="+document.getElementById("sta_destination").value+
"&launch_name="+document.getElementById("la_name").value+
"&seat_catagory="+document.getElementById("class_name").value,true);
xmlhttp.send();
}
function get_result()
{
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("fare_info").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","routelist/resultForPerchuse.php?date="+document.getElementById("journey_date").value+
"&source="+document.getElementById("station_from").value+
"&destination="+document.getElementById("sta_destination").value+
"&launch_name="+document.getElementById("la_name").value+
"&seat_catagory="+document.getElementById("class_name").value+
"&cabin="+document.getElementById("no_amount").value+
"&time="+document.getElementById("sta_time").value,true);
xmlhttp.send();
}
</script>
</head>
<body>
<div class="container-fluid" style="margin-top: 140px;">
  <div class="row">
    <div class="col-md-7">
      <div class="card">
        <div class="card-header bg-info text-white">
          <h4>Purchase Ticket Info</h4>
        </div>
        <div class="card-body">
          
          <div class="row" style="margin-top: 0px;">
            <div class="col-sm-4"><label for='journey_date'>Journey Date</label></div>
            <div class="col-sm-8">
              <div id="select">
                <select class="form-control form-control-sm" name="journey_date" id="journey_date">
                  <option value="0">SELECT JOURNEY DATE</option>
                  <?php for($i=1;$i<=7;$i++){
                  $bookingTime = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
                  ?>
                  <option value="<?php echo date("d-m-Y", $bookingTime);?>">
                    <?php echo date("d-m-Y", $bookingTime);?>
                  </option>
                  <?php }?>
                </select>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top: 10px;">
            <div class="col-sm-4"><label for='station_from'>Station From</label></div>
            <div class="col-sm-8">
              <div id="select">
                <select class="form-control form-control-sm" name="station_from" id="station_from" required="required" onChange="get_stn_to(this.value)">
                  <option value="0" label="SELECT STATION">SELECT STATION</option>
                  <?php
                  do { ?>
                  <option value="<?php echo $row_routelist['source']?>"<?php if (!(strcmp($row_routelist['source'], $row_routelist['source'])))?>>
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
            </div>
          </div>
          <div class="row" style="margin-top: 10px;">
            <div class="col-sm-4"><label for='station_to'>Station To</label></div>
            <div class="col-sm-8">
              <div id="select">
                <font id="stn_to_list">
                <select id="input_train_info" class="form-control form-control-sm" name="stn_to_list">
                  <option value="0">NONE</option>
                </select>
                </font>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top: 10px;">
            <div class="col-sm-4"><label for='class'>Deperture Time</label></div>
            <div class="col-sm-8">
              <div id="select">
                <font id="train_list1">
                <select id="de_time" class="form-control form-control-sm" name="dep_time">
                  <option value="0">NONE</option>
                </select>
                </font>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top: 10px;">
            <div class="col-sm-4"><label for='train_name'>Launch Name</label></div>
            <div class="col-sm-8">
              <div id="select">
                <font id="train_list">
                <select class="form-control form-control-sm" name="train_list">
                  <option value="0">NONE</option>
                </select>
                </font>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top: 10px;">
            <div class="col-sm-4"><label for='class'>Travel Class</label></div>
            <div class="col-sm-8"><div id="select">
              <font id="class_list">
              <select id="no_cabin" class="form-control form-control-sm" name="class_list">
                <option value="0">NONE</option>
              </select>
              </font>
            </div></div>
          </div>
          <div class="row" style="margin-top: 10px;">
            <div class="col-sm-4"><label for='class'>Amount</label></div>
            <div class="col-sm-8">
              <div id="select">
                <font id="amount_list">
                <select id="no_amount" class="form-control form-control-sm" name="amount_list">
                  <option value="0">NONE</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
                </font>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top: 10px;">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
              
              <input class ="btn btn-info btn-lg" type="button" name="show_fare" value="Show Purchase Info"
              id="button1" tabindex="4" onClick="get_result()" />
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Second Section -->
    <div class="col-md-5">
      <div class="card">
        <div class="card-header  bg-info text-white ">
          <h4>Purchase Ticket Result</h4>
        </div>
        <div class="card-body">
          <form id="fare_query_result" action="ticketConfermation.php" method="post">
            <fieldset class="signup_fieldset">
              <div id="fare_info">
                Give All Information About Your Journey
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include('includes/footer.php');
?>