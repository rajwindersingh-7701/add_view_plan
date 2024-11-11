<?php
include('php-includes/connect.php');
include('php-includes/check-login.php');
$userid = $_SESSION['userid'];

?>
<?php
//User cliced on join
if(isset($_POST['update'])){
$compfile=time().$_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"],"../images/".time().$_FILES["image"]["name"]);
$query=mysqli_query($con,"UPDATE `plan`  `image`='".$compfile."' WHERE id='1'");
	

echo '<script> alert("Image Add Successfully")</script>';
}

?><!--/join user-->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Super Digital Coin  - News </title>

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
                        <h1 class="page-header">Plan Change</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-9">
                   
                    	<form method="post" enctype="multipart/form-data">
                        
                            <div class="col-lg-9">
                            <div class="form-group">
                            <?php $pl=mysqli_query("select * from plan where id='1'");
							       $pl_r=mysqli_fetch_array($pl);
							 ?>
                                <label>Upload PDF</label>
                                <input name="image"  type="file" class="form-control"  required value="<?php echo $pl_r['image'];?>"/>
                                <a href="../../images/<?php echo $pl_r['image'];?>" target="_blank">View Plan</a>
                            </div></div>
                        
                            
                            <div class="col-lg-9">
                            <div class="form-group">
                        	<input type="submit" name="update" class="btn btn-primary" value="Update">
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
