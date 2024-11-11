<?php
include('php-includes/check-login.php');
require('php-includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Super Digital Coinss Website  - Home</title>
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
                        <h1 class="page-header">Admin Home</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-3">
                    	<div class="panel panel-primary">
                        	<div class="panel-heading">
                            	<h4 class="panel-title">Total User</h4>
                            </div>
                            <div class="panel-body">
                            	<?php 
								echo  mysqli_num_rows(mysqli_query($con,"select * from user"));
								?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                    	<div class="panel panel-primary">
                        	<div class="panel-heading">
                            	<h4 class="panel-title">Total Active User</h4>
                            </div>
                            <div class="panel-body">
                            	<?php 
								echo  mysqli_num_rows(mysqli_query($con,"select * from user where status='Active'"));
								?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                    	<div class="panel panel-primary">
                        	<div class="panel-heading">
                            	<h4 class="panel-title">Total Joing Bussiness</h4>
                            </div>
                            <div class="panel-body">
                            	<?php 
									$pn=mysqli_query($con,"select sum(pintype) from pin_list where status='close' ");
									$pn_r=mysqli_fetch_array($pn);
									echo $tpn=$pn_r['0'];
									?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                    	<div class="panel panel-primary">
                        	<div class="panel-heading">
                            	<h4 class="panel-title">Total Paid Payout</h4>
                            </div>
                            <div class="panel-body">
                            	<?php 
								  $py=mysqli_query($con,"select sum(amount) from withdrwal where status='Success'");
								  $py_r=mysqli_fetch_array($py);
								   echo $tpyy=$py_r['0'];
								    
								  
								   
								?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                    	<div class="panel panel-primary">
                        	<div class="panel-heading">
                            	<h4 class="panel-title">Today Payout</h4>
                            </div>
                            <div class="panel-body">
                            	<?php 
								$inc11=mysqli_query($con,"select sum(amount) from level_in");
								$inc_r11=mysqli_fetch_array($inc11);
								$ti11=$inc_r11['0'];
								
								$inc21=mysqli_query($con,"select sum(amount) from `self_in` ");
								$inc_r21=mysqli_fetch_array($inc21);
								$ti21=$inc_r21['0'];
								
								$wth1=mysqli_query($con,"select sum(amount) from withdrwal where status='Success'");
								$wth_r1=mysqli_fetch_array($wth1);
								$twth1=$wth_r1['0'];
								
								
								 $tinc1=$ti11+$ti21;
								$tinc111=$tinc1-$twth1;
								echo $tinc11=$tinc111+0;
								?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                    	<div class="panel panel-primary">
                        	<div class="panel-heading">
                            	<h4 class="panel-title">Total Payout</h4>
                            </div>
                            <div class="panel-body">
                            	<?php 
								  echo $tinc1+0;
								?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                    	<div class="panel panel-primary">
                        	<div class="panel-heading">
                            	<h4 class="panel-title">Total Admin </h4>
                            </div>
                            <div class="panel-body">
                            	<?php $gtt=mysqli_query($con,"select sum(adm_amt) from withdrwal where status='Success' ");
								$gtt_r=mysqli_fetch_array($gtt);
								echo $tgtt=$gtt_r['0']+0;?>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    
                </div>
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
