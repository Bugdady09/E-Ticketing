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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['inputEmail'])) {
  $loginUsername=$_POST['inputEmail'];
  $password=$_POST['inputPassword'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "purchaseticket.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = true;
//  mysql_select_db($database_neticketing, $neticketing);
  
  $LoginRS__query=sprintf("SELECT user_email, user_password, user_id FROM user_info WHERE user_email=%s AND user_password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  $forUserId = mysql_fetch_assoc($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	   
	  $_SESSION['user_email'] = $_POST['inputEmail']; 
    $_SESSION['user_id'] = $forUserId['user_id'];

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['inputEmail'])) {
  $loginUsername=$_POST['inputEmail'];
  $password=$_POST['inputPassword'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "dashboard.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_neticketing, $neticketing);
  
  $LoginRS__query=sprintf("SELECT user_email, user_password FROM user_info WHERE user_email=%s AND user_password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $neticketing) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>

<?php include('includes/banner.php');
include('includes/navigation.php');
?>

  </head>
  <body>


    <div class="container" style="margin-top: 140px;">
    <div class="row justify-content-center">
      <div class="col-md-8 mt-n10">
        <div class="border card">
          <div class="card-header bg-primary text-white">
            <h4>Login</h4>
          </div>
          <div class="card-body">
            <div id="train_route_div">
            <form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" name="myLoginForm">
  <div class="form-group">
    <label for="exampleInputEmail1">Email Or Phone</label>
    <input class="form-control" type="email" name="inputEmail" id="inputEmail" placeholder="Email"
                    required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input class="form-control" type="password" name="inputPassword" id="inputPassword"
                    placeholder="Password" required>
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
  </div>
  <input type="submit" class="btn btn-primary">
  <p>Don't Have an Account?<a class=" btn btn-link" href="registration.php"> Sign Up Here</a></p>
</form>
</div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
     include('includes/footer.php');
?>