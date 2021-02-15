<?php require_once('../Connections/neticketing.php'); ?>
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user_email'])) {
    $id = $_GET['id'];
    $flag = $_GET['flag'];

    if ($flag == 0) {
        $query = "SELECT * FROM launch_info WHERE launch_id = '" . $id . "'";
        $result = mysql_query($query);
        $allLaunchInfo = mysql_fetch_assoc($result);

    }

    if ($flag == 1) {
        $launch_id = $_GET['launch_id'];
        $query_seat = "SELECT * FROM seat_catagory WHERE catagory_id = '" . $id . "'";
        
    }
    ?>


<?php include('include/banner.php');
include('include/navigation.php');
?>

  </head>
    <body>


        <?php
    $placeholder = "dashboard";
    ?>

    <div class="container" style="margin-top: 140px;">
    <div class="row justify-content-center">
      <div class="col-md-8 mt-n10">
        <div class="border card">
          <div class="card-header bg-info text-white">
            <h4>Update Launch Information</h4>
          </div>
          <div class="card-body">
              
            <?php
                if ($flag == 0) {
                    ?>
                    <div id="dashboard" style="margin-top: 30px; ">
                        <div>
                            <div>
                                <div id="trainroute" style="margin-top: 30px;">
                                    <div id="train_route_div">
                                        <form ACTION="model/edit.php" METHOD="POST" name="myLoginForm" class="form-horizontal">
                                            <fieldset>
                                                
                                                <div class="form-group">
                                                    <label class="control-label" for="launch_id">Launch Id</label>
                                                    <div class="controls">
                                                        <input class= "form-control" type="text" name="launch_id" id="launch_id" value="<?php echo $allLaunchInfo['launch_id']; ?>"
                                                               disabled="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="launch_name">Launch Name</label>
                                                    <div class="controls">
                                                        <input class= "form-control" type="text" name="launch_name" id="launch_name" value="<?php echo $allLaunchInfo['launch_name']; ?>"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="source">Source</label>
                                                    <div class="controls">
                                                        <input class= "form-control" type="text" name="source" id="source" value="<?php echo $allLaunchInfo['source']; ?>"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="destination">Destination</label>
                                                    <div class="controls">
                                                        <input class= "form-control" type="text" name="destination" id="destination" value="<?php echo $allLaunchInfo['destination']; ?>"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="dept_time">Departure Time</label>
                                                    <div class="controls">
                                                        <input class= "form-control" type="text" name="dept_time" id="dept_time" value="<?php echo $allLaunchInfo['dept_time']; ?>"
                                                               required>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="flag" value="0"/>
                                                <input type="hidden" name="launch_id" value="<?php echo $allLaunchInfo['launch_id']; ?>"/>
                                                <div class="control-group">
                                                    <div class="controls">                  
                                                        <input type="submit" name="upadte" value="Update" class="btn btn-success"> 
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <br/>
                    </div>
                <?php } ?>
                <!-- DIV end for Dashboard --> 

                <?php
                if ($flag == 1) {
                    ?>
                    <div class="title_home">
                        <font style="padding-left: 10px; font-family: arial; font-size: 16px; font-weight: bold; color: #000; text-align: center">
                        <?php $result_seat = mysql_query($query_seat);
                          if($result_seat){$seat = mysql_fetch_assoc($result_seat);}
                          ?>
                        </font>
                    </div>
                    <div id="dashboard" style="margin-top: 30px; ">

                        <div>
                            <div>
                                <div id="trainroute" style="margin-top: 30px;">
                                    <div id="train_route_div">
                                        <form ACTION="model/edit.php" METHOD="POST" name="myLoginForm" class="form-horizontal">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label class="control-label" for="launchName">Launch Name</label>
                                                    <div class="controls">
                                                        <input class= "form-control" type="text" name="launch_name" id="launchName" value="<?php echo $seat['launch_name']; ?>"
                                                               disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="catagory_name">Category Name</label>
                                                    <div class="controls">
                                                        <input class= "form-control" type="text" name="catagory_name" id="catagory_name" value="<?php echo $seat['catagory_name']; ?>"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="price">Price</label>
                                                    <div class="controls">
                                                        <input class= "form-control" type="text" name="price" id="price" value="<?php echo $seat['price']; ?>"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="capacity_amount">Capacity Amount</label>
                                                    <div class="controls">
                                                        <input class= "form-control" type="text" name="capacity_amount" id="capacity_amount"
                                                               value="<?php echo $seat['capacity_amount']; ?>" required>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="catagory_id" value="<?php echo $seat['catagory_id']; ?>"/>
                                                <input type="hidden" name="flag" value="1"/>
                                                <input type="hidden" name="launch_id" value="<?php echo $launch_id;?>"/>
                                                <div class="control-group">
                                                    <div class="controls">                  
                                                        <input type="submit" name="adminLogin" value="Update" class="btn btn-success"> 
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <br/>
                    </div>
                <?php } ?>
            </div>

          </div>


</div>
</div>
</div>


<?php 
     include('include/footer.php');
?>


<?php 
}
  else {
    header("Location:http://ttp://localhost/ticketing/admin/");
}
?>