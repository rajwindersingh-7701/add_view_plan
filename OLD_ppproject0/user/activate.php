<?php include('check-login.php');
include('../connect.php');
 $ms=mysqli_query($con,"select * from user where loginid='".$_SESSION['userid']."'");
      $ms_r=mysqli_fetch_array($ms);
	  $email = $_SESSION['userid'];
date_default_timezone_set('Asia/Kolkata');

	
//pin request 
if(isset($_POST['submit'])){
	$date=date('Y-m-d');
    $ex_date = date('Y-m-d', strtotime($date. ' +30 days')); 
	$loginid = mysqli_real_escape_string($con,$_POST['loginid']);
	$uid = mysqli_real_escape_string($con,$_POST['uid']);
	$pin = mysqli_real_escape_string($con,$_POST['pin']);
	$pn=mysqli_query($con,"select * from pin_list where pin='".$pin."'");
	$pn_r=mysqli_fetch_array($pn);
    $amount=$pn_r['pintype'];
	$ur=mysqli_query($con,"select * from user where loginid='".$uid."'");
	$ur_r=mysqli_fetch_array($ur);
	$sp=mysqli_query($con,"select * from `daily_pay` where userid='".$ur_r['sponser_id']."'");
	$sp_r=mysqli_fetch_array($sp);
	$spo=$sp_r['sponser'];
    $r_date= date("Y-m-d H:i:s",$mod_date);
	if($pn_r['status']=='open'){
		if($ur_r['status']=='Unactive'){
		//Inset the value to pin request
		$sponser=$spo+1;
		$query = mysqli_query($con,"UPDATE `user` SET `status` = 'Active',`re_status` = 'Unactive',`act_date`=NOW(),`ex_date`='$ex_date' WHERE `loginid` = '$uid'");
		mysqli_query($con,"INSERT INTO `sdc_income`(`userid`, `amount`,`r_date`) VALUES ('$uid','1000',NOW())");
    mysqli_query($con,"UPDATE `pin_list` SET `use_by` = '$loginid',`use_for`='$uid',`status`='close',`use_date`=NOW() WHERE `pin` = '$pin'");
		mysqli_query($con,"UPDATE `lvl1` SET `status`='Active' WHERE userid='$uid'");
		mysqli_query($con,"UPDATE `lvl2` SET `status`='Active' WHERE userid='$uid'");
		mysqli_query($con,"UPDATE `lvl3` SET `status`='Active' WHERE userid='$uid'");
		mysqli_query($con,"UPDATE `lvl4` SET `status`='Active' WHERE userid='$uid'");
		mysqli_query($con,"UPDATE `lvl5` SET `status`='Active' WHERE userid='$uid'");
		mysqli_query($con,"UPDATE `lvl6` SET `status`='Active' WHERE userid='$uid'");
		mysqli_query($con,"UPDATE `lvl7` SET `status`='Active' WHERE userid='$uid'");
		mysqli_query($con,"UPDATE `lvl8` SET `status`='Active' WHERE userid='$uid'");
		mysqli_query($con,"UPDATE `lvl9` SET `status`='Active' WHERE userid='$uid'");
		mysqli_query($con,"UPDATE `lvl10` SET `status`='Active' WHERE userid='$uid'");
		mysqli_query($con,"UPDATE `daily_pay` SET `status`='Active' WHERE userid='$uid'");
		mysqli_query($con,"UPDATE `daily_pay` SET `sponser`='$sponser' WHERE userid='".$ur_r['sponser_id']."'");	
			echo '<script>alert("Successfully Activate");window.location.assign("activate.php");</script>';
		}
		else{
			//echo mysqli_error($con);
			echo '<script>alert("User already Activated");window.location.assign("activate.php");</script>';
	}
	}
	else{
		echo '<script>alert("Pin already used");window.location.assign("activate.php");</script>';
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
  
  <script language="javascript">
function usernamedetail(str)
{

var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		
    document.getElementById("username").innerHTML=xmlhttp.responseText;
	
    }
  }
xmlhttp.open("GET","usernamedetail1.php?str="+str,true);
xmlhttp.send();

  }
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
           <div class="card-title">Account Activate</div>
           <hr>
            <form action="" method="post" enctype="multipart/form-data">
           <div class="form-group">
            <label for="input-1">Enter Pin</label>
            <input type="text" class="form-control" id="input-2" name="pin"  placeholder="Enter Pin" required>
            <input type="hidden" value="<?php echo $email;?>" name="loginid" />
           </div>
           <div class="form-group">
            <label for="input-2">Enter User Id</label>
            <input type="text" class="form-control" onblur="usernamedetail(this.value)"   id="under_userid" name="uid"  placeholder="Enter User ID" required><br>
            <div id="username"></div>
           </div>
           
           
           <div class="form-group">
            <button type="submit" name="submit" class="btn btn-light px-5"><i class="icon-lock"></i> Submit</button>
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
