<?php 
include('connect.php');
 

//pin request 
$us=mysqli_query($con,"select * from user where status='Active'");
while($us_r=mysqli_fetch_array($us)){
	$date=$us_r['act_date'];
    $ex_date = date('Y-m-d', strtotime($date. ' +30 days')); 
	$uid=$us_r['loginid'];
	
		$query = mysqli_query($con,"UPDATE `user` SET `ex_date`='$ex_date' WHERE `loginid` = '$uid'");
}?>