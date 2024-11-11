<?php
session_start();
if(isset($_SESSION['id']) && $_SESSION['use_type']=='admin'){
}
else{
	echo '<script>alert("Access denied");window.location.assign("index.php");</script>';
}
?>