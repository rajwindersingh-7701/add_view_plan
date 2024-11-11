<?php
include('php-includes/connect.php');
include('php-includes/check-login.php');
$userid = $_SESSION['userid'];
$search = $userid;
?>
<?php
function tree_data($userid){
global $con;
$data = array();
$query = mysqli_query($con,"select * from tree where userid='$userid'");
$result = mysqli_fetch_array($query);
$data['left'] = $result['left'];
$data['right'] = $result['right'];
$data['leftcount'] = $result['leftcount'];
$data['rightcount'] = $result['rightcount'];
return $data;
}
?>
<?php 
if(isset($_GET['search-id'])){
$search_id = mysqli_real_escape_string($con,$_GET['search-id']);
if($search_id!=""){
$query_check = mysqli_query($con,"select * from user where loginid='$search_id'");
if(mysqli_num_rows($query_check)>0){
$search = $search_id;
}
else{
echo '<script>alert("Access Denied");window.location.assign("tree.php");</script>';
}
}
else{
echo '<script>alert("Access Denied");window.location.assign("tree.php");</script>';
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
<title>Super Digital Coin - Tree</title>
<!-- Bootstrap Core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- MetisMenu CSS -->
<link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="dist/css/sb-admin-2.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
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
<h1 class="page-header">Tree</h1>
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
<div class="col-lg-12">
<div class="table-responsive">
<table class="table" align="center" border="0" style="text-align:center">
<tr height="150">
<?php
$data = tree_data($search);
?>
<td><?php echo $data['leftcount'] ?></td>
<td colspan="2">

<i class="fa fa-user fa-4x" style="color:<?php $us1=mysqli_query($con,"select * from user where loginid='$search'");
      $us_r1=mysqli_fetch_array($us1);
	  if($us_r1['status']=='Active'){ echo '#006600'; }else{ echo '#FF0000';}
?>"></i><p><button type="button"  data-toggle="modal" data-target="#myModal"><?php echo $search; ?></button></p></td>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center> <h4 class="modal-title">User Name: <?php echo $us_r1['name'];?></h4><br>
         <b class="modal-title">Sponser ID: <?php echo $us_r1['rfrl_id'];?></b><br>
         <b class="modal-title">Status: <?php echo $us_r1['status'];?></b><br>
         <b class="modal-title">Postion: <?php echo $us_r1['side'];?></b><br>
         </center>
        </div>
        <div class="modal-body">
         <center> </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> </div></div></div>
  
</div>
<td><?php echo $data['rightcount'] ?></td>
</tr>
<tr height="150">
<?php
$first_left_user = $data['left'];
$first_right_user = $data['right'];
?>
<?php 
if($first_left_user!=""){
?>
<td colspan="2"><a href="tree.php?search-id=<?php echo $first_left_user ?>">
<i class="fa fa-user fa-4x" style="color:<?php $us2=mysqli_query($con,"select * from user where loginid='$first_left_user'");
      $us_r2=mysqli_fetch_array($us2);
	  if($us_r2['status']=='Active'){ echo '#006600'; }else{ echo '#FF0000';}
?>"></i><p><?php echo $first_left_user ?></p></a><p><button type="button"  data-toggle="modal" data-target="#myModal1">View</button></p></td>
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center> <h4 class="modal-title">User Name: <?php echo $us_r2['name'];?></h4><br>
         <b class="modal-title">Sponser ID: <?php echo $us_r2['rfrl_id'];?></b><br>
         <b class="modal-title">Status: <?php echo $us_r2['status'];?></b><br>
         <b class="modal-title">Postion: <?php echo $us_r2['side'];?></b><br>
         </center>
        </div>
        <div class="modal-body">
         <center> </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> </div></div></div></td>
<?php 
}
else{
?>
<td colspan="2"><i class="fa fa-user fa-4x" style="color:<?php $us3=mysqli_query($con,"select * from user where loginid='$first_left_user'");
      $us_r3=mysqli_fetch_array($us3);
	  if($us_r3['status']=='Active'){ echo '#006600'; }else{ echo '#FF0000';}
?>"></i><p><?php echo $first_left_user ?></p>
<button type="button"  data-toggle="modal" data-target="#myModal2">View</button></p></td>
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center> <h4 class="modal-title">User Name: <?php echo $us_r3['name'];?></h4><br>
         <b class="modal-title">Sponser ID: <?php echo $us_r3['rfrl_id'];?></b><br>
         <b class="modal-title">Status: <?php echo $us_r3['status'];?></b><br>
         <b class="modal-title">Postion: <?php echo $us_r3['side'];?></b><br>
         </center>
        </div>
        <div class="modal-body">
         <center> </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> </div></div></div>
</td>
<?php
}
?>
<?php 
if($first_right_user!=""){
?>
<td colspan="2"><a href="tree.php?search-id=<?php echo $first_right_user ?>"><i class="fa fa-user fa-4x" style="color:<?php $us4=mysqli_query($con,"select * from user where loginid='$first_right_user'");
      $us_r4=mysqli_fetch_array($us4);
	  if($us_r4['status']=='Active'){ echo '#006600'; }else{ echo '#FF0000';}
?>"></i><p><?php echo $first_right_user ?></p></a>
<button type="button"  data-toggle="modal" data-target="#myModal3">View</button></p></td>
<div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center> <h4 class="modal-title">User Name: <?php echo $us_r4['name'];?></h4><br>
         <b class="modal-title">Sponser ID: <?php echo $us_r4['rfrl_id'];?></b><br>
         <b class="modal-title">Status: <?php echo $us_r4['status'];?></b><br>
         <b class="modal-title">Postion: <?php echo $us_r4['side'];?></b><br>
         </center>
        </div>
        <div class="modal-body">
         <center> </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> </div></div></div>
</td>
<?php 
}
else{
?>
<td colspan="2"><i class="fa fa-user fa-4x" style="color:<?php $us5=mysqli_query($con,"select * from user where loginid='$first_right_user'");
      $us_r5=mysqli_fetch_array($us5);
	  if($us_r5['status']=='Active'){ echo '#006600'; }else{ echo '#FF0000';}
?>"></i><p><?php echo $first_right_user ?></p>
<button type="button"  data-toggle="modal" data-target="#myModal4">View</button></p></td>
<div class="modal fade" id="myModal4" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center> <h4 class="modal-title">User Name: <?php echo $us_r5['name'];?></h4><br>
         <b class="modal-title">Sponser ID: <?php echo $us_r5['rfrl_id'];?></b><br>
         <b class="modal-title">Status: <?php echo $us_r5['status'];?></b><br>
         <b class="modal-title">Postion: <?php echo $us_r5['side'];?></b><br>
         </center>
        </div>
        <div class="modal-body">
         <center> </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> </div></div></div>
</td>
<?php
}
?>
</tr>
<tr height="150">
<?php 
$data_first_left_user = tree_data($first_left_user);
$second_left_user = $data_first_left_user['left'];
$second_right_user = $data_first_left_user['right'];

$data_first_right_user = tree_data($first_right_user);
$third_left_user = $data_first_right_user['left'];
$thidr_right_user = $data_first_right_user['right'];
?>
<?php 
if($second_left_user!=""){
?>
<td><a href="tree.php?search-id=<?php echo $second_left_user ?>"><i class="fa fa-user fa-4x" style="color:<?php $us6=mysqli_query($con,"select * from user where loginid='$second_left_user'");
      $us_r6=mysqli_fetch_array($us6);
	  if($us_r6['status']=='Active'){ echo '#006600'; }else{ echo '#FF0000';}
?>"></i><p><?php echo $second_left_user ?></p></a>
<button type="button"  data-toggle="modal" data-target="#myModal5">View</button></p></td>
<div class="modal fade" id="myModal5" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center> <h4 class="modal-title">User Name: <?php echo $us_r6['name'];?></h4><br>
         <b class="modal-title">Sponser ID: <?php echo $us_r6['rfrl_id'];?></b><br>
         <b class="modal-title">Status: <?php echo $us_r6['status'];?></b><br>
         <b class="modal-title">Postion: <?php echo $us_r6['side'];?></b><br>
         </center>
        </div>
        <div class="modal-body">
         <center> </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> </div></div></div>
</td>
<?php 
}
else{
?>
<td><i class="fa fa-user fa-4x" style="color:#333333"></i></td>
<?php
}
?>
<?php 
if($second_right_user!=""){
?>
<td><a href="tree.php?search-id=<?php echo $second_right_user ?>"><i class="fa fa-user fa-4x" style="color:<?php $us7=mysqli_query($con,"select * from user where loginid='$second_right_user'");
      $us_r7=mysqli_fetch_array($us7);
	  if($us_r7['status']=='Active'){ echo '#006600'; }else{ echo '#FF0000';}
?>"></i><p><?php echo $second_right_user ?></p></a>
<button type="button"  data-toggle="modal" data-target="#myModal6">View</button></p></td>
<div class="modal fade" id="myModal6" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center> <h4 class="modal-title">User Name: <?php echo $us_r7['name'];?></h4><br>
         <b class="modal-title">Sponser ID: <?php echo $us_r7['rfrl_id'];?></b><br>
         <b class="modal-title">Status: <?php echo $us_r7['status'];?></b><br>
         <b class="modal-title">Postion: <?php echo $us_r7['side'];?></b><br>
         </center>
        </div>
        <div class="modal-body">
         <center> </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> </div></div></div>
</td>
<?php 
}
else{
?>
<td><i class="fa fa-user fa-4x" style="color:#333333"></i></td>
<?php
}
?>
<?php 
if($third_left_user!=""){
?>
<td><a href="tree.php?search-id=<?php echo $third_left_user ?>"><i class="fa fa-user fa-4x" style="color:<?php $us8=mysqli_query($con,"select * from user where loginid='$third_left_user'");
      $us_r8=mysqli_fetch_array($us8);
	  if($us_r8['status']=='Active'){ echo '#006600'; }else{ echo '#FF0000';}
?>"></i><p><?php echo $third_left_user ?></p></a>
<button type="button"  data-toggle="modal" data-target="#myModal7">View</button></p></td>
<div class="modal fade" id="myModal7" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center> <h4 class="modal-title">User Name: <?php echo $us_r8['name'];?></h4><br>
         <b class="modal-title">Sponser ID: <?php echo $us_r8['rfrl_id'];?></b><br>
         <b class="modal-title">Status: <?php echo $us_r8['status'];?></b><br>
         <b class="modal-title">Postion: <?php echo $us_r8['side'];?></b><br>
         </center>
        </div>
        <div class="modal-body">
         <center> </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> </div></div></div>
</td>
<?php 
}
else{
?>
<td><i class="fa fa-user fa-4x" style="color:#333333"></i></td>
<?php
}
?>
<?php 
if($thidr_right_user!=""){
?>
<td><a href="tree.php?search-id=<?php echo $thidr_right_user ?>"><i class="fa fa-user fa-4x" style="color:<?php $us9=mysqli_query($con,"select * from user where loginid='$thidr_right_user'");
      $us_r9=mysqli_fetch_array($us9);
	  if($us_r9['status']=='Active'){ echo '#006600'; }else{ echo '#FF0000';}
?>"></i><p><?php echo $thidr_right_user ?></p></a>
<button type="button"  data-toggle="modal" data-target="#myModal8">View</button></p></td>
<div class="modal fade" id="myModal8" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center> <h4 class="modal-title">User Name: <?php echo $us_r9['name'];?></h4><br>
         <b class="modal-title">Sponser ID: <?php echo $us_r9['rfrl_id'];?></b><br>
         <b class="modal-title">Status: <?php echo $us_r9['status'];?></b><br>
         <b class="modal-title">Postion: <?php echo $us_r9['side'];?></b><br>
         </center>
        </div>
        <div class="modal-body">
         <center> </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> </div></div></div>
</td>
<?php 
}
else{
?>
<td><i class="fa fa-user fa-4x" style="color:#333333"></i></td>
<?php
}
?>
</tr>
</table>
</div>
</div>
</div>
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