<?php include('check-login.php');
include('../connect.php');
$userid=strtoupper($_SESSION['userid']);
$sf=mysqli_query($con,"select * from user where loginid='".$userid."'");
$sf_r=mysqli_fetch_array($sf);

 $ms=mysqli_query($con,"SELECT * FROM `video` where srno='".$_GET['VID']."'");
      $ms_r=mysqli_fetch_array($ms);
	  $ns=$ms_r['srno']+1;
	  $date=date('Y-m-d');
	  $ch=mysqli_query($con,"select count(id) from video_view where userid='".$userid."' and r_date='".$date."'");
	  $ch_r=mysqli_fetch_array($ch);
	  $tch=$ch_r[0];
	  $chh=mysqli_query($con,"select count(id) from video_view where userid='".$userid."' and srno='".$_GET['VID']."' and r_date='".$date."'");
	  $chh_r=mysqli_fetch_array($chh);
	  $tchh=$chh_r[0];
	  if($tch!=$ns && $tchh=='0' && $_GET['VID']<='10'){
	  mysqli_query($con,"INSERT INTO `video_view`(`userid`, `srno`, `status`,`r_date`) VALUES ('".$userid."','".$_GET['VID']."','Active',NOW())");
	  
	  }
	  $us=mysqli_query($con,"select * from user where status='Active' and loginid='".$userid."'");
	  $us_r=mysqli_fetch_array($us);
	  
	  
	  if($tch=='8' && $us_r['loginid']==$userid && $sf_r['re_status']=='Active'){
	   
	mysqli_query($con,"INSERT INTO `self_in`(`userid`, `amount`, `r_date`) VALUES ('".$userid."','15',NOW())");
	mysqli_query($con,"INSERT INTO `re_wallet`(`userid`, `amount`, `r_date`) VALUES ('".$userid."','15',NOW())");
	}elseif($tch=='8' && $us_r['loginid']==$userid){
		 mysqli_query($con,"INSERT INTO `self_in`(`userid`, `amount`, `r_date`) VALUES ('".$userid."','30',NOW())");}
		mysqli_query($con,"UPDATE `user` SET `l_status` = 'Active' WHERE `loginid`='".$us_r['loginid']."'");
	
	   echo '<script>window.location.assign("video.php?VID='.$ns.'");</script>';
	  
?>
