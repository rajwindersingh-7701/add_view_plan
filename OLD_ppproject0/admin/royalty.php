<?php
include('php-includes/check-login.php');
include('php-includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Super Digital Coin - Royalty Achiver</title>
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
                        <h1 class="page-header">Royalty Achivers</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        	<a id="downloadLink" onclick="exportF(this)"><button value="Export to excel" >Export to excel</button></a>
                        	<table class="table table-striped table-bordered"  id="table">
                            	
                                <tr>
                                	<th>S.n.</th>
                                    <th>Userid</th>
                                    <th>Name </th>
                                    <th>Address</th>
                                    <th>Amount</th>
                                    <th> Date</th>
                                    
                                </tr>
                                <?php $bl=mysqli_query($con,"select * from royalty order by id");
								$i=0;
								while($bl_r=mysqli_fetch_array($bl)){
								$i++;
								$us=mysqli_query($con,"select * from user where loginid='".$bl_r['user_id']."'");
								$us_r=mysqli_fetch_array($us)
								?>
                                    	<tr>
                                        	<td><?php echo $i;?></td>
                                            <td><?php echo $lg=$bl_r['user_id'];?></td>
                                            <td><?php echo $us_r['name'];?> </td>   
                                            <td><?php echo $us_r['address'];?></td>
                                            <td><?php echo $bl_r['amount'];?></td>
                                            <td><?php echo $bl_r['date'];?></td>
                                            </tr>
                                    <?php }?>
                            </table>
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
