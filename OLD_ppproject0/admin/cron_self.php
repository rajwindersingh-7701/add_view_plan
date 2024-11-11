<?php
include('php-includes/connect.php');
$sf=mysqli_query($con,"SELECT * FROM `user` WHERE status='Active' and date(r_date) = date(now()) - 1");
while($sf_r=mysqli_fetch_array($sf)){
	$date = date('Y-m-d');
	mysqli_query($con,"INSERT INTO `self_in`(`userid`, `amount`, `r_date`) VALUES ('".$sf_r['loginid']."','50','$date')");
	
}
?>
