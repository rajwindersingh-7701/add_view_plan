<?php
include('php-includes/check-login.php');
include('php-includes/connect.php');
?>
<?php
//Clicked on send buton
if(isset($_POST['submit'])){
	if($_POST['pay_type']=='Success'){
	mysqli_query($con,"update withdrwal set status='Success',remark='".$_POST['remark']."' where id='".$_POST['id']."'");
	echo '<script>alert("Withdrwal send successfully.");window.location.assign("withdrwal.php");</script>';
}else{
	mysqli_query($con,"update withdrwal set status='Pending',remark='".$_POST['remark']."' where id='".$_POST['id']."'");
	echo '<script>alert("Withdrwal Reject successfully.");window.location.assign("withdrwal.php");</script>';	
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
    <title>Super Digital Coin - Withdrwal</title>
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
                        <h1 class="page-header">Withdrwal Request</h1>
						<a href="reject.php" style="float:right">Reject History</a>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        <a id="downloadLink" onclick="exportF(this)"><button value="Export to excel" >Export to excel</button></a>
                        	<table class="table table-striped table-bordered"  id="table">
                            	<tr><th colspan="10">Pending Withdrwal Request</th></tr>
                                <tr>
                                	<th>S.n.</th>
                                    
                                    <th>Userid</th>
                                    <th>Name / Mobile No.</th>
                                    <th>Amount</th>
                                    
                                    <th>Admin</th>
                                    <th>Account No.</th>
                                    <th>IFSC Code</th>
                                    <th>Paybal Amount</th>
                                    
                                     <th>Action</th>
                                    
                                </tr>
                                <?php
									$query = mysqli_query($con,"select * from withdrwal where status='Pending'  order by id");
									if(mysqli_num_rows($query)>0){
										$i=1;
										while($row=mysqli_fetch_array($query)){
											$us=mysqli_query($con,"select * from user where loginid='".$row['user_id']."'");
												$row1=mysqli_fetch_array($us);
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                
                                                <td><?php echo $row['user_id']; ?></td>
                                                <td><?php $us=mysqli_query($con,"select * from user where loginid='".$row['user_id']."'");
												$us_r=mysqli_fetch_array($us); echo $us_r['name'];
												 ?> / <?php echo $us_r['mob'];?></td>
                                                <td><?php echo $amt=$row['amount']; ?></td>
                                                
                                                <td><?php echo $row['adm_amt']; ?></td>
                                                <td><?php echo $row['bank_ac']; ?></td>
                                                <td><?php echo $row['ifsc']; ?></td>
                                                <td><?php echo $row['f_amt']; ?></td>
                                                <td><?php if($row['status']=='Pending'){ ?>
                                               <form action="" method="post">
                                               <textarea name="remark" ><?php echo $row['remark']; ?></textarea>
                                               <select name="pay_type" >
                                               <option value="Success">Accept</option>
                                               <option value="Reject">Reject</option>
                                               
                                               </select><br><br>
                                               <input type="hidden" value="<?php echo $row['id'];?>" name="id">
                                               <input type="submit" name="submit" value="Submit" >
                                               </form><?php }?>
                                               </td>
                                            </tr>
                                        <?php
											$i++;
										}
									}
									else{
									?>
                                    	<tr>
                                        	<td colspan="10" align="center">You have no data.</td>
                                        </tr>
                                    <?php
									}
								?>
                            </table><br>
                            
                            <a id="downloadLink" onclick="exportF(this)"><button value="Export to excel" >Export to excel</button></a>
                        	<table class="table table-striped table-bordered"  id="table">
                            	<tr><th colspan="11">Success Withdrwal Request</th></tr>
                                <tr>
                                	<th>S.n.</th>
                                    <th>Account Detail</th>
                                    <th>Userid</th>
                                    <th>Name / Mobile No.</th>
                                    <th>Amount</th>
                                    <th>TDS</th>
                                     <th>Re-purchase</th>
                                    <th>Admin</th>
                                    <th>Paybal Amount</th>
                                    <th>Remarks</th>
                                     <th>Action</th>
                                    
                                </tr>
                                <?php
									$query = mysqli_query($con,"select * from withdrwal where status='Success'  order by id");
									if(mysqli_num_rows($query)>0){
										$i=1;
										while($row=mysqli_fetch_array($query)){
											$us=mysqli_query($con,"select * from user where loginid='".$row['user_id']."'");
												$row1=mysqli_fetch_array($us);
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td>Bank Name: <?php echo $row1['bank_name']; ?><br>
                                                 A/C No.: <?php echo $row1['bank_ac']; ?><br>
                                                 IFSC Code: <?php echo $row1['bank_ifsc']; ?><br>
                                                 Branch: <?php echo $row1['bank_branch']; ?><br>
                                                </td>
                                                <td><?php echo $row['user_id']; ?></td>
                                                <td><?php $us=mysqli_query($con,"select * from user where loginid='".$row['user_id']."'");
												$us_r=mysqli_fetch_array($us); echo $us_r['name'];
												 ?> / <?php echo $us_r['mob'];?></td>
                                                <td><?php echo $amt=$row['amount']; ?></td>
                                                <td><?php echo $row['tds_amt']; ?></td>
                                                <td><?php echo $row['re_amt']; ?></td>
                                                <td><?php echo $row['adm_amt']; ?></td>
                                                <td><?php echo $row['f_amt']; ?></td>
                                                <td> <?php echo $row['remark'];?></td>
                                               <td> <?php if($row['status']=='Pending'){ ?>
                                               <form action="" method="post">
                                               <textarea name="remark" ><?php echo $row['remark']; ?></textarea>
                                               <select name="pay_type" >
                                               <option value="Success">Accept</option>
                                               <option value="Reject">Reject</option>
                                               
                                               </select><br><br>
                                               <input type="hidden" value="<?php echo $row['id'];?>" name="id">
                                               <input type="submit" name="submit" value="Submit" >
                                               </form><?php }else{?>Success<?php }?></td>
                                            </tr>
                                        <?php
											$i++;
										}
									}
									else{
									?>
                                    	<tr>
                                        	<td colspan="11" align="center">You have no data.</td>
                                        </tr>
                                    <?php
									}
								?>
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
