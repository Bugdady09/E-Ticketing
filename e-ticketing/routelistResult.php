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

//mysql_select_db($database_neticketing, $neticketing);
$query_route_list_details = "SELECT launch_name,dept_time
							FROM launch_info,schedule_info 
              WHERE launch_info.launch_id=schedule_info.launch_id
              AND dept_date = '$_POST[journey_date]'
							AND source='$_POST[station_from]'
							AND destination = '$_POST[station_to]'
              ORDER BY dept_time";
$route_list_details = mysql_query($query_route_list_details) or die(mysql_error());
$row_route_list_details = mysql_fetch_assoc($route_list_details);
$totalRows_route_list_details = mysql_num_rows($route_list_details);
?>


<?php include('includes/banner.php');
include('includes/navigation.php');
?>

 </head>
  <body>

    <div class="bg-info p-2" style="margin-top: 83px;">
      <h2 class="lead text-white text-center"><div id="legend_s">&nbsp;&nbsp;Launch Route Showing For :: <?php echo $_POST['station_from']?> to <?php echo $_POST['station_to']?> :: <?php echo $_POST['journey_date']?> &nbsp;&nbsp;</div></h2>
    </div>


    
       <div class="container mt-5">

        <div id="train_route_div_b">

        <table class="table">
            <tbody>
              <tr class="text-center table-active">
                <th class="lead">Serial </th>
                <th class="lead">Launch Name</th>
                <th class="lead">Departure Time </th>
              </tr>

<?php if ($totalRows_route_list_details>0){ ?>
<?php 
$i = 1; 
do { ?>
<tr style="text-align: center; background: #EAFFD5">
  <td>
    <?php
      echo $i;
      $i++;
    ?>
  </td>
  <td style="text-align: center;"><?php echo $row_route_list_details['launch_name']; ?></td>
  <td><?php echo $row_route_list_details['dept_time']; ?></td>
</tr>
<?php } while ($row_route_list_details = mysql_fetch_assoc($route_list_details)); ?>

<?php } else{
  echo "<p class='lead'>Sorry no Launch is available on That day</p>";
} ?>
        </tbody>
    </table>
</div>
         
       </div>


<div style="margin-top: 255px;">
    
    <?php 
     include('includes/footer.php');
    ?>
  
</div>

       