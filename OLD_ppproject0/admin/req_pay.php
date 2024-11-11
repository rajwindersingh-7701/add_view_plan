<?php
include('php-includes/check-login.php');
include('php-includes/connect.php');
?>
<?php
//Clicked on send buton
if(isset($_POST['submit'])){
	if($_POST['pay_type']=='Success'){
	mysqli_query($con,"update req_payment set status='Success',remark='".$_POST['remark']."' where id='".$_POST['id']."'");
	}else{
		mysqli_query($con,"update req_payment set r_status='Reject',remark='".$_POST['remark']."' where id='".$_POST['id']."'");
	}
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
    <title>Super Digital Coin - Payment Request</title>
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
                        <h1 class="page-header">Payment Request</h1>
                        <a href="pay_reject.php" style="float:right">Reject History</a>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        	<table class="table table-striped table-bordered">
                            	<tr><th colspan="7">Pending Request</th></tr>
                                <tr>
                                	<th>S.n.</th>
                                    <th>Userid</th>
                                    <th>Name / Mobile No.</th>
                                    <th>Amount</th>
                                    <th>UTR NO.</th>
                                    <th>Image</th>
                                    
                                     <th>Action</th>
                                    
                                </tr>
                                <?php
									$query = mysqli_query($con,"select * from req_payment where status='Pending' and r_status='Success' order by id");
									if(mysqli_num_rows($query)>0){
										$i=1;
										while($row=mysqli_fetch_array($query)){
											
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td><?php echo $row['user_id']; ?></td>
                                                <td><?php $us=mysqli_query($con,"select * from user where loginid='".$row['user_id']."'");
												$us_r=mysqli_fetch_array($us); echo $us_r['name'];
												 ?> / <?php echo $us_r['mobile'];?></td>
                                                <td><?php echo $row['amount']; ?></td>
                                                <td><?php echo $row['utr']; ?></td>
                                                <td><a href="../payment/<?php echo $row['image']; ?>" target="_blank"><img src="../payment/<?php echo $row['image']; ?>" width="80px" height="80px" ></a></td>
                                                
                                                <td><?php if($row['status']=='Pending'){ ?>
                                               <form action="" method="post">
                                               <textarea name="remark" ><?php echo $row['remark']; ?></textarea>
                                               <select name="pay_type" >
                                               <option value="Success">Accept</option>
                                               <option value="Reject">Reject</option>
                                               
                                               </select><br><br>
                                               <input type="hidden" value="<?php echo $row['id'];?>" name="id">
                                               <input type="submit" name="submit" value="Submit" >
                                               </form><?php }else{?>Success<?php }?>
                                               </td>
                                            </tr>
                                        <?php
											$i++;
										}
									}
									else{
									?>
                                    	<tr>
                                        	<td colspan="7" align="center">You have no data.</td>
                                        </tr>
                                    <?php
									}
								?>
                            </table><br>
                            
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
                            	<tr><th colspan="8">Success Payment</th></tr>
                                <tr>
                                	<th>S.n.</th>
                                    <th>Userid</th>
                                    <th>Name / Mobile No.</th>
                                    <th>Amount</th>
                                    <th>UTR NO.</th>
                                    <th>Image</th>
                                    <th>Remark</th>
                                     <th>Action</th>
                                    
                                </tr>
                                <?php
									$query = mysqli_query($con,"select * from req_payment where status='Success' order by id desc");
									if(mysqli_num_rows($query)>0){
										$i=1;
										while($row=mysqli_fetch_array($query)){
											
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td><?php echo $row['user_id']; ?></td>
                                                <td><?php $us=mysqli_query($con,"select * from user where loginid='".$row['user_id']."'");
												$us_r=mysqli_fetch_array($us); echo $us_r['name'];
												 ?> / <?php echo $us_r['mobile'];?></td>
                                                <td><?php echo $row['amount']; ?></td>
                                                <td><?php echo $row['utr']; ?></td>
                                                <td><a href="../payment/<?php echo $row['image']; ?>" target="_blank"><img src="../payment/<?php echo $row['image']; ?>" width="80px" height="80px" ></a></td>
                                                <td><?php echo $row['remark']; ?></td>
                                                <td><a href="req_pay.php?cid=<?php echo $row['id'];?>"><button type="submit" style="background:#F00"  class="btn btn-primary">Cancel Payment</button></a></td>
                                            </tr>
                                        <?php
											$i++;
										}
									}
									else{
									?>
                                    	<tr>
                                        	<td colspan="7" align="center">You have no data.</td>
                                        </tr>
                                    <?php
									}
								?>
                            </table><?php }else{
								$query = mysqli_query($con,"select * from req_payment where status='Success' and r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."' order by id desc");
								?>
                            <table class="table table-striped table-bordered"  id="table">
                            	<tr><th colspan="7">Success Payment</th></tr>
                                <tr>
                                	<th>S.n.</th>
                                    <th>Userid</th>
                                    <th>Name / Mobile No.</th>
                                    <th>Amount</th>
                                    <th>UTR NO.</th>
                                    <th>Image</th>
                                     <th>Action</th>
                                    
                                </tr>
                                <?php
									
									if(mysqli_num_rows($query)>0){
										$i=1;
										while($row=mysqli_fetch_array($query)){
											
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td><?php echo $row['user_id']; ?></td>
                                                <td><?php $us=mysqli_query($con,"select * from user where loginid='".$row['user_id']."'");
												$us_r=mysqli_fetch_array($us); echo $us_r['name'];
												 ?> / <?php echo $us_r['mobile'];?></td>
                                                <td><?php echo $row['amount']; ?></td>
                                                <td><?php echo $row['utr']; ?></td>
                                                <td><a href="../payment/<?php echo $row['image']; ?>" target="_blank"><img src="../payment/<?php echo $row['image']; ?>" width="80px" height="80px" ></a></td>
                                                
                                                <td><a href="req_pay.php?cid=<?php echo $row['id'];?>"><button type="submit" style="background:#F00"  class="btn btn-primary">Cancel Payment</button></a></td>
                                            </tr>
                                        <?php
											$i++;
										}
									}
									else{
									?>
                                    	<tr>
                                        	<td colspan="7" align="center">You have no data.</td>
                                        </tr>
                                    <?php
									}
								?>
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
