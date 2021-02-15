<?php require_once('Connections/neticketing.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
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


$colname_user_information = "-1";
if (isset($_SESSION['user_email'])) {
  $colname_user_information = $_SESSION['user_email'];
}
//mysql_select_db($database_neticketing, $neticketing);
$query_user_information = sprintf("SELECT user_name, user_email, user_phone, user_address FROM user_info WHERE user_email = %s", GetSQLValueString($colname_user_information, "text"));
$user_information = mysql_query($query_user_information) or die(mysql_error());
$row_user_information = mysql_fetch_assoc($user_information);
$totalRows_user_information = mysql_num_rows($user_information);

$colname_purchaseInfo = "-1";
if (isset($_GET['user_id'])) {
  $colname_purchaseInfo = $_GET['user_id'];
}
//mysql_select_db($database_neticketing, $neticketing);
$query_purchaseInfo = sprintf("SELECT purchase_date, journey_date, dept_time, source, destination, launch_name, tnr, catagory, amount
  FROM purchase_info 
  WHERE user_id = '".$_SESSION['user_id']."'
  ORDER BY journey_date DESC", GetSQLValueString($colname_purchaseInfo, "int"));
$purchaseInfo = mysql_query($query_purchaseInfo) or die(mysql_error());
$row_purchaseInfo = mysql_fetch_assoc($purchaseInfo);
$totalRows_purchaseInfo = mysql_num_rows($purchaseInfo);
?>

<?php include('includes/banner.php');
include('includes/navigation.php');
?>

  </head>
  <body>

    <?php 
$placeholder = "dashboard";
?>

 <div class="container" style="margin-top: 140px;">
   <div class="card">
  <div class="card-header bg-info text-white">
    <h4>User Information</h4>
  </div>
  <div class="card-body">

    <table class="table" style="box-shadow:0px 0px 16px;">
        <tr class="home" >
          <th>Name</th>
          <td><?php echo $row_user_information['user_name']; ?></td>
        </tr>
        <tr class="home" >
          <th>Email Address</th>
          <td><?php echo $row_user_information['user_email']; ?></td>
        </tr>
        <tr class="home" >
          <th>Address</th>
          <td><?php echo $row_user_information['user_address']; ?></td>
        </tr>
        <tr class="home" >
          <th>Phone Number</th>
          <td><?php echo $row_user_information['user_phone']; ?></td>
        </tr>
      </table>
    
  </div>
</div>


<div class="card mt-5">
  <div class="card-header bg-info text-white">
    <h4>Successful Purchase Information</h4>
  </div>
  <div class="card-body" style="padding: 40px 40px;">

    <table  class="table" style="box-shadow:0px 0px 16px #000000;">
        <tr bgcolor="#ccccc" align="center" font-size="1.5em" >
          <td>Journey Date</td>
          <td>Departure Time</td>
          <td>Station From </td>
          <td>Station To</td>
          <td>eTicket Number</td>
          <td>Purchase Date</td>
          <td>launch Name</td>
          <td>Type</td>
          <td>Amount</td>
        </tr>
        <?php do { ?>
          <tr bgcolor="#FFF" align="center" >
            <td><?php echo $row_purchaseInfo['journey_date']; ?></td>
            <td><?php echo $row_purchaseInfo['dept_time']; ?></td>
            <td><?php echo $row_purchaseInfo['source']; ?></td>
            <td><?php echo $row_purchaseInfo['destination']; ?></td>
            <td><?php echo $row_purchaseInfo['tnr']; ?></td>
            <td><?php echo $row_purchaseInfo['purchase_date']; ?></td>
            <td><?php echo $row_purchaseInfo['launch_name']; ?></td>
            <td><?php echo $row_purchaseInfo['catagory']; ?></td>
            <td><?php echo $row_purchaseInfo['amount']; ?></td>
          </tr>
          <?php } while ($row_purchaseInfo = mysql_fetch_assoc($purchaseInfo)); ?>
      </table>
    
  </div>
</div>


 </div>

 
<?php 
     include('includes/footer.php');
?>