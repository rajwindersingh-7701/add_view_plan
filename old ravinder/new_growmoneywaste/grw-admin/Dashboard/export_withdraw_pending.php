<?php
require_once("../../database/db.php");
// $user_id = $_GET['uid'];

$columnHeader = '';
$columnHeader = "Name" . "\t" . "User id". "\t" . "Phone" . "\t" . "Bank Name" . "\t" . "Account Name" . "\t" . "Account IFSC" . "\t" . "Account Number" . "\t". "Amount" . "\t". "Date" . "\t";

$q = "SELECT * FROM  `withdraw` where status!='done'";
$setData = '';
$i = 1;
$queryUser = mysqli_query($db, $q);

while ($dataQuery = mysqli_fetch_array($queryUser)) {

    $userquery = mysqli_query($db, "SELECT `name`,`user_id`,`phone`,`bank_name`,`bank_ifsc`,`account_name`,`account_number` FROM `user` where `id`= '" . $dataQuery['userId'] . "'");
    $userresult = mysqli_fetch_array($userquery);
//    print_r($userresult['user_id']);die('fsadf11');
    $name = $userresult['name'];
    $user_id = $userresult['user_id'];
    $phone = (int)$userresult['phone'];
    $bank_name = $userresult['bank_name'];
    $bank_ifsc = $userresult['bank_ifsc'];
    $account_name = $userresult['account_name'];
	$account_number =  mb_convert_encoding($userresult['account_number'],"UTF-7", "EUC-JP");
    $amount = $dataQuery['amount'];
    $date = $dataQuery['date'];
    $rowData = '';
    if (count($userresult) == 0) {
        continue;
    }
    extract($userresult);
    $name = '"' . $name . '"' . "\t";
    $rowData .= $name;
    $user_id = '"' . $user_id . '"' . "\t";
    $rowData .= $user_id;
    $phone = '"' . $phone . '"' . "\t";
    $rowData .= $phone;
    $bank_name = '"' . $bank_name . '"' . "\t";
    $rowData .= $bank_name;
    $bank_ifsc = '"' . $bank_ifsc . '"' . "\t";
    $rowData .= $bank_ifsc;
    $account_name = '"' . $account_name . '"' . "\t";
    $rowData .= $account_name;
    $account_number = '"' . $account_number . '"' . "\t";
    $rowData .= $account_number;
    $amount = '"' . $amount . '"' . "\t";
    $rowData .= $amount;
    $date = '"' . $date . '"' . "\t";
    $rowData .= $date;
    
    $setData .= trim($rowData) . "\n";
}

header("Content-type: application/octet-stream");


header("Content-Disposition: attachment; filename=User_Downline_Reoprt.xls");


header("Pragma: no-cache");


header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";
//die;
?>

