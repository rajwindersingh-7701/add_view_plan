                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <?php
require_once("../../database/db.php");
require_once("userClass.php");
error_reporting(0);
//session_start();
$newData = new userClass();
$userData = $_SESSION['user'];
$userId = $userData['id'];

if (isset($_POST["submit_topup"])) {
    extract($_POST);
    if ($user_id == '') {

        $_SESSION["top_up"] = array("msg" => "Somthing went wrong.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../topup-request.php'; </script>";
    }
    $userleg1 = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `payment_refrece` WHERE `user_id`='$user_id' and `status`='pending'"));
    if ($userleg1 > 0) {
        $_SESSION["top_up"] = array("msg" => "Sorry, Please wait your request is already under processed.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../topup-request.php'; </script>";
    }
//   echo "SELECT id FROM `payment_refrece` WHERE `user_id`='$user_id' and `status`='pending'";die;
    mysqli_query($db, "INSERT INTO `payment_refrece`(`referance_number`, `user_id`) VALUES ('$referance_number','$user_id')");
    $_SESSION["top_up"] = array("msg" => "Thankyou for submitted your plan, Your Request will be confirmed with in 24 hours.", "status" => "true");
    echo "<script type='text/javascript'> document.location = '../topup-request.php'; </script>";
}
if (isset($_POST["submit_invest"])) {
    extract($_POST);
    if ($user_id == '') {

        $_SESSION["invest"] = array("msg" => "Somthing went wrong.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../invest.php'; </script>";
    }
    $currentQuery = mysqli_query($db, "SELECT * FROM  `user` where `id`='" . $userData['id'] . "' ");
    $currentUser = mysqli_fetch_array($currentQuery);
    
    if ($tans_key != $currentUser['master_key']) {
        $_SESSION["invest"] = array("msg" => "Sorry, Master key is Invalid.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../invest.php'; </script>";exit();
    }

    $userleg1 = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `payment_invest` WHERE `user_id`='$user_id' and `status`='pending'"));
    if ($userleg1 > 0) {
        $_SESSION["invest"] = array("msg" => "Sorry, Please wait your request is already under pocessed.", "status" => "false");
        echo "<script type='text/javascript'> document.location = '../invest.php'; </script>";
    }
//   echo "SELECT id FROM `payment_refrece` WHERE `user_id`='$user_id' and `status`='pending'";die;
    mysqli_query($db, "INSERT INTO `payment_invest`(`referance_number`, `user_id`,`walletType`,`amount`) VALUES ('$referance_number','$user_id','$type','$amnt')");
    $_SESSION["invest"] = array("msg" => "Thankyou for submitted Your request It will be confirmed with in 24 hours.", "status" => "true");
    echo "<script type='text/javascript'> document.location = '../invest.php'; </script>";
}