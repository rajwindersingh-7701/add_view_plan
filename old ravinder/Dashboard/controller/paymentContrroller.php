<?php

require_once("../../database/db.php");
require_once("userClass.php");
$userClass = new userClass();
$userData = $_SESSION['user'];
$userId = $userData['id'];
$query = mysqli_query($db, "SELECT * FROM `user` WHERE id='$userId'");
$userData = mysqli_fetch_array($query);
//print_r($_POST);


if (isset($_REQUEST["purchase"])) {
    $value = $userClass->extract_post($db, $_REQUEST);
    extract($value);
    if ($master_key != $userData["master_key"]) {
        $_SESSION["bid"] = array("msg" => "Invalid secure key.", "status" => false);
        echo "<script type='text/javascript'> document.location = '../pay.php?purchase=true&amnt=$amount'; </script>";
        exit;
    }
    $total = $userClass->getWallet($db, 'BD2', $userId);
    $co = $amount;
    $amount = $amount / (1 / $ratecoin);
    if ($amount < 10) {
        $_SESSION["bid"] = array("msg" => "You can buy minimum $10.", "status" => false);
        echo "<script type='text/javascript'> document.location = '../pay.php?purchase=true&amnt=$amount'; </script>";
        exit;
    }
    if ($amount > $total) {
        $_SESSION["bid"] = array("msg" => "Your Not sufficent balance for this transaction.", "status" => false);
        echo "<script type='text/javascript'> document.location = '../pay.php?purchase=true&amnt=$amount'; </script>";
        exit;
    }
    //    $co = number_format($amount/$ratecoin,8,'.','');
    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '$userId','" . $userData['user_id'] . "', '$amount', 'debit','', 'Debit amount from kdinar wallet','', 'purchase','BD2')");
    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '$userId','" . $userData['user_id'] . "', '$co', 'credit','', 'Credit KDC In Your KDC Wallet','', 'purchase','coin')");
    if ($userData['package'] == 'InActive') {
        mysqli_query($db, "UPDATE `user` SET `package`=1,`rank`='Partner',`rankDate`=NOW(),`level`=3 WHERE `id`='$userId'");
        mysqli_query($db, "UPDATE `level_downline` SET `rank`='Partner' WHERE `user_id`='$userId'");
    }
    $loop = false;
    $spnser = $userData['sponser_by'];
    $userId = $userData['user_id'];
    $levelloop = 1;
    $usid = '';
    while ($loop == false) {
        $levelcommision1 = levelIncome($levelloop);
        if ($spnser == 'admin' or $spnser == '') {
            $loop = true;
            break;
        }
        $com = $amount / 100 * $levelcommision1;
        $commission = number_format($com, 8, '.', '');
        $sponserget = mysqli_fetch_array(mysqli_query($db, "select `id`,`user_id`,`package`,`sponser_by`,`level` from `user` where `user_id`='$spnser'"));

        if ($sponserget['package'] == 'InActive' and ($sponserget['level'] < $levelloop)) {
            $spnser = $sponserget['sponser_by'];
            $levelloop++;
            continue;
        }
        if ($levelloop == 7 and $sponserget['rank'] != 'Manager') {
            $loop = true;
            break;
        }
        //        echo  "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $sponserget['id'] . "','" . $sponserget['user_id'] . "','$commission', 'credit','$userId', 'Affiliate commision','$levelloop', 'level','LEVEL') <br>";
        mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $sponserget['id'] . "','" . $sponserget['user_id'] . "','$commission', 'credit','$userId', 'Affiliate commision $levelcommision1% level $levelloop ','$levelloop', 'level','BD2')");
        $spnser = $sponserget['sponser_by'];
        $spnser = $sponserget['sponser_by'];
        $levelloop++;
    }
    $_SESSION["bid"] = array("msg" => "Credit KDC In Your KDC Wallet.", "status" => true);
    echo "<script type='text/javascript'> document.location = '../index.php'; </script>";
    exit;
}

function levelIncome($levelloop)
{
    if ($levelloop == 1) {
        return 8;
    } else if ($levelloop == 2) {
        return 7;
    } else if ($levelloop == 3) {
        return 5;
    } else if ($levelloop == 4) {
        return 4;
    } else if ($levelloop == 5) {
        return 3;
    } else if ($levelloop == 6) {
        return 2;
    } else if ($levelloop >= 7) {
        return 1;
    }
}

