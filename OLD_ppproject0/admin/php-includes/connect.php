<?php
	$db_host = "localhost";
	$db_user = "superdig";
	$db_pass = "15ZCgMY3PUcw";
	$db_name = "superdig_GNI";
	
	$con =  mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if(mysqli_connect_error()){
		echo 'connect to database failed';
	}
?>