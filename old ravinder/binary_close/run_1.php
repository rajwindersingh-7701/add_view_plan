<?php
die;
date_default_timezone_set('Asia/Kolkata');

$db = mysqli_connect("localhost", "payadsf1_user", "5R1gGMTEQUP7", "payadsf1_ads") or die('Sorry, Site is Under maintenance !');
echo 'cron is working ....';
$date = date("Y-m-d") . ' 00:00:00';
$dateCurrent = $date . 'binary';
mysqli_query($db, "INSERT INTO `cron_run`(`count`) VALUES ('$dateCurrent')");
$date = date("Y-m-d") . ' 00:01:01';
$query = mysqli_query($db, "SELECT * FROM `user_green` WHERE status='0'");

while ($userGreen = mysqli_fetch_array($query)) {

    $ugid = $userGreen['id'];
    $uname = $userGreen['user_id'];
    $preid = 0;
    if ($uname === $preid) {
        break;
    }
    $preid = $userGreen['user_id'];
    $userName = $userGreen['user_id'];
    $pak = $userGreen['package'];
    $userData = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` WHERE user_id = '$userName'"));
    $pak = $userData['package'];
    $pakData = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `package` WHERE id = '$pak'"));
    $position = $userData["position"];

    $packagePv = $pakData["profit"];
    $packagePv = $pakData["profit"];
//    if($userGreen['pv']!='register'){
//        $packagePv = $userGreen["pv"];
//    }
    $sponser = $userData["sponser"];
    $while = true;
    $oldPv = 0;
    $oldPv1 = 0;
    $pvinsert = 0;
    $i = 0;
    $mainSponsor = "admin";
    $detailData = array();
    $unameid = $userName;
    $premactid = 0;
    $premactFromid = 0;
    $prePv = 0;
    $preusergreenid = 0;
//    echo $userName;
//    echo "<br>";
    while ($while == true) {

        if ($sponser == $mainSponsor || $sponser == '') {
// echo $sponser;die;
            $while = false;
            break;
        }
        $sponserCheck = mysqli_fetch_array(mysqli_query($db, "select `package`,`binary`,`onlybinary` from `user` where `user_id`='$sponser'"));
        $dataDetail = json_encode($detailData);
        $sponserId = getUserId($db, $sponser);
        $sponserIdName = $sponser;
        $packageStatus = getPackageUser($db, $sponser);

        if ($premactid == $sponserId and $premactFromid == $uname and $prePv == $packagePv and $preusergreenid == $userGreen['id']) {
            continue;
            $while = false;
            break;
        }

        mysqli_query($db, "INSERT INTO `point_matching`(`user_id`,`userName`,`pv`,`type`, `position`, `from_id`,`detail`) VALUES ('$sponserId','$sponserIdName','$packagePv','credit','$position','$uname','')");
        $premactid = $sponserId;
        $premactFromid = $uname;
        $preusergreenid = $userGreen['id'];
        $prePv = $packagePv;
        $caping = getCaping($db, $packageStatus);
        $childAnother = getPoints($db, $position, $sponserId);
        $swallet = getWalleteStatus($db, $sponserId);
        $pvCash = 0;
        $leftChild = 0;
        $rightChild = 0;
        $dataDetail1 = array();
        $left = $leftChild;
        $right = $leftChild;

        $leftChild1 = getPoints($db, "right", $sponserId);
        $rightChild1 = getPoints($db, "left", $sponserId);

        if ($swallet < 1 and ( $sponserCheck['binary'] == 1 or $sponserCheck['onlybinary'] == 1) and $sponserCheck['package'] != 'InActive') {

            $desc = "Point matching income 7% from 2:1";

            $leftRatio = getRatio($db, "left", $sponserId);
            
            $rightRatio = getRatio($db, "right", $sponserId);

            if (($leftChild1 >= 999 and $rightChild1 >= 1998) or ( $leftChild1 >= 1998 and $rightChild1 >= 999)) {

                $i++;
                $userName = $sponser;
                $sponserArray = getUserFromUserName($db, $sponser);
                $sponser = $sponserArray['sponser'];
                $position = $sponserArray['position'];
                continue;
            }


            if ($leftRatio >= 2 && $rightRatio == 1) {
                $leftChild = getPoints1($db, "right", $sponserId);
                $rightChild = getPoints2($db, "left", $sponserId);
            } else if ($rightRatio >= 2 and $leftRatio == 1) {
                $leftChild = getPoints2($db, "right", $sponserId);
                $rightChild = getPoints1($db, "left", $sponserId);
            } else if ($rightRatio >= 2 and $leftRatio >= 1) {
                $leftChild = getPoints2($db, "right", $sponserId);
                $rightChild = getPoints1($db, "left", $sponserId);
            }
            $left = $leftChild;
            $right = $rightChild;
            if ($leftChild > $rightChild) {
                $matchPoint = 7 / 100 * $rightChild;
            } else {
                $matchPoint = 7 / 100 * $leftChild;
            }
        } else {

            $desc = "Point matching income 7%";

//            $leftChild1 = getPoints($db, "right", $sponserId);
//            $rightChild1 = getPoints($db, "left", $sponserId);

            if ($leftChild1 > 0 && $rightChild1 > 0) {
                if ($leftChild1 > $rightChild1) {
                    $leftChild = $rightChild1;
                    $rightChild = $rightChild1;
                    $matchPoint = 7 / 100 * $rightChild;
                    $left = $rightChild;
                    $right = $rightChild;
                } else {
                    $leftChild = $leftChild1;
                    $rightChild = $leftChild1;
                    $matchPoint = 7 / 100 * $leftChild;
                    $left = $leftChild;
                    $right = $leftChild;
                }
//                $matchPoint = 90;
            }
        }
//        $dataDetail1 = array();
//        $usernum = mysqli_num_rows(mysqli_query($db, "select `id` from `user` where `sponser_by`='$sponser'"));
//        if ($usernum < 3) {
//            $i++;
//            $userName = $sponser;
//            $sponserArray = getUserFromUserName($db, $sponser);
//            $sponser = $sponserArray['sponser'];
//            $position = $sponserArray['position'];
//            continue;
//        }

        if ($rightChild != 0 && $leftChild != 0) {
//            echo 'matching';
//            $dataDetail1["left"] = '';
//            $dataDetail1["right"] = '';
//            $dataDetail1 = json_encode($dataDetail1);

            $sponserIdName1 = getUserIdName($db, $sponserId);
            mysqli_query($db, "INSERT INTO `point_matching`(`user_id`,`userName`,`pv`,`type`, `position`, `from_id`,`detail`) VALUES ('$sponserId','$sponserIdName1','$left','debit','left','$unameid','')");
            mysqli_query($db, "INSERT INTO `point_matching`(`user_id`,`userName`,`pv`,`type`, `position`, `from_id`,`detail`) VALUES ('$sponserId','$sponserIdName1','$right','debit','right','$unameid','')");

            if ($packageStatus == "InActive") {
                $i++;
                $userName = $sponser;
                $sponserArray = getUserFromUserName($db, $sponser);
                $sponser = $sponserArray['sponser'];
                $position = $sponserArray['position'];
                continue;
            }
//            echo "select sum(amount) as sumAMount from `wallet` where userId='$sponserId'  and datetime > '$date' and transaction_type='point_matching' group by userId";
//    echo   "select sum(amount) as sumAMount from `wallet` where userId='$sponserId'  and datetime > '$date' and transaction_type='point_matching' group by userId";
            $resultData = mysqli_fetch_array(mysqli_query($db, "select sum(amount) as sumAMount from `wallet` where userId='$sponserId'  and datetime > '$date' and transaction_type='point_matching' group by userId"));


            $loolWhile = true;

            if ($resultData['sumAMount'] < $caping and ( $sponserCheck['binary'] == 1 or $sponserCheck['onlybinary'] == 1) and $sponserCheck['package'] != 'InActive') {

                $rld = $resultData['sumAMount'];
                $pnt = $matchPoint + $rld;

                if ($matchPoint > $caping && $swallet < 1) {
                    $matchPoint = $caping;
//                    echo "INSERT INTO `wallet`(`userId`,`username`,`amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`, `walletType`) VALUES ('$sponserId','$sponser','$matchPoint','credit','$unameid','$desc','1','point_matching','BTC')";
                    mysqli_query($db, "INSERT INTO `wallet`(`userId`,`username`,`amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`, `walletType`) VALUES ('$sponserId','$sponser','$matchPoint','credit','$unameid','$desc','1','point_matching','INR')");
                } else if ($pnt > $caping) {
                    $mnt = $pnt - $caping;
                    $matchPoint = $caping - $rld;
//                    echo "INSERT INTO `wallet`(`userId`,`username`,`amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`, `walletType`) VALUES ('$sponserId','$sponser','$matchPoint','credit','$unameid','$desc','1','point_matching','BTC')";
                    mysqli_query($db, "INSERT INTO `wallet`(`userId`,`username`,`amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`, `walletType`) VALUES ('$sponserId','$sponser','$matchPoint','credit','$unameid','$desc','1','point_matching','INR')");
                } else if ($pnt <= $caping) {
//                    echo "INSERT INTO `wallet`(`userId`,`username`,`amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`, `walletType`) VALUES ('$sponserId','$sponser','$matchPoint','credit','$unameid','$desc','1','point_matching','BTC')";
                    mysqli_query($db, "INSERT INTO `wallet`(`userId`,`username`,`amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`, `walletType`) VALUES ('$sponserId','$sponser','$matchPoint','credit','$unameid','$desc','1','point_matching','INR')");
                }
//                echo "INSERT INTO `wallet`(`userId`,`username`,`amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`, `walletType`) VALUES ('$sponserId','$sponser','$matchPoint','credit','$unameid','$desc','1','point_matching','BTC')";
            }

            $sp = getUserFromUserId($db, $sponser);
            $vspName = $sp['sponser_by'];
            $com = $matchPoint;
            $lv = 1;
        }

        $i++;
        $userName = $sponser;
        $sponserArray = getUserFromUserName($db, $sponser);
        $sponser = $sponserArray['sponser'];
        $position = $sponserArray['position'];
    }
    mysqli_query($db, "UPDATE `user_green` SET `status` = '1' WHERE `user_green`.`id` = '$ugid'");
}

function getUserId($db, $sponser) {
    $user = mysqli_fetch_array(mysqli_query($db, "SELECT id FROM `user` WHERE user_id='$sponser'"));
    return $user['id'];
}

function getUserIdName($db, $sponser) {
    $user = mysqli_fetch_array(mysqli_query($db, "SELECT user_id FROM `user` WHERE id='$sponser'"));
    return $user['user_id'];
}

function getWalleteStatus($db, $uid) {
    $wallet = mysqli_num_rows(mysqli_query($db, "SELECT amount FROM `wallet` WHERE userId='$uid' && type='credit' && transaction_type='point_matching'"));
    return $wallet;
}

function getPoints($db, $position, $sponser) {
    $totalpv = 0;
    $creditPv = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(pv) as pvsum FROM `point_matching` WHERE user_id='$sponser' AND position!='$position' AND `type`='credit'"));
    $debitPv = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(pv) as pvsum FROM `point_matching` WHERE user_id='$sponser' AND position!='$position' AND `type`='debit'"));
    $totalpv = $creditPv['pvsum'] - $debitPv['pvsum'];
    return $totalpv;
    exit;
}

function getRatio($db, $position, $sponser) {
    $result = 0;
    $result = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `point_matching` WHERE user_id='$sponser' AND position='$position' AND `type`='credit'"));
    return $result;
    exit;
}

function getUserFromUserName($db, $id, $param = null) {
    if (isset($param)) {
        $user = mysqli_fetch_array(mysqli_query($db, "SELECT " . $param . " FROM `user` WHERE user_id='$id'"));
        return $user;
        exit;
    }
    $user = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` WHERE user_id='$id'"));
    return $user;
    exit;
}

