<?php
include('php-includes/connect.php');
$sf=mysqli_query($con,"SELECT * FROM `user` WHERE status='Active' and loginid in('SDC511313','SDC540047','SDC552607','SDC213942')");
while($sf_r=mysqli_fetch_array($sf)){
	$vd=mysqli_query($con,"select * from video");
	while($vd_r=mysqli_fetch_array($vd)){
		mysqli_query($con,"INSERT INTO `video_view`(`userid`, `srno`, `status`,`r_date`) VALUES ('".$sf_r['loginid']."','".$vd_r['srno']."','Active',NOW())");
		
	}
	if($sf_r['re_status']=='Active'){
	mysqli_query($con,"INSERT INTO `self_in`(`userid`, `amount`, `r_date`) VALUES ('".$sf_r['loginid']."','15',NOW())");
	mysqli_query($con,"INSERT INTO `re_wallet`(`userid`, `amount`, `r_date`) VALUES ('".$sf_r['loginid']."','15',NOW())");
	}else{ mysqli_query($con,"INSERT INTO `self_in`(`userid`, `amount`, `r_date`) VALUES ('".$sf_r['loginid']."','30',NOW())");}
	$tu=mysqli_query($con,"select count(id) from user where sponser_id='".$sf_r['loginid']."' and status='Active' ");
	$tu_r=mysqli_fetch_array($tu);
	$ttu=$tu_r['0'];
	$lv1=mysqli_query($con,"SELECT count(id) FROM `lvl1` WHERE lvl='".$sf_r['loginid']."' and status='Active'");
	$lv_r1=mysqli_fetch_array($lv1);
	$tlv1=$lv_r1[0]*3;
	if($tlv1>='1' && $ttu>='1'){
	mysqli_query($con,"INSERT INTO `level_in`(`userid`, `amount`, `r_date`, `lvl`) VALUES ('".$sf_r['loginid']."','".$tlv1."',NOW(),'Level 1')");}
	//---- Level 2
	$lv2=mysqli_query($con,"SELECT count(id) FROM `lvl2` WHERE lvl='".$sf_r['loginid']."' and status='Active'");
	$lv_r2=mysqli_fetch_array($lv2);
	$tlv2=$lv_r2['0']*2;
	if($tlv2>='1' && $tlv1>='1'  && $ttu>='2'){
	mysqli_query($con,"INSERT INTO `level_in`(`userid`, `amount`, `r_date`, `lvl`) VALUES ('".$sf_r['loginid']."','".$tlv2."',NOW(),'Level 2')");}
	//----- Level 3
	$lv3=mysqli_query($con,"SELECT count(id) FROM `lvl3` WHERE lvl='".$sf_r['loginid']."' and status='Active'");
	$lv_r3=mysqli_fetch_array($lv3);
	$tlv3=$lv_r3['0']*2;
	if($tlv3>='1' && $tlv1>='1' && $tlv1>='2'  && $ttu>='3'){
	mysqli_query($con,"INSERT INTO `level_in`(`userid`, `amount`, `r_date`, `lvl`) VALUES ('".$sf_r['loginid']."','".$tlv3."',NOW(),'Level 3')");}
	//----- Level 4
	$lv4=mysqli_query($con,"SELECT count(id) FROM `lvl4` WHERE lvl='".$sf_r['loginid']."' and status='Active'");
	$lv_r4=mysqli_fetch_array($lv4);
	$tlv4=$lv_r4['0']*2;
	if($tlv4>='1' && $tlv1>='1' && $tlv1>='2' && $tlv1>='3'  && $ttu>='4'){
	mysqli_query($con,"INSERT INTO `level_in`(`userid`, `amount`, `r_date`, `lvl`) VALUES ('".$sf_r['loginid']."','".$tlv4."',NOW(),'Level 4')");}
	//------- Lvel 5
	$lv5=mysqli_query($con,"SELECT count(id) FROM `lvl5` WHERE lvl='".$sf_r['loginid']."' and status='Active'");
	$lv_r5=mysqli_fetch_array($lv5);
	$tlv5=$lv_r5['0']*1;
	if($tlv5>='1' && $tlv1>='1' && $tlv1>='2' && $tlv1>='3' && $tlv1>='4'  && $ttu>='5'){
	mysqli_query($con,"INSERT INTO `level_in`(`userid`, `amount`, `r_date`, `lvl`) VALUES ('".$sf_r['loginid']."','".$tlv5."',NOW(),'Level 5')");}
	//------ Level 6
	$lv6=mysqli_query($con,"SELECT count(id) FROM `lvl6` WHERE lvl='".$sf_r['loginid']."' and status='Active'");
	$lv_r6=mysqli_fetch_array($lv6);
	$tlv6=$lv_r6['0']*1;
	if($tlv6>='1' && $tlv1>='1' && $tlv1>='2' && $tlv1>='3' && $tlv1>='4' && $tlv1>='5'  && $ttu>='6'){
	mysqli_query($con,"INSERT INTO `level_in`(`userid`, `amount`, `r_date`, `lvl`) VALUES ('".$sf_r['loginid']."','".$tlv6."',NOW(),'Level 6')");}
	//----- Level 7
	$lv7=mysqli_query($con,"SELECT count(id) FROM `lvl7` WHERE lvl='".$sf_r['loginid']."' and status='Active'");
	$lv_r7=mysqli_fetch_array($lv7);
	$tlv7=$lv_r7['0']*1;
	if($tlv7>='1' && $tlv1>='1' && $tlv1>='2' && $tlv1>='3' && $tlv1>='4' && $tlv1>='5' && $tlv1>='6'  && $ttu>='7'){
	mysqli_query($con,"INSERT INTO `level_in`(`userid`, `amount`, `r_date`, `lvl`) VALUES ('".$sf_r['loginid']."','".$tlv7."',NOW(),'Level 7')");}
	//------ Level 8
	$lv8=mysqli_query($con,"SELECT count(id) FROM `lvl8` WHERE lvl='".$sf_r['loginid']."' and status='Active'");
	$lv_r8=mysqli_fetch_array($lv8);
	$tlv8=$lv_r8['0']*1;
	if($tlv8>='1' && $tlv1>='1' && $tlv1>='2' && $tlv1>='3' && $tlv1>='4' && $tlv1>='5' && $tlv1>='6' && $tlv1>='7'  && $ttu>='8'){
	mysqli_query($con,"INSERT INTO `level_in`(`userid`, `amount`, `r_date`, `lvl`) VALUES ('".$sf_r['loginid']."','".$tlv8."',NOW(),'Level 8')");}
	//----- Level 9
	$lv9=mysqli_query($con,"SELECT count(id) FROM `lvl9` WHERE lvl='".$sf_r['loginid']."' and status='Active'");
	$lv_r9=mysqli_fetch_array($lv9);
	$tlv9=$lv_r9['0']*1;
	if($tlv9>='1' && $tlv8>='1' && $tlv1>='1' && $tlv1>='2' && $tlv1>='3' && $tlv1>='4' && $tlv1>='5' && $tlv1>='6' && $tlv1>='7'  && $ttu>='9'){
	mysqli_query($con,"INSERT INTO `level_in`(`userid`, `amount`, `r_date`, `lvl`) VALUES ('".$sf_r['loginid']."','".$tlv9."',NOW(),'Level 9')");}
	//----- Level 10
	$lv10=mysqli_query($con,"SELECT count(id) FROM `lvl10` WHERE lvl='".$sf_r['loginid']."' and status='Active'");
	$lv_r10=mysqli_fetch_array($lv10);
	$tlv10=$lv_r10['0']*1;
	if($tlv10>='1' && $tlv9>='1' && $tlv8>='1' && $tlv1>='1' && $tlv1>='2' && $tlv1>='3' && $tlv1>='4' && $tlv1>='5' && $tlv1>='6' && $tlv1>='7'  && $ttu>='10'){
	mysqli_query($con,"INSERT INTO `level_in`(`userid`, `amount`, `r_date`, `lvl`) VALUES ('".$sf_r['loginid']."','".$tlv10."',NOW(),'Level 10')");}
}
mysqli_query($con,"UPDATE `user` SET `l_status`='Unactive'");
?>
