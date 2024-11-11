<?php
include('php-includes/connect.php');
date_default_timezone_set('Asia/Kolkata');
$date=date('Y-m-d');
$us=mysqli_query($con,"select * from user order by id");
while($us_r=mysqli_fetch_array($us)){
	if($us_r['ex_date']<$date && $us_r['ex_date']!=''){
mysqli_query($con,"UPDATE `user` SET `status`='Unactive',`re_status`='Active' where loginid='".$us_r['loginid']."'");}}
?>
