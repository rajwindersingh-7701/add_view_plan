<?php
include('php-includes/check-login.php');
include('php-includes/connect.php');

?>
<?php
//Clicked on send buton
if(isset($_GET['id'])){
	mysqli_query($con,"delete from pin_request where id='".$_GET['id']."'");
	echo '<script>alert("Pin Request Delete Successfully.");window.location.assign("view-pin-request.php");</script>';
}
if(isset($_GET['did'])){
	mysqli_query($con,"delete from pin_list where id='".$_GET['did']."'");
	echo '<script>alert("Pin Delete Successfully.");window.location.assign("view-pin-request.php");</script>';
}
if(isset($_POST['send'])){
	$userid = mysqli_real_escape_string($con,$_POST['userid']);
	$amount = mysqli_real_escape_string($con,$_POST['amount']);
	$id = mysqli_real_escape_string($con,$_POST['id']);
	$product_amount=mysqli_real_escape_string($con,$_POST['pinamount']);
	$no_of_pin = $amount/$product_amount;
	//Insert pin
	$i=1;
	while($i<=$no_of_pin){
		$new_pin = pin_generate();
		mysqli_query($con,"insert into pin_list (`userid`,`pin`,`pintype`,`r_date`) values('$userid','$new_pin','$product_amount',NOW())");
		$i++;	
	}
	
	//updae pin request status
	mysqli_query($con,"update pin_request set status='close' where id='$id' limit 1");
	
	echo '<script>alert("Pin send successfully.");window.location.assign("view-pin-request.php");</script>';	
}

//Pin generate
function pin_generate(){
	global $con;
	$generated_pin = rand(100000,999999);
	
	$query = mysqli_query($con,"select * from pin_list where pin = '$generated_pin'");
	if(mysqli_num_rows($query)>0){
		pin_generate();
	}
	else{
		return $generated_pin;
	}
	
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

    <title>Mlml Website  - View Pin Request</title>

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
  elem.setAttribute("download", "pin_<?php echo date('d-m-Y');?>.xls"); // Choose the file name
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
                        <h1 class="page-header">Admin - View pin request</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        	<table class="table table-striped table-bordered" >
                            	<tr>
                                	<th>S.n.</th>
                                    <th>Userid</th>
                                    <th>Amount</th>
                                    <th>No. of Pin / Type</th>
                                    <th>Date</th>
                                    <th>Send</th>
                                    <th>Delete</th>
                                </tr>
                                <?php
									$query = mysqli_query($con,"select * from pin_request where status='open'");
									if(mysqli_num_rows($query)>0){
										$i=1;
										while($row=mysqli_fetch_array($query)){
											$id = $row['id'];
											$email = $row['email'];
											$amount = $row['amount'];
											$pintype = $row['pintype'];
											$date = $row['date'];
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $amount; ?></td>
                                                <td><?php echo $pn=$amount/$pintype; ?> / <?php echo $pintype;?></td>

                                                <td><?php echo $date; ?></td>
                                                <form method="post">
                                                	<input type="hidden" name="userid" value="<?php echo $email ?>">
                                                    <input type="hidden" name="amount" value="<?php echo $amount ?>">
                                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                                    <input type="hidden" name="pinamount" value="<?php echo $pintype ?>">
                                                	<td><input type="submit" name="send" value="Send" class="btn btn-primary"></td>
                                                </form>
                                                <td><a href="view-pin-request.php?id=<?php echo $row['id'];?>">
                                                <button type="button" class="btn btn-primary" >DELETE</button></a></td>
                                            </tr>
                                        <?php
											$i++;
										}
									}
									else{
									?>
                                    	<tr>
                                        	<td colspan="7" align="center">You have no pin request.</td>
                                        </tr>
                                    <?php
									}
								?>
                            </table>
                            <br>
                            
                            <form action="" method="post"><table width="100%">
                            <tr><td> From Date:
                            <input type="date" name="fromdate" class="form-control" style="width:90%"></td>
                            <td> To Date:
                            <input type="date" name="todate" class="form-control" style="width:90%"></td>
                            <td>&nbsp;  
                            <input type="submit" name="submit" value="Search" class="form-control" style="width:90%"></td>
                           </tr> </table></form><br>
                           <?php if($_POST['submit']==''){?>
                           <a id="downloadLink" onclick="exportF(this)"><button value="Export to excel" >Export to excel</button></a><br><br>
                        	<table class="table table-striped table-bordered"  id="table">
                            	<tr>
                                	<th>S.n.</th>
                                    <th>Userid</th>
                                    <th>Amount</th>
                                    <th>Pin</th>
                                    <th>Delete</th>
                                    <th>Status</th>
                                </tr>
                                <?php
									$query = mysqli_query($con,"select * from pin_list order by id desc");
									if(mysqli_num_rows($query)>0){
										$i=1;
										while($row=mysqli_fetch_array($query)){
											$id = $row['id'];
											$email = $row['userid'];
										    $pintype = $row['pintype'];
											$pin = $row['pin'];
											$status = $row['status'];
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $pintype; ?></td>
                                                <td><?php echo $pin;?></td>
                                                <td><a href="view-pin-request.php?did=<?php echo $row['id'];?>">
                                                <button type="button" class="btn btn-primary" >DELETE</button></a>
                                                </td>
                                                <td><?php echo $status; ?></td>
                                                
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
                            <?php }else{
								if(isset($_POST['submit'])){
								$query = mysqli_query($con,"select * from pin_list where r_date between '".$_POST['fromdate']."' and '".$_POST['todate']."' order by id desc");
									if(mysqli_num_rows($query)>0){
								?>
                            
                            <table class="table table-striped table-bordered"  id="table">
                            	<tr>
                                	<th>S.n.</th>
                                    <th>Userid</th>
                                    <th>Amount</th>
                                    <th>Pin</th>
                                    <th>Delete</th>
                                    <th>Status</th>
                                </tr>
                                <?php 
									
										$i=1;
										while($row=mysqli_fetch_array($query)){
											$id = $row['id'];
											$email = $row['userid'];
										    $pintype = $row['pintype'];
											$pin = $row['pin'];
											$status = $row['status'];
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $pintype; ?></td>
                                                <td><?php echo $pin;?></td>
                                                <td><a href="view-pin-request.php?did=<?php echo $row['id'];?>">
                                                <button type="button" class="btn btn-primary" >DELETE</button></a>
                                                </td>
                                                <td><?php echo $status; ?></td>
                                                
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
                            </table><?php }}?>
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