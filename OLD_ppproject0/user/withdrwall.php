<?php include('check-login.php');
include('../connect.php');
date_default_timezone_set("Asia/Kolkata");
 $userid = $_SESSION['userid'];
$ak=mysqli_query($con,"select * from user WHERE `loginid` ='$userid'");
$ak_r=mysqli_fetch_array($ak);

	
	
if($ak_r['status']=='Active'){
//User cliced on join
if(isset($_POST['submit'])){
	
	$f_amt = mysqli_real_escape_string($con,$_POST['amount']);
	$adm_amt = $f_amt*10/100;
	$tlam=$adm_amt;
	$amount1 = $f_amt-$tlam;
	$var_name=$f_amt/10;
    $tamnt = mysqli_real_escape_string($con,$_POST['tamnt']);
	
	$us1=mysqli_query($con,"SELECT * FROM `user` WHERE loginid='".$userid."' ");
	$us_r1=mysqli_fetch_array($us1);
	$bank=$us_r1['bank_ac'];
	$ifsc=$us_r1['ifsc'];
	$mob=$us_r1['mob'];
	$mobile=strlen($mob);
	$ifcode=strlen($ifsc);
	$nam=$us_r1['name'];
	$name=urlencode($nam);
	$trid = rand(100000,999999);
          $str_arr = explode('.',$amount1);
    $gamt=$str_arr[0];                       
	$bus=mysqli_query($con,"select * from user WHERE `loginid` ='$userid'");
					      $bus_r=mysqli_fetch_array($bus);
						 
					                    
	 $bank_ac =$bus_r['bank_ac'];
	$bank_ifsc = $bus_r['ifsc'];
	
	if($bank!='' && $ifsc!='' && $mob!='' && $mobile=='10' && $ifcode=='11' ){
	if($tamnt>=$f_amt && $f_amt>='10'){
		
		
		$url = "https://zozowallet.com/api/payout/transfer?api_token=IPX8POv5kg95iwadepkvJ9x6ZdDt0BPkM289AbC9KWirrMktpyUC5SbQWJsD&beneficiary_name=".$name."&account_number=".$bank."&ifsc=".$ifsc."&mobile_number=".$mob."&amount=".$gamt."&client_id=".$trid;
 
// Initialize a CURL session.
$ch = curl_init();
 
// Return Page contents.
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
//grab URL and pass it to the variable.
//curl_setopt($ch, CURLOPT_URL, $url);
 
$result = curl_exec($ch);
 

		$json = @file_get_contents($url);
    
    $arr = json_decode($json);
	$status=$arr->status;
	$utr=$arr->utr;
	$order_id=$arr->orderid;
	$msg=$arr->message;
	
	
	
		echo $status;
	
	
	
if($status=='success'){
		$query = mysqli_query($con,"INSERT INTO `withdrwal` (`user_id`, `amount`,`adm_amt`,`f_amt`,`r_date`,`status`,`order_id`,`bank_ac`,`ifsc`) VALUES ('$userid', '$f_amt','$adm_amt','$amount1', NOW(),'$status','$order_id','$bank_ac','$bank_ifsc')");
		
		
		
		echo '<script>alert("Successfully Withdrwal");window.location.assign("withdrwall.php");</script>';
		}else{ echo '<script>alert("Withdrwal Pending");window.location.assign("withdrwall.php");</script>';}
	}}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Withdrwal :: Super Digital Coin</title>
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
          <?php  $li=mysqli_query($con,"select sum(amount) from level_in  where userid='".$_SESSION['userid']."'");
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
				  $tb=$lv_in+$sf_in;
				  ?>
           <div class="card-title">Wallet </div>
           <hr>
            
           <div class="form-group">
            <label for="input-1">Current Wallet Blance</label>
            <input type="text" readonly class="form-control" id="input-1"  value="<?php echo $ms_r=$tb-$wtt;?>" >
           </div>
           <div class="form-group">
            <label for="input-2">Withdrwal</label>
            <input type="text" readonly class="form-control" id="input-2"  value="<?php echo $wtt;?>" >
           </div>
           <div class="form-group">
            <label for="input-3">Total Income</label>
            <input type="text" readonly class="form-control"  value="<?php echo $tb;?>" >
           </div>
           
          
         </div>
         </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
           <div class="card-body">
           <div class="card-title">Withdrwal Request</div>
           <hr><?php $tu=mysqli_query($con,"select count(id) from user where  sponser_id='".$_SESSION['userid']."' and status='Active'");
		   $tu_r=mysqli_fetch_array($tu);
		   $ttu=$tu_r['0'];
		   
		   ?>
            <form action="" method="post">
            <input type="hidden" name="tamnt" value="<?php echo $ms_r=$tb-$wtt;?>" />
           <div class="form-group">
            <label for="input-6">Withdrwal Amount</label>
            <input type="number" class="form-control form-control-rounded"  name="amount" id="input-6" placeholder="Enter Amount">
            <p style="color:#F00">Minimum withdrawal amount 200</p>
           </div>
           <div class="form-group">
            <label for="input-7">Password</label>
            <input type="password" class="form-control form-control-rounded"  name="trsn_pass" id="input-7" placeholder="Enter Password">
           </div>
           
           
           <div class="form-group">
            <button type="submit" name="submit" class="btn btn-light btn-round px-5"><i class="icon-lock"></i> Submit</button>
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
</html><?php }else{
	header('location:home.php');
}?>
