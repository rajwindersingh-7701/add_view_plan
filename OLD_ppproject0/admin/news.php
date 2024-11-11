<?php
include('php-includes/connect.php');
include('php-includes/check-login.php');
$userid = $_SESSION['userid'];

?>
<?php
//User cliced on join
if(isset($_POST['submit'])){
	
	$news_type = mysqli_real_escape_string($con,$_POST['news_type']);
	$title = mysqli_real_escape_string($con,$_POST['title']);
	$query = mysqli_query($con,"INSERT INTO `news` (`news_type`, `title`,`r_date`) VALUES ('$news_type', '$title', NOW())");
		
		
		
		echo '<script>alert("Successfully Add News.");window.location.assign("news.php");</script>';
	}
	if(isset($_GET['nid'])){
		mysqli_query($con,"DELETE FROM `news` WHERE `id` = '".$_GET['nid']."' ");
	echo '<script>alert("Successfully News Delete.");window.location.assign("news.php");</script>';	
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
                        <h1 class="page-header">Add ews</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-9">
                   
                    	<form method="post" enctype="multipart/form-data">
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label>Select News Type</label>
                                <select  name="news_type" class="form-control"  required>
                                <option value=""> - - - Select News Type - - - </option>
                                <option value="Home">Main Website</option>
                                <option value="User">User</option>
                                </select>
                            </div></div>
                            <div class="col-lg-9">
                            <div class="form-group">
                                <label>News Detail</label>
                                <textarea name="title" class="form-control"  required></textarea>
                            </div></div>
                        
                            
                            <div class="col-lg-9">
                            <div class="form-group">
                        	<input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </div></div>
                        </form>
                        
                        <br>
                        	<table class="table table-bordered table-striped">
                            	<tr>
                                	<th>S.n.</th>
                                    <th>News Type</th>
                                    <th>Details</th>
                                    
                                    <th>Add Date</th>
                                    <th>Action</th>
                                    
                                    
                                </tr>
                                <?php
									$i=1;
									$query = mysqli_query($con,"select * from news order by id desc");
									if(mysqli_num_rows($query)>0){
										while($row=mysqli_fetch_array($query)){
											
											
										?>
                                        	<tr>
                                            	<td><?php echo $i ?></td>
                                                <td><?php if($row['news_type']=='Home') { echo 'Main Website'; }else{ echo 'Customer Side'; }?></td>
                                                <td><?php echo $row['title']; ?></td>
                                               <td><?php echo $row['r_date']; ?></td>
                                                <td><a href="news.php?nid=<?php echo $row['id']; ?>">Delete</a></td>
                                                
                                            </tr>
                                        <?php
											$i++;
										}
									}
									else{
									?>
                                    	<tr>
                                        	<td colspan="2">Sorry no data found</td>
                                        </tr>
                                    <?php
									}
								?>
                            </table>
                       
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
