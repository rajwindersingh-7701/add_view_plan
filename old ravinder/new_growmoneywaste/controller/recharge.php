<?php
die;
require_once("../database/db.php");
require_once("../Dashboard/controller/userClass.php");
$userClass = new userClass();
//die('fasfda');
$userData = $_SESSION['user'];
if (empty($_SESSION['user'])) {
    echo "<span class='text-danger'>Please First Login Your Account.</span>";
    exit;
}

if ($_REQUEST['crf'] != $_SESSION['crf']) {
    echo "<span class='text-danger'>Something went wrong.</span>";
    exit;
}

$userId = $userData['id'];
$query = mysqli_query($db, "SELECT * FROM `user` WHERE id='$userId'");
$userData = mysqli_fetch_array($query);
$request = array();
foreach ($_REQUEST as $k => $v) {
    if (is_array($v)) {
        foreach ($v as $k2 => $v2) {
            if (is_array($v2)) {
                foreach ($v2 as $k3 => $v3) {
                    $request[$k][$k2][$k3] = mysqli_real_escape_string($db, $v3);
                }
            } else {
                $request[$k][$k2] = mysqli_real_escape_string($db, $v2);
            }
        }
    } else {
        $request[$k] = mysqli_real_escape_string($db, $v);
    }
}

$response = "";
//print_r($request);
if (isset($request["reachargeType"])) {
//    die('fsdfsdf');
    if ($request["reachargeType"] == "mobile" || $request["reachargeType"] == "dth") {
        $walletbalance = $userClass->getWallet($db, 'INR', $userData['id']);
        if ($walletbalance < $request["amount"]) {
            echo "<span class='text-danger'>You Don't have sufficient balance.</span>";
            exit;
        }
        mysqli_query($db, "INSERT INTO `recharge`(`userId`,`reachargeType`,`amount`,`number`, `status`, `response`) VALUES ('" . $userData['user_id'] . "','".$request["reachargeType"]."','" . $request['amount'] . "','" . $request["number"] . "','" . $response_api["status"] . "','')");
//        echo "INSERT INTO `recharge`(`userId`,`amount`,`number`, `status`, `response`) VALUES ('" . $userData['user_id'] . "','" . $request['amount'] . "'," . $request["number"] . "','" . $response_api["status"] . "','$response_api')";die;
        $paywallet = mysqli_insert_id($db);

        $parm = array("number" => $request["number"], "amount" => $request["amount"], "provider_id" => $request["provider_id"], "client_id" => $paywallet);
        $response_api = apihit($parm, "https://api.pay2all.in/v1/payment/recharge", "POST");
        $response_api = json_decode($response_api, true);
         $resp = json_encode($response_api, true);
        if($response_api["status"] == 0 || $response_api["status"] == 1){
            mysqli_query($db, "INSERT INTO `wallet`(`userId`,`username`, `amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`,`walletType`) VALUES ( '" . $userData['id'] . "','" . $userData['user_id'] . "', '" . $request['amount'] . "', 'debit','$paywallet', 'Recharge Successfully','', 'recharge','INR')");
            mysqli_query($db, " UPDATE `recharge` SET  `status`='" . $response_api["status"] . "',`msg`='".$response_api["message"]."',`response`='$resp' WHERE `id`='$paywallet'");
            $response = "<span class='text-success'>{$response_api["message"]}</span>";
        }else if ($response_api["status"] == 2) {
            mysqli_query($db, " UPDATE `recharge` SET  `status`='" . $response_api["status"] . "',`msg`='".$response_api["message"]."',`response`='$resp' WHERE `id`='$paywallet'");
            $response = "<span class='text-danger'>{$response_api["message"]}</span>";
        }else if ($response_api["status"] == 3) {
            mysqli_query($db, " UPDATE `recharge` SET  `status`='" . $response_api["status"] . "',`msg`='".$response_api["message"]."',`response`='$resp' WHERE `id`='$paywallet'");
            mysqli_query($db, "INSERT INTO `wallet`(`userId`,`username`, `amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`,`walletType`) VALUES ( '" . $userData['id'] . "','" . $userData['user_id'] . "', '" . $request['amount'] . "', 'debit','$paywallet', 'Recharge Status Processing, Payment Hold','', 'recharge_process','INR')");
            $response = "<span class='text-warning'>{$response_api["message"]}</span>";
        }
    }
}
echo $response;

function apihit($parameters, $url, $method = "POST") {
    $key = ""; //you have to add personal access token 
    $header = ["Accept:application/json", "Authorization:Bearer " . $key];
//    $method = 'POST';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $response = curl_exec($ch);
    return $response;
// //[JSON RESPONSE]
}
