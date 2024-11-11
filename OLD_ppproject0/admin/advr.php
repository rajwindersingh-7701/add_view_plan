<?php
include('php-includes/connect.php');
include('php-includes/check-login.php');
$userid = $_SESSION['userid'];

?>
<?php
//User cliced on join
if(isset($_POST['submit'])){
	
	$compfile=time().$_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"],"../bonaza/".time().$_FILES["image"]["name"]);
	
		$query = mysqli_query($con,"UPDATE `advr` SET `image`='".$compfile."',`r_mnth`='".$_POST['r_mnth']."',`r_date`='".$_POST['r_date']."',`r_yr`='".$_POST['r_yr']."',`r_hr`='".$_POST['r_hr']."',`r_mnt`='".$_POST['r_mnt']."' WHERE id='1'");
		
		echo '<script>alert("Successfully Change.");window.location.assign("advr.php");</script>';
	}?><!--/join user-->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Super Digital Coin  - Bonanza </title>

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
                        <h1 class="page-header">Update Bonanza</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-9">
                   <?php $bz=mysqli_query($con,"SELECT * FROM `advr` WHERE id='1' ");
				         $bz_r=mysqli_fetch_array($bz);
				   ?>
                    	<form method="post" enctype="multipart/form-data">
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label>Select Month</label>
                                <select  name="r_mnth" class="form-control"  required>
                                <option value="<?php echo $bz_r['r_mnth'];?>"> <?php echo $bz_r['r_mnth'];?> </option>
                                <option value="jan">January</option>
                                <option value="feb">February</option>
                                <option value="mar">March</option>
                                <option value="apr">April </option>
                                <option value="may">May</option>
                                <option value="jun">June</option>
                                <option value="jul">July</option>
                                <option value="aug">August </option>
                                <option value="sep">September </option>
                                <option value="oct">October </option>
                                <option value="nov">November </option>
                                <option value="dec">December </option>
                                </select>
                            </div></div>
                            <div class="col-lg-9">
                            <div class="form-group">
                                <label>Select Date</label>
                                <select  name="r_date" class="form-control"  required>
                                <option value="<?php echo $bz_r['r_date'];?>"> <?php echo $bz_r['r_date'];?> </option>
                               <?php $begin = '1';
                                     $end='31';

                                for($i = $begin; $i <= $end; $i++){?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php }?>
                                </select>
                            </div></div>
                        
                            <div class="col-lg-9">
                            <div class="form-group">
                                <label>Select Year</label>
                                <select  name="r_yr" class="form-control"  required>
                                <option value="<?php echo $bz_r['r_yr'];?>"> <?php echo $bz_r['r_yr'];?> </option>
                               <?php $begin1 = '2020';
                                     $end1='2030';

                                for($i = $begin1; $i <= $end1; $i++){?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php }?>
                                </select>
                            </div></div>
                            <div class="col-lg-9">
                            <div class="form-group">
                                <label>Select Hour</label>
                                <select  name="r_hr" class="form-control"  required>
                                <option value="<?php echo $bz_r['r_hr'];?>"> <?php echo $bz_r['r_hr'];?> </option>
                               <?php $begin2 = '1';
                                     $end2='24';

                                for($i = $begin2; $i <= $end2; $i++){?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php }?>
                                </select>
                            </div></div>
                            <div class="col-lg-9">
                            <div class="form-group">
                                <label>Select Minute</label>
                                <select  name="r_mnt" class="form-control"  required>
                                <option value="<?php echo $bz_r['r_mnt'];?>"> <?php echo $bz_r['r_mnt'];?> </option>
                               <?php $begin3 = '1';
                                     $end3='60';

                                for($i = $begin3; $i <= $end3; $i++){?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php }?>
                                </select>
                            </div></div>
                            <div class="col-lg-9">
                            <div class="form-group">
                                <label>Upload Photo</label>
                                <input type="file"  name="image" class="form-control"  required value="<?php echo $bz_r['image']?>">
                                <img src="../bonaza/<?php echo $bz_r['image'];?>" width="100px" height="100px" />
                            </div></div>
                            <div class="col-lg-9">
                            <div class="form-group">
                        	<input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </div></div>
                        </form>
                        
                        <br>
                        	
                       
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
