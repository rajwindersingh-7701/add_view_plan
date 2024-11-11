
<?php
include('php-includes/connect.php');
include('php-includes/check-login.php');
$userid = $_SESSION['userid'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Super Digital Coin Website  - Level Tree</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

 

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('php-includes/menu.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Level Tree</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        
<table class="table table-bordered table-striped">
    <tr>
                                	
                                    <th>Userid</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Level</th>
                                    <th>Join date</th>
                                    <th>Status</th>
                                    
                                    
                                </tr>
                                <?php
									$query = mysqli_query($con,"select * from user where rfrl_id='$userid'");
									
										while($row=mysqli_fetch_array($query)){
											$loginid = $row['loginid'];
											$name = $row['name'];
											$mobile = $row['mobile'];
											$r_date = $row['reg_date'];
											$status = $row['status'];
											
										?>
                                        	<tr>
                                            	<td><?php echo $loginid; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $mobile; ?></td>
                                                <td>LEVEL 1</td>
                                                <td><?php echo $r_date; ?></td>
                                                <td><?php echo $status; ?></td>
                                                
                                            </tr>
                                            <?php
									$query2 = mysqli_query($con,"select * from user where rfrl_id='$loginid'");
									
										while($row2=mysqli_fetch_array($query2)){
											$loginid2 = $row2['loginid'];
											$name2 = $row2['name'];
											$mobile2 = $row2['mobile'];
											$r_date2 = $row2['reg_date'];
											$status2 = $row2['status'];
											
										?>
                                        	<tr>
                                            	<td><?php echo $loginid2; ?></td>
                                                <td><?php echo $name2; ?></td>
                                                <td><?php echo $mobile2; ?></td>
                                                <td>LEVEL 2</td>
                                                <td><?php echo $r_date2; ?></td>
                                                <td><?php echo $status2; ?></td>
                                                
                                            </tr>
                                            <?php
									$query3 = mysqli_query($con,"select * from user where rfrl_id='$loginid2'");
									
										while($row3=mysqli_fetch_array($query3)){
											$loginid3 = $row3['loginid'];
											$name3 = $row3['name'];
											$mobile3 = $row3['mobile'];
											$r_date3 = $row33['reg_date'];
											$status3 = $row['status'];
											
										?>
                                        	<tr>
                                            	<td><?php echo $loginid3; ?></td>
                                                <td><?php echo $name3; ?></td>
                                                <td><?php echo $mobile3; ?></td>
                                                <td>LEVEL 3</td>
                                                <td><?php echo $r_date3; ?></td>
                                                <td><?php echo $status3; ?></td>
                                                
                                            </tr>
                                        <?php }?>
                                        <?php }?>
                                        <?php }?>
                                    
                            </table></div>
    
    
                        	
                        </div>
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
