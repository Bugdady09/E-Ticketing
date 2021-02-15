<?php require_once('Connections/neticketing.php'); ?>
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
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "signupForm")) {
$insertSQL = sprintf("INSERT INTO user_info (user_name, user_email, user_phone, user_address, user_password) VALUES (%s, %s, %s, %s, %s)",
GetSQLValueString($_POST['inputName'], "text"),
GetSQLValueString($_POST['inputEmail'], "text"),
GetSQLValueString($_POST['inputPhone'], "text"),
GetSQLValueString($_POST['address'], "text"),
GetSQLValueString($_POST['inputPassword'], "text"));
//  mysql_select_db($database_neticketing, $neticketing);
$Result1 = mysql_query($insertSQL) or die(mysql_error());
$insertGoTo = "login.php";
if (isset($_SERVER['QUERY_STRING'])) {
$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
$insertGoTo .= $_SERVER['QUERY_STRING'];
}
header(sprintf("Location: %s", $insertGoTo));
}
mysql_select_db($database_neticketing,$conn);
$query_insert_record = "SELECT * FROM user_info";
$insert_record = mysql_query($query_insert_record, $conn) or die(mysql_error());
$row_insert_record = mysql_fetch_assoc($insert_record);
$totalRows_insert_record = mysql_num_rows($insert_record);
?>
<?php include('includes/banner.php');
include('includes/navigation.php');
?>
</head>
<body>
<?php
$placeholder = "login";
?>
<div class="container" style="margin-top: 140px;">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="border card">
        <div class="card-header bg-info text-white">
          <h4>Registration Form</h4>
        </div>
        <div class="card-body p-5">
          
          <div id="trainroute">
            <div id="train_route_div">
              <form method="POST" action="<?php echo $editFormAction; ?>" name="signupForm" class="form-horizontal">
                <fieldset>
                  <div class="row">
                    <div class="col-sm-4"><label for='class'>Name</label></div>
                    <div class="col-sm-8"><input class="form-control" type="text" name="inputName" id="inputName" placeholder="Your Name"
                    required></div>
                  </div>
                  
                  <div class="row">
                    <div class="col-sm-4"><label for='class'>Email</label></div>
                    <div class="col-sm-8"><input class="form-control" type="email" name="inputEmail" id="inputEmail" placeholder="Email"
                    required></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4"><label for='class'>Password</label></div>
                    <div class="col-sm-8"><input class="form-control" type="password" id="inputPassword" name="inputPassword"
                    placeholder="Password" required></div>
                  </div>
                  
                  <div class="row">
                    <div class="col-sm-4"><label for='class'>Address</label></div>
                    <div class="col-sm-8"><textarea class="form-control" name="address" rows="3"></textarea></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4"><label for='class'>Phone Number</label></div>
                    <div class="col-sm-8"><input class="form-control" type="text" id="inputPhone" name="inputPhone"
                    placeholder="CellPhone Number" required></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="col-sm-8"><input type="submit" class="btn btn-success" value="Register"></div>
                    </div>
                    
                    <!-- </div> -->
                  </fieldset>
                  <input type="hidden" name="MM_insert" value="signupForm">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include('includes/footer.php');
  ?>