function getUserFromUserId($db, $id, $param = null) {
    if (isset($param)) {
        $user = mysqli_fetch_array(mysqli_query($db, "SELECT " . $param . " FROM `user` WHERE id='$id'"));
        return $user;
        exit;
    }
    $user = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` WHERE user_id='$id'"));
    return $user;
    exit;
}

function getPoints1($db, $position, $sponser) {
    $totalpv = 0;
//    echo "SELECT SUM(pv) as pvsum FROM (SELECT pv FROM `point_matching` WHERE user_id='$sponser' AND position!='$position' AND `type`='credit' LIMIT 2) as sum";die;
    $creditPv = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(pv) as pvsum FROM (SELECT pv FROM `point_matching` WHERE user_id='$sponser' AND position!='$position' AND `type`='credit' LIMIT 2) as sum"));
    return $creditPv['pvsum'];
    exit;
}

function getPoints2($db, $position, $sponser) {
    $totalpv = 0;
    $creditPv = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(pv) as pvsum FROM (SELECT pv FROM `point_matching` WHERE user_id='$sponser' AND position!='$position' AND `type`='credit' LIMIT 1) as sum"));
    return $creditPv['pvsum'];
    exit;
}

function getPackageUser($db, $sponser) {
    $user = mysqli_fetch_array(mysqli_query($db, "SELECT package FROM `user` WHERE user_id='$sponser'"));
    return $user['package'];
}

function getCaping($db, $packageStatus) {
    $pack = mysqli_fetch_array(mysqli_query($db, "SELECT caping FROM `package` WHERE id='$packageStatus'"));
    return $pack['caping'];
}

function getLevel($lv, $points) {
    if ($points >= '1500' && $lv == 1) {
        return 10;
    } else if ($points >= '3000' && $lv == 2) {
        return 5;
    } else if ($points >= '5000' && $lv == 3) {
        return 3;
    } else if ($points >= '7000' && $lv == 4) {
        return 1;
    } else if ($points >= '10000' && $lv == 5) {
        return 1;
    } else {
        return 0;
    }
}

echo "Cron run";
