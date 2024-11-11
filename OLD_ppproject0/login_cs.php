<?php
ob_start();
SESSION_START();

require('connect.php');
$loginid = mysqli_real_escape_string($con,$_POST['user_id']);
$password = mysqli_real_escape_string($con,$_POST['password']);

 $localIp = getenv("REMOTE_ADDR") ;
 

$query = mysqli_query($con,"select * from user where loginid='$loginid' and password='$password'");
mysqli_num_rows($query);
if(mysqli_num_rows($query)>0){
	$_SESSION['userid'] = $loginid;
	$_SESSION['id'] = session_id();
	$_SESSION['login_type'] = "user";
	$_SESSION['username'] = $loginid;
	
	echo '<script>alert("Login Success.");window.location.assign("user/index.php");</script>';
	
}
else{
	echo '<script>window.location.assign("login.php");</script>';
}

?>