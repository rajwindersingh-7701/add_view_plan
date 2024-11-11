<?php
include('php-includes/connect.php');
date_default_timezone_set('Asia/Kolkata');
$us=mysqli_query($con,"SELECT * FROM `daily_pay` order by id");
while($us_r=mysqli_fetch_array($us)){
	$lv=mysqli_query($con,"SELECT sum(amount) FROM `level_in` where userid='".$us_r['userid']."'");
	$lv_r=mysqli_fetch_array($lv);
	$tlv=$lv_r['0'];
	$sl=mysqli_query($con,"SELECT sum(amount) FROM `self_in` where userid='".$us_r['userid']."'");
	$sl_r=mysqli_fetch_array($sl);
	$tsl=$sl_r['0'];
	$wt=mysqli_query($con,"SELECT sum(amount) FROM `withdrwal` where user_id='".$us_r['userid']."'");
	$wt_r=mysqli_fetch_array($wt);
	$twt=$wt_r['0'];
	$tt=$tlv+$tsl-$twt;
	$adm=$tt*10/100;
	$famt=$tt-$adm;
	mysqli_query($con,"UPDATE `daily_pay` SET `amount`='".$tt."',`adm_amt`='".$adm."',`f_amt`='".$famt."' WHERE userid='".$us_r['userid']."'");
	}
?>
