<?php

//die;
require_once("../../database/db.php");
date_default_timezone_set('Asia/Kolkata');

$daycurrent = date("Y-m-d") . ' 00:00:00';

$us_Id = $_SESSION['user']['id'];
//echo  $datecurrent = date("Y-m-d H:i:s");
$query = mysqli_query($db, "SELECT * FROM `user` WHERE `id`='$us_Id'");
$userData = mysqli_fetch_array($query);
$pquery = mysqli_query($db, "SELECT * FROM `package` WHERE `id`='" . $userData['package'] . "'");
$packData = mysqli_fetch_array($pquery);

require_once("userClass.php");
$userClass = new userClass();
$_GET = $userClass->extract_post($db, $_GET);

if (isset($_GET['uid'])) {

    if ($_SESSION['crf'] != $_GET['crf']) {
        return 0;
    }

//    if (date("D") != "Sun") {
//        echo 'false';
//    }


    $pre = $_SESSION['ad'];
    if ($_GET['uid'] == 1) {
        $pre = 0;
    }
    $current = $_GET['uid'] - 1;
    if ($current == $pre) {


        $query1 = "select * from `googleadd` where status=0";
        $res = mysqli_num_rows(mysqli_query($db, $query1));
      

        echo $_GET['uid'] .'=='. $res;
        if ($_GET['uid'] == $res) {

            if ($userData['package'] != 'InActive') {
                $datecurrent = date("Y-m-d H:i:s");
                $checkdate = date("Y-m-d") . ' 00:00:01';
                $query1 = mysqli_query($db, "SELECT `id` FROM `wallet` WHERE userId='" . $userData['id'] . "' and `transaction_type`='ad' and datetime>'$checkdate'");
                $addcehcld = mysqli_num_rows($query1);
                $addcehcld = 0;
                
                      echo "ccccc";
                if ($addcehcld < 1) {
                    $amnt = $packData['roi'];

//                    if($userData['packageAmount']==2000){
//                        $amnt = 35;
//                        if($userData['booster']==1){
//
//                            mysqli_query($db, "INSERT INTO `wallet`(`userId`,`username`, `amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`,`walletType`,`datetime`) VALUES ( '".$userData['id']."','".$userData['user_id']."', '15', 'credit','', 'Booster Income','', 'booster','ROI','$datecurrent')");
//                        }
//                    }else if($userData['packageAmount']==5000){
//                        $amnt = 50;
//                    }else if($userData['packageAmount']==10000){
//                        $amnt = 100;
//                    }
//                       echo  $userData['packageAmount'];
//                       echo  $userData['booster'];

                    
                    echo "aaaaaa";
                    $cap = $userData['cap'];

                    $totalincome = mysqli_num_rows(mysqli_query($db, "SELECT count(*) as cnt  FROM `wallet` WHERE `username`='" . $sponserget['user_id'] . "' and `datetime`>'$daycurrent'"));
                    $totalamtc = $amnt + $totalincome['cnt'];
                   
                    if ($cap > $totalamtc) {
                         echo "false";
                        exit;
                    }
                   
      echo "bbbbbbb";
                    if ($userData['package'] != 'InActive') {
                        echo "INSERT INTO `wallet`(`userId`,`username`, `amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`,`walletType`,`datetime`) VALUES ( '" . $userData['id'] . "','" . $userData['user_id'] . "', '$amnt', 'credit','', 'Ad view income','', 'ad','INR','$datecurrent')";
                        mysqli_query($db, "INSERT INTO `wallet`(`userId`,`username`, `amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`,`walletType`,`datetime`) VALUES ( '" . $userData['id'] . "','" . $userData['user_id'] . "', '$amnt', 'credit','', 'Ad view income','', 'ad','INR','$datecurrent')");
                    }

                    $querytt = mysqli_query($db, "SELECT SUM(amount) as sm FROM `wallet` WHERE userId='" . $userData['id'] . "' and `type`!='debit' and `walletType`='INR' and `transaction_type`='ad'");

                    $addcehttts = mysqli_fetch_array($querytt);

//                    echo "INSERT INTO `wallet`(`userId`,`username`, `amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`,`walletType`,`datetime`) VALUES ( '".$userData['id']."','".$userData['user_id']."', '$amnt', 'credit','', 'Ad view income','', 'ad','ROI','$datecurrent')";DIE;


                    $loop = true;
                    $spnser = $userData['sponser_by'];
                    $other_user_id = $userData['user_id'];
                    $levelloop = 1;
                    $usid = '';
                    while ($loop == false) {
                        if ($levelloop >= 9) {
                            $loop = true;
                            break;
                            exit;
                        }
                        $levelcommision1 = levelIncome($levelloop);
                        $levedirect = leveldirect($levelloop);
                        //        print_r($levelcommision1);
                        //        echo $amountpack.'<br>';
                        $levelcommision = $levelcommision1;
                        //        echo $levelcommision;
                        if ($spnser == 'admin' or $spnser == '') {
                            $loop = true;
                            break;
                        }

                        $type = 'level_ad';
                        $desc = "$levelloop Task level income from id $other_user_id";

                        $sponserget = mysqli_fetch_array(mysqli_query($db, "select `id`,`user_id`,`package`,`sponser_by`,`cap` from `user` where `user_id`='$spnser'"));
                        //       echo $spnser.$sponserget['level'].'. <.' .$levelcommision1['direct'];

                        $directuser = mysqli_num_rows(mysqli_query($db, "select `id` from `user` where `sponser_by`='$spnser' and `package`!='InActive'"));

                        if ($sponserget['package'] == 'InActive') {
                            $spnser = $sponserget['sponser_by'];
                            $levelloop++;
                            continue;
                            exit;
                        }

                        $walletentry = mysqli_num_rows(mysqli_query($db, "SELECT count(*) as cnt  FROM `wallet` WHERE `transaction_type` = 'ad' and `username`='" . $sponserget['user_id'] . "' and `datetime`>'$daycurrent'"));
                        if ($walletentry['cnt'] > 0) {
                            $spnser = $sponserget['sponser_by'];
                            $levelloop++;
                            continue;
                            exit;
                        }

                        if ($directuser < $levedirect and $levelloop != 1) {
                            //            die($levelloop.'fsdaf');
                            $spnser = $sponserget['sponser_by'];
                            $levelloop++;
                            continue;
                            exit;
                        }

                        $totalincome = mysqli_num_rows(mysqli_query($db, "SELECT count(*) as cnt  FROM `wallet` WHERE `username`='" . $sponserget['user_id'] . "' and `datetime`>'$daycurrent'"));
                        $fnam = $totalincome['cnt']+$levelcommision;
                        if ($sponserget['cap'] > $fnam ) {
                            $spnser = $sponserget['sponser_by'];
                            $levelloop++;
                            continue;
                            exit;
                        }

                        //        echo "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $sponserget['id'] . "','" . $sponserget['user_id'] . "','$levelcommision', 'credit','$other_user_id', '$desc','$levelloop', '$type','BTC')";
//                            echo "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $sponserget['id'] . "','" . $sponserget['user_id'] . "','$levelcommision', 'credit','$other_user_id', '$desc','$levelloop', '$type','BTC')";
                        mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $sponserget['id'] . "','" . $sponserget['user_id'] . "','$levelcommision', 'credit','$other_user_id', '$desc','$levelloop', '$type','ROI')");
                        $spnser = $sponserget['sponser_by'];
                        $levelloop++;
                    }
                }
            }
//           unset($_SESSION['ad']);
        }
        $_SESSION['ad'] = $_GET['uid'];
        echo 'true1';
    } else {
        echo 'false';
    }

//    echo 'fsadf';
}

function levelIncome($level) {
    if ($level == 1) {
        return 5;
    } else if ($level == 2) {
        return 3;
    } else if ($level == 3) {
        return 3;
    } else if ($level == 4) {
        return 3;
    } else if ($level == 5) {
        return 3;
    } else if ($level >= 6 and $level <= 8) {
        return 2;
    }
}

function leveldirect($level) {
    if ($level == 1) {
        return 1;
    } else if ($level == 2) {
        return 2;
    } else if ($level == 3) {
        return 3;
    } else if ($level == 4) {
        return 4;
    } else if ($level == 5) {
        return 5;
    } else if ($level == 6) {
        return 6;
    } else if ($level == 7) {
        return 7;
    } else if ($level == 8) {
        return 8;
    }
}
