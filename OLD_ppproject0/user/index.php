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
  <title>Dashboard <?php echo $ms_r['name'];?> :: superditialcoin.com</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- Vector CSS -->
  <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
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
 
<!-- Start wrapper-->
 <div id="wrapper">
 
  <!--Start sidebar-wrapper-->
   <?php include("header.php");?>
<!--End topbar header-->

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
<marquee behavior="scroll" direction="left" scrollamount="3" style="color:#F00;font-size:15px;font-weight:800;">
						<?php  $nw=mysqli_query($con,"select * from news order by id desc");
						while($nw_r=mysqli_fetch_array($nw)){
							echo $nw_r['title'];?>&nbsp; &nbsp; &nbsp; &nbsp;<?php }?>
						</marquee><br>
  <!--Start Dashboard Content-->
REFERRAL LINK: <input style="width:50%" type="text" value="https://superdigitalcoins.com/register.php?sponser=<?php echo $_SESSION['userid'];?>" id="myInput"><button onclick="myFunction()" style="background:none;border:none"><i class="fa fa-file-o" aria-hidden="true" style="color: #ff9205;font-size: 20px;"></i></button>
<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied");
}
</script><br><?php if($ms_r['re_status']=='Active' && $ms_r['status']=='Unactive'){?><br>
<center>
     <div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="row m-0 row-group text-center border-top border-light-3">
		   <div class="col-12 col-lg-12">
		     <div class="p-3"><i class="zmdi zmdi-run" style="font-size:45px;color:#006600"></i>
		       <h5 class="mb-0">If do you want Re-TopUp your account click Re-TopUp Button<br> <a href="re_topup.php"><input type="button" value="Re-TopUp" /></a></h5>
			   <small class="mb-0">Re-TopUp  </small>
		     </div>
		   </div>
		   </div>
		 </div>
	 </div></center><?php }?>
	<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-4 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?php echo $ms_r['loginid'];?> <span class="float-right"><i class="fa fa-user"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">User ID </p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-4 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?php echo $ms_r['sponser_id'];?> <span class="float-right"><i class="fa fa-users"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Sponser ID </p>
                </div>
            </div>
            
            <div class="col-12 col-lg-6 col-xl-4 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?php if($ms_r['status']=='Active'){ echo '1000'; }else{ echo '000';}?> <span class="float-right"><i class="fa fa-cart-plus"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Activated SDC </p>
                </div>
            </div>
            
            <?php $li=mysqli_query($con,"select sum(amount) from level_in  where userid='".$_SESSION['userid']."'");
                  $li_r=mysqli_fetch_array($li);
				  $lv_in=$li_r['0'];
				 //self
				 $sf=mysqli_query($con,"select sum(amount) from self_in  where userid='".$_SESSION['userid']."'");
                  $sf_r=mysqli_fetch_array($sf);
				  $sf_in=$sf_r['0'];
				  //withdrwal
				  $wt=mysqli_query($con,"SELECT sum(amount) FROM `withdrwal` where user_id='".$_SESSION['userid']."'");
				  $wt_r=mysqli_fetch_array($wt);
				  $wtt=$wt_r['0'];
				  
		    ?>
            
        </div>
    </div>
 </div>  
	  <div class="row">
     <div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="row m-0 row-group text-center border-top border-light-3">
		   <div class="col-12 col-lg-12">
		     <div class="p-3"><i class="icon-wallet mr-2" style="font-size:45px;color:#F86105"></i>
		       <h5 class="mb-0"><?php echo $tl=$lv_in+$sf_in;?></h5>
			   <small class="mb-0">Total Income  </small>
		     </div>
		   </div>
		   </div>
		 </div>
	 </div>

     <div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="row m-0 row-group text-center border-top border-light-3">
		   <div class="col-12 col-lg-12">
		     <div class="p-3"><i class="icon-wallet mr-2 text-success" style="font-size:45px;"></i>
		       <h5 class="mb-0"><?php  $tl=$lv_in+$sf_in; echo $fttu=$tl-$wtt;?></h5>
			   <small class="mb-0">Current Balance   </small>
		     </div>
		   </div>
		   </div>
		 </div>
	 </div>
     <div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="row m-0 row-group text-center border-top border-light-3">
		   <div class="col-12 col-lg-12">
		     <div class="p-3"><i class="icon-wallet mr-2 " style="font-size:45px;;color:#D2061B"></i>
		       <h5 class="mb-0"><?php echo $wtt;?></h5>
			   <small class="mb-0">Total Withdrwal </small>
		     </div>
		   </div>
		   </div>
		 </div>
	 </div>
     <div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="row m-0 row-group text-center border-top border-light-3">
		   <div class="col-12 col-lg-12">
		     <div class="p-3"><i class="zmdi zmdi-accounts-list-alt" style="font-size:45px;;color:#BFCC7E"></i>
		       <h5 class="mb-0"><?php $re=mysqli_query($con,"SELECT sum(amount) FROM `re_wallet` where userid='".$_SESSION['userid']."'");
				  $re_r=mysqli_fetch_array($re);
				  echo $ret=$re_r['0'];?></h5>
			   <small class="mb-0">Re-Purchase Withdrwal </small>
		     </div>
		   </div>
		   </div>
		 </div>
	 </div>
     <div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="row m-0 row-group text-center border-top border-light-3">
		   <div class="col-12 col-lg-12">
		     <div class="p-3"><img src="assets/images/logo-icon.png" width="14%" />
		       <h5 class="mb-0"><?php $lv1=mysqli_query($con,"SELECT sum(sdc_coin) FROM `lvl1` WHERE lvl='".$_SESSION['userid']."' and status='Active'");
	                                  $lv_r1=mysqli_fetch_array($lv1);
	                                  $tlv1=$lv_r1[0];
									  $lv2=mysqli_query($con,"SELECT sum(sdc_coin) FROM `lvl2` WHERE lvl='".$_SESSION['userid']."' and status='Active'");
	                                  $lv_r2=mysqli_fetch_array($lv2);
	                                  $tlv2=$lv_r2[0];
									  $lv3=mysqli_query($con,"SELECT sum(sdc_coin) FROM `lvl3` WHERE lvl='".$_SESSION['userid']."' and status='Active'");
	                                  $lv_r3=mysqli_fetch_array($lv3);
	                                  $tlv3=$lv_r3[0];
									  $lv4=mysqli_query($con,"SELECT sum(sdc_coin) FROM `lvl4` WHERE lvl='".$_SESSION['userid']."' and status='Active'");
	                                  $lv_r4=mysqli_fetch_array($lv4);
	                                  $tlv4=$lv_r4[0];
									  $lv5=mysqli_query($con,"SELECT sum(sdc_coin) FROM `lvl5` WHERE lvl='".$_SESSION['userid']."' and status='Active'");
	                                  $lv_r5=mysqli_fetch_array($lv5);
	                                  $tlv5=$lv_r5[0];
									  $lv6=mysqli_query($con,"SELECT sum(sdc_coin) FROM `lvl6` WHERE lvl='".$_SESSION['userid']."' and status='Active'");
	                                  $lv_r6=mysqli_fetch_array($lv6);
	                                  $tlv6=$lv_r6[0];
									  $lv7=mysqli_query($con,"SELECT sum(sdc_coin) FROM `lvl7` WHERE lvl='".$_SESSION['userid']."' and status='Active'");
	                                  $lv_r7=mysqli_fetch_array($lv7);
	                                  $tlv7=$lv_r7[0];
									  $lv8=mysqli_query($con,"SELECT sum(sdc_coin) FROM `lvl8` WHERE lvl='".$_SESSION['userid']."' and status='Active'");
	                                  $lv_r8=mysqli_fetch_array($lv8);
	                                  $tlv8=$lv_r8[0];
									  $lv9=mysqli_query($con,"SELECT sum(sdc_coin) FROM `lvl9` WHERE lvl='".$_SESSION['userid']."' and status='Active'");
	                                  $lv_r9=mysqli_fetch_array($lv9);
	                                  $tlv9=$lv_r9[0];
									  $lv10=mysqli_query($con,"SELECT sum(sdc_coin) FROM `lvl10` WHERE lvl='".$_SESSION['userid']."' and status='Active'");
	                                  $lv_r10=mysqli_fetch_array($lv10);
	                                  $tlv10=$lv_r10[0];
									  $msd=mysqli_query($con,"SELECT sum(amount) FROM `sdc_income` WHERE userid='".$_SESSION['userid']."' ");
                                      $msd_r=mysqli_fetch_array($msd);
									  $tlv11=$msd_r[0]; 
									  echo $tsdc=$tlv1+$tlv2+$tlv3+$tlv4+$tlv5+$tlv6+$tlv7+$tlv8+$tlv9+$tlv10+$tlv11;
	                             ?></h5>
			   <small class="mb-0">Total SDC Coin </small>
		     </div>
		   </div>
		   </div>
		 </div>
	 </div>
     <div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="row m-0 row-group text-center border-top border-light-3">
		   <div class="col-12 col-lg-12">
		     <div class="p-3"><i class="icon-credit-card mr-2 " style="font-size:45px;;color:#A842CA"></i>
		       <h5 class="mb-0"><?php echo $sf_in;?></h5>
			   <small class="mb-0">Self Income </small>
		     </div>
		   </div>
		   </div>
		 </div>
	 </div>
     <div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="row m-0 row-group text-center border-top border-light-3">
		   <div class="col-12 col-lg-12">
		     <div class="p-3"><i class="zmdi zmdi-slideshare " style="font-size:45px;;color:#D2CF06"></i>
		       <h5 class="mb-0"><?php echo $lv_in;?></h5>
			   <small class="mb-0">Level Income  </small>
		     </div>
		   </div>
		   </div>
		 </div>
	 </div>
     <div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="row m-0 row-group text-center border-top border-light-3">
		   <div class="col-12 col-lg-12">
		     <div class="p-3"><i class="icon-trophy mr-2 " style="font-size:45px;;color:#267CD7"></i>
		       <h5 class="mb-0">000</h5>
			   <small class="mb-0">Bonaza   </small>
		     </div>
		   </div>
		   </div>
		 </div>
	 </div>
     
	</div>
	<!--End Row-->
	
	<!--End Row-->

      <!--End Dashboard Content-->
	  
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
  <!-- loader scripts -->
  <script src="assets/js/jquery.loading-indicator.js"></script>
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  <!-- Chart js -->
  
  <script src="assets/plugins/Chart.js/Chart.min.js"></script>
 
  <!-- Index js -->
  <script src="assets/js/index.js"></script>

  
</body>
</html>
