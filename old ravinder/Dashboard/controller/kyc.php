<?php

require_once("../../database/db.php");
require_once("userClass.php");
$userClass = new userClass();
$userData = $_SESSION['user'];
$userId = $userData['id'];
$query = mysqli_query($db, "SELECT * FROM `user` WHERE id='$userId'");
$userData = mysqli_fetch_array($query);
//print_r($_POST);

if (isset($_POST['kyc'])) {
    
    $checkData = mysqli_query($db, "SELECT * FROM `user_kyc` WHERE account_number='" . $_POST['account_number'] . "'");
$check = mysqli_fetch_array($checkData);
if(!empty($check)){
    $_SESSION["invest"] = array("msg" => "Account No Already  Exists.", "status" => "false");
    echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
    exit; 
}

        $sql = "INSERT INTO `user_kyc`(`userId`,`account_name`,`bank_ifsc`, `account_number`, `pan`, `adhar`,`kyc_status`) VALUES ('" . $userData['user_id'] . "','" . $_POST['account_name'] . "','" . $_POST['bank_name'] . "','" . $_POST['bank_ifsc'] . "','" . $_POST['account_number'] . "','" . $_POST['pan'] . "','" . $_POST['adhar'] . "','1')";
//			echo $sql;die;
        mysqli_query($db, $sql);
        $_SESSION["invest"] = array("msg" => "Your request successfully submitted.", "status" => "true");
//			echo "done";	
header('Location:https://growmoney.me/Dashboard/user_kyc_form.php');
}

?>