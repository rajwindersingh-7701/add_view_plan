<?php
include('php-includes/check-login.php');
include('php-includes/connect.php');

?>
<?php
//Clicked on send buton
if(isset($_POST['submit'])){
	
	if($_POST['kyc']=='Success'){
	mysqli_query($con,"update user set kyc_status='".$_POST['kyc']."' where id='".$_POST['id']."' ");
	echo '<script>alert("Successfully Accept.");window.location.assign("kyc.php");</script>';
}else{
	mysqli_query($con,"update user set kyc_status='".$_POST['kyc']."',current_status='0' where id='".$_POST['id']."' ");
	echo '<script>alert("Reject successfully.");window.location.assign("kyc.php");</script>';	
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

    <title>Super Digital Coin  - KYC</title>

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
                        <h1 class="page-header">User - KYC</h1>
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
                                    <th>Name</th>
                                    <th>Mobile No</th>
                                    <th>Bank Details</th>
                                    <th>Adhar Card</th>
                                    <th>PanCard</th>
                                    <th>Bank Doc</th>
                                    
                                    <th>Action</th>
                                </tr>
                                <?php
									$query = mysqli_query($con,"select * from user where current_status='1'");
									if(mysqli_num_rows($query)>0){
										$i=1;
										while($row=mysqli_fetch_array($query)){
											
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td><?php echo $row['loginid']; ?><br>
                                                <a href="../profile/<?php echo $row['image']; ?>">
                                                <img src="../profile/<?php echo $row['image']; ?>" width="80px" height="80px" /></a></td>
                                                </td>
                                                <td>Name: <?php echo $row['name']; ?><br>
                                                F Name: <?php echo $row['f_name']; ?><br>
                                                M Name: <?php echo $row['m_name']; ?><br>
                                                </td>
                                                <td><?php echo $row['mobile']; ?></td>
                                                <td>Bank: <?php echo $row['bank_name']; ?><br>
                                                Branch: <?php echo $row['bank_branch']; ?><br>
                                                A/C: <?php echo $row['bank_ac']; ?><br>
                                                IFSC: <?php echo $row['bank_ifsc']; ?><br>
                                                </td>
                                                <td><a href="../doc/<?php echo $row['adhar_frnt']; ?>">
                                                <img src="../doc/<?php echo $row['adhar_frnt']; ?>" width="80px" height="80px" /></a>
                                                <a href="../doc/<?php echo $row['adhr_back']; ?>">
                                                <img src="../doc/<?php echo $row['adhar_back']; ?>" width="80px" height="80px" /></a>
                                                </td>
                                                <td><?php echo $row['panno']; ?><br><a href="../doc/<?php echo $row['pancard']; ?>">
                                                <img src="../doc/<?php echo $row['pancard']; ?>" width="80px" height="80px" /></a></td>
                                                
                                                <td><a href="../doc/<?php echo $row['bankac']; ?>">
                                                <img src="../doc/<?php echo $row['bankac']; ?>" width="80px" height="80px" /></a></td>
                                                
                                                <td><?php if($row['kyc_status']=='Success'){?>
                                                Accept<?php }else{?>
                                                <form action="" method="post">
                                                <input type="hidden" value="<?php echo $row['id'];?>" name="id">
                                                <select name="kyc" >
                                                <option value="Success">Accept</option>
                                                <option value="Reject">Reject</option>
                                                </select><br><br>
                                                <input type="submit" value="Submit" name="submit">
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
                                        	<td colspan="6" align="center">You have no pin request.</td>
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
