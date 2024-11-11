<?php

include_once("../../../database/db.php");
include_once("../../../model/userClass.php");
require_once("functionalityClass.php");

include_once("distributeIncome.php");
// $fu = new functionalityClass();
// $dsb = new distributeIncome();
//$const = new constant();
$usreClass = new user();


if (isset($_REQUEST['deleteroiwithdraw'])) {
    //    die;
    //    die;
    $withid = mysqli_real_escape_string($db, $_REQUEST['deleteroiwithdraw']);
    $withQuery = mysqli_query($db, "SELECT * FROM  `user_kyc` where `id`='" . $_REQUEST['deleteroiwithdraw'] . "' ");
    $resultWith = mysqli_fetch_array($withQuery);

    if (COUNT($resultWith) == 0) {
        echo "<script type='text/javascript'> document.location = '../kyc_request.php'; </script>";
        exit;
    }
    //    $des = "Withdraw id " . $resultWith['id'] . " for amount " . $resultWith['amount'] . " user_id " . $resultWith['username'] . "";
    //    mysqli_query($db, "INSERT INTO `meta`(`title`, `text`, `type`) VALUES ('" . $resultWith['username'] . "','$des','Withdraw_log')");
    //    mysqli_query($db, "DELETE FROM `wallet` WHERE `withdraw_id`='" . $resultWith['id'] . "'");
    mysqli_query($db, "DELETE FROM `user_kyc` WHERE `id`='" . $resultWith['id'] . "'");
    //    echo "DELETE FROM `user_kyc` WHERE `id`='" . $resultWith['id'] . "'";die;

    echo "<script type='text/javascript'> document.location = '../kyc_request.php'; </script>";
    exit;
}


if (isset($_REQUEST['deleteroiwithdraw1'])) {
    //    die;
    $withid = mysqli_real_escape_string($db, $_REQUEST['deleteroiwithdraw']);
    $withQuery = mysqli_query($db, "SELECT * FROM  `withdraw` where `id`='" . $_REQUEST['deleteroiwithdraw'] . "' ");
    $resultWith = mysqli_fetch_array($withQuery);
    if (COUNT($resultWith) == 0) {
        echo "<script type='text/javascript'> document.location = '../withdraw_work_pend.php'; </script>";
        exit;
    }
    $des = "Withdraw id " . $resultWith['id'] . " for amount " . $resultWith['amount'] . " user_id " . $resultWith['username'] . "";
    mysqli_query($db, "INSERT INTO `meta`(`title`, `text`, `type`) VALUES ('" . $resultWith['username'] . "','$des','Withdraw_log')");
    mysqli_query($db, "DELETE FROM `wallet` WHERE `withdraw_id`='" . $resultWith['id'] . "'");
    mysqli_query($db, "DELETE FROM `withdraw` WHERE `id`='" . $resultWith['id'] . "'");

    echo "<script type='text/javascript'> document.location = '../withdraw_work_pend.php'; </script>";
    exit;
}




