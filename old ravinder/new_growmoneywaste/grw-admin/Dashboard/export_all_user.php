<?php
require_once("../../database/db.php");
// $user_id = $_GET['uid'];

$columnHeader = '';
$columnHeader = "Name" . "\t" . "User id" . "\t" . "Phone" . "\t" . "Email" . "\t" . "Position" . "\t" . "Master Key" . "\t" . "Password" . "\t" . "Date" . "\t" . "Paid Date" . "\t";

$q = "SELECT * FROM  `user` where user_id != 'admin'";
$setData = '';
$i = 1;
$queryUser = mysqli_query($db, $q);

while ($dataQuery = mysqli_fetch_array($queryUser)) {
    $name = $dataQuery['name'];
    $user_id = $dataQuery['user_id'];
    $phone = (int)$dataQuery['phone'];
    $email = $dataQuery['email'];

    $position = $dataQuery['position'];
    $master_key = $dataQuery['master_key'];
    $password = $dataQuery['password'];
    $Date = $dataQuery['Date'];
    $paid_date = $dataQuery['paid_date'];

    $rowData = '';
    $name = '"' . $name . '"' . "\t";
    $rowData .= $name;
    $user_id = '"' . $user_id . '"' . "\t";
    $rowData .= $user_id;
    $phone = '"' . $phone . '"' . "\t";
    $rowData .= $phone;
    $email = '"' . $email . '"' . "\t";
    $rowData .= $email;
    $position = '"' . $position . '"' . "\t";
    $rowData .= $position;
    $master_key = '"' . $master_key . '"' . "\t";
    $rowData .= $master_key;
    $password = '"' . $password . '"' . "\t";
    $rowData .= $password;
    $Date = '"' . $Date . '"' . "\t";
    $rowData .= $Date;
    $paid_date = '"' . $paid_date . '"' . "\t";
    $rowData .= $paid_date;

    $setData .= trim($rowData) . "\n";
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=User_Downline_Reoprt.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";
//die;