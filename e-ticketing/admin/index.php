<?php 
require_once('neticketing.php'); 
session_start();
		if (isset($_POST['inputEmail'],$_POST['inputPassword']))
			   {
                $user_email=$_POST['inputEmail'];
                $password=$_POST['inputPassword'];
  
                   if (empty($user_email) || empty($password))
                   {
                      $error = 'Hey All fields are required!!';
                    }
                     
					 else {  
					 $login="select * from user_info where user_email='".$user_email."' and user_password ='".$password."' and admin = '1'";
					 $result=mysql_query($login,$conn);
					 
				
					 
					if(mysql_fetch_array($result)){
            
				 $_SESSION['logged_in']='true';
				 session_start();
				 $_SESSION['user_email']=$user_email;
					 header('Location:dashboard.php');
					 exit();

					 } else {
					 $error='Incorrect details !!';
					 }
					       }
		}
  



?>

<?php include('include/banner.php');
include('include/navigation.php');
?>

  </head>
    <body>

    	<?php
        $placeholder = "login";
        ?>

        <div class="container" style="margin-top: 140px;">
    <div class="row justify-content-center">
      <div class="col-md-8 mt-n10">
        <div class="border card">
          <div class="card-header bg-info text-white">
            <h4>Admin Login</h4>
          </div>
          <div class="card-body">
            <div id="train_route_div">
            <form ACTION="index.php" METHOD="POST" name="myLoginForm">
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
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
  <input type="submit" class="btn btn-primary" name="adminLogin" >
  
</form>
</div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
     include('include/footer.php');
?>