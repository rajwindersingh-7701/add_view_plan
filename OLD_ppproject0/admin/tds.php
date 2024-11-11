<?php
include('php-includes/check-login.php');
require('php-includes/connect.php');
?>
<?php
if(isset($_GET['userid'])){
	$userid = mysqli_real_escape_string($con,$_GET['userid']);
	$amount = mysqli_real_escape_string($con,$_GET['amount']);
	
	$date = date("Y-m-d");
	
	$query = mysqli_query($con,"insert into income_received(`userid`, `amount`, `date`) value('$userid', '$amount', '$date')");
	
	$query = mysqli_query($con,"update income set current_bal=0 where userid='$userid'");
	
	echo '<script>alert("Payment has paid");window.location.assign("income.php");</script>';
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

    <title>Super Digital Coin  - Tds</title>

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
  elem.setAttribute("download", "TDS_<?php echo date('d-m-Y');?>.xls"); // Choose the file name
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
                        <h1 class="page-header">TDS Report</h1>
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
                            <a id="downloadLink" onclick="exportF(this)"><button value="Export to excel" >Export to excel</button></a><br><br>
                        	
                           <?php if($_POST['submit']==''){?>
                          <table class="table table-bordered table-striped" id="table">
                            	<thead>
                                	<tr>
                                    	<th>S.N.</th>
                                        <th>USER ID</th>
                                        <th>NAME</th>
                                        <th>PAN No.</th>
                                        <th>AMOUNT</th>
                                        <th>TDS</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
                                	$query = mysqli_query($con,"select * from withdrwal where status='Success' order by id");
									
										$i=1;
										while($row=mysqli_fetch_array($query)){
											$userid = $row['user_id'];
											$query_user = mysqli_query($con,"select * from user where loginid='$userid'");
											$result = mysqli_fetch_array($query_user);
											
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td><?php echo $userid; ?></td>
                                                <td><?php echo $result['name']; ?></td>
                                                <td><?php echo $result['panno']; ?></td>
                                                <td><?php echo $row['amount'];?></td>
                                                 <td><?php echo $row['tds_amt'];?></td>
                                                 <td><?php echo $row['r_date'];?></td>
                                            </tr>
                                        <?php
											$i++;
										}
                                ?>
                                <tr><td colspan="4">Grand Total</td>
                                <td><?php $gt=mysqli_query($con,"select sum(amount) from withdrwal where status='Success' ");
								$gt_r=mysqli_fetch_array($gt);
								echo $tgt=$gt_r['0'];
								?></td>
                                <td colspan="2" style="float:left"><?php $gtt=mysqli_query($con,"select sum(tds_amt) from withdrwal where status='Success' ");
								$gtt_r=mysqli_fetch_array($gtt);
								echo $tgtt=$gtt_r['0'];
								?></td>
                                </tr>
                                </tbody>
                            </table><?php }else{
				$query = mysqli_query($con,"select * from withdrwal where r_date BETWEEN '".$_POST['fromdate']."' AND '".$_POST['todate']."' AND status='Success'");
									
								?>
                            <table class="table table-bordered table-striped" id="table">
                            	<thead>
                                	<tr>
                                    	<th>S.N.</th>
                                        <th>USER ID</th>
                                        <th>NAME</th>
                                        <th>PAN No.</th>
                                        <th>AMOUNT</th>
                                        <th>TDS</th>
                                        <th>DATE</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
                                	
										$i=1;
										while($row=mysqli_fetch_array($query)){
											$userid = $row['user_id'];
											$query_user = mysqli_query($con,"select * from user where loginid='$userid'");
											$result = mysqli_fetch_array($query_user);
											
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td><?php echo $userid; ?></td>
                                                <td><?php echo $result['name']; ?></td>
                                                <td><?php echo $result['panno']; ?></td>
                                                <td><?php echo $row['amount'];?></td>
                                                 <td><?php echo $row['tds_amt'];?></td>
                                                 <td><?php echo $row['r_date'];?></td>
                                            </tr>
                                        <?php
											$i++;
										}
                                ?>
                                <tr><td colspan="4">Grand Total</td>
                                <td><?php $gt=mysqli_query($con,"select sum(amount) from withdrwal where r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."' and status='Success' ");
								$gt_r=mysqli_fetch_array($gt);
								echo $tgt=$gt_r['0'];
								?></td>
                                <td colspan="3" style="float:left"><?php $gtt=mysqli_query($con,"select sum(tds_amt) from withdrwal where r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."' and status='Success' ");
								$gtt_r=mysqli_fetch_array($gtt);
								echo $tgtt=$gtt_r['0'];
								?></td>
                                </tr>
                                </tbody>
                            </table>
                            <?php }?>
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
