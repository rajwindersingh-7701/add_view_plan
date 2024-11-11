<?php
include('php-includes/check-login.php');
include('php-includes/connect.php');

?>
<?php
//Clicked on send buton
if(isset($_GET['aid'])){
	
	
	mysqli_query($con,"update user set status='Active' where id='".$_GET['id']."' ");
	
	echo '<script>alert("Active successfully.");window.location.assign("user.php");</script>';	
}
if(isset($_GET['uid'])){
	
	
	mysqli_query($con,"update user set status='Unlock' where id='".$_GET['id']."' ");
	
	echo '<script>alert("Unactive successfully.");window.location.assign("user.php");</script>';	
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

    <title>Super Digital Coin  - All User</title>

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
}</script>
 

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
                        <h1 class="page-header">User - All User</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        	<a id="downloadLink" onclick="exportF(this)"><button value="Export to excel" >Export to excel</button></a><br>
                            <br>
                            <form action="" method="post"><table width="100%">
                            <tr><td> Userid:
                            <input type="text" name="login" class="form-control" style="width:90%"></td>
                            <td>&nbsp;  
                            <input type="submit" name="submit" value="Search" class="form-control" style="width:50%"></td>
                           </tr> </table></form><br>
                           <?php if($_POST['submit']==''){?>
                            <br>
                        	<table class="table table-striped table-bordered"  id="table">
                            	<tr>
                                	<th>S.n.</th>
                                    <th>Userid</th>
                                    <th>Password & Trasction Pass.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Act Date</th>
                                    <th>Sponser Id</th>
                                    
                                    
                                    <th>Status</th>
                                    
                                    <th>Lock</th>
                                </tr>
                                <?php
									$query = mysqli_query($con,"select * from user");
									if(mysqli_num_rows($query)>0){
										$i=1;
										while($row=mysqli_fetch_array($query)){
											
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td><?php echo $row['loginid']; ?></td>
                                                <td><?php echo $row['password']; ?>
                                                
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['mob']; ?></td>
                                                <td><?php echo  $row['act_date']; ?></td>
                                                <td><?php echo $row['sponser_id']; ?></td>
                                                
                                                <td><?php echo $row['status']; ?></td>
                                                <td><?php if($row['status']=='Active'){?>
                                               <a href="user.php?uid=<?php echo $row['id'];?>">
                                                
                                                <button type="submit"   class="btn btn-primary">Click In-Active</button></a><?php }else{?>
                                                
                                                <a href="user.php?aid=<?php echo $row['id'];?>">
                                                
                                                <button type="submit"   class="btn btn-primary">Click To Active</button></a><?php }?></td>
                                            </tr>
                                        <?php
											$i++;
										}
									}
									else{
									?>
                                    	<tr>
                                        	<td colspan="6" align="center">You have no pin request.</td>
                                        </tr>
                                    <?php
									}
								?>
                            </table><?php 
						   }else{
							   $query = mysqli_query($con,"select * from user where loginid='".$_POST['login']."'");
							   ?>
                           <table class="table table-striped table-bordered"  id="table">
                            	<tr>
                                	<th>S.n.</th>
                                    <th>Userid</th>
                                    <th>Password & Trasction Pass.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Act Date</th>
                                    <th>Sponser Id</th>
                                    
                                    
                                    <th>Status</th>
                                    
                                    <th>Lock</th>
                                </tr>
                                <?php
									
									if(mysqli_num_rows($query)>0){
										$i=1;
										while($row=mysqli_fetch_array($query)){
											
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td><?php echo $row['loginid']; ?></td>
                                                <td><?php echo $row['password']; ?>
                                                
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['mob']; ?></td>
                                                <td><?php echo  $row['act_date']; ?></td>
                                                <td><?php echo $row['sponser_id']; ?></td>
                                                
                                                <td><?php echo $row['status']; ?></td>
                                                <td><?php if($row['status']=='Active'){?>
                                               <a href="user.php?uid=<?php echo $row['id'];?>">
                                                
                                                <button type="submit"   class="btn btn-primary">Click In-Active</button></a><?php }else{?>
                                                
                                                <a href="user.php?aid=<?php echo $row['id'];?>">
                                                
                                                <button type="submit"   class="btn btn-primary">Click To Active</button></a><?php }?></td>
                                            </tr>
                                        <?php
											$i++;
										}
									}
									else{
									?>
                                    	<tr>
                                        	<td colspan="6" align="center">You have no pin request.</td>
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
