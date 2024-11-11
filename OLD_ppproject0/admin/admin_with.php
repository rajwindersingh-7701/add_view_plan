<?php
include('php-includes/connect.php');
include('php-includes/check-login.php');
$userid = $_SESSION['userid'];

?>
<?php
//User cliced on join
if(isset($_POST['submit'])){
	
	$status = mysqli_real_escape_string($con,$_POST['status']);
	$time = mysqli_real_escape_string($con,$_POST['time']);
	
		$query = mysqli_query($con,"UPDATE `admin_with` SET `status` = '$status',`time`='$time' WHERE `id` = 1");
		
		
		
		echo '<script>alert("Successfully Update.");window.location.assign("admin_with.php");</script>';
	}
	

?><!--/join user-->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Super Digital Coin  - Update Profile</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

 

<script>function exportF(elem) {
  var table = document.getElementById("table");
  var html = table.outerHTML;
  var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
  elem.setAttribute("href", url);
  elem.setAttribute("download", "user.xls"); // Choose the file name
  return false;
}</script></head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('php-includes/menu.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Profile Update</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                 <?php $us=mysqli_query($con,"SELECT * FROM `admin_with` WHERE id='1'");
						$us_r=mysqli_fetch_array($us);
						?>
                        Current Withdrwal Status: <?php echo  $us_r['status']?><br>
                	<div class="col-lg-9">
                   
                    	<form method="post">
                       
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Withdrwal Status</label>
                                <select  name="status" class="form-control">
                                <option value="<?php echo $us_r['status'];?>"><?php echo $us_r['status'];?></option>
                                <option value="Open">Open</option>
                                <option value="Close">Close</option></select>
                            </div></div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label>Withdrawal Start TIme</label>
                                <input type="text" name="time" class="form-control" value="<?php echo $us_r['time'];?>" required>
                            </div></div>
                            <div class="col-lg-9">
                            <div class="form-group">
                        	<input type="submit" name="submit" class="btn btn-primary" value="Update">
                        </div></div>
                        </form>
                    </div>
                </div><!--/.row-->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
