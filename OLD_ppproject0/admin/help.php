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

    <title>Super Digital Coin Pvt. Ltd  - Help</title>

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
                        <h1 class="page-header">Help</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        	<table class="table table-bordered table-striped">
                            	<thead>
                                	<tr>
                                    	<th>S.N.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile No.</th>
                                        <th>MSG</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
                                	$query = mysqli_query($con,"select * from enq  order by id");
									if(mysqli_num_rows($query)>0){
										$i=1;
										while($row=mysqli_fetch_array($query)){
																				
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td><?php echo $row['name'];?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['mob']; ?></td>
                                                <td><?php echo $row['msg']; ?></td>
                                                <td><?php echo $row['r_date']; ?></td>
                                              </tr>
                                        <?php
											$i++;
										}
									}
									else{
									?>
                                    	<tr>
                                        	<td colspan="6">No user exist</td>
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
