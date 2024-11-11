<?php
include_once("../../../database/db.php");
include_once("../../../model/userClass.php");
require_once("functionalityClass.php");

include_once("distributeIncome.php");
$fu = new functionalityClass();
$dsb = new distributeIncome();
//$const = new constant();
$usreClass = new user();



if (isset($_POST['kyc_id'])) {
    $msg = $_POST['remarks'];
     mysqli_query($db, "UPDATE `user_kyc` SET `kyc_status`=1,`kyc_remarks`='$msg' WHERE `id`='" . $_POST['id'] . "'");
    echo "<script type='text/javascript'> document.location = '../kyc_request.php'; </script>";
    exit;
}
if (isset($_POST['kyc_rj'])) {
    $msg = $_POST['remarks'];
     mysqli_query($db, "UPDATE `user_kyc` SET `kyc_status`='-1',`kyc_remarks`='$msg' WHERE `id`='" . $_POST['id'] . "'");
    echo "<script type='text/javascript'> document.location = '../kyc_request.php'; </script>";
    exit;
}
