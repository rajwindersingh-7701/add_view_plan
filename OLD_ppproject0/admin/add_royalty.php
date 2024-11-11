<?php
include('php-includes/check-login.php');
include('php-includes/connect.php');
?>
<?php
//Clicked on send buton
if(isset($_POST['submit'])){
	
	 
						$rs=mysqli_query($con,"select * from royalty_super where user_id='".$_POST['loginid']."'");
						$rs_r=mysqli_fetch_array($rs);
						$rsa=mysqli_query($con,"select count(id) from royalty_super ");
						$rsa_r=mysqli_fetch_array($rsa);
						$trs=$rsa_r['0'];
						if($trs<='100'){ $usr='1'; $tw='999999999'; }else{ $usr='0'; $tw='30';}
						if($rs_r['user_id']==''){
							mysqli_query($con,"INSERT INTO `royalty_super`(`user_id`, `user_type`,`t_week`,`date`) VALUES ('".$_POST['loginid']."','".$usr."','".$tw."',NOW())");
						}
						
	echo '<script>alert("Royalty Achivers Add Successfully.");window.location.assign("add_royalty.php");</script>';	
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
    <title>Super Digital Coin - Royalty Achivers</title>
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
                        <h1 class="page-header">Add Royalty Achivers</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        <br>
                        	<center>
                            <form action="" method="post">
                            <input type="text" name="loginid" class="form-control" placeholder="Enter User ID" /><br>
                            <input type="submit" name="submit" value="SUBMIT" class="btn-success" />
                            </form>
                            </center>
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
