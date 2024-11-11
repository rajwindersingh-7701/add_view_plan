<?php
require_once("../database/db.php");
include_once("userClass.php");

$usreClass = new user();
if(isset($_REQUEST["type"])){
	if($_REQUEST["type"] =="logout"){
		unset($_SESSION);
		unset($_SESSION['admin']);
		unset($_SESSION['user']);
		session_destroy();
                
//		header("location:../");die;
                
                echo "<script type='text/javascript'> document.location = '../'; </script>";exit;
	}
}

