<?php include('check-login.php');
include('../connect.php');
 $ms=mysqli_query($con,"select * from user where loginid='".$_SESSION['userid']."'");
      $ms_r=mysqli_fetch_array($ms); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Active Team :: Super Digital Coin</title>
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
     
    <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" style="float:left">Active Team</h5>
              
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      
                      <th scope="col">Level</th>
                      <th scope="col" style="background:#24ea8770">Active</th>
                      <th scope="col" style="background:#9006">In-Active</th>
                      <th scope="col" style="background:#ece0248a">Total</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  
                    <tr>
                      <th scope="row">Level 1</th>
                      <td style="background:#24ea8770"><?php $av1=mysqli_query($con,"SELECT count('id') FROM `lvl1` where lvl='".$_SESSION['userid']."' and status='Active'");
					                               $av1_r=mysqli_fetch_array($av1);
												   echo $av1_r['0'];
					  ?></td>
                      <td style="background:#9006"><?php $uv1=mysqli_query($con,"SELECT count('id') FROM `lvl1` where lvl='".$_SESSION['userid']."' and status='Unactive'");
					                               $uv1_r=mysqli_fetch_array($uv1);
												   echo $uv1_r['0'];
					  ?></td>
                      <td style="background:#ece0248a"><?php $tv1=mysqli_query($con,"SELECT count('id') FROM `lvl1` where lvl='".$_SESSION['userid']."'");
					                               $tv1_r=mysqli_fetch_array($tv1);
												   echo $tv1_r['0'];
					  ?></td>
                     
                      
                    </tr>
                    <tr>
                      <th scope="row">Level 2</th>
                      <td style="background:#24ea8770"><?php $av2=mysqli_query($con,"SELECT count('id') FROM `lvl2` where lvl='".$_SESSION['userid']."' and status='Active'");
					                               $av2_r=mysqli_fetch_array($av2);
												   echo $av2_r['0'];
					  ?></td>
                      <td style="background:#9006"><?php $uv2=mysqli_query($con,"SELECT count('id') FROM `lvl2` where lvl='".$_SESSION['userid']."' and status='Unactive'");
					                               $uv2_r=mysqli_fetch_array($uv2);
												   echo $uv2_r['0'];
					  ?></td>
                      <td style="background:#ece0248a"><?php $tv2=mysqli_query($con,"SELECT count('id') FROM `lvl2` where lvl='".$_SESSION['userid']."'");
					                               $tv2_r=mysqli_fetch_array($tv2);
												   echo $tv2_r['0'];
					  ?></td>
                     
                      
                    </tr>
                    <tr>
                      <th scope="row">Level 3</th>
                      <td style="background:#24ea8770"><?php $av3=mysqli_query($con,"SELECT count('id') FROM `lvl3` where lvl='".$_SESSION['userid']."' and status='Active'");
					                               $av3_r=mysqli_fetch_array($av3);
												   echo $av3_r['0'];
					  ?></td>
                      <td style="background:#9006"><?php $uv1=mysqli_query($con,"SELECT count('id') FROM `lvl3` where lvl='".$_SESSION['userid']."' and status='Unactive'");
					                               $uv1_r=mysqli_fetch_array($uv1);
												   echo $uv1_r['0'];
					  ?></td>
                      <td style="background:#ece0248a"><?php $tv3=mysqli_query($con,"SELECT count('id') FROM `lvl3` where lvl='".$_SESSION['userid']."'");
					                               $tv3_r=mysqli_fetch_array($tv3);
												   echo $tv3_r['0'];
					  ?></td>
                     
                      
                    </tr>
                    <tr>
                      <th scope="row">Level 4</th>
                      <td style="background:#24ea8770"><?php $av4=mysqli_query($con,"SELECT count('id') FROM `lvl4` where lvl='".$_SESSION['userid']."' and status='Active'");
					                               $av4_r=mysqli_fetch_array($av4);
												   echo $av4_r['0'];
					  ?></td>
                      <td style="background:#9006"><?php $uv1=mysqli_query($con,"SELECT count('id') FROM `lvl4` where lvl='".$_SESSION['userid']."' and status='Unactive'");
					                               $uv1_r=mysqli_fetch_array($uv1);
												   echo $uv1_r['0'];
					  ?></td>
                      <td style="background:#ece0248a"><?php $tv4=mysqli_query($con,"SELECT count('id') FROM `lvl4` where lvl='".$_SESSION['userid']."'");
					                               $tv4_r=mysqli_fetch_array($tv4);
												   echo $tv4_r['0'];
					  ?></td>
                     
                      
                    </tr>
                    <tr>
                      <th scope="row">Level 5</th>
                      <td style="background:#24ea8770"><?php $av5=mysqli_query($con,"SELECT count('id') FROM `lvl5` where lvl='".$_SESSION['userid']."' and status='Active'");
					                               $av5_r=mysqli_fetch_array($av5);
												   echo $av5_r['0'];
					  ?></td>
                      <td style="background:#9006"><?php $uv5=mysqli_query($con,"SELECT count('id') FROM `lvl5` where lvl='".$_SESSION['userid']."' and status='Unactive'");
					                               $uv5_r=mysqli_fetch_array($uv5);
												   echo $uv5_r['0'];
					  ?></td>
                      <td style="background:#ece0248a"><?php $tv5=mysqli_query($con,"SELECT count('id') FROM `lvl5` where lvl='".$_SESSION['userid']."'");
					                               $tv5_r=mysqli_fetch_array($tv5);
												   echo $tv5_r['0'];
					  ?></td>
                     
                      
                    </tr>
                    <tr>
                      <th scope="row">Level 6</th>
                      <td style="background:#24ea8770"><?php $av6=mysqli_query($con,"SELECT count('id') FROM `lvl6` where lvl='".$_SESSION['userid']."' and status='Active'");
					                               $av6_r=mysqli_fetch_array($av6);
												   echo $av6_r['0'];
					  ?></td>
                      <td style="background:#9006"><?php $uv6=mysqli_query($con,"SELECT count('id') FROM `lvl6` where lvl='".$_SESSION['userid']."' and status='Unactive'");
					                               $uv6_r=mysqli_fetch_array($uv6);
												   echo $uv6_r['0'];
					  ?></td>
                      <td style="background:#ece0248a"><?php $tv6=mysqli_query($con,"SELECT count('id') FROM `lvl6` where lvl='".$_SESSION['userid']."'");
					                               $tv6_r=mysqli_fetch_array($tv6);
												   echo $tv6_r['0'];
					  ?></td>
                     
                      
                    </tr>
                    <tr>
                      <th scope="row">Level 7</th>
                      <td style="background:#24ea8770"><?php $av7=mysqli_query($con,"SELECT count('id') FROM `lvl7` where lvl='".$_SESSION['userid']."' and status='Active'");
					                               $av7_r=mysqli_fetch_array($av7);
												   echo $av7_r['0'];
					  ?></td>
                      <td style="background:#9006"><?php $uv7=mysqli_query($con,"SELECT count('id') FROM `lvl7` where lvl='".$_SESSION['userid']."' and status='Unactive'");
					                               $uv7_r=mysqli_fetch_array($uv7);
												   echo $uv7_r['0'];
					  ?></td>
                      <td style="background:#ece0248a"><?php $tv7=mysqli_query($con,"SELECT count('id') FROM `lvl7` where lvl='".$_SESSION['userid']."'");
					                               $tv7_r=mysqli_fetch_array($tv7);
												   echo $tv7_r['0'];
					  ?></td>
                     
                      
                    </tr>
                    <tr>
                      <th scope="row">Level 8</th>
                      <td style="background:#24ea8770"><?php $av8=mysqli_query($con,"SELECT count('id') FROM `lvl8` where lvl='".$_SESSION['userid']."' and status='Active'");
					                               $av8_r=mysqli_fetch_array($av8);
												   echo $av8_r['0'];
					  ?></td>
                      <td style="background:#9006"><?php $uv8=mysqli_query($con,"SELECT count('id') FROM `lvl8` where lvl='".$_SESSION['userid']."' and status='Unactive'");
					                               $uv8_r=mysqli_fetch_array($uv8);
												   echo $uv8_r['0'];
					  ?></td>
                      <td style="background:#ece0248a"><?php $tv8=mysqli_query($con,"SELECT count('id') FROM `lvl8` where lvl='".$_SESSION['userid']."'");
					                               $tv8_r=mysqli_fetch_array($tv8);
												   echo $tv8_r['0'];
					  ?></td>
                     
                      
                    </tr>
                    <tr>
                      <th scope="row">Level 9</th>
                      <td style="background:#24ea8770"><?php $av9=mysqli_query($con,"SELECT count('id') FROM `lvl9` where lvl='".$_SESSION['userid']."' and status='Active'");
					                               $av9_r=mysqli_fetch_array($av9);
												   echo $av9_r['0'];
					  ?></td>
                      <td style="background:#9006"><?php $uv9=mysqli_query($con,"SELECT count('id') FROM `lvl9` where lvl='".$_SESSION['userid']."' and status='Unactive'");
					                               $uv9_r=mysqli_fetch_array($uv9);
												   echo $uv9_r['0'];
					  ?></td>
                      <td style="background:#ece0248a"><?php $tv9=mysqli_query($con,"SELECT count('id') FROM `lvl9` where lvl='".$_SESSION['userid']."'");
					                               $tv9_r=mysqli_fetch_array($tv9);
												   echo $tv9_r['0'];
					  ?></td>
                     
                      
                    </tr>
                    <tr>
                      <th scope="row">Level 10</th>
                      <td style="background:#24ea8770"><?php $av10=mysqli_query($con,"SELECT count('id') FROM `lvl10` where lvl='".$_SESSION['userid']."' and status='Active'");
					                               $av10_r=mysqli_fetch_array($av10);
												   echo $av10_r['0'];
					  ?></td>
                      <td style="background:#9006"><?php $uv10=mysqli_query($con,"SELECT count('id') FROM `lvl10` where lvl='".$_SESSION['userid']."' and status='Unactive'");
					                               $uv10_r=mysqli_fetch_array($uv10);
												   echo $uv10_r['0'];
					  ?></td>
                      <td style="background:#ece0248a"><?php $tv10=mysqli_query($con,"SELECT count('id') FROM `lvl10` where lvl='".$_SESSION['userid']."'");
					                               $tv10_r=mysqli_fetch_array($tv10);
												   echo $tv10_r['0'];
					  ?></td>
                     
                      
                    </tr>
                    
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
