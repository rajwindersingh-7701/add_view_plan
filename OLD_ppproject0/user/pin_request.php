<?php include('check-login.php');
include('../connect.php');
 $ms=mysqli_query($con,"select * from user where loginid='".$_SESSION['userid']."'");
      $ms_r=mysqli_fetch_array($ms);
	  $email=$_SESSION['userid'];
	  //pin request 
if(isset($_POST['pin_request'])){
	$amount1 = mysqli_real_escape_string($con,$_POST['amount']);
	$nopin = mysqli_real_escape_string($con,$_POST['nopin']);
	$amount=$amount1*$nopin;
	$date = date("y-m-d");
	if($amount!=''){
		//Inset the value to pin request
		$query = mysqli_query($con,"insert into pin_request(`email`,`amount`,`pintype`,`date`) values('$email','$amount','$amount1','$date')");
		if($query){
			echo '<script>alert("Pin request sent successfully");window.location.assign("pin_request.php");</script>';
		}
		else{
			//echo mysqli_error($con);
			echo '<script>alert("Unknown error occure.");window.location.assign("pin_request.php");</script>';
	}
	}
	else{
		echo '<script>alert("Please fill all the fields");</script>';
	}
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
           <div class="card-title">Pin Request</div>
           <hr>
            <form action="" method="post" enctype="multipart/form-data">
           <div class="form-group">
            <label for="input-1">Pin Type</label>
            <select name="amount" class="form-control" required>
                                <option value="">Select Pin Type</option>
                                <option value="450">450</option>
                                
                                
                                </select>
           </div>
           <div class="form-group">
            <label for="input-2">Enter No. Of Pin</label>
            <input type="text" class="form-control" id="input-2" name="nopin"  placeholder="Enter No. Of Pin" required>
           </div>
           
           
           <div class="form-group">
            <button type="submit" name="pin_request" class="btn btn-light px-5"><i class="icon-lock"></i> Submit</button>
          </div>
          </form>
         </div>
         </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
           <div class="card-body">
           <div class="card-title">Pin Details</div>
           <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                            	<th scope="col">S.n.</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                            </tr>
                            <?php 
							$i=1;
							$query = mysqli_query($con,"select * from pin_request where email='$email' order by id desc");
							if(mysqli_num_rows($query)>0){
								while($row=mysqli_fetch_array($query)){
									$amount = $row['amount'];
									$date = $row['date'];
									$status = $row['status'];
								?>
                                	<tr>
                                    	<td ><?php echo $i; ?></td>
                                        <td><?php echo $amount; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td><?php echo $status; ?></td>
                                    </tr>
                                <?php
									$i++;
								}
							}
							else{
							?>
                            	<tr>
                                	<td colspan="4">You have no pin request yet.</td>
                                </tr>
                            <?php
							}
							?>
                    
                  </tbody>
                </table>
              </div>
         </div>
         </div>
      </div>
      <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" >Pin History</h5>
              
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                                	<th scope="col">S.n.</th>
                                    <th scope="col">Pin</th>
                                    <th scope="col">Pin Type</th>
                                </tr>
                                <?php
									$i=1;
									$query = mysqli_query($con,"select * from pin_list where userid='$email' and status='open'");
									if(mysqli_num_rows($query)>0){
										while($row=mysqli_fetch_array($query)){
											$pin = $row['pin'];
											$pintype = $row['pintype'];
										?>
                                        	<tr>
                                            	<td><?php echo $i ?></td>
                                                <td><?php echo $pin ?></td>
                                                <td><?php echo $pintype ?></td>
                                            </tr>
                                        <?php
											$i++;
										}
									}
									else{
									?>
                                    	<tr>
                                        	<td colspan="2">Sorry you have no pin.</td>
                                        </tr>
                                    <?php
									}
								?>
                    
                  </tbody>
                </table>
              </div>
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
