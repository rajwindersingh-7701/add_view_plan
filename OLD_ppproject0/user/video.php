<?php include('check-login.php');
include('../connect.php');
 $ms=mysqli_query($con,"SELECT * FROM `video` where srno='".$_GET['VID']."'");
      $ms_r=mysqli_fetch_array($ms);
	$date=date('Y-m-d');  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Ad View :: Super Digital Coin</title>
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
  
  <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
  $('#proceed').delay(5000).show(0);   
</script>
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
           <div class="card-title">Ad View</div>
           <hr>
           <?php
		    
		   $ch=mysqli_query($con,"select count(id) from video_view where userid='".$_SESSION['userid']."' and r_date='$date'");
	       $ch_r=mysqli_fetch_array($ch);
	       $tvd=$ch_r['0'];
		   
		    if($_GET['VID']>='11' && $tvd=='10'){?>
           <center><h2>Your today task is successfully completed! Come back tomorrow...</h2><hr>
           <h2>Congratulations you won <u>30/-</u></h2>
           </center>
           <?php }elseif($tvd>='10'){?>
           <center><h2>Your today task is successfully completed! Come back tomorrow...</h2><hr></center>
           <?php }else{?>
            <iframe width="100%" height="450" src="https://www.youtube.com/embed/<?php echo $ms_r['link']; ?>?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            
            <script>setInterval(function() {
  $("#a").hide();
  setTimeout(function() {
    $("#b").fadeIn('normal');
  });
}, 6000);</script>
<style>
#b {
  display: none
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div id="b"><button type="button" id="proceed" style="background:#363;color:#FFF;"><a href="video_view.php?VID=<?php echo $nv=$ms_r['srno'];?>">Next Ad View</a></button></div><?php }?>

         </div>
         </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
           <div class="card-body">
           <div class="card-title">Today Video View</div>
           <hr>
            <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                            	<th scope="col">S.n.</th>
                                <th scope="col">AD Title</th>
                                
                                <th scope="col">Status</th>
                            </tr>
                            <?php 
							$i=1;
							$date=date('Y-m-d');
							 $vd=mysqli_query($con,"SELECT * FROM `video_view` WHERE userid='".$_SESSION['userid']."' and r_date='$date'");
			  while($vd_r=mysqli_fetch_array($vd)){
				  $vn=mysqli_query($con,"select * from video where srno='".$vd_r['srno']."'");
				  $vn_r=mysqli_fetch_array($vn);
			?>
								
                                	<tr>
                                    	<td ><?php echo $i; ?></td>
                                        <td><?php echo $vn_r['name']; ?></td>
                                        <td><?php echo $vd_r['status']; ?></td>
                                        
                                    </tr>
                                <?php
									$i++;
								}?>
                    
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