if (isset($_POST["wallet"])) {
    $value = $userClass->extract_post($db, $_REQUEST);
    extract($value);
    if ($master_key != $userData["master_key"]) {
        $_SESSION["transaction"] = array("msg" => "Security key.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }

    $total = $userClass->getWallet($db, 'BTC', $userId);
    if ($amount > $total) {
        $_SESSION["transaction"] = array("msg" => "Your Not sufficent balance for this transaction.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }

    if ($amount < 10) {
        $_SESSION["transaction"] = array("msg" => "Minimum amount for transfer $10.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }

    $description = "Transfer BTC to BDC wallet. Debit Amount:- $$amount";
    $description1 = "Transfer BTC to BDC wallet. Credit Amount:- $$amount";

    $currentdate = date('Y-m-d H:i:s');
    $admincharge = $amount / 100 * 10;
    $amounttransfer = $amount;

    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '$userId','" . $userData['user_id'] . "', '$amount', 'debit','', '$description','', 'transfer','BTC')");


    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '$userId','" . $userData['user_id'] . "', '$amounttransfer', 'credit','', '$description1','', 'transfer','BD2')");
    $_SESSION["transaction"] = array("msg" => "Succefully transfer Amount:- $$amounttransfer", "status" => "true");
    //    header("location:../add_fund.php");
    echo "<script type='text/javascript'> document.location = '../index.php'; </script>";
    exit;
}


if (isset($_POST["wallet_roi"])) {
    $value = $userClass->extract_post($db, $_REQUEST);
    extract($value);
    if ($master_key != $userData["master_key"]) {
        $_SESSION["transaction"] = array("msg" => "Invalid master key.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../add_fund.php'; </script>";
        exit;
    }

    $total = $userClass->getWallet($db, 'ROI', $userId);
    if ($amount > $total) {
        $_SESSION["transaction"] = array("msg" => "Your Not sufficent balance for this transaction.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../add_fund.php'; </script>";
        exit;
    }

    if ($amount < 10) {
        $_SESSION["transaction"] = array("msg" => "Minimum amount for transfer $10.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../add_fund.php'; </script>";
        exit;
    }

    $description = "Transfer Mining Fund to BDC wallet. Debit Amount:- $$amount";
    $description1 = "Transfer Mining Fund to BDC wallet. Credit Amount:- $$amount";

    $currentdate = date('Y-m-d H:i:s');
    //    $admincharge = $amount/100*10;
    //    $amounttransfer = $amount+$admincharge;

    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '$userId','" . $userData['user_id'] . "', '$amount', 'debit','', '$description','', 'transfer','ROI')");


    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '$userId','" . $userData['user_id'] . "', '$amounttransfer', 'credit','', '$description1','', 'transfer','BD2')");
    $_SESSION["transaction"] = array("msg" => "Succefully transfer Amount:- $$amounttransfer Mining wallet to BDC", "status" => "true");
    //    header("location:../add_fund.php");
    echo "<script type='text/javascript'> document.location = '../add_fund.php'; </script>";
    exit;
    die;
}




if (isset($_POST["transfer-money"])) {
    $value = $userClass->extract_post($db, $_POST);
    extract($value);
    if ($master_key != $userData["master_key"]) {
        $_SESSION["send"] = array("msg" => "Invalid Password.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> document.location = '../transfer-wallet.php'; </script>";
        exit;
    }

    $userQuery = mysqli_query($db, "SELECT * FROM  `user` where `user_id`='" . $uid . "'");
    $userTresult = mysqli_fetch_array($userQuery);

    //    
    if (count($userTresult) < 1) {
        $_SESSION["send"] = array("msg" => "User id not valid.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> document.location = '../transfer-wallet.php'; </script>";
        exit;
        die;
    }
    $total = $userClass->getWallet($db, 'epin', $userId);
    if ($amount > $total) {
        $_SESSION["send"] = array("msg" => "Your Not sufficent balance in income wallet for this transaction.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> document.location = '../transfer-wallet.php'; </script>";
        exit;
        die;
    }
    if ($amount < 500) {
        $_SESSION["send"] = array("msg" => "Minimum amount for transfer 500.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> document.location = '../transfer-wallet.php'; </script>";
        exit;
        die;
    }
    $description = "Sent " . $amount . " from " . $userData['user_id'] . ", Credit in user:-" . $user_id . "";
    $description1 = "Credit " . $amount . " in $user_id, From " . $userData['user_id'];
    $currentdate = date('Y-m-d H:i:s');
    $rUser = $userData['id'];
    $rUser_id = $userData['user_id'];
    $amountCharge = $amount;
    $amount1 = $amount;//$amount - $amountCharge;
    // echo "INSERT INTO  `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $userTresult['id'] . "','" . $userTresult['user_id'] . "', '$amount1', 'credit','$rUser_id', '$description1','', 'receive','epin')";
    // echo '<br>';
    // echo "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '$rUser','$rUser_id', '$amount', 'debit','', '$description','', 'send','epin')";
    // die;
    mysqli_query($db, "INSERT INTO  `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $userTresult['id'] . "','" . $userTresult['user_id'] . "', '$amount1', 'credit','$rUser_id', '$description1','', 'receive','epin')");
    //    mysqli_query($db, "INSERT INTO  `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '$rUser','$rUser_id', '$amountCharge', 'debit','', '5% admin charge deducted.','', 'receive','BD2')");
    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '$rUser','$rUser_id', '$amount', 'debit','', '$description','', 'send','epin')");
    $_SESSION["send"] = array("msg" => "Succefully transfer Amount:- $amount in user id:- " . $userTresult['user_id'], "status" => "true");
    //    header("location:../add_fund.php");
    echo "<script type='text/javascript'> document.location = '../transfer-wallet.php'; </script>";
    exit;
}

if (isset($_POST["pay-transfer-money"])) {
    $value = $userClass->extract_post($db, $_POST);
    extract($value);
    if ($master_key != $userData["master_key"]) {
        $_SESSION["send"] = array("msg" => "Invalid Password.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> document.location = '../pay-transfer-wallet.php'; </script>";
        exit;
    }

    $userQuery = mysqli_query($db, "SELECT count(id)as ids FROM  `user` where `sponser_by`='" . $user_id . "'");
    $userTresult = mysqli_fetch_array($userQuery);

    //    
    if ($userTresult['ids']  >= 2) {
        $_SESSION["send"] = array("msg" => "2 Direct Required.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> document.location = '../pay-transfer-wallet.php'; </script>";
        exit;
        die;
    }
    $total = $userClass->getWallet($db, 'INR', $userId);
    if ($amount > $total) {
        $_SESSION["send"] = array("msg" => "Your Not sufficent balance in income wallet for this transaction.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> document.location = '../pay-transfer-wallet.php'; </script>";
        exit;
        die;
    }
    if ($amount < 500) {
        $_SESSION["send"] = array("msg" => "Minimum amount for transfer 500.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> document.location = '../pay-transfer-wallet.php'; </script>";
        exit;
        die;
    }
    $description = "Sent " . $amount . " from " . $userData['user_id'] . ", Credit in user:-" . $user_id . "";
    $description1 = "Credit " . $amount . " in $user_id, From " . $userData['user_id'];
    $currentdate = date('Y-m-d H:i:s');
    $rUser = $userData['id'];
    $rUser_id = $userData['user_id'];
    $amountCharge = $amount / 100 * 8;
    $amount1 = $amount - $amountCharge;
    mysqli_query($db, "INSERT INTO  `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '$rUser','$rUser_id', '$amount1', 'credit','$rUser_id', '$description1','', 'receive','epin')");
    //    mysqli_query($db, "INSERT INTO  `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '$rUser','$rUser_id', '$amountCharge', 'debit','', '5% admin charge deducted.','', 'receive','BD2')");
    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '$rUser','$rUser_id', '$amount', 'debit','', '$description','', 'send','INR')");
    $_SESSION["send"] = array("msg" => "Succefully transfer Amount:- $amount", "status" => "true");
    //    header("location:../add_fund.php");
    echo "<script type='text/javascript'> document.location = '../pay-transfer-wallet.php'; </script>";
    exit;
}

if (isset($_POST["pay-with-btc"])) {
    $value = $userClass->extract_post($db, $_REQUEST);
    extract($value);
    $other_user_id = $userData['user_id'];
    $userquery = mysqli_query($db, "SELECT * FROM  `user` where `user_id`='$other_user_id'");
    $dataUSer = mysqli_fetch_array($userquery);
    $masteKey = $userClass->getMasterKey($db, $userData["id"]);
    $inuser = $dataUSer['id'];
    $inuser_id = $dataUSer['user_id'];

    $investquery = mysqli_query($db, "SELECT * FROM package WHERE id='$pack'");
    $investdata = mysqli_fetch_array($investquery);
    $amount = $investdata['price'];
    //    if ($amount < $investdata['minin']) {
    //        $_SESSION["top_up"] = array("msg" => "You can invest minimum $$min.", "status" => "false");
    ////        header("location:../pay_wallete.php?p=$pack");
    //         echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
    //        exit;
    //    }
    $investpackquery = mysqli_query($db, "SELECT * FROM package WHERE id=$pack");
    $investpack = mysqli_fetch_array($investpackquery);
    if (count($investpack) == 0) {
        $_SESSION["top_up"] = array("msg" => "Please enter amount according to package.", "status" => "false");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    $pack = $investpack['id'];
    if ($master_key != $masteKey) {
        $_SESSION["top_up"] = array("msg" => "Invalid  password.", "status" => "false");
        //        header("location:../pay_wallete.php?p=$pack");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }

    mysqli_query($db, "INSERT INTO `order_pack`(`userId`,`user_id`,`package`,`wallet`,`price`,`paid_date`,`status`,`payment_status`) VALUES ('$inuser','$inuser_id','$pack','BTC','$amount','NOW()',0,'Pending')");
    $order_last = mysqli_insert_id($db);

    $_SESSION["top_up"] = array("msg" => "Your investment request submit succefully.", "status" => "true");
    echo "<script type='text/javascript'> document.location = '../pay/pay.php?am=$amount&or=$order_last'; </script>";
    exit;
}

if (isset($_POST["pay-with-ewalet"])) {

    $value = $userClass->extract_post($db, $_REQUEST);
    extract($value);
    $other_user_id = $userData['user_id'];
    $userquery = mysqli_query($db, "SELECT * FROM  `user` where `user_id`='$other_user_id'");
    $dataUSer = mysqli_fetch_array($userquery);
    $totalinvetmetn = $dataUSer['totalinvestent'] + $amount;
    $masteKey = $userClass->getMasterKey($db, $userData["id"]);
    $inuser = $dataUSer['id'];
    $inuser_id = $dataUSer['user_id'];
    if ($master_key != $masteKey) {
        $_SESSION["top_up"] = array("msg" => "Invalid password.", "status" => "false");
        //        header("location:../pay_wallete.php?p=$pack");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    $investquery = mysqli_query($db, "SELECT `minin` FROM invest_pack WHERE minin =  ( SELECT MIN(minin) FROM invest_pack ) limit 1");
    $investdata = mysqli_fetch_array($investquery);
    $min = $investdata['minin'];
    if ($amount < $investdata['minin']) {
        $_SESSION["top_up"] = array("msg" => "You can invest minimum $$min.", "status" => "false");
        //        header("location:../pay_wallete.php?p=$pack");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    //    echo "SELECT `id`,`minin` FROM invest_pack WHERE minin >=$amount and maxin <= $amount limit 1";
    $investpackquery = mysqli_query($db, "SELECT `id`,`minin` FROM invest_pack WHERE minin <=$amount and maxin >= $amount limit 1");
    $investpack = mysqli_fetch_array($investpackquery);
    if (count($investpack) < 1) {
        $_SESSION["top_up"] = array("msg" => "Something went wrong.", "status" => "false");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }

    $pack = $investpack['id'];
    $total = $userClass->getWallet($db, 'epin', $userId);
    if ($amount > $total) {
        $_SESSION["top_up"] = array("msg" => "You Not sufficent balance in E-wallet for this transaction.", "status" => "false");
        //        header("location:../pay_wallete.php?p=$pack");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }

    mysqli_query($db, "INSERT INTO `wallet`(`userId`,`username`, `amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`,`walletType`) VALUES ( '$inuser','$inuser_id', '$amount', 'debit','$inuser_id', 'Investment Package','', 'joining','epin')");
    $paywallet = mysqli_insert_id($db);
    mysqli_query($db, "INSERT INTO `order_pack`(`userId`,`user_id`,`payment_id`,`package`,`wallet`,`price`,`paid_date`,`status`,`payment_status`) VALUES ('$inuser','$inuser_id','$paywallet','$pack','epin','$amount',NOW(),1,'paid')");
    $order_last = mysqli_insert_id($db);
    mysqli_query($db, "INSERT INTO `user_green`(`user_id`,`invested`,`soponsor_by`) VALUES ('$inuser_id','$totalinvetmetn','')");
    $q = mysqli_insert_id($db);

    mysqli_query($db, "UPDATE  `user` SET  `package`='$pack',`totalinvestent`='$totalinvetmetn',`order`='$order_last',packageAmount='$amount',`paid_date`=NOW(),`top_up_from`='" . $userData['user_id'] . "'  WHERE `id`='$inuser'");
    mysqli_query($db, "UPDATE `level_downline` SET  `package`='$amount',`invested`='$totalinvetmetn' where `user_id`='$inuser_id'");
    $loop = false;
    $spnser = $dataUSer['sponser_by'];
    $levelloop = 1;
    $usid = '';
    while ($loop == false) {
        $query = mysqli_query($db, "SELECT * FROM  `level_income` where `level`='$levelloop'");
        $dataQuery = mysqli_fetch_array($query);
        $levelcommision1 = $dataQuery['percentage'];
        $levelcommision = $levelcommision1 / 100 * $amount;
        if ($spnser == 'admin' or $spnser == '' or count($dataQuery) == 0) {
            $loop = true;
            break;
            exit;
        }
        $type = 'level';
        $desc = "$levelloop level income $levelcommision1% from user $other_user_id";
        $sponserget = mysqli_fetch_array(mysqli_query($db, "select `id`,`user_id`,`package`,`sponser_by` from `user` where `user_id`='$spnser'"));
        //        if ($sponserget['package'] == 'InActive') {
        //            $spnser = $sponserget['sponser_by'];
        //            $levelloop++;
        //            continue;
        //            exit;
        //        }
        mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $sponserget['id'] . "','" . $sponserget['user_id'] . "','$levelcommision', 'credit','$other_user_id', '$desc','$levelloop', '$type','INR')");
        $spnser = $sponserget['sponser_by'];
        $levelloop++;
    }

    $_SESSION["top_up"] = array("msg" => "Your investment request submit succefully.", "status" => "true");
    echo "<script type='text/javascript'> document.location = '../investment.php    '; </script>";
    exit;
    die;
}

if (isset($_POST["pay-with-wallet-other"])) {
    //    die('In Process');
    //    print_r($_POST);die;
    $value = $userClass->extract_post($db, $_REQUEST);
    extract($value);
    $userquery = mysqli_query($db, "SELECT * FROM  `user` where `user_id`='$other_user_id'");
    $dataUSer = mysqli_fetch_array($userquery);
    $masteKey = $userClass->getMasterKey($db, $userData["id"]);
    $packagePrevious = $dataUSer["package"];

    //    echo $packagePrevious;die;
    $user_id = $userData["user_id"];
    $user__id = $dataUSer["user_id"];
    $uid = $dataUSer["id"];

    if ($master_key != $masteKey) {
        $_SESSION["upgrade"] = array("msg" => "Invalid password.", "status" => "false");
        //        header("location:../pay_wallete.php?p=$pack");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    if (COUNT($dataUSer) == 0) {
        $_SESSION["upgrade"] = array("msg" => "Please enter valid user_id.", "status" => "false");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    $query = mysqli_query($db, "SELECT * FROM  `package` where `id`='$pack' ");
    $dataQuery = mysqli_fetch_array($query);

    if ($packagePrevious >= $pack and $packagePrevious != 'InActive') {
        $_SESSION["upgrade"] = array("msg" => "Sorry, You Can only request for upgrade Your package.", "status" => "false");
        //        header("location:../pay_wallete.php?p=$pack");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }

    //    echo $pack;die;
    $amount = $dataQuery['price'];
    if (count($dataQuery) < 1) {
        $_SESSION["upgrade"] = array("msg" => "Somthing Went Wrong.", "status" => "false");
        //        header("location:../pay_wallete.php?p=$pack");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    $total = $userClass->getWallet($db, 'epin', $userId);

    if ($dataQuery['price'] > $total) {
        $_SESSION["upgrade"] = array("msg" => "Your Not sufficent balance for this transaction.", "status" => "false");
        //        header("location:../pay_wallete.php?p=$pack");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    if ($dataQuery['price'] == 100000 and $userData['user_id'] != 'Ad220334') {
        $_SESSION["upgrade"] = array("msg" => "Your Not sufficent balance for this transaction.", "status" => "false");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }

    $pquery = mysqli_query($db, "SELECT * FROM  `package` where `id`='$pack'");
    $datapQuery = mysqli_fetch_array($pquery);

    $userNameId = $userClass->getUserIdFromId($db, $uid);
    $SponserId = $userClass->getSponserId($db, $uid);
    $userPhone = $userClass->getUserPhone($db, $uid);

    $description = "Transaction for id top up is Successfully top up";
    $OrderId = $dataQuery['id'];

    $currentdate = date('Y-m-d H:i:s');

    mysqli_query($db, "INSERT INTO `wallet`(`userId`,`username`, `amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`,`walletType`) VALUES ( '$userId','$user_id', '" . $dataQuery['price'] . "', 'debit','$other_user_id', '$description','', 'joining','epin')");
    $paywallet = mysqli_insert_id($db);
    $activationDate = date('Y-m-d H:i:s');

    mysqli_query($db, "INSERT INTO `tbl_activation_details`(`user_id`, `activator`, `package`,`topup_date`) VALUES ('$other_user_id','".$userData['user_id']."','".$datapQuery['price'] ."','$activationDate')");


    mysqli_query($db, "UPDATE `order_pack` SET `status`=2 WHERE `user_id`='$userNameId' and `status`=1");

    mysqli_query($db, "INSERT INTO `order_pack`(`userId`,`user_id`,`package`,`price`) VALUES ('" . $dataUSer['id'] . "','" . $dataUSer['user_id'] . "','$pack','" . $datapQuery['price'] . "')");
    $order_last = mysqli_insert_id($db);
    $paidDate = date('Y-m-d H:i:s');
    $last_wallet='';
    mysqli_query($db, "UPDATE `order_pack` SET `status`=1,`payment_status`='paid',`payment_id`='$last_wallet',`wallet`='BD2',`paid_date`='$paidDate' WHERE id='$order_last'");

    mysqli_query($db, "INSERT INTO `user_green`(`user_id`,`soponsor_by`,`pack`,`invested`) VALUES ('$userNameId','" . $dataUSer['sponser_by'] . "','$pack','" . $datapQuery['price'] . "')");
    $q = mysqli_insert_id($db);
    $ord='';
    mysqli_query($db, "UPDATE  `user` SET  `package`='$pack',`order`='$ord',packageAmount='$amount',`paid_date`=NOW(),`top_up_from`='" . $userData['user_id'] . "'  WHERE `id`='$uid'");

    mysqli_query($db, "UPDATE `level_downline` SET  `package`='$amount' where `user_id`='$userNameId'");
    mysqli_query($db, "UPDATE `downline_count` SET  `package`='$pack',`pack_amount`='$amount',`pack_date`='$paidDate' where `user_id`='$userNameId'");

    $userQuery1 = mysqli_query($db, "SELECT * FROM  `user` where `user_id`='" . $userData['sponser_by'] . "'");
    $userTresult1 = mysqli_fetch_array($userQuery1);
    $userQuery = mysqli_query($db, "SELECT count(id) as ids FROM  `user` where sponser_by ='" . $userTresult1['user_id'] . "'");
    $userTresult = mysqli_fetch_array($userQuery);
    $date1 = date('Y-m-d H:i:s');
    $date2 = date('Y-m-d H:i:s', strtotime($userTresult1['paid_date'] . '+1 month'));
    $diff1 = strtotime($date2) - strtotime($date1);
    //    
    if ($diff1 > 0) {                               
        if ($userTresult['ids']  >= 50) {
            mysqli_query($db, "UPDATE `user` SET `royalty_bonus`=1 WHERE `user_id`='" . $userTresult1['user_id'] . "' and `royalty_bonus`=0");
            mysqli_query($db, "INSERT INTO `tbl_roi`(`user_id`,`amount`,`days`,`type`,`creditDate`) VALUES ('" . $userTresult1['user_id '] . "','5000','365','royalty_bonus','$date1')");
            mysqli_insert_id($db);
        } elseif ($userTresult['ids']  >= 125) {
            mysqli_query($db, "UPDATE `user` SET `royalty_bonus`=2 WHERE `user_id`='" . $userTresult1['user_id'] . "' and `royalty_bonus`=1");
            mysqli_query($db, "UPDATE `tbl_roi` SET `amount`=7500 , `creditDate` = '$date1' WHERE `user_id`='" . $userTresult1['user_id'] . "'");
        } elseif ($userTresult['ids']  >= 225) {
            mysqli_query($db, "UPDATE `user` SET `royalty_bonus`=3 WHERE `user_id`='" . $userTresult1['user_id'] . "' and `royalty_bonus`=2");
            mysqli_query($db, "UPDATE `tbl_roi` SET `amount`=10000 `creditDate` = '$date1' WHERE `user_id`='" . $userTresult1['user_id'] . "'");
        } else {
            // exit;
        }
    }
    //    $activeleft = mysqli_num_rows(mysqli_query($db, "select `id` from `user` where `sponser_by`='" . $SponserId['user_id'] . "' and `package`!='InActive' and `position`='left'"));
    $activeright = mysqli_num_rows(mysqli_query($db, "select `id` from `user` where `sponser_by`='" . $SponserId['user_id'] . "' and `package`!='InActive'"));
    if ($activeright >= 2) {
        mysqli_query($db, "UPDATE `user` SET `onlybinary`=1 WHERE `id`='" . $SponserId['id'] . "'");
    }

    $loop = false;
    $spnser = $dataUSer['sponser_by'];
    $levelloop = 1;
    $usid = '';
    while ($loop == false) {
        $query = mysqli_query($db, "SELECT * FROM  `level_income` where `level`='$levelloop'");
        $dataQuery = mysqli_fetch_array($query);
        $levelcommision1 = $dataQuery['percentage'];
        $levelcommision = $amount / 100 * $levelcommision1;
        //        $levelcommision = round($levelcommision);
        if ($spnser == 'admin' or $spnser == '' or count($dataQuery) < 1) {
            $loop = true;
            break;
            exit;
        }
        $type = 'level';
        $desc = "$levelloop level income from user $other_user_id";
        if ($levelloop == 1) {
            $type = 'direct';
            $desc = "Refer Bonus from $other_user_id";
        }
        $sponserget = mysqli_fetch_array(mysqli_query($db, "select `id`,`user_id`,`package`,`sponser_by`,`incomelimit` from `user` where `user_id`='$spnser'"));
        $sponserincomeget = mysqli_fetch_array(mysqli_query($db, "select sum(amount) as total_income from `wallet` where `username`='".$sponserget['user_id']."' AND `walletType`='INR'"));
        if ($sponserget['package'] == 'InActive') {
            $spnser = $sponserget['sponser_by'];
            $levelloop++;
            continue;
            exit;
        }
        if($sponserincomeget['total_income'] <= $sponserget['incomelimit']){
            mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $sponserget['id'] . "','" . $sponserget['user_id'] . "','$levelcommision', 'credit','$other_user_id', '$desc','$levelloop', '$type','INR')");
        }
       
        $spnser = $sponserget['sponser_by'];
        $levelloop++;
    }
    royalty_status($dataUSer['sponser_by'],$db);
    capping_update($dataUSer['sponser_by'],$db);

    $_SESSION["upgrade"] = array("msg" => "Successfully activate account", "status" => "true");
    echo "<script type='text/javascript'> document.location = '../upgrade.php'; </script>";
    exit;
    die;
}

if (isset($_POST["repay-with-wallet-other"])) {

    //    die('In Process');
    //    print_r($_POST);die;
    $value = $userClass->extract_post($db, $_REQUEST);
    extract($value);
    $userquery = mysqli_query($db, "SELECT * FROM  `user` where `user_id`='$other_user_id'");
    $dataUSer = mysqli_fetch_array($userquery);
    $masteKey = $userClass->getMasterKey($db, $userData["id"]);
    $packagePrevious = $dataUSer["package"];

    //    echo $packagePrevious;die;
    $user_id = $userData["user_id"];
    $user__id = $dataUSer["user_id"];
    $uid = $dataUSer["id"];

    if ($master_key != $masteKey) {
        $_SESSION["upgrade"] = array("msg" => "Invalid transaction password.", "status" => "false");
        //        header("location:../pay_wallete.php?p=$pack");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    if (COUNT($dataUSer) == 0) {
        $_SESSION["upgrade"] = array("msg" => "Please enter valid user_id.", "status" => "false");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    $query = mysqli_query($db, "SELECT * FROM  `package` where `id`='$pack' ");
    $dataQuery = mysqli_fetch_array($query);

    if ($packagePrevious == 'InActive') {
        $_SESSION["upgrade"] = array("msg" => "Please first upgrade your id than you can retopup your id.", "status" => "false");
        //        header("location:../pay_wallete.php?p=$pack");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    if ($dataUSer['binary'] != 2) {
        $_SESSION["upgrade"] = array("msg" => "Your not eligible for retopup.", "status" => "false");
        //        header("location:../pay_wallete.php?p=$pack");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }

    //    echo $pack;die;
    $amount = $dataQuery['price'];
    if (count($dataQuery) < 1) {
        $_SESSION["upgrade"] = array("msg" => "Somthing Went Wrong.", "status" => "false");
        //        header("location:../pay_wallete.php?p=$pack");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    $total = $userClass->getWallet($db, 'epin', $userId);

    if ($dataQuery['price'] > $total) {

        $_SESSION["upgrade"] = array("msg" => "Your Not sufficent balance for this transaction.", "status" => "false");
        //        header("location:../pay_wallete.php?p=$pack");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    if ($dataQuery['price'] == 100000 and $userData['user_id'] != 'Ad220334') {

        $_SESSION["upgrade"] = array("msg" => "Your Not sufficent balance for this transaction.", "status" => "false");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }

    $pquery = mysqli_query($db, "SELECT * FROM  `package` where `id`='$pack'");
    $datapQuery = mysqli_fetch_array($pquery);

    $userNameId = $userClass->getUserIdFromId($db, $uid);
    $SponserId = $userClass->getSponserId($db, $uid);
    $userPhone = $userClass->getUserPhone($db, $uid);

    $description = "Transaction for id Re topup is Successfully.";
    $OrderId = $dataQuery['id'];

    $currentdate = date('Y-m-d H:i:s');

    mysqli_query($db, "INSERT INTO `wallet`(`userId`,`username`, `amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`,`walletType`) VALUES ( '$userId','$user_id', '" . $dataQuery['price'] . "', 'debit','$other_user_id', '$description','', 'joining','epin')");
    $paywallet = mysqli_insert_id($db);

    $paidDate = date('Y-m-d H:i:s');

    mysqli_query($db, "INSERT INTO `user_green_retopup`(`user_id`,`soponsor_by`,`pack`,`invested`,`from`) VALUES ('$userNameId','" . $dataUSer['sponser_by'] . "','$pack','" . $datapQuery['price'] . "','" . $userData['user_id'] . "')");
    $q = mysqli_insert_id($db);

    $querytt = mysqli_query($db, "SELECT SUM(amount) as sm FROM `wallet` WHERE userId='$uid' and `type`!='debit' and `walletType`='INR' and `transaction_type`='ad'");
    $addcehttts = mysqli_fetch_array($querytt);

    $finalcap = $addcehttts['sm'] + 3000;

    $withq = mysqli_query($db, "SELECT SUM(total) as sm FROM `withdraw` WHERE `userId`='$uid'");
    $withdata = mysqli_fetch_array($withq);
    $finalcapwith = $withdata['sm'] + 3000;

    //    echo "UPDATE  `user` SET `onlybinary`='1',`binary`='1',`cap`='$finalcap',`withexpir`='0',`withdracap`='$finalcapwith'  WHERE `id`='$uid'";die;

    mysqli_query($db, "UPDATE  `user` SET `onlybinary`='1',`binary`='1',`cap`='$finalcap',`withexpir`='0',`withdracap`='$finalcapwith'  WHERE `id`='$uid'");


    $_SESSION["upgrade"] = array("msg" => "Retopup successfully", "status" => "true");
    echo "<script type='text/javascript'> document.location = '../reupgrade.php'; </script>";
    exit;
    die;
}

if (isset($_POST["withdraw"])) {
    //die("Withdraw Off For Few Minutes !");
    $value = $userClass->extract_post($db, $_POST);
    extract($value);
    $dayDate = date('d');
    //     if($dayDate == "01" || $dayDate == "15"){

    $userQuery = mysqli_query($db, "SELECT * FROM  `user` where `id`='$userId' ");
    $resultUser = mysqli_fetch_array($userQuery);

    $withQuery = mysqli_query($db, "SELECT id FROM `withdraw` where `userId`='$userId' and `status`='pending' and type='BTC'");
    $resultWith = mysqli_num_rows($withQuery);

    //     if (true) {
    //        $_SESSION["withdraw"] = array("msg" => "Sorry, Your withdraw limit exceed, Please try again later.", "status" => "false");
    ////        header("location:../withdraw_request.php");
    //        if ($wallettype == 'ROI') {
    //            echo "<script type='text/javascript'> document.location = '../withdraw.php?type=true'; </script>";
    //            exit;
    //        } else {
    //            echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
    //            exit;
    //        }
    //    }

    if ($resultWith > 0) {
        $_SESSION["withdraw"] = array("msg" => "Sorry, Your withdraw request is already in queue.", "status" => "false");
        //        header("location:../withdraw_request.php");
        if ($wallettype == 'ROI') {
            echo "<script type='text/javascript'> document.location = '../withdraw.php?type=true'; </script>";
            exit;
        } else {
            echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
            exit;
        }
    }

    if ($resultUser['package'] == 'InActive') {
        $_SESSION["withdraw"] = array("msg" => "Your request is not submitted.", "status" => "false");
        //        header("location:../withdraw_request.php");
        if ($wallettype == 'ROI') {
            echo "<script type='text/javascript'> document.location = '../withdraw.php?type=true'; </script>";
            exit;
        } else {
            echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
            exit;
        }
    }
    if ($password != $userData["master_key"]) {
        $_SESSION["withdraw"] = array("msg" => "Please enter valid password.", "status" => "false");
        //        header("location:../withdraw_request.php");
        if ($wallettype == 'ROI') {
            echo "<script type='text/javascript'> document.location = '../withdraw.php?type=true'; </script>";
            exit;
        } else {
            echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
            exit;
        }
    }

    $total = $userClass->getWallet($db, "$wallettype", $userId);

    if ($amount < 500) {
        $_SESSION["withdraw"] = array("msg" => "Minimum withdrawal request 500.", "status" => "false");
        if ($wallettype == 'ROI') {
            echo "<script type='text/javascript'> document.location = '../withdraw.php?type=true'; </script>";
            exit;
        } else {
            echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
            exit;
        }
    }
    //    if ($amount % 200 != 0) {
    //        $_SESSION["withdraw"] = array("msg" => "Only request multiply with 200.", "status" => "false");
    //        if ($wallettype == 'ROI') {
    //            echo "<script type='text/javascript'> document.location = '../withdraw.php?type=true'; </script>";
    //            exit;
    //        } else {
    //            echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
    //            exit;
    //        }
    //    }
    //    if ($amount > 5000) {
    //        $_SESSION["withdraw"] = array("msg" => "Maximum withdrawal request 5000.", "status" => "false");
    //        if ($wallettype == 'ROI') {
    //            echo "<script type='text/javascript'> document.location = '../withdraw.php?type=true'; </script>";
    //            exit;
    //        } else {
    //            echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
    //            exit;
    //        }
    //    }


    if ($amount > $total) {
        $_SESSION["withdraw"] = array("msg" => "Your Not sufficent balance for this transaction.", "status" => "false");
        if ($wallettype == 'ROI') {
            echo "<script type='text/javascript'> document.location = '../withdraw.php?type=true'; </script>";
            exit;
        } else {
            echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
            exit;
        }
    }
    $tansferid = $userData["$withdraw_type"];
    //    if($walet < 100){
    //      $_SESSION["withdraw"] = array("msg"=>"Your wallet balance is not sufficient for withdraw." ,"status"=>"false");
    //      header("location:../withdraw_request.php");die;
    //    }
    if (empty($ban)) {
        $ban = "";
        $name = "";
        $account = "";
    }
    $wname = $userData['name'];
    $wuser = $userData['user_id'];
    $description = "Withdraw request by name:- $wname, user:-$wuser";
    $description4 = "Deducted Admin fee and tds 10% from your withdraw";
    $currentdate = date('Y-m-d H:i:s');
    $total = $amount;
    $adminfee = round(10 / 100 * $amount);
    $amount = round($amount - $adminfee);

    mysqli_query($db, "INSERT INTO `withdraw` (`userId`,`transaction_id`,`amount`,`withdrawWallet`,`status`, `date`, `description`, `confirmDate`,`type`,`username`,`total`,`admin`,`tansferid`,`ban`,`name`,`acc`) VALUES ('$userId','$tran', '$amount','$withdraw_type', 'pending', '$currentdate ', '$description', '','$wallettype','$wuser','$total','$adminfee','$tansferid','$ban','$name','$account')");
    $with_id = mysqli_insert_id($db);
    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`,`withdraw_id`) VALUES ( '$userId','$wuser', '$adminfee', 'debit','', '$description4','','withdraw','$wallettype','$with_id')");
    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`,`withdraw_id`) VALUES ( '$userId','$wuser', '$amount', 'debit','', '$description','','withdraw','$wallettype','$with_id')");
    $tran = strtotime($currentdate);
    //    echo "INSERT INTO `withdraw` (`userId`,`transaction_id`,`amount`,`withdrawWallet`,`status`, `date`, `description`, `confirmDate`,`type`,`username`,`total`,`admin`,`tansferid`) VALUES ('$userId','$tran', '$amount','$withdraw_type', 'pending', '$currentdate ', '$description', '','$wallettype',$wuser','$total','$adminfee','$tansferid')";
    //die;
    $phone = $resultUser['phone'];
    $msg = "Your Withraw request for $amount on $site successfully submitted.";
    //    $msg = urlencode($msg);
    //    $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $phone . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
    //    curl_get_contents($url);
    $_SESSION["withdraw"] = array("msg" => "Your withdraw request is submitted. It will be credit in your bank.", "status" => "true");
    //    header("location:../withdraw_request.php");
    if ($wallettype == 'ROI') {
        echo "<script type='text/javascript'> document.location = '../withdraw.php?type=true'; </script>";
        exit;
    } else {
        echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
        exit;
    }
}

function curl_get_contents($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    // print_r($data);die;
    return "";
}


////Royalty Status function///////
function royalty_status($userId='',$db){
    $rewards = [
        1 => ['rank' => 'Diamond','reward' => '5000','directs'=>'50','days'=>'12'],
        2 => ['rank' => 'Crown','reward' => '7500','directs'=>'75','days'=>'12'],
        3 => ['business' => 'Kohinoor','reward' => '1000','directs'=>'100','days'=>'12'],
    ];
    $s_userQuery = mysqli_query($db, "SELECT *  FROM  `user` where `sponser_by`='$userId' and package != 'InActive'");
    $resultWith = mysqli_num_rows($s_userQuery);
    $royalityuserQuery = mysqli_query($db, "SELECT *  FROM  `tbl_roi` where `user_id`='$userId'");
    $royalityresultWith = mysqli_fetch_array($royalityuserQuery);
    $i = 1;
    // $resultWith = 50;
    while($i <= count($rewards)){
        if($resultWith >= $rewards[$i]['directs']){
            if($royalityresultWith['level'] < $rewards[$i]){
                $amount = ($rewards[$i]['reward']*$rewards[$i]['days']);
                $roi_amount = ($rewards[$i]['reward']);
                $type = 'roi_income';
                $days = $rewards[$i]['days'];
                $total_days = $rewards[$i]['days'];
                $level = $i;
                $creditDate = date('Y-m-d');
               mysqli_query($db, "INSERT INTO `tbl_roi` (`user_id`, `amount`, `roi_amount`,`type`, `days`, `total_days`,`level`, `creditDate`) VALUES ('$userId','$amount', '$roi_amount', '$type','$days', '$total_days','$level','$creditDate')");
                // die('wait..');
            }
        }
        $i++;
    }
}

////end Royalty Status function///////

//////capping update function////
function capping_update($sponsor_id,$db){
    $rankquery = mysqli_query($db, "SELECT *  FROM  `rank`");
    $directsQuery = mysqli_query($db, "SELECT  count(id) as directs FROM  `user` where `sponser_by`='$sponsor_id' and package != 'InActive'");
    $directsresultWith = mysqli_fetch_array($directsQuery);
    $teamQuery = mysqli_query($db, "SELECT count(id) as team  FROM  `level_downline` where `sponser_by`='$sponsor_id'");
    $teamresultWith = mysqli_fetch_array($teamQuery);
    while($rankqueryresult = mysqli_fetch_array($rankquery)){
        if(($directsresultWith['directs'] >= $rankqueryresult['directs']) && ($teamresultWith['team'] >= $rankqueryresult['level'])){
            // echo "UPDATE `user` SET `incomelimit`='".$rankqueryresult['capping']."' WHERE `user_id`='$sponsor_id'";
            
            mysqli_query($db, "UPDATE `user` SET `incomelimit`='".$rankqueryresult['capping']."' WHERE `user_id`='$sponsor_id'");
        }
    }
    // die('here');
} 
//////end capping update function////




