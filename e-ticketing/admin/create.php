<?php require_once('../Connections/neticketing.php'); ?>
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user_email'])) {
    ?>



<?php include('include/banner.php');
include('include/navigation.php');
?>

  </head>
    <body>
    	<?php
        $placeholder = "create";
        ?>

   <div class="container" style="margin-top: 140px;">

    <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="border card">
        <div class="card-header bg-info text-white">
          <h4>Add New Launch</h4>
        </div>
        <div class="card-body pt-2 pb-1">
        	
        	<form ACTION="model/create.php" METHOD="POST" name="myLoginForm" class="form-horizontal">
                                            <div class="form-group">
                                                <label class="control-label" for="launch_id">Launch Id</label>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="launch_id" id="launch_id" value="MV-<?php echo uniqid();?>"
                                                           disabled="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="launch_name">Launch Name</label>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="launch_name" id="launch_name" value=""
                                                           required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="source">Source</label>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="source" id="source" value=""
                                                           required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="destination">Destination</label>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="destination" id="destination" value=""
                                                           required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="dept_time">Departure Time</label>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="dept_time" id="dept_time" value=""
                                                           required>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="controls">					
                                                    <input type="submit" name="Save" value="Save" class="btn btn-success">
                                                </div>
                                            </div>
                                    </form>

        </div>
    </div>


    <div class="border card mt-5">
        <div class="card-header bg-info text-white">
          <h4>Add Seat Category</h4>
        </div>
        <div class="card-body pt-2 pb-1">

        		<form ACTION="model/create.php" METHOD="POST" name="myLoginForm" class="form-horizontal">
                                        <fieldset>
                                            <legend>Add Seat Category</legend>
                                            <div class="control-group">
                                                <label class="control-label" for="launch_id">Launch ID</label>
                                                <div class="controls">
                                                    <input type="text" name="launch_id" id="launch_id" value=""
                                                           required>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="catagory_name">Category Name</label>
                                                <div class="controls">
                                                    <input type="text" name="catagory_name" id="catagory_name" value=""
                                                           required>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="price">Price</label>
                                                <div class="controls">
                                                    <input type="text" name="price" id="price" value=""
                                                           required>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="capacity_amount">Capacity Amount</label>
                                                <div class="controls">
                                                    <input type="text" name="capacity_amount" id="capacity_amount"
                                                           value="" required>
                                                </div>
                                            </div>
                                            <input type="hidden" name="catagory_id" value=""/>
                                            <input type="hidden" name="flag" value="1"/>
                                            
                                            <div class="control-group">
                                                <div class="controls">					
                                                    <input type="submit" name="adminLogin" value="Update" class="btn"><p></P>
                                                    <!--<p>Don't Have an Account?<a href="registration.php"> Sign Up Here</a></p>-->  
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
        	
        	
        </div>
    </div>

    </div>
    </div>
    </div>

    <?php 
     include('include/footer.php');
?>
        <?php
} else {
    header("Location:http://localhost/ticketing/admin/");
}
?>



<!-- <form ACTION="model/create.php" METHOD="POST" name="myLoginForm" class="form-horizontal">
                                            <div class="form-group">
                                                <label class="control-label" for="launch_id">Launch ID</label>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="launch_id" id="launch_id" value=""
                                                           required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="catagory_name">Category Name</label>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="catagory_name" id="catagory_name" value=""
                                                           required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="price">Price</label>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="price" id="price" value=""
                                                           required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="capacity_amount">Capacity Amount</label>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="capacity_amount" id="capacity_amount"
                                                           value="" required>
                                                </div>
                                            </div>
                                            <input type="hidden" name="catagory_id" value=""/>
                                            <input type="hidden" name="flag" value="1"/>
                                            
                                            <div class="form-group">
                                                <div class="controls">					
                                                    <input type="submit" name="adminLogin" value="Update" class="btn btn-success"> 
                                                </div>
                                            </div>
                                    </form> -->