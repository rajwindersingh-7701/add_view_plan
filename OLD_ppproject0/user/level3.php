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
  <title>Level Team :: Super Digital Coin</title>
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
              <h5 class="card-title" style="float:left">Direct Sponser</h5>
              <h5 class="card-title" style="float:right">Level <a href="direct.php">1</a> ||
              <a href="level.php">2</a> || 
              <a href="level2.php">3</a> ||
               <a href="level3.php">4</a> || 
               <a href="level4.php">5</a> || 
               <a href="level5.php">6</a> || 
               <a href="level6.php">7</a> || 
               <a href="level7.php">8</a> || 
               <a href="level8.php">9</a> || 
               <a href="level9.php">10</a>  </h5>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Loginid</th>
                      <th scope="col">Mobile Number</th>
                      <th scope="col">Act Status</th>
                      <th scope="col">Act Date</th>
                      <th scope="col">Reg Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $lv=mysqli_query($con,"SELECT * FROM `lvl4` where lvl='".$_SESSION['userid']."'");
				         $i=0;
						 while($lv_r=mysqli_fetch_array($lv)){
							 $i++;
							 $nm=mysqli_query($con,"select * from user where loginid='".$lv_r['userid']."'");
							 $nm_r=mysqli_fetch_array($nm);
				  ?>
                    <tr>
                      <th scope="row"><?php echo $i;?></th>
                      <td><?php echo $nm_r['name'];?></td>
                      <td><?php echo $nm_r['loginid'];?></td>
                      <td><?php echo $nm_r['mob'];?></td>
                      <td><?php if($nm_r['status']=='Active'){ echo 'Active'; }else{ echo 'In-Active';}?></td>
                      <td><?php echo $nm_r['act_date'];?></td>
                      <td><?php echo $nm_r['r_date'];?></td>
                    </tr><?php }?>
                    
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
