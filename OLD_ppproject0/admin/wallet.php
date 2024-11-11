<?php
include('php-includes/check-login.php');
include('php-includes/connect.php');
?>
<?php
//Clicked on send buton
if(isset($_GET['uid'])){
	
	mysqli_query($con,"update req_payment set status='Success' where id='".$_GET['uid']."'");
	
	echo '<script>alert("Payment successfully added.");window.location.assign("req_pay.php");</script>';	
}
if(isset($_GET['cid'])){
	
	mysqli_query($con,"update req_payment set status='Pending' where id='".$_GET['cid']."'");
	
	echo '<script>alert("Payment successfully Cancel.");window.location.assign("req_pay.php");</script>';	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Super Digital Coin - E-Wallet</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script>function exportF(elem) {
  var table = document.getElementById("table");
  var html = table.outerHTML;
  var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
  elem.setAttribute("href", url);
  elem.setAttribute("download", "wallet_<?php echo date('d-m-Y');?>.xls"); // Choose the file name
  return false;
}</script>
</head>
<body>
 <div id="wrapper">
 <?php include('php-includes/menu.php'); ?>
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">E-Wallet</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        	<a id="downloadLink" onclick="exportF(this)"><button value="Export to excel" >Export to excel</button></a><br>
                            <form action="" method="post"><table width="100%">
                            <tr><td> From Date:
                            <input type="date" name="fromdate" class="form-control" style="width:90%"></td>
                            <td> To Date:
                            <input type="date" name="todate" class="form-control" style="width:90%"></td>
                            <td>&nbsp;  
                            <input type="submit" name="submit" value="Search" class="form-control" style="width:90%"></td>
                           </tr> </table></form><br>
                           <?php if($_POST['submit']==''){?>
                        	<table class="table table-striped table-bordered"  id="table">
                            	
                                <tr>
                                	<th>S.n.</th>
                                    <th>Userid</th>
                                    <th>Name / Mobile No.</th>
                                    <th>Pan No.</th>
                                    <th>Wallet Balance</th>
                                    
                                    
                                </tr>
                                <?php
									$query = mysqli_query($con,"select * from user where status='Active' order by id");
									if(mysqli_num_rows($query)>0){
										$i=1;
										while($row=mysqli_fetch_array($query)){
											
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td><?php echo $uid=$row['loginid']; ?></td>
                                                <td><?php  echo $row['name'];
												 ?> / <?php echo $row['mobile'];?></td>
                                                <td><?php echo $row['panno']; ?></td>
                                                <td><?php 
								
								$winc11=mysqli_query($con,"select sum(amount) from direct_income where  user_id='$uid' ");
								$winc_r11=mysqli_fetch_array($winc11);
								$wti11=$winc_r11['0'];
								
								$winc21=mysqli_query($con,"select sum(amount) from pair_match where  user_id='$uid' ");
								$winc_r21=mysqli_fetch_array($winc21);
								$wti21=$winc_r21['0'];
								
								$winc31=mysqli_query($con,"select sum(amount) from repurchase where  user_id='$uid'");
								$winc_r31=mysqli_fetch_array($winc31);
								$wti31=$winc_r31['0'];
								
								$winc41=mysqli_query($con,"select sum(amount) from reward where  user_id='$uid'");
								$winc_r41=mysqli_fetch_array($winc41);
								$wti41=$winc_r41['0'];
								
								$winc51=mysqli_query($con,"select sum(amount) from royalty where  user_id='$uid'");
								$winc_r51=mysqli_fetch_array($winc51);
								$wti51=$winc_r51['0'];
								
								$winc61=mysqli_query($con,"select sum(amount) from cashback where  user_id='$uid'");
								$winc_r61=mysqli_fetch_array($winc61);
								$wti61=$winc_r61['0'];
								
								$wth1=mysqli_query($con,"select sum(amount) from withdrwal where status='Success' and  user_id='$uid'");
								$wth_r1=mysqli_fetch_array($wth1);
								$wtwth1=$wth_r1['0'];
								
								echo $wtinc1=$wti11+$wti21+$wti31+$wti41+$wti51+$wti61-$wtwth1;
								
								?></td>
                                            </tr>
                                        <?php
											$i++;
										}
									}
									else{
									?>
                                    	
                                    <?php
									}
								?>
                                <tr>
                                        	<td colspan="4" align="center">Grand Total</td>
                                            <td><?php 
											
								$inc11=mysqli_query($con,"select sum(amount) from direct_income ");
								$inc_r11=mysqli_fetch_array($inc11);
								$ti11=$inc_r11['0'];
								
								$inc21=mysqli_query($con,"select sum(amount) from pair_match ");
								$inc_r21=mysqli_fetch_array($inc21);
								$ti21=$inc_r21['0'];
								
								$inc31=mysqli_query($con,"select sum(amount) from repurchase ");
								$inc_r31=mysqli_fetch_array($inc31);
								$ti31=$inc_r31['0'];
								
								$inc41=mysqli_query($con,"select sum(amount) from reward ");
								$inc_r41=mysqli_fetch_array($inc41);
								$ti41=$inc_r41['0'];
								
								$inc51=mysqli_query($con,"select sum(amount) from royalty ");
								$inc_r51=mysqli_fetch_array($inc51);
								$ti51=$inc_r51['0'];
								
								$inc61=mysqli_query($con,"select sum(amount) from cashback ");
								$inc_r61=mysqli_fetch_array($inc61);
								$ti61=$inc_r61['0'];
								
								$wth1=mysqli_query($con,"select sum(amount) from withdrwal where status='Success'");
								$wth_r1=mysqli_fetch_array($wth1);
								$twth1=$wth_r1['0'];
								
								 $tinc1=$ti11+$ti21+$ti31+$ti41+$ti51+$ti61;
								 echo $tinc11=$tinc1-$twth1;
								?></td>
                                        </tr>
                            </table>
                            <?php }else{
								$frd=$_POST['fromdate'];
								$tdt=$_POST['todate'];
								$query=mysqli_query($con,"select * from user where act_date between '".$frd."' and '".$tdt."' and  status='Active'");
									
								?>
                            <table class="table table-striped table-bordered"  id="table">
                            	
                                <tr>
                                	<th>S.n.</th>
                                    <th>Userid</th>
                                    <th>Name / Mobile No.</th>
                                    <th>Pan No.</th>
                                    <th>Wallet Balance</th>
                                    
                                    
                                </tr>
                                <?php
									if(mysqli_num_rows($query)>0){
										$i=1;
										while($row=mysqli_fetch_array($query)){
											
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td><?php echo $uid=$row['loginid']; ?></td>
                                                <td><?php  echo $row['name'];
												 ?> / <?php echo $row['mobile'];?></td>
                                                <td><?php echo $row['panno']; ?></td>
                                                <td><?php 
								$inc1=mysqli_query($con,"select sum(amount) from direct_income where user_id='$uid' and r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."'");
								$inc_r1=mysqli_fetch_array($inc1);
								$ti1=$inc_r1['0'];
								
								$inc2=mysqli_query($con,"select sum(amount) from pair_match where user_id='$uid' and r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."'");
								$inc_r2=mysqli_fetch_array($inc2);
								$ti2=$inc_r2['0'];
								
								$inc3=mysqli_query($con,"select sum(amount) from repurchase where user_id='$uid' and r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."'");
								$inc_r3=mysqli_fetch_array($inc3);
								$ti3=$inc_r3['0'];
								
								$inc4=mysqli_query($con,"select sum(amount) from reward where user_id='$uid' and r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."'");
								$inc_r4=mysqli_fetch_array($inc4);
								$ti4=$inc_r4['0'];
								
								$inc5=mysqli_query($con,"select sum(amount) from royalty where user_id='$uid' and r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."'");
								$inc_r5=mysqli_fetch_array($inc5);
								$ti5=$inc_r5['0'];
								
								$inc6=mysqli_query($con,"select sum(amount) from cashback where user_id='$uid' and r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."'");
								$inc_r6=mysqli_fetch_array($inc6);
								$ti6=$inc_r6['0'];
								
								$wth=mysqli_query($con,"select sum(amount) from withdrwal where user_id='$uid' and r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."' and status='Success'");
								$wth_r=mysqli_fetch_array($wth);
								$twth=$wth_r['0'];
								
								echo $tinc=$ti1+$ti2+$ti3+$ti4+$ti5+$ti6-$twth;
								?></td>
                                            </tr>
                                        <?php
											$i++;
										}
									}
									else{
									?>
                                    	
                                    <?php
									}
								?>
                                <tr>
                                        	<td colspan="4" align="center">Grand Total</td>
                                            <td><?php 
								$inc11=mysqli_query($con,"select sum(amount) from direct_income where  r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."'");
								$inc_r11=mysqli_fetch_array($inc11);
								$ti11=$inc_r11['0'];
								
								$inc21=mysqli_query($con,"select sum(amount) from pair_match where  r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."'");
								$inc_r21=mysqli_fetch_array($inc21);
								$ti21=$inc_r21['0'];
								
								$inc31=mysqli_query($con,"select sum(amount) from repurchase where  r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."'");
								$inc_r31=mysqli_fetch_array($inc31);
								$ti31=$inc_r31['0'];
								
								$inc41=mysqli_query($con,"select sum(amount) from reward where  r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."'");
								$inc_r41=mysqli_fetch_array($inc41);
								$ti41=$inc_r41['0'];
								
								$inc51=mysqli_query($con,"select sum(amount) from royalty where  r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."'");
								$inc_r51=mysqli_fetch_array($inc51);
								$ti51=$inc_r51['0'];
								
								$inc61=mysqli_query($con,"select sum(amount) from cashback where  r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."'");
								$inc_r61=mysqli_fetch_array($inc61);
								$ti61=$inc_r61['0'];
								
								$wth1=mysqli_query($con,"select sum(amount) from withdrwal where  r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."' and status='Success'");
								$wth_r1=mysqli_fetch_array($wth);
								$twth1=$wth_r1['0'];
								
								echo $tinc1=$ti11+$ti21+$ti31+$ti41+$ti51+$ti61-$twth1;
								?></td>
                                        </tr>
                            </table>
                            
                            <?php }?>
                            <br>
                            
                            
                        </div><!--/.table-responsive-->
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
