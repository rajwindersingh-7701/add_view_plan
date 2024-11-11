<?php include('check-login.php');
include('../connect.php');
 $ms=mysqli_query($con,"select * from user where loginid='".$_SESSION['userid']."'");
      $ms_r=mysqli_fetch_array($ms);
	  if(isset($_POST['submit'])){
		  $compfile=time().$_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"],"image/".time().$_FILES["image"]["name"]);
		  mysqli_query($con,"UPDATE `user` SET `name`='".$_POST['name']."',`mob`='".$_POST['mob']."',`email`='".$_POST['email']."',`image`='".$compfile."' WHERE loginid='".$_SESSION['userid']."'");
		   mysqli_query($con,"UPDATE `daily_pay` SET `name`='".$_POST['name']."' WHERE userid='".$_SESSION['userid']."'");
		  echo '<script>alert("Update Successfully.");window.location.assign("profile.php");</script>';
	} 
	if(isset($_POST['update'])){
		  mysqli_query($con,"UPDATE `user` SET `bank_name`='".$_POST['bank_name']."',`bank_ac`='".$_POST['bank_ac']."',`ifsc`='".$_POST['ifsc']."',`gpay`='".$_POST['gpay']."',`paytm`='".$_POST['paytm']."',`ppay`='".$_POST['ppay']."',`wallet_name`='".$_POST['wallet_name']."',`wallet_add`='".$_POST['wallet_add']."' WHERE loginid='".$_SESSION['userid']."'");
		  mysqli_query($con,"UPDATE `daily_pay` SET `bank`='".$_POST['bank_name']."',`bank_ac`='".$_POST['bank_ac']."',`ifsc`='".$_POST['ifsc']."' where userid='".$_SESSION['userid']."'");
		  echo '<script>alert("Update Successfully.");window.location.assign("profile.php");</script>';
	} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Profile :: Super Digital Coin</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  
  
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

 <!--Start sidebar-wrapper-->
   <?php include("header.php");?>
<!--End topbar header-->
<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

    <div class="row mt-3">
      <div class="col-lg-6">
         <div class="card">
           <div class="card-body">
           <div class="card-title">Persnol Details</div>
           <hr>
            <form action="" method="post" enctype="multipart/form-data">
           <div class="form-group">
            <label for="input-1">Name</label>
            <input type="text" class="form-control" id="input-1" name="name" value="<?php echo $ms_r['name'];?>" placeholder="Enter Your Name" required>
           </div>
           <div class="form-group">
            <label for="input-2">Email</label>
            <input type="text" class="form-control" id="input-2" name="email" value="<?php echo $ms_r['email'];?>" placeholder="Enter Your Email Address" required>
           </div>
           <div class="form-group">
            <label for="input-3">Mobile</label>
            <input type="text" class="form-control" id="input-3" name="mob" value="<?php echo $ms_r['mob'];?>" placeholder="Enter Your Mobile Number" required>
           </div>
           <div class="form-group">
            <label for="input-3">Upload Photo</label>
            <input type="file" class="form-control" id="input-3" value="<?php echo $ms_r['image'];?>" name="image">
           </div>
           
           <div class="form-group">
            <button type="submit" name="submit" class="btn btn-light px-5"><i class="icon-lock"></i> Update</button>
          </div>
          </form>
         </div>
         </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
           <div class="card-body">
           <div class="card-title">Account Details</div>
           <hr>
            <form action="" method="post">
           <div class="form-group">
            <label for="input-6">Bank Name</label>
            <input type="text" class="form-control form-control-rounded" value="<?php echo $ms_r['bank_name'];?>" name="bank_name" id="input-6" placeholder="Enter Bank Name">
           </div>
           <div class="form-group">
            <label for="input-7">Account Number</label>
            <input type="text" class="form-control form-control-rounded" value="<?php echo $ms_r['bank_ac'];?>" name="bank_ac" id="input-7" placeholder="Enter Bank Account">
           </div>
           <div class="form-group">
            <label for="input-8">IFSC Code</label>
            <input type="text" class="form-control form-control-rounded" value="<?php echo $ms_r['ifsc'];?>" name="ifsc" id="input-8" placeholder="Enter IFSC Code">
           </div>
           <div class="form-group">
            <label for="input-9">Google Pay Number</label>
            <input type="text" class="form-control form-control-rounded" value="<?php echo $ms_r['gpay'];?>" name="gpay" id="input-9" placeholder="Enter Google Pay No.">
           </div>
           <div class="form-group">
            <label for="input-10">Phone Pay Number</label>
            <input type="text" class="form-control form-control-rounded" value="<?php echo $ms_r['ppay'];?>" name="ppay" id="input-10" placeholder="Enter Phone Pay No.">
           </div>
           <div class="form-group">
            <label for="input-10">Paytm Number</label>
            <input type="text" class="form-control form-control-rounded" value="<?php echo $ms_r['paytm'];?>" name="paytm" id="input-10" placeholder="Enter Paytm No.">
           </div>
           <div class="form-group">
            <label for="input-10">Wallet Name</label>
            <input type="text" class="form-control form-control-rounded" value="<?php echo $ms_r['wallet_name'];?>" name="wallet_name" id="input-10" placeholder="Enter Wallet Name">
           </div>
           <div class="form-group">
            <label for="input-10">Wallet Account Number</label>
            <input type="text" class="form-control form-control-rounded" value="<?php echo $ms_r['wallet_add'];?>" name="wallet_add" id="input-10" placeholder="Enter Wallet Number">
           </div>
           
           <div class="form-group">
            <button type="submit" name="update" class="btn btn-light btn-round px-5"><i class="icon-lock"></i> Update</button>
          </div>
          </form>
         </div>
         </div>
      </div>
    </div><!--End Row-->

	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->

    </div>
    <!-- End container-fluid-->
    
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--Start footer-->
	<footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2021 SDC
        </div>
      </div>
    </footer>
	<!--End footer-->
	
	<!--start color switcher-->
   <div class="right-sidebar">
    <div class="switcher-icon">
      <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">

      <p class="mb-0">Gaussion Texture</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme1"></li>
        <li id="theme2"></li>
        <li id="theme3"></li>
        <li id="theme4"></li>
        <li id="theme5"></li>
        <li id="theme6"></li>
      </ul>

      <p class="mb-0">Gradient Background</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme7"></li>
        <li id="theme8"></li>
        <li id="theme9"></li>
        <li id="theme10"></li>
        <li id="theme11"></li>
        <li id="theme12"></li>
		<li id="theme13"></li>
        <li id="theme14"></li>
        <li id="theme15"></li>
      </ul>
      
     </div>
   </div>
  <!--end color switcher-->
   
  </div><!--End wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	
 <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
	
</body>
</html>
