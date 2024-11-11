<?php

require_once("../../database/db.php");
require_once("userClass.php");

error_reporting(0);
//session_start();
$newData = new userClass();
$userData = $_SESSION['user'];
$userId = $userData['id'];
$userQuery = mysqli_query($db, "SELECT * FROM  `user` where `id`='" . $userData['id'] . "' ");
$userData = mysqli_fetch_array($userQuery);


if (isset($_POST["withdraw"])) {
    //    die;
    $postdata = $newData->extract_post($db, $_POST);
    extract($postdata);

    $userQuery = mysqli_query($db, "SELECT * FROM  `user` where `id`='$userId' ");
    $resultUser = mysqli_fetch_array($userQuery);
    $phone = $resultUser['phone'];
    $withdrawon = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `meta` WHERE type='withdraw'"));
    if ($withdrawon != 0) {
        $_SESSION["withdraw"] = array("msg" => "Withdraw not active yet.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
        exit;
    }
    if ($resultUser['package'] == 'InActive') {
        $_SESSION["withdraw"] = array("msg" => "Your request is not submitted.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
        exit;
    }

    if ($ban == '') {
        $_SESSION["withdraw"] = array("msg" => "Beneficiary not valid.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
        exit;
    }

    if ($master_key != $userData["password"]) {
        $_SESSION["withdraw"] = array("msg" => "Invalid master key.", "status" => "false");
        //        header("location:../withdraw_request.php");
        echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
        exit;
    }
    //     die('fsdfs');
    $total = $newData->getWallet($db, 'INR', $userId);
    if ($amount < 200) {
        $_SESSION["withdraw"] = array("msg" => "Minimum withdrawal request 200.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
        exit;
    }

    if ($amount > $total) {
        $_SESSION["withdraw"] = array("msg" => "Your Not sufficent balance for this transaction.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
        exit;
    }
    //    $walet = $userClass->getWallet($db, 'INR', $userId);

    $wname = $userData['name'];
    $wuser = $userData['user_id'];
    $description = "Withdraw request by name:- $wname, user:-$wuser";
    $description5 = "Deducted admin charge 10% from your withdraw";

    $currentdate = date('Y-m-d H:i:s');
    $tamount = $amount;
    $adminchARGE = 20 / 100 * $amount;
    $amount = $amount - ($adminchARGE);
    $amount = round($amount);
    $rand = rand(1000000000000, 999999);
    $parameters = array(
        'beneficiary_id' => "$ban",
        'mobile_number' => "$phone",
        'amount' => "$amount",
        'channel_id' => "2",
        'client_id' => "$rand",
        'provider_id' => "$userId"
    );
    //    print_r($parameters);die;
    $url = 'https://api.pay2all/.in/v1/money/transfer';

    $res = apihit($parameters, $url);
    $resjson = json_decode($res);
    $tran = strtotime($currentdate);
    print_r($resjson);
    //    die;
    //    echo "INSERT INTO `withdraw` (`userId`,`transaction_id`,`amount`, `status`, `date`, `description`, `confirmDate`,`username`,`res`,`rand`,`totalwithdraw`) VALUES ('$userId','$tran', '$amount', 'pending', '$currentdate ', '$description', '','$wuser','$resjson','$rand','$tamount')";die;
    if ($resjson->status == '1') {
        $tran = $resjson->txnid;
        $msg = $resjson->message;

        mysqli_query($db, "INSERT INTO `withdraw` (`userId`,`transaction_id`,`amount`, `status`, `date`, `description`,`beneficiary_id`,`remarks`, `confirmDate`,`username`,`res`,`rand`,`totalwithdraw`) VALUES ('$userId','$tran', '$amount', 'done', '$currentdate ', '$description','$ban','$msg', '','$wuser','$res','$rand','$tamount')");
        $with_id = mysqli_insert_id($db);
        mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`,`withdraw_id`) VALUES ( '$userId','$wuser', '$adminchARGE', 'debit','', '$description5','','admin_charge','INR','$with_id')");
        mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`,`withdraw_id`) VALUES ( '$userId','$wuser', '$amount', 'debit','', '$description','','withdraw','INR','$with_id')");
        mysqli_query($db, "INSERT INTO `meta`(`type`,`text`) VALUES ('error','$res')");

        $_SESSION["withdraw"] = array("msg" => "$msg.", "status" => true);
        echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
        exit;
    }
    mysqli_query($db, "INSERT INTO `meta`(`type`,`text`) VALUES ('error','$res')");
    //        print_r($resjson);die;
    //    curl_get_contents($url);
    $_SESSION["withdraw"] = array("msg" => "Something went wrong,Try Again.", "status" => false);
    //    header("location:../withdraw_request.php");
    echo "<script type='text/javascript'> document.location = '../withdraw.php'; </script>";
    exit;
}
if (isset($_REQUEST['bendel'])) {
    $value = $newData->extract_post($db, $_REQUEST);
    extract($value);
    $phone = $userData['phone'];
    $parameters = array(
        'mobile_number' => "$phone",
        'beneficiary_id' => "$bendel"
    );
    //      print_r($parameters);die;
    $url = 'https://api.pay2all.in/v1/money/delete_beneficiary';
    $res = apihit($parameters, $url);
    $resjson = json_decode($res);
    //    print_r($resjson);die;
    $_SESSION["bdelete"] = array("msg" => "Beneficiary Succefully deleted.", "status" => false);
    echo "<script type='text/javascript'> document.location = '../profile_kyc.php?add_user=true'; </script>";
    exit;
}
if (isset($_POST['otp_validate'])) {
    $value = $newData->extract_post($db, $_POST);
    extract($value);
    $phone = $userData['phone'];
    $parameters = array(
        'mobile_number' => "$phone",
        'otp' => "$otp"
    );
    //      print_r($parameters);die;
    $url = 'https://api.pay2all.in/v1/money/add_sender_confirm';
    $res = apihit($parameters, $url);
    $resjson = json_decode($res);

    //      print_r($resjson);die;

    $msg = "";
    if (isset($resjson->message)) {
        $msg = $resjson->message;
    }
    $data = mysqli_query($db, "UPDATE  `user` SET  `userRes`='$res' WHERE  `user`.`id` ='$userId'");
    $_SESSION["user_info"] = array("msg" => $msg, "status" => "true");
    echo "<script type='text/javascript'> document.location = '../profile_kyc.php?add_user=true'; </script>";
    exit;
    //    echo "<script type='text/javascript'> document.location = '../profile_kyc.php?verify=true'; </script>";
    exit;
}
if (isset($_POST['user_info'])) {
    $_POST['user_info'] = "true";
    if (in_array("", $_POST)) {
        $_SESSION["user_info"] = array("msg" => "All fields are required.", "status" => false);
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }

    $value = $newData->extract_post($db, $_POST);
    extract($value);
    $mobile_number = $userData['phone'];
    $parameters = array(
        'mobile_number' => "$mobile_number",
        'first_name' => "$first_name",
        'last_name' => "$last_name",
        'address1' => "$address1",
        'address2' => "$address2",
        'pin_code' => "$pin_code"
    );
    $url = 'https://api.pay2all.in/v1/money/add_sender';
    $res = apihit($parameters, $url);
    $resjson = json_decode($res);
    //    print_r($resjson);
    //   echo $resjson->message;die;
    //    die;
    //    if ($resjson->status == 2) {
    //        $_SESSION["user_info"] = array("msg" => "Sender already exists.", "status" => false);
    //        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
    //        exit;
    //    }
    $data = mysqli_query($db, "UPDATE  `user` SET  `name` = '$first_name',`lname` ='$last_name',`phone` =  '$mobile_number',`address` =  '$address1',`address2` ='$address2',`zip`='$pin_code',`userRes`='$res' WHERE  `user`.`id` ='$userId'");
    $error = $resjson->errors;
    if (isset($error)) {
        $_SESSION["user_info"] = array("msg" => "$resjson->message", "status" => "false");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    if ($resjson->status == 2) {
        $_SESSION["user_info"] = array("msg" => "Sender already exists.", "status" => "false");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    $_SESSION["user_info"] = array("msg" => "All information submitted succefuly", "status" => "true");
    echo "<script type='text/javascript'> document.location = '../profile_kyc.php?verify=true'; </script>";
    exit;
}

if (isset($_POST['account_bank'])) {

    $userData1 = $newData->extract_post($db, $_POST);
    extract($userData1);


    $phone = $userData['phone'];
    // =================ADD Baneficial USER ====================    
    $parameters = array(
        'mobile_number' => "$phone",
        'account_number' => "$account_number",
        'beneficiary_name' => "$account_name",
        'ifsc' => "$bank_ifsc",
        'bank_id' => 6
    );
    $url = 'https://api.pay2all.in/v1/money/add_beneficiary';
    $res = apihit($parameters, $url);
    $resjson = json_decode($res);
    //    print_r($parameters);
    //    print_r($resjson);die;

    $bankdata = mysqli_fetch_array(mysqli_query($db, "select * from bank_detial where `account_number`='$account_number' and `userId`='$userId'"));
    //    if (count($bankdata) < 1) {

    mysqli_query($db, "INSERT INTO `bank_detial`(`userId`,`mobile`,`ifsc`, `account_name`, `account_number`, `beneficiary_id`) VALUES ('$userId','$phone',$bank_ifsc','$account_name','$account_number','$beneficiary_id')");
    mysqli_query($db, "UPDATE  `user` SET  `bank_name` =  '$bank_name',`bank_ifsc` =  '$bank_ifsc',`account_name` =  '$account_name',`account_number` ='$account_number',`userRes`='$res',`beneficiary_id`='$beneficiary_id' WHERE  `user`.`id` ='$userId'");
    //    }

    $_SESSION["bankinfo"] = array("msg" => "All information submitted succefuly", "status" => "true");
    echo "<script type='text/javascript'> document.location = '../profile_kyc.php?add_user=true'; </script>";
    exit;
}

function apihit($parameters, $url)
{
    $key = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQxZWQwMzQyYmE0NWUyYTkwMmU1Y2IxZDIwYmZjNTM1OWFiMzEyN2FhYzdiMmVhNzZjZDljN2JhNTU1ZDQ5ZjAwZjk1OTNiZTQzYzQxZjBkIn0.eyJhdWQiOiIxIiwianRpIjoiZDFlZDAzNDJiYTQ1ZTJhOTAyZTVjYjFkMjBiZmM1MzU5YWIzMTI3YWFjN2IyZWE3NmNkOWM3YmE1NTVkNDlmMDBmOTU5M2JlNDNjNDFmMGQiLCJpYXQiOjE1ODk2MDQ4ODgsIm5iZiI6MTU4OTYwNDg4OCwiZXhwIjoxNjIxMTQwODg4LCJzdWIiOiIyMDgiLCJzY29wZXMiOltdfQ.vAhUKbAcvVt3GuF0dF69kd5iWxGoGUbd4LtYAa1OTwK_DNeDBJhSMLykJw1yY14EEnoyGVNsYubCbZQILxfu4MivXgEX30OmR4kn-lfN4m6D4Jxn10kXzB3N5VIEVe9UtFxKlqDysRhm3Z1UdEtP3nYAQlKVWUE8LR3YQ51TB_AVVuM5ng1Zq1CtN_aumGmEoCZ6X8f4Zxza7OlzdRZLGZErAHGdiPbIrPDmGdqAYxnRoVblmDzFmNptpkn0n1sPltwALeDmDv02sLaAsuHXMQKcDjoyddQy44900IQahUTDrCV9lr1CWizFffe_g2gu3nWx1KVUIu3mho1IJXODGitx9icT_8QpYz6toFHtNYhqLxED2mFb-2UPYe4XyrPFOayYDqzYKjYth_k1D5VoIVC7Cy6d28JhZDk8Eck7w4emGnlna5-3TDSTkhogsGgtdXP2ii9hPa0ffFuJ_8LVGAITcuVSydcLorRHeT4qcvUfcuJp-TR_osTT_X1VVfR4wSpy5Igi-Dpe5XBx-PuOLrz25uEVNHTe8BUkP4TMIXEfuJrJhvcwGHOUftmrNmhfqlBy3nGI0tUBhPweJJtyIcvcR3NAXd7EkNjsuha0w-qMVuJu09MYapyhrYhwD9cW1AvupUsJcKhBLwvmzdE2WTeIwas4rHSypWKbuNfxZ8w"; //you have to add personal access token 
    $header = ["Accept:application/json", "Authorization:Bearer " . $key];
    $method = 'POST';
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

if (isset($_POST['account_bank_save'])) {
    $userData = $newData->extract_post($db, $_POST);
    extract($userData);
    //    echo "UPDATE  `user` SET  `bank_name` =  '$bank_name',`bank_ifsc` =  '$bank_ifsc',`account_name` =  '$account_name',`account_number` ='$account_number' WHERE  `user`.`id` ='$userId'";die;
    $data = mysqli_query($db, "UPDATE  `user` SET  `pan`='$pan',`adhar`='$adhar',`bank_name` =  '$bank_name',`bank_ifsc` =  '$bank_ifsc',`account_name` =  '$account_name',`account_number` ='$account_number' WHERE  `user`.`id` ='$userId'");
    //    echo "UPDATE  `user` SET  `bank_name` =  '$bank_name',`bank_ifsc` =  '$bank_ifsc',`account_name` =  '$account_name',`account_number` ='$account_number' WHERE  `user`.`id` ='$userId'";die;
    $_SESSION["bank_submit"] = array("msg" => "Detail succefully updated.", "status" => "false");

    echo "<script type='text/javascript'> document.location = '../profile_bank.php'; </script>";
    exit;
}
if (isset($_POST['account2'])) {
    $userData1 = $newData->extract_post($db, $_POST);
    extract($userData1);
    $mobile = $userData1['phone'];
    if ($userData1["password"] != $password) {
        $_SESSION["btc_update"] = array("msg" => "Your password is not match.", "status" => "false");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    if ($userData['package'] == 'InActive') {
        $data = mysqli_query($db, "UPDATE `user` SET  `name`='$name',`phone`='$phone',`email`='$email' WHERE  `user`.`id` ='" . $userData['id'] . "'");
    } else {
        $_SESSION["btc_update"] = array("msg" => "Activate user not able to change his profile detail.", "status" => "false");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    $_SESSION["btc_update"] = array("msg" => "Succeccfully updated.", "status" => "true");
    echo "<script type='text/javascript'> document.location = '../profile.php'; </script>";
}


if (isset($_POST['user_upload'])) {
    //    print_r($_POST);die;
    if (isset($_FILES['user_pic']['name'])) {
        $imageuser_pic = $newData->moveImage($db, $userId, $_FILES['user_pic'], 'user_pic', 'profile');
        if ($imageuser_pic != false) {
            mysqli_query($db, "UPDATE `user` SET  `picture`='$imageuser_pic' WHERE  `id` ='" . $userData['id'] . "'");
        }
    }
    $_SESSION["user_upload"] = array("msg" => "Your profile pic succefully upload.", "status" => "true");
    echo "<script type='text/javascript'> document.location = '../Edit_Profile.php'; </script>";
    exit;
}

if (isset($_POST['exchange_confirm'])) {
    $postData = $newData->extract_post($db, $_POST);
    extract($postData);
    $ratequery = mysqli_query($bdcdb, "SELECT `text` FROM `meta` where `type`='rate' order by id desc limit 1");
    $datarareQuery = mysqli_fetch_array($ratequery);
    $ratecoin = $datarareQuery['text'];

    $bdcQury = mysqli_query($bdcdb, "SELECT `id`,`user_id` FROM `user` WHERE `user_id`='$bdc_userid'");
    $bdcData = mysqli_fetch_array($bdcQury);
    mysqli_query($db, "UPDATE `user` SET `bdc_userID`='$bdc_userid' WHERE `user_id`='" . $postData['user_id'] . "'");

    $total = $newData->getWallet($db, 'BD2', $userId);
    if ($amount > $total) {
        $_SESSION["exchange"] = array("msg" => "Your Not sufficent balance for this transaction.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> document.location = '../exchange.php'; </script>";
        exit;
        die;
    }

    if (count($bdcData) < 1) {
        $_SESSION["exchange"] = array("msg" => "Please check, User id is not exsits in bdcworld.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../exchange.php'; </script>";
        exit;
    }
    if ($security_pass != $postData['master_key']) {
        $_SESSION["exchange"] = array("msg" => "Invalid Transaction password.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../exchange.php'; </script>";
        exit;
    }
    $extraamount = $amount / 100 * 10;
    $extraam = ($amount + $extraamount) * (1 / $ratecoin);
    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '$userId','$wuser', '$amount', 'debit','','Exchange BDC to BDC coin.','','exchange','BD2')");
    mysqli_query($bdcdb, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $bdcData['id'] . "','" . $bdcData['user_id'] . "', '$extraam', 'credit','','Exchange From BDC to BDC coin.','','exchange','coin')");
    $_SESSION["exchange"] = array("msg" => "Your BDC Wallet is successfully exchange in BDC Coin.", "status" => "true");
    echo "<script type='text/javascript'> document.location = '../exchange.php'; </script>";
    exit;
}

if (isset($_POST['pimage'])) {

    $userId = $_POST['pimage'];
    if ($userId == $userId) {
        echo "<script type='text/javascript'> document.location = '../my_account.php?perror=1'; </script>";
        exit;
    }
    $target_dir = "../uploads/profile/";

    $temp = explode(".", $_FILES["fileToUpload"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $path = "uploads/profile/" . $newfilename;
    $target_file = $target_dir . $newfilename;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "<script type='text/javascript'> document.location = '../my_account.php?perror=1'; </script>";
            exit;
            die;
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "<script type='text/javascript'> document.location = '../my_account.php?perror=1'; </script>";
            exit;
            die;
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<script type='text/javascript'> document.location = '../my_account.php?perror=1'; </script>";
        exit;
        die;
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "<script type='text/javascript'> document.location = '../my_account.php?perror=1'; </script>";
        exit;
        die;
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "<script type='text/javascript'> document.location = '../my_account.php?perror=1'; </script>";
        exit;
        die;
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script type='text/javascript'> document.location = '../my_account.php?perror=1'; </script>";
        exit;
        die;
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            mysqli_query($db, "UPDATE  `user` SET  `picture` =  '$path' WHERE  `user`.`id` =$userId");
            $newData->userSessionUpdate($db, $userId);
            echo "<script type='text/javascript'> document.location = '../my_account.php?perror=1'; </script>";
            exit;
            die;
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            echo "<script type='text/javascript'> document.location = '../my_account.php?perror=1'; </script>";
            exit;
            die;
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

if (isset($_POST['account1'])) {
    $postData = $newData->extract_post($db, $_POST);
    extract($postData);
    //    if($userData["master_key"] != $master_key){
    //             header("location:../account.php?master_key=error");die;
    //    }    
    $date = $dmonth . "/" . "$dday" . "/" . $dyear;
    $dob = date($date);
    $data = mysqli_query($db, "UPDATE  `user` SET  `dob`='$dob',`pan`='$pan',`address`='$address',`city`='$city',`zip`='$zip',`state`='$state',`country` =  '$country' WHERE  `user`.`id` ='$userId'");
    $newData->userSessionUpdate($db, $userId);
    echo "<script type='text/javascript'> document.location = '../my_account.php'; </script>";
    exit;
    die;
}


if (isset($_POST['account3'])) {
    $postData = $newData->extract_post($db, $_POST);
    extract($postData);
    $userQuery = mysqli_query($db, "SELECT * FROM  `user` where `id`='" . $userData['id'] . "' ");
    $resultUser = mysqli_fetch_array($userQuery);
    if ($resultUser["password"] != $password) {
        $_SESSION["pass"] = array("msg" => "Your password is incorrect.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../profile_password.php'; </script>";
        // echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    if ($npassword != $cpassword) {
        $_SESSION["pass"] = array("msg" => "Your password and confirm password not matched.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../profile_password.php'; </script>";
        // echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    $data = mysqli_query($db, "UPDATE  `user` SET  `password`='$npassword' WHERE  `user`.`id` ='" . $resultUser['id'] . "'");
    $newData->userSessionUpdate($db, $userId);
    $_SESSION["pass"] = array("msg" => "Your password is updated.", "status" => "true");
    // echo "<script type='text/javascript'> document.location = '../profile_password.php'; </script>";
    echo "<script type='text/javascript'> document.location = '../../model/function.php?type=logout'; </script>";
    exit;
    die;
}

if (isset($_POST['account4'])) {
    $postData = $newData->extract_post($db, $_POST);
    extract($postData);
    $userQuery = mysqli_query($db, "SELECT * FROM  `user` where `id`='" . $userData['id'] . "' ");
    $resultUser = mysqli_fetch_array($userQuery);
    if ($resultUser["master_key"] != $master) {
        $_SESSION["pass"] = array("msg" => "Your transaction password incorrect.", "status" => false);
        echo "<script type='text/javascript'> document.location = '../profile_tra_pass.php'; </script>";
    }

    if ($rnmasters != $nmaster) {
        $_SESSION["pass"] = array("msg" => "Your Confirm Transaction Password is incorrect.", "status" => false);
        echo "<script type='text/javascript'> document.location = '../profile_tra_pass.php'; </script>";
    }

    $data = mysqli_query($db, "UPDATE  `user` SET  `master_key`='$nmaster' WHERE  `user`.`id` ='$userId'");
    $newData->userSessionUpdate($db, $userId);
    $_SESSION["pass"] = array("msg" => "Your transaction password is updated.", "status" => true);
    echo "<script type='text/javascript'> document.location = '../profile_tra_pass.php'; </script>";
    //    echo json_encode(array("msg" => "Your password is updated", "status" => "true"));
    die;
}



if (isset($_REQUEST['userSponser'])) {


    $userId = mysqli_real_escape_string($db, $_REQUEST['userSponser']);
    $queryData['user'] = $userId;
    $query = mysqli_query($db, "select `user_id`,`name` from `user` where sponser_by='$userId' && enable='1'");
    $data = [];
    while ($data = mysqli_fetch_array($query)) {
        $queryData['data'][] = $data;
    }
    echo json_encode($queryData);
    die;
}

if (isset($_GET["oID"])) {
    $id = mysqli_real_escape_string($db, $_GET["oID"]);
    $query = mysqli_query($db, "SELECT * FROM  `package` where `id`='$id' ");
    $dataQuery = mysqli_fetch_array($query);
    $userId = $_SESSION['user']['id'];
    $userNameId = $_SESSION['user']['user_id'];
    mysqli_query($db, "INSERT INTO `order_pack`(`userId`,`user_id`,`package`, `price`) VALUES ('$userId','$userNameId','$id','" . $dataQuery['price'] . "')");
    $order_last = mysqli_insert_id($db);
    echo "<script type='text/javascript'> document.location = '../payment-Details.php?pID=" . $id . "&oID=" . $order_last . "'; </script>";
    exit;
    //    header("location:../payment-Details.php?pID=$id&oID=$order_last");exit();
}
