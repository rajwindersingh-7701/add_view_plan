<?php

require_once("../database/db.php");
require_once("../Dashboard/controller/userClass.php");
$userClass = new userClass();
//die('fasfda');
$userData = $_SESSION['user'];
if (empty($_SESSION['user'])) {
    echo "<span class='text-danger'>Please First Login Your Account.</span>";
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
    if ($request["reachargeType"] == "mobile") {
        $walletbalance = $userClass->getWallet($db, 'INR', $userData['id']);
        if($walletbalance < $request["amount"]){
            echo "<span class='text-danger'>You Don't have sufficient balance.</span>";
            exit;
        }
        mysqli_query($db, "INSERT INTO `recharge`(`userId`,`amount`,`number`, `status`, `response`) VALUES ('" . $userData['user_id'] . "','" . $request['amount'] . "','" . $request["mobile"] . "','" . $response_api["status"] . "','')");
//        echo "INSERT INTO `recharge`(`userId`,`amount`,`number`, `status`, `response`) VALUES ('" . $userData['user_id'] . "','" . $request['amount'] . "'," . $request["mobile"] . "','" . $response_api["status"] . "','$response_api')";die;
        $paywallet = mysqli_insert_id($db);

        $parm = array("number" => $request["mobile"], "amount" => $request["amount"], "provider_id" => $request["provider_id"], "client_id" => $paywallet);
        $response_api = apihit($parm, "https://api.pay2all.in/v1/payment/recharge", "POST");
        $response_api = json_decode($response_api, true);
        if ($response_api["status"] == 0 || $response_api["status"] == 1) {
            mysqli_query($db, "INSERT INTO `wallet`(`userId`,`username`, `amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`,`walletType`) VALUES ( '" . $userData['id'] . "','" . $userData['user_id'] . "', '" . $request['amount'] . "', 'debit','$paywallet', 'Mobile Recharge Successfully','', 'recharge','INR')");
            mysqli_query($db, " UPDATE `recharge` SET  `status`='" . $response_api["status"] . "',`response`='$response_api' WHERE `id`='$paywallet'");
            $response = "<span class='text-success'>{$response_api["message"]}</span>";
        } else if ($response_api["status"] == 2) {
            mysqli_query($db, " UPDATE `recharge` SET  `status`='" . $response_api["status"] . "',`response`='$response_api' WHERE `id`='$paywallet'");
            $response = "<span class='text-danger'>{$response_api["message"]}</span>";
        } else if ($response_api["status"] == 3) {
            mysqli_query($db, " UPDATE `recharge` SET  `status`='" . $response_api["status"] . "',`response`='$response_api' WHERE `id`='$paywallet'");
            mysqli_query($db, "INSERT INTO `wallet`(`userId`,`username`, `amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`,`walletType`) VALUES ( '" . $userData['id'] . "','" . $userData['user_id'] . "', '" . $request['amount'] . "', 'debit','$paywallet', 'Mobile Recharge Status Processing, Payment Hold','', 'recharge_process','INR')");
            $response = "<span class='text-warning'>{$response_api["message"]}</span>";
        }
    }
}
echo $response;

function apihit($parameters, $url, $method = "POST") {
    $key = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImZiNjBiNTAwMjczM2MxZGQ2NzcwODhiMzczY2FjMjk2ZGNhYTE1NTFjZGVmZDYyMDQ5MGYyOWI3ODZjZjExYzNiZWNmN2FhYTU5ZGZkMjdmIn0.eyJhdWQiOiIxIiwianRpIjoiZmI2MGI1MDAyNzMzYzFkZDY3NzA4OGIzNzNjYWMyOTZkY2FhMTU1MWNkZWZkNjIwNDkwZjI5Yjc4NmNmMTFjM2JlY2Y3YWFhNTlkZmQyN2YiLCJpYXQiOjE1ODk2MTc0NDAsIm5iZiI6MTU4OTYxNzQ0MCwiZXhwIjoxNjIxMTUzNDQwLCJzdWIiOiIyMDgiLCJzY29wZXMiOltdfQ.hfdYv4fBeo9ktABHdGOScbh96ux26z05K2fiPmqDW8aL-xlLYuIf2tGJIgrAYtBSbvCOsfoyOylelvyC_AkiNN8UJ83tV3b6dfWwgYgRqSSOmc9araeGMxuqZcmAgDhRplO8UxvceGmz9jP-2Ug0xz0fQRVxdte7N-1ghs8tGJLcNeDnd1oRqTXNmXsD1wuDP8KYRkkW30-M0x6-oCOZ9JF_p5uxtOE1UEw2NquhfuQJ41x6zFM62c8mVOYhc7oZ-QZx-p9yfeBvlk8S_yxWn1hRNE2jn8Yker2kKrmLT85cn7piVNZAGY6isghkDvIvuGEbyUxfOOHOH627AunmFgawGU69wwvSq_h0dyGXTpZLAMNZCzZyEPX69p4L7NC4Wpod20mrE-v0tKCSUdIOG0JWMH5WZf14Mi-q4QahfWI6vNLZwDNNr-UXFhmYUhjsc6RaxPCmKck9_rNPFDD8a1fEIMK-edbwa_MS55NsoMxo-XiEaOgc35qc-1S0SR9L7Hl8G7P1ddWe4Vq24RIsfYUDpM9yUTqk-HTDqRFDmGY7eohL_jFaapQnYYnsHpURqAGmt1ZB-PjyTwBXZXtP-2Pd4dDymYk1_aYR74JVy-LpMYuBcUC2spY6zTY5v5MxNbjj0gyJhdY5ACByFKpAuPpmj0blWLEb3ls-ajB5j18"; //you have to add personal access token 
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
