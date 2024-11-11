<?php
include('php-includes/connect.php');
include('php-includes/check-login.php');
$userid = $_SESSION['userid'];

?>
<?php
//User cliced on join
if(isset($_POST['submit'])){
	
	$name = mysqli_real_escape_string($con,$_POST['name']);
	$f_name = mysqli_real_escape_string($con,$_POST['f_name']);
	$m_name = mysqli_real_escape_string($con,$_POST['m_name']);
	$nominee = mysqli_real_escape_string($con,$_POST['nominee']);
	$nominee_r = mysqli_real_escape_string($con,$_POST['nominee_r']);
	$dob = mysqli_real_escape_string($con,$_POST['dob']);
	$state = mysqli_real_escape_string($con,$_POST['state']);
	$city = mysqli_real_escape_string($con,$_POST['city']);
	$country = mysqli_real_escape_string($con,$_POST['country']);
	$mob = mysqli_real_escape_string($con,$_POST['mobile']);
	$email = mysqli_real_escape_string($con,$_POST['email']);
	$address = mysqli_real_escape_string($con,$_POST['address']);
	$pincode = mysqli_real_escape_string($con,$_POST['pincode']);
	$password = mysqli_real_escape_string($con,$_POST['password']);
	$trans_pass = mysqli_real_escape_string($con,$_POST['trans_pass']);
	$panno = mysqli_real_escape_string($con,$_POST['panno']);
		$query = mysqli_query($con,"UPDATE `user` SET `name` = '$name',`f_name` = '$f_name',`m_name` = '$m_name',`nominee` = '$nominee',`nominee_r` = '$nominee_r',`dob` = '$dob',`state` = '$state',`city` = '$city',`country` = '$country',`mobile` = '$mob',`email` = '$email',`address` = '$address',`pincode` = '$pincode',`password` = '$password',`trans_pass` = '$trans_pass',`panno`='$panno'  WHERE `loginid` ='".$_POST['us_id']."'");
		
		
		
		echo '<script>alert("Successfully Update.");window.location.assign("user.php");</script>';
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
                	<div class="col-lg-9">
                    <?php $us=mysqli_query($con,"select * from user WHERE `loginid` ='".$_GET['us_id']."'");
					      $us_r=mysqli_fetch_array($us);
						 
					?>
                    	<form method="post">
                        <input type="hidden" name="us_id" value="<?php echo $_GET['us_id'];?>" />
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $us_r['name'];?>" required>
                            </div></div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label>Father Name</label>
                                <input type="text" name="f_name" class="form-control" value="<?php echo $us_r['f_name'];?>" required>
                            </div></div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label>Mother Name</label>
                                <input type="text" name="m_name" class="form-control" value="<?php echo $us_r['m_name'];?>" required>
                            </div></div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label>D.O.B.</label>
                                <input type="text" name="dob" class="form-control" value="<?php echo $us_r['dob'];?>" required>
                            </div></div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label>Pan Card</label>
                                <input type="text" name="panno" class="form-control" value="<?php echo $us_r['panno'];?>" required>
                            </div></div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nominee Name</label>
                                <input type="text" name="nominee" class="form-control" value="<?php echo $us_r['nominee'];?>" required>
                            </div></div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nominee Relation</label>
                                <input type="text" name="nominee_r" class="form-control" value="<?php echo $us_r['nominee_r'];?>" required>
                            </div></div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="number" name="mobile" class="form-control" value="<?php echo $us_r['mobile'];?>" required>
                            </div></div>
                            
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $us_r['email'];?>" required>
                            </div></div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label>State</label>
                                <input type="text" name="state" class="form-control" value="<?php echo $us_r['state'];?>" required>
                            </div></div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" value="<?php echo $us_r['city'];?>" required>
                            </div></div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" name="country" class="form-control" value="<?php echo $us_r['country'];?>" required>
                            </div></div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label>Pincode</label>
                                <input type="number" name="pincode" class="form-control" value="<?php echo $us_r['pincode'];?>" required>
                            </div></div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="number" name="password" class="form-control" value="<?php echo $us_r['password'];?>" required>
                            </div></div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                <label>Transction Password</label>
                                <input type="number" name="trans_pass" class="form-control" value="<?php echo $us_r['trans_pass'];?>" required>
                            </div></div>
                            <div class="col-lg-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" value="<?php echo $us_r['address'];?>" required>
                            </div></div><div class="col-lg-9">
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
