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
  xmlhttp.open("GET","routelist/getStationTo.php?q="+str,true);
  xmlhttp.send();
}
</script>
</head>
<body>

  <div class="margin-top-fix-all"  style="margin: 120px 0px;">
  
<!--   card section -->
<div class="content">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 mt-n10">
        <div class="border card">
          <div class="card-header bg-primary text-white">
            <h4>Launch Route</h4>
          </div>
          <div class="card-body">
             <div id="train_route_div">
            <form id='train_route' action='routelistResult.php' method='post' accept-charset='UTF-8'>
  <div class="form-group">
    <label for="exampleInputEmail1">Journey Date</label>
    <select class="form-control form-control-sm" name="journey_date"
                    id="journey_date" required>
                    <option value="0">SELECT JOURNEY DATE</option>
                    <?php for($i=1;$i<=7;$i++){ 
                     $bookingTime = mktime(0,0,0,date("m"),date("d")+$i,date("Y"));
                     ?>
                     <option value="<?php echo date("d-m-Y", $bookingTime);?>"> <?php echo date("d-m-Y", $bookingTime);?> </option>
                     <?php }?>
                   </select>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Station From</label>
    <select name="station_from" id="station_from" class="form-control form-control-sm" tabindex="2" onchange="get_stn_to(this.value)">
                    <option value="0" label="SELECT STATION">SELECT STATION</option>
                    <?php
                    do { ?>
                    <option value="<?php echo $row_routelist['source']?>"<?php if (!(strcmp($row_routelist['source'], $row_routelist['source'])))?>> <?php echo $row_routelist['source']?> </option>
                    <?php } while ($row_routelist = mysql_fetch_assoc($routelist));
                    $rows = mysql_num_rows($routelist);
                    if($rows > 0) {
                      mysql_data_seek($routelist, 0);
                      $row_routelist = mysql_fetch_assoc($routelist);
                    }
                    ?>
                  </select>
  </div>
  <div class="form-group">
    <label for="exampleCheck1">Station To</label>
    <font id="stn_to_list">
                      <select id="input_train_info" class="form-control form-control-sm" name="stn_to_list">
                        <option value="0" />NONE</option>
                      </select>
                    </font> 
                 </div>
        <input class = "btn btn-warning" type="submit" name="train_route" value="Find Available Launch(s)" id="button1" tabindex="5" />

</form>
      </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
      <!--       main section end -->

  
</div>



<?php 
     include('includes/footer.php');
?>