if (isset($_POST['withoff'])) {
    $postdata = $fu->extract_post($db, $_POST);
    extract($postdata);
    //    echo "INSERT INTO `meta`(`type`,`text`) VALUES ('withdraw_type','$w_type')";die;
    //    $userData = extract($_POST);
    //    print_r($_POST);die;
    mysqli_query($db, "DELETE FROM `meta` WHERE `type`='withdraw'");
    mysqli_query($db, "DELETE FROM `meta` WHERE `type`='withdraw_msg'");
    mysqli_query($db, "INSERT INTO `meta`(`type`,`text`) VALUES ('withdraw_type','$w_type')");
    mysqli_query($db, "INSERT INTO `meta`(`type`,`text`) VALUES ('withdraw_msg','$msg')");
    echo "<script type='text/javascript'> document.location = '../withdraw_setting.php'; </script>";
    exit;
}
if (isset($_POST['withon'])) {
    $postdata = $fu->extract_post($db, $_POST);
    extract($postdata);
    mysqli_query($db, "DELETE FROM `meta` WHERE `type`='withdraw_type'");
    mysqli_query($db, "DELETE FROM `meta` WHERE `type`='withdraw_msg'");
    mysqli_query($db, "INSERT INTO `meta`(`type`) VALUES ('withdraw')");
    //    mysqli_query($db, "INSERT INTO `meta`(`type`,`text`) VALUES ('withdraw_type','$w_type')");
    mysqli_query($db, "INSERT INTO `meta`(`type`,`text`) VALUES ('withdraw_setting','$msg')");
    echo "<script type='text/javascript'> document.location = '../withdraw_setting.php'; </script>";
    exit;
}
if (isset($_REQUEST["investconfirmation"])) {
    //    echo '1';
    $ref_id = $_REQUEST["refId"];
    $remarks = $_REQUEST["remarks"];
    $amount = $_REQUEST["amount"];
    $withQuery = mysqli_query($db, "SELECT * FROM  `payment_invest` where `id`='$ref_id' ");
    $resultWith = mysqli_fetch_array($withQuery);
    $userQuery = mysqli_query($db, "SELECT * FROM  `user` where `user_id`='" . $resultWith['user_id'] . "' ");
    $resultUser = mysqli_fetch_array($userQuery);
    $date = date('Y-m-d H:i:s');
    //    echo "update payment_refrece set `status`='done',remarks='$remarks' where `id`='$ref_id'";die;
    $data = mysqli_query($db, "update payment_invest set `status`='done',remarks='$remarks',`cofirm_date`='$date',`confirm_amount`='$amount' where `id`='$ref_id'");
    //    $data = mysqli_query($db, "update user set `package`='done',packageAmount='$amount',`paid_date`=NOW() where `id`='" . $resultUser['id'] . "'");
    //Calculation payment 
    $description2 = "E-wallet balance added by admin.";
    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`,`walletType`) VALUES ( '" . $resultUser['id'] . "','" . $resultUser['user_id'] . "', '$amount', 'credit','$userName', '$description2','','send_fund','epin')");
    $phone = $resultUser['phone'];
    header("location:../invest_pending.php");
}
if (isset($_REQUEST["rejected"])) {
    $ref_id = $_REQUEST["refId"];
    $remarks = $_REQUEST["remarks"];
    $withQuery = mysqli_query($db, "SELECT * FROM  `payment_refrece` where `id`='$ref_id' ");
    $resultWith = mysqli_fetch_array($withQuery);
    $userQuery = mysqli_query($db, "SELECT phone FROM  `user` where `id`='" . $resultWith['user_id'] . "' ");
    $resultUser = mysqli_fetch_array($userQuery);
    $date = date('Y-m-d H:i:s');
    $data = mysqli_query($db, "update payment_invest set `status`='Reject',remarks='$remarks' where `id`='$ref_id'");
    $phone = $resultUser['phone'];
    header("location:../invest_done.php");
}

if (isset($_REQUEST['rewards'])) {

    $query = $_REQUEST['rewards'];
    $date = date("Y/m/d");
    $data = mysqli_query($db, "update rewards_acheiver set `confirm`='1',date=NOW() where id='$query'");
    //    header("location:../query_list.php");

    echo "<script type='text/javascript'> document.location = '../rewards_list.php'; </script>";
    exit;
}
if (isset($_GET['kycrequest'])) {
    $kycid = $_GET['kycid'];
    mysqli_query($db, "UPDATE  `kyc` SET `status`='" . $_GET['kycrequest'] . "'  WHERE `id` ='$kycid'");
    echo "<script type='text/javascript'> document.location = '../kyc_pending.php'; </script>";

    exit;
}
if (isset($_POST['account_bank'])) {
    $userData = extract($_POST);
    $data = mysqli_query($db, "UPDATE  `user` SET  `bank_name` =  '$bank_name',`bank_ifsc` =  '$bank_ifsc',`account_name` =  '$account_name',`account_number` ='$account_number' WHERE  `user`.`id` ='$uid'");
    mysqli_query($db, "UPDATE `withdraw` SET  `acc`='$account_number' WHERE `userId`='$uid' and status='pending'");
    echo "<script type='text/javascript'> document.location = '../view_user.php?uid=" . $uid . "'; </script>";
    exit;
}
//if (isset($_POST['account_bank'])) {
//    $userData = extract($_POST);
//    $data = mysqli_query($db, "UPDATE  `user` SET  `bank_name` =  '$bank_name',`bank_address` ='$bank_address',`bank_ifsc` =  '$bank_ifsc',`account_name` =  '$account_name',`account_number` ='$account_number',`pay_number`='$pay_number' WHERE  `user`.`id` ='$uid'");
//    mysqli_query($db, "UPDATE `withdraw` SET  `acc`='$account_number' WHERE `userId`='$uid' and status='pending'");
//    echo "<script type='text/javascript'> document.location = '../view_user.php?uid=" . $uid . "'; </script>";
//    exit;
//}
if (isset($_POST['sub_admin_login'])) {

    $user = $_POST['subname'];
    $pass = $_POST['subpassword'];
    //    echo "select * from user where email='$user' || user_id='$user' && enable=1 ";die;
    $query = mysqli_query($db, "select * from sub_admin where email='$user' || user_id='$user' && disable=1 ");

    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_array($query);
        if ($user["password"] == $pass) {
            if ($user["role"] == "sub_admin") {
                $_SESSION['subadmin'] = $user;
                //                header("location:../");
                echo "<script type='text/javascript'> document.location = '../'; </script>";
                exit;
                die;
            }
        }
    }

    $_SESSION['error'] = "Invalid Credentail";
    //    header("location:../../");
    echo "<script type='text/javascript'> document.location = '../../'; </script>";
    exit;
    die;
}


if (isset($_POST['pimage'])) {

    $userId = $_POST['pimage'];

    $target_dir = "../../../Dashboard/uploads/profile/";

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
            //            header("location:../view_user.php?uid=$userId&perror=1");
            echo "<script type='text/javascript'> document.location = '../view_user.php?uid=$userId&perror=1'; </script>";
            exit;
            die;
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //            header("location:../view_user.php?uid=$userId&perror=1");
            echo "<script type='text/javascript'> document.location = '../view_user.php?uid=$userId&perror=1'; </script>";
            exit;
            die;
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        //        header("location:../view_user.php?uid=$userId&perror=1");
        echo "<script type='text/javascript'> document.location = '../view_user.php?uid=$userId&perror=1'; </script>";
        exit;
        die;
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        //        header("location:../view_user.php?uid=$userId&perror=1");
        echo "<script type='text/javascript'> document.location = '../view_user.php?uid=$userId&perror=1'; </script>";
        exit;
        die;
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        //        header("location:../view_user.php?uid=$userId&perror=1");
        echo "<script type='text/javascript'> document.location = '../view_user.php?uid=$userId&perror=1'; </script>";
        exit;
        die;
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //        header("location:../view_user.php?uid=$userId&perror=1");
        echo "<script type='text/javascript'> document.location = '../view_user.php?uid=$userId&perror=1'; </script>";
        exit;
        die;
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            mysqli_query($db, "UPDATE  `user` SET  `picture` =  '$path' WHERE  `user`.`id` =$userId");
            // $newData->userSessionUpdate($db, $userId);
            //            header("location:../view_user.php?uid=$userId&psuccess=1");
            echo "<script type='text/javascript'> document.location = '../view_user.php?uid=$userId&psuccess=1'; </script>";
            exit;

            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            //            header("location:../view_user.php?uid=$userId&perror=1");
            echo "<script type='text/javascript'> document.location = '../view_user.php?uid=$userId&perror=1'; </script>";
            die;
            echo "Sorry, there was an error uploading your file.";
        }
    }
    die;
}
if (isset($_POST['account2'])) {
    extract($_POST);
    //    if ($userData["master_key"] != $master_key) {
    //        echo json_encode(array("msg" => "Your master key is incorrect", "status" => "false"));
    //        die;
    //    }


    $data = mysqli_query($db, "UPDATE `user` SET  `bitcoin`='$bitcoin' WHERE  `user`.`id` ='$userId'");

    //    echo json_encode(array("msg" => "Your bitcoin detail is updated", "status" => "true"));
    echo "<script type='text/javascript'> document.location = '../view_user.php?uid=$userId'; </script>";
    exit;
    die;
}



if (isset($_REQUEST["type"])) {
    if ($_REQUEST["type"] == "logout") {

        unset($_SESSION);
        unset($_SESSION['subadmin']);
        unset($_SESSION['sub_admin']);
        session_destroy();
        //        header("location:../../");
        echo "<script type='text/javascript'> document.location = '../../'; </script>";
        exit;
        die;
    }
}
if (isset($_REQUEST["ido"])) {
    $ido = $_REQUEST["ido"];
    $data = mysqli_query($db, "SELECT * FROM `sub_admin` WHERE id = '$ido'");
    $_SESSION["user"] = mysqli_fetch_array($data);

    if (isset($_SESSION["user"])) {
        echo "true";
        die;
    } else {
        echo "false";
        die;
    }
}


if (isset($_REQUEST["with_id_selected"])) {
    //    print_r($_POST);die;
    $ids = $_POST['id'];
    $remarks = $_POST['remarks'];
    foreach ($ids as $wid) {
        $with_id = $wid;
        $withQuery = mysqli_query($db, "SELECT userId,amount FROM  `withdraw` where `id`='$with_id' ");
        $resultWith = mysqli_fetch_array($withQuery);
        $userQuery = mysqli_query($db, "SELECT `phone`,`user_id` FROM  `user` where `id`='" . $resultWith['userId'] . "' ");
        $resultUser = mysqli_fetch_array($userQuery);
        $date = date('Y-m-d H:i:s');
        $data = mysqli_query($db, "update withdraw set `status`='done',remarks='$remarks',confirmDate='$date' where `id`='$with_id'");
        $phone = $resultUser['phone'];
        $amount = $resultWith['amount'];
        $userid1 = $resultUser['user_id'];
        //        $msg = "Hi, $name Your Id No $userid1  Withdrawal request for $amount/Star Credit Your Bank Account Team Wealthway Marketing";
        $msg = urlencode($msg);
        //        $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $phone . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
        //        curl_get_contents($url);
    }
    if ($wallettype == 'ROI') {
        header("location:../withdraw_roi_pend.php");
    } else {
        header("location:../withdraw_work_pend.php");
    }
    exit();
}

if (isset($_REQUEST["with_id"])) {
    $with_id = $_REQUEST["userId"];
    $remarks = $_REQUEST["remarks"];
    $wallettype = $_REQUEST["wallettype"];
    $withQuery = mysqli_query($db, "SELECT userId,amount FROM  `withdraw` where `id`='$with_id' ");
    $resultWith = mysqli_fetch_array($withQuery);
    $userQuery = mysqli_query($db, "SELECT `phone`,`user_id` FROM  `user` where `id`='" . $resultWith['userId'] . "' ");
    $resultUser = mysqli_fetch_array($userQuery);
    $date = date('Y-m-d H:i:s');
    $data = mysqli_query($db, "update withdraw set `status`='done',remarks='$remarks',confirmDate='$date' where `id`='$with_id'");
    $phone = $resultUser['phone'];
    $amount = $resultWith['amount'];
    $userid1 = $resultUser['user_id'];
    if ($wallettype == 'ROI') {
        header("location:../withdraw_roi_pend.php");
    } else {
        header("location:../withdraw_work_pend.php");
    }

    exit();
}
if (isset($_REQUEST["add_package"])) {
    $post = $_POST;
    $data = $usreClass->extract_post($db, $post);
    extract($data);
    if ($title == "" || $price == "") {
        $_SESSION["package"] = array("msg" => "All fields are required", "status" => false);
        //        header("location:../add_package.php");
        echo "<script type='text/javascript'> document.location = '../add_package.php'; </script>";
        exit;
        exit;
    }
    //    echo  "INSERT INTO `package`(`title`, `price`,`color`, `profit`, `roi`, `product_name`, `description`,'caping') VALUES ('$title','$price','$color','$pv','$roi','$product_name','$description','$caping')";die;
    if ($packid != 0) {
        mysqli_query($db, "UPDATE `package` SET `title`='$title',`price`='$price',`roi`='$roi',`roi_days`='$days',`sat&sund`='$offd' WHERE `id`='$packid'");
    } else {
        mysqli_query($db, "INSERT INTO `package`(`title`, `price`,`roi`,`roi_days`,`sat&sund`) VALUES ('$title','$price','$roi','$days','$offd')");
    }
    $_SESSION["package"] = array("msg" => "Succefuly added", "status" => true);
    //    header("location:../add_package.php");
    echo "<script type='text/javascript'> document.location = '../add_package.php?pack=$packid'; </script>";
    exit;
}
if (isset($_REQUEST["add_level"])) {
    $post = $_POST;
    $data = $usreClass->extract_post($db, $post);
    extract($data);
    if ($levelid != 0) {
        mysqli_query($db, "UPDATE `level_income` SET `level`='$level',`percentage`='$p',`directcondition`='$dc' WHERE `id`='$levelid'");
    } else {
        mysqli_query($db, "INSERT INTO `level_income`(`level`, `percentage`, `directcondition`) VALUES ('$level','$p','$dc')");
    }
    $_SESSION["package"] = array("msg" => "Level income added for $level", "status" => true);
    echo "<script type='text/javascript'> document.location = '../add_level.php'; </script>";
    exit;
}
if (isset($_REQUEST["add_reward"])) {
    $post = $_POST;
    $data = $usreClass->extract_post($db, $post);
    extract($data);
    if ($levelid != 0) {
        mysqli_query($db, "UPDATE `rewards` SET `level`='$level',`reward`='$p',`required`='$dc',`levelName`='$levelName' WHERE `id`='$levelid'");
    } else {
        mysqli_query($db, "INSERT INTO `rewards`(`level`, `reward`, `required`,`levelName`) VALUES ('$level','$p','$dc','$levelName')");
    }
    $_SESSION["package"] = array("msg" => "Level income added for $level", "status" => true);
    echo "<script type='text/javascript'> document.location = '../add_reward.php'; </script>";
    exit;
}
if (isset($_REQUEST["payemnt-add"])) {
    $post = $_POST;
    $data = $usreClass->extract_post($db, $post);
    extract($data);
    if ($levelid != 0) {
        mysqli_query($db, "UPDATE `meta` SET `title`='$title',`text`='$detail' WHERE `id`='$levelid'");
    } else {
        mysqli_query($db, "INSERT INTO `meta`(`title`,`text`, `type`) VALUES ('$title','$detail','payment')");
    }
    $_SESSION["package"] = array("msg" => "Payment detail submmited", "status" => true);
    echo "<script type='text/javascript'> document.location = '../add_payment_link.php'; </script>";
    exit;
}
if (isset($_REQUEST["add_inpack"])) {
    $post = $_POST;
    $data = $usreClass->extract_post($db, $post);
    extract($data);
    if ($levelid != 0) {
        mysqli_query($db, "UPDATE `invest_pack` SET `name`='$name',`minin`='$min',`maxin`='$max',`roi`='$roi',`roitype`='$type',`days`='$day',`cback`='$cback' WHERE `id`='$levelid'");
    } else {
        mysqli_query($db, "INSERT INTO `invest_pack`(`name`,`minin`, `maxin`, `roi`,`roitype`,`days`, `cback`) VALUES ('$name','$min','$max','$roi','$type','$day','$cback')");
    }
    $_SESSION["package"] = array("msg" => "Added Package investment.", "status" => true);
    echo "<script type='text/javascript'> document.location = '../add_invest_pack.php'; </script>";
    exit;
}
if (isset($_REQUEST["select_package"])) {
    die;
    $uid = mysqli_real_escape_string($db, $_POST['user_id']);
    $pack = mysqli_real_escape_string($db, $_POST['package']);

    $package = $fu->getPackageId($db, $pack);
    $packagePrice = $package["price"];
    $packagePv = $package["pv"];
    $direct = $const::direct;
    $pointMatch = $const::point_matching;
    $pointMatch1 = $const::first_matching;
    $user = $fu->getUser($db, $uid);

    $position = $user["position"];
    $userName = $user["user_id"];
    $sponser = $user["sponser"];
    $sponserId = $fu->getUserId($db, $sponser);

    $amount = $direct / 100 * $packagePrice;
    $directSponser = $user["sponser_by"];
    $directSponserId = $fu->getUserId($db, $directSponser);

    $date = date("Y/m/d");

    $q = mysqli_query($db, "UPDATE `user` SET `package` = '$pack',paid_date='$date' WHERE `user`.`id` = '$uid'");
    mysqli_query($db, "INSERT INTO `user_green`(`user_id`,`package`) VALUES ('$userName','$pack')");
    $dsb->directIncome($db, $directSponserId, $directSponser, $amount, $userName);
    //    header("location:../Users.php");
    echo "<script type='text/javascript'> document.location = '../Users.php'; </script>";
    exit;
}

if (isset($_POST["sms"])) {

    $userData = $fu->extract_post($db, $_POST);
    extract($userData);
    $data = $fu->sms($mob, $msg);
    $mm = explode(",", $data);

    if ($mm[0] == "fail") {
        $_SESSION["sms"] = array("msg" => "SMS status $mm[0]", "status" => false);
    } else {
        $_SESSION["sms"] = array("msg" => "SMS status $mm[0]", "status" => true);
    }

    //    header("location:../send_message.php");
    echo "<script type='text/javascript'> document.location = '../send_message.php'; </script>";
    exit;
}

if (isset($_POST['account1'])) {

    $userData = $fu->extract_post($db, $_POST);
    extract($userData);
    //    if($userData["master_key"] != $master_key){
    //             header("location:../account.php?master_key=error");die;
    //    }    

    $data = mysqli_query($db, "UPDATE  `user` SET  `name` =  '$name',`email`='$email',`phone`='$phone',`father_name` ='$fname',`dob` =  '$dob',`address` =  '$address'  WHERE  `user`.`id` ='$userId'");
    //$newData->userSessionUpdate($db, $userId);
    //    header("location:../view_user.php?uid=$userId");
    echo "<script type='text/javascript'> document.location = '../view_user.php?uid=$userId'; </script>";
    exit;
    die;
}

if (isset($_POST['user_status'])) {
    extract($_POST);
    if ($user_status == "Enable") {
        mysqli_query($db, "UPDATE  `user` SET  `enable` =  '1' WHERE `user`.`id` ='$userId'");
    } else if ($user_status == "Disable") {
        mysqli_query($db, "UPDATE  `user` SET  `enable` =  '0' WHERE `user`.`id` ='$userId'");
    }
    //    if($userData["master_key"] != $master_key){
    //             header("location:../account.php?master_key=error");die;
    //    }    
    //$newData->userSessionUpdate($db, $userId);
    //    header("location:../view_user.php?uid=$userId");
    echo "<script type='text/javascript'> document.location = '../view_user.php?uid=$userId'; </script>";
    exit;
}

if (isset($_POST["user_role"])) {
    extract($_POST);
    mysqli_query($db, "UPDATE  `user` SET  `service`='$type' WHERE `user`.`id` ='$userId'");

    //    header("location:../view_user.php?uid=$userId");
    echo "<script type='text/javascript'> document.location = '../view_user.php?uid=$userId'; </script>";
    exit;
}
if (isset($_POST['change_pass'])) {
    $adminid = $_SESSION['admin']['id'];
    $aminData = $fu->getUser($db, $adminid);
    if ($_POST['current_pass'] == $aminData['password']) {
        mysqli_query($db, "UPDATE  `sub_admin` SET  `password` ='" . $_POST['new_pass'] . "' WHERE `id` ='$adminid'");
        //        $_SESSION['type'] = true;
        //        $_SESSION['msg'] = "Password changed";
        //        header("location:function.php?type=logout");
        echo "<script type='text/javascript'> document.location = 'function.php?type=logout'; </script>";
        exit;
    } else {
        $_SESSION['type'] = false;
        $_SESSION['msg'] = "Your password is not correct, Please enter valid password.";
        //        header("location:../change_pass.php");
        echo "<script type='text/javascript'> document.location = '../change_pass.php'; </script>";
        exit;
    }
    //    header("location:../change_pass.php");
    echo "<script type='text/javascript'> document.location = '../change_pass.php'; </script>";
    exit;
}

if (isset($_POST["rewarda-edit"])) {
    $rid = $_POST['rid'];
    $reward = $_POST['reward'];
    mysqli_query($db, "UPDATE `rewards` SET `reward`='$reward' WHERE id='$rid'");
    echo "<script type='text/javascript'> document.location = '../rewards_edit.php?uid=$rid'; </script>";
    exit;
}


if (isset($_POST["transfer-balance"])) {
    extract($_POST);
    //    if ($master_key != $userData["master_key"]) {
    //        $_SESSION["send"] = array("msg" => "Invalid master key.", "status" => "false");
    //        header("location:../add_fund.php");
    //        die;
    //    }
    //    if ($_SESSION['random'] != $cf) {
    //        $_SESSION["register"] = array("msg" => "Somthing went wrong.", "status" => false);
    //        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
    //        exit;
    //    }
    $userQuery = mysqli_query($db, "SELECT * FROM  `user` where `user_id`='$userIds' ");
    $userTresult = mysqli_fetch_array($userQuery);
    if (count($userTresult) < 1) {
        $_SESSION["send"] = array("msg" => "User id not valid.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> document.location = '../add_fund.php'; </script>";
        exit;
    }
    //    if ($userTresult['activation'] == 0) {
    //        $_SESSION["send"] = array("msg" => "This id $userIds is not activated, Please activate with $20", "status" => "false");
    ////        header("location:../pay_wallete.php?p=$pack");
    //        echo "<script type='text/javascript'> document.location = '../add_fund.php'; </script>";
    //        exit;
    //    }
    //    if ($amount < 10) {
    //        $_SESSION["send"] = array("msg" => "Minimum amount for transfer 10.", "status" => "false");
    ////        header("location:../add_fund.php");
    //
    //        echo "<script type='text/javascript'> document.location = '../add_fund.php'; </script>";
    //        exit;
    //    }
    $description = "Sent " . $amount . " from admin, Credit in user:-" . $userIds . "";
    $currentdate = date('Y-m-d H:i:s');
    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $userTresult['id'] . "','$userIds', '$amount', 'credit','admin', '$des','', 'refund','$walletType')");
    $name = $userTresult['name'];
    $msg = "Hi $name, Your Fund $amount is added in your Ewallet user id $userIds. Thankyou";
    $msg = urlencode($msg);
    $mobile = $userTresult['phone'];
    $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $mobile . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
    //    curl_get_contents($url);

    $_SESSION["send"] = array("msg" => "Succefully transfer Amount:- $amount in user id:- $userIds", "status" => "true");

    //    header("location:../add_fund.php");

    echo "<script type='text/javascript'> document.location = '../add_balance.php'; </script>";
    exit;
}
if (isset($_POST["transfer-money"])) {
    extract($_POST);
    //    if ($master_key != $userData["master_key"]) {
    //        $_SESSION["send"] = array("msg" => "Invalid master key.", "status" => "false");
    //        header("location:../add_fund.php");
    //        die;
    //    }
    if ($_SESSION['random'] != $cf) {
        $_SESSION["register"] = array("msg" => "Somthing went wrong.", "status" => false);
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    $userQuery = mysqli_query($db, "SELECT * FROM  `user` where `user_id`='$userIds' ");
    $userTresult = mysqli_fetch_array($userQuery);
    if (count($userTresult) < 1) {
        $_SESSION["send"] = array("msg" => "User id not valid.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> document.location = '../add_fund.php'; </script>";
        exit;
    }
    //    if ($userTresult['activation'] == 0) {
    //        $_SESSION["send"] = array("msg" => "This id $userIds is not activated, Please activate with $20", "status" => "false");
    ////        header("location:../pay_wallete.php?p=$pack");
    //        echo "<script type='text/javascript'> document.location = '../add_fund.php'; </script>";
    //        exit;
    //    }



    if ($amount < 10) {
        $_SESSION["send"] = array("msg" => "Minimum amount for transfer 10.", "status" => "false");
        //        header("location:../add_fund.php");

        echo "<script type='text/javascript'> document.location = '../add_fund.php'; </script>";
        exit;
    }
    $description = "Sent " . $amount . " from admin, Credit in user:-" . $userIds . "";

    $currentdate = date('Y-m-d H:i:s');
    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $userTresult['id'] . "','$userIds', '$amount', 'credit','admin', '$description','', 'send','epin')");
    $name = $userTresult['name'];
    $msg = "Hi $name, Your Fund $amount is added in your Ewallet user id $userIds. Thankyou";
    $msg = urlencode($msg);
    $mobile = $userTresult['phone'];
    $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $mobile . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
    //    curl_get_contents($url);

    $_SESSION["send"] = array("msg" => "Succefully transfer Amount:- $amount in user id:- $userIds", "status" => "true");

    //    header("location:../add_fund.php");

    echo "<script type='text/javascript'> document.location = '../add_fund.php'; </script>";
    exit;
}

if (isset($_POST["addbinary"])) {

    extract($_POST);
    if ($_SESSION['random'] != $cf) {
        $_SESSION["register"] = array("msg" => "Somthing went wrong.", "status" => false);
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    $userQuery = mysqli_query($db, "SELECT * FROM  `user` where `user_id`='$userIds' ");
    $userTresult = mysqli_fetch_array($userQuery);
    if (count($userTresult) < 1) {
        $_SESSION["send"] = array("msg" => "User id not valid.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }

    if ($amount < 1) {
        $_SESSION["send"] = array("msg" => "Minimum amount for add 1.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    //    $description = "Fund is deducted";

    $currentdate = date('Y-m-d H:i:s');
    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $userTresult['id'] . "','$userIds', '$amount', 'credit','add', 'Point matching income 7%','', 'point_matching','INR')");
    $name = $userTresult['name'];
    $msg = "Fund is deducted";
    $msg = urlencode($msg);
    $mobile = $userTresult['phone'];
    //    $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $mobile . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
    //    curl_get_contents($url);
    $_SESSION["send"] = array("msg" => "Succefully transfer Amount:- $amount in user id:- $userIds", "status" => "true");
    //    header("location:../add_fund.php");
    echo "<script type='text/javascript'> document.location = '../addbinary.php'; </script>";
    exit;
}

if (isset($_POST["transfer-money-deduct"])) {

    extract($_POST);
    if ($_SESSION['random'] != $cf) {
        $_SESSION["register"] = array("msg" => "Somthing went wrong.", "status" => false);
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    $userQuery = mysqli_query($db, "SELECT * FROM  `user` where `user_id`='$userIds' ");
    $userTresult = mysqli_fetch_array($userQuery);
    if (count($userTresult) < 1) {
        $_SESSION["send"] = array("msg" => "User id not valid.", "status" => "false");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }

    if ($amount < 1) {
        $_SESSION["send"] = array("msg" => "Minimum amount for deduction 100.", "status" => "false");
        //        header("location:../add_fund.php");

        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    $description = "Fund is deducted";

    $currentdate = date('Y-m-d H:i:s');
    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $userTresult['id'] . "','$userIds', '$amount', 'debit','admin', 'Deduction','', 'deduct','$walletttype')");
    $name = $userTresult['name'];
    $msg = "Fund is deducted";
    $msg = urlencode($msg);
    $mobile = $userTresult['phone'];
    //    $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $mobile . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
    //    curl_get_contents($url);
    $_SESSION["send"] = array("msg" => "Succefully transfer Amount:- $amount in user id:- $userIds", "status" => "true");
    //    header("location:../add_fund.php");
    echo "<script type='text/javascript'> document.location = '../deduct_fund.php'; </script>";
    exit;
}
if (isset($_POST["social-link-save"])) {
    extract($_POST);

    $userQuery = mysqli_query($db, "SELECT * FROM  `social_links`");
    $qresult = mysqli_fetch_array($userQuery);
    if (count($qresult) < 1) {
        //insert query
        mysqli_query($db, "INSERT INTO `social_links` (`facebook`,`twitter`, `telegram`, `linkedin`, `whatsapp`) VALUES ('$facebook', '$twitter', '$telegram', '$linkedin', '$whatsapp')");
        $_SESSION["send"] = array("msg" => "Data Saved Successfuly", "status" => "true");
        //        header("location:../add_fund.php");
        echo "<script type='text/javascript'> document.location = '../social_links.php'; </script>";
        exit;
    } else {
        //update query
        mysqli_query($db, "update `social_links` SET facebook='$facebook', twitter='$twitter', telegram='$telegram', linkedin='$linkedin', whatsapp='$whatsapp'");
        $_SESSION["send"] = array("msg" => "Data Updated Successfuly", "status" => "true");
        //        header("location:../add_fund.php");

        echo "<script type='text/javascript'> document.location = '../social_links.php'; </script>";
        exit;
    }

    echo "<script type='text/javascript'> document.location = '../social_links.php'; </script>";
    exit;
}
if (isset($_REQUEST['query_uid'])) {
    $query = $_REQUEST['query_uid'];
    $date = date("Y/m/d");
    $data = mysqli_query($db, "update support set `status`='Resolved',resolveDate='$date' where `id`='$query'");
    //    header("location:../query_list.php");
    echo "<script type='text/javascript'> document.location = '../query_list.php'; </script>";
    exit;
}
if (isset($_REQUEST['checksp'])) {

    $uname = $_POST['user_id'];

    //sql query to check whether the user name is exist or not
    $sql = "SELECT * FROM user where user_id = '$uname'";
    $rows = mysqli_query($db, $sql);
    //echo $uname;


    if (mysqli_num_rows($rows) == 0) {
        echo "<font color='red'>This is not a valid id please check and try again</font>";
    } else {
        $data = mysqli_fetch_assoc($rows);
        echo "Name: <font color='blue'>" . $data['name'] . "</font>";
    }
}
