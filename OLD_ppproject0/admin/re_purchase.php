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
  elem.setAttribute("download", "export.xls"); // Choose the file name
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
                        <h1 class="page-header">Re-Purchase Business Report</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        <form action="" method="post"><table width="100%">
                            <tr><td> From Date:
                            <input type="date" name="fromdate" class="form-control" style="width:90%"></td>
                            <td> To Date:
                            <input type="date" name="todate" class="form-control" style="width:90%"></td>
                            <td>&nbsp;  
                            <input type="submit" name="submit" value="Search" class="form-control" style="width:90%"></td>
                           </tr> </table></form><br>
                        	<a id="downloadLink" onclick="exportF(this)"><button value="Export to excel" >Export to excel</button></a>
                             <?php if($_POST['submit']==''){?>
                        	<table class="table table-striped table-bordered"  id="table">
                            	
                                <tr>
                                	<th>S.n.</th>
                                    <th>Userid</th>
                                    <th>Name / Mobile No.</th>
                                    <th>Product</th>
                                    <th>Amount</th>
                                    <th>B.V</th>
                                    <th>Date</th>
                                    
                                </tr>
                                <?php $re=mysqli_query($con,"select * from repurchase order by id desc");
								     $i=0;
									  while($re_r=mysqli_fetch_array($re)){
										  $i++;
								?>
                                    	<tr>
                                        	<td align="center"><?php echo $i;?></td>
                                            <td align="center"><?php
											$us=mysqli_query($con,"select * from user where id='".$re_r['user_id']."'");
								$us_r=mysqli_fetch_array($us);
											 echo $us_r['loginid'];?></td>
                                            <td align="center"><?php $us=mysqli_query($con,"select * from user where loginid='".$re_r['user_id']."'");
											                         $us_r=mysqli_fetch_array($us);
																	 echo $us_r['name'];
											?></td>
                                            <td align="center"><?php $ps=mysqli_query($con,"select * from products where id='".$re_r['product']."'");
											                         $ps_r=mysqli_fetch_array($ps);
																	 echo $ps_r['productName'];
											?></td>
                                            <td align="center"><?php echo $ps_r['productPrice'];?></td>
                                            <td align="center"><?php echo $re_r['amount'];?></td>
                                            <td align="center"><?php echo $re_r['r_date'];?></td>
                                        </tr>
                                   <?php }?> 
                                   <tr><th colspan="5" align="center">Grand Total</th>
                                   <th colspan="2" ><?php $ret=mysqli_query($con,"select sum(amount) from repurchase");
								   $ret_r=mysqli_fetch_array($ret);
								   echo $trt=$ret_r['0'];
								   ?></th>
                                   </tr>
                            </table><?php }else{?>
                            <table class="table table-striped table-bordered"  id="table">
                            	
                                <tr>
                                	<th>S.n.</th>
                                    <th>Userid</th>
                                    <th>Name / Mobile No.</th>
                                    <th>Product</th>
                                    <th>Amount</th>
                                    <th>B.V</th>
                                    <th>Date</th>
                                    
                                </tr>
                                <?php $re=mysqli_query($con,"select * from repurchase where r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."' order by id ");
								     $i=0;
									  while($re_r=mysqli_fetch_array($re)){
										  $i++;
								?>
                                    	<tr>
                                        	<td align="center"><?php echo $i;?></td>
                                            <td align="center"><?php echo $re_r['user_id'];?></td>
                                            <td align="center"><?php $us=mysqli_query($con,"select * from user where loginid='".$re_r['user_id']."'");
											                         $us_r=mysqli_fetch_array($us);
																	 echo $us_r['name'];
											?></td>
                                            <td align="center"><?php $ps=mysqli_query($con,"select * from products where id='".$re_r['product']."'");
											                         $ps_r=mysqli_fetch_array($ps);
																	 echo $ps_r['productName'];
											?></td>
                                            <td align="center"><?php echo $ps_r['productPrice'];?></td>
                                            <td align="center"><?php echo $re_r['amount'];?></td>
                                            <td align="center"><?php echo $re_r['r_date'];?></td>
                                        </tr>
                                   <?php }?> 
                                   <tr><th colspan="5" align="center">Grand Total</th>
                                   <th colspan="2" ><?php $ret=mysqli_query($con,"select sum(amount) from repurchase where r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."'");
								   $ret_r=mysqli_fetch_array($ret);
								   echo $trt=$ret_r['0'];
								   ?></th>
                                   </tr>
                            </table>
                            <?php }?>
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
