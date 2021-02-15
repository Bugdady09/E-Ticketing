<?php require_once('Connections/neticketing.php'); ?>
<?php
if (!isset($_SESSION)) {
    session_start();
    $userEmail = $_SESSION['user_email'];
}

if (isset($_SESSION['passMsg']) && !empty($_SESSION['passMsg'])) {
    ?>
    <script>alert("<?php echo $_SESSION['passMsg']; ?>");</script>
    <?php
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
          <div class="card-header bg-info text-white">
            <h4>Change Password</h4>
          </div>
          <div class="card-body">
            
          	<div id="trainroute" style="margin-top: 30px;
                     ">
                    <div id="train_route_div">
                        <form ACTION="passwordChanged.php" METHOD="POST" name="myLoginForm" class="form-horizontal">
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="currPassword">Current Password</label>
                                    <div class="controls">
                                        <input class="form-control" type="password" name="currPassword" id="currPassword" 
                                               required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputPassword">New Password</label>
                                    <div class="controls">
                                        <input class="form-control" type="password" name="inputPassword" id="inputPassword"
                                               required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="confirmPassword">Confirm Password</label>
                                    <div class="controls">
                                        <input class="form-control" type="password" name="confirmPassword" id="confirmPassword"
                                               required>
                                    </div>
                                </div>
                                <input type="hidden" name="userEmail" value="<?php echo $userEmail; ?>"/>
                                <input type="submit" class="btn btn-success btn-lg mt-3" value="Save">
                            </fieldset>
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