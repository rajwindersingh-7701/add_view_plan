 <?php
require_once("../database/db.php");
include("userClass.php");

require_once '../mailsend/serveremail.php';



$user = new user();
if (isset($_POST["register"])) {
    $_POST["register"] =true;
    if (in_array("", $_POST)) {
        $_SESSION["register"] = array("msg" => "All fields are required.", "status" => false);
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
 
    
    
    $value = $user->extract_post($db, $_POST);
    extract($value);
    
     $position_user  = "Left";
    // Sponsor id check condition 
    $sponsercheck = mysqli_num_rows(mysqli_query($db, "select user_id from `user` where `user_id` = '$sponsor'"));
    if ($sponsercheck == 0) {
        $_SESSION["register"] = array("msg" => "Sponser id is not valid please check and try again.", "status" => false);
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }

//    $rightSponsor = $under_place;
    $under_place = $sponsor;
//    $position_user = '';
//    $spcheck = mysqli_num_rows(mysqli_query($db, "select user_id from `user` where `sponser` = '$under_place' and `position`='$position_user'"));
//    if ($spcheck > 0) {
//        $_SESSION["register"] = array("msg" => "Sorry your under place id is not valid please choose another one.", "status" => false);
//                 echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
//
//        exit;
//    }

    //get valid sponsor
    $rightSponsor = $user->getvalidSponsor($db, $sponsor, $position_user);
    // Sponsor id check condition 
    $spcheck = mysqli_num_rows(mysqli_query($db, "select user_id from `user` where `user_id` = '$sponsor'"));
    if ($spcheck == 0) {
        $_SESSION["register"] = array("msg" => "Sponser id is not valid please check and try again.", "status" => false);
                 echo "<script type='text/javascript'> javascript:history.go(-1) </script>";

        exit;
    }
    
   
            
    //mobile number condition 
    $mobile = trim($mobile);
    $mobilecheck = mysqli_num_rows(mysqli_query($db, "select phone from `user` where `phone`='$mobile'"));
    if ($mobilecheck >= 1) {
        $_SESSION["register"] = array("msg" => "This mobile number already register.", "status" => false);
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    
    $email = trim($email);
    $emailcheck = mysqli_num_rows(mysqli_query($db, "select phone from `user` where `email`='$email'"));
    if ($emailcheck >= 1) {
        $_SESSION["register"] = array("msg" => "This email already exist.", "status" => false);
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";

        exit  ;
    }
    $userId = $user->getUserIdForRegister($db);  
//    $userId = trim($mobile);
    $userIdcheck = mysqli_num_rows(mysqli_query($db, "select id from `user` where `user_id`='$userId'"));
    if ($userIdcheck > 0) {
        $_SESSION["register"] = array("msg" => "This $userId Account ID already exists.", "status" => false);
                  echo "<script type='text/javascript'> javascript:history.go(-1) </script>";

        exit;
    }
   
    //get user id  
    
    
    if (strpos($userId, ' ') == true) {
        $_SESSION["register"] = array("msg" => "<font color=red>Please remove space from Account ID</font>", "status" => false);
                  echo "<script type='text/javascript'> javascript:history.go(-1) </script>";

        exit;
    }
    
    $master = rand(100000, 999999);
    $uidd = $userId;
//    echo "INSERT INTO `user`(`name`,`user_id`,`role`,`phone`,`email`,`gender`,`password`,`sponser`,`position`,`sponser_by`,`master_key`,`enable`) VALUES ('$name','$userId','user','$mobile','$email','$gender',$password','$rightSponsor','$position_user','$sponsor','$master','1')";die;
//    echo "INSERT INTO `user`(`name`,`user_id`,`role`,`phone`,`email`,`gender`,`password`,`sponser`,`position`,`sponser_by`,`master_key`,`enable`) VALUES ('$name','$userId','user','$mobile','$email','$gender','$password','$rightSponsor','$position_user','$sponsor','$master','1')";die;
    mysqli_query($db, "INSERT INTO `user`(`name`,`user_id`,`role`,`phone`,`email`,`gender`,`password`,`sponser`,`position`,`sponser_by`,`master_key`,`enable`) VALUES ('$name','$userId','user','$mobile','$email','$gender','$password','$rightSponsor','$position_user','$sponsor','$master','1')");
    $id = mysqli_insert_id($db);
    
//    $loop = false;
//    $sponsor1 = $rightSponsor;
//    $currentSponsor = $rightSponsor;
//
//    while ($loop == false) {
//
//        mysqli_query($db, "INSERT INTO `downline_count`(`tag_sponsor`, `sponser`, `user_id`,`position`) VALUES ('$sponsor1','$currentSponsor','$userId','$position_user')");
//        if ($sponsor1 == "admin") {
//            $loop = true;
//            continue;
//        }
//        $sponserget = mysqli_fetch_array(mysqli_query($db, "select `sponser`,`position` from `user` where `user_id`='$sponsor1'"));
//        $sponsor1 = $sponserget['sponser'];
//        $position_user = $sponserget['position'];
//    }

   
    
    if (isset($id)) {
//        mysqli_query($db, "INSERT INTO `points`(`userId`) VALUES('$id')");
//        mysqli_query($db, "INSERT INTO `down_count_total`(`userId`) VALUES('$id')");
    } else {
        $_SESSION["register"] = array("msg" => "<font color=red>Please try after some time</font>", "status" => false);
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    
//    $loop = false;
//    $sponsor2 = $rightSponsor;
//    $currentSponsor2 = $rightSponsor;
//    $positionu = $position_user;
//    $d2 = 1;
//    while ($loop == false) {
//        $sponserget2 = mysqli_fetch_array(mysqli_query($db, "select `id`,`sponser`,`position` from `user` where `user_id`='$sponsor2'"));
//        $spidd = $sponserget2['id'];
//        
//        if ($position_user == 'LEFT' or $position_user == 'left') {
//            $tleft = 1;
//            mysqli_query($db, "UPDATE `down_count_total` SET `left`=`left`+1 WHERE `userId`='$spidd'");
//        } else {
//            mysqli_query($db, "UPDATE `down_count_total` SET `right`=`right`+1 WHERE `userId`='$spidd'");
//        }
//        mysqli_query($db, "INSERT INTO `downline_count`(`tag_sponsor`,`tag_id`,`sponser`, `user_id`,`position`,`leftSide`,`level`) VALUES ('$sponsor2','$spidd','$currentSponsor2','$userId','$position_user','$tleft','$d2')");
//        $sponsor2 = $sponserget2['sponser'];
//        $position_user = $sponserget2['position'];
//        if ($sponsor2 == "admin" or $sponsor2 == "" or $sponsor2 == "ADMIN"){
//            $loop = true;
//            break;
//            exit;
//        }
//        $d2++;
//    }
    
    
     $loop1 = false;
    $sponsor11 = $sponsor;
    $currentSponsor1 = $sponsor;
    $lv = 1;
    while ($loop1 == false) {
        mysqli_query($db, "INSERT INTO `level_downline`(`sponser_by`, `user_id`, `level`) VALUES ('$sponsor11','$userId','$lv')");
       
        if ($sponsor11 == "admin" or $sponsor11 == "" or $sponsor11 == "ADMIN"){
            $loop1 = true;
            break;
            exit;
        }
        $sponserget1 = mysqli_fetch_array(mysqli_query($db, "select `sponser_by` from `user` where `user_id`='$sponsor11'"));
        $sponsor11 = $sponserget1['sponser_by'];

        $lv++;
    }
    
    $_SESSION["register_msg"] =  $userId;
//    $msg = "Congrats $name, username $userId, password $password and Secure Key $master. Thanks From team $site";

        
    $msg = "Hi ! $name, welcome You to $sitec. Your username $userId and password $password and master key $master. For Any query visit $link. KCS TRADING COMPANY";
//    $msg = "Congrats $name, username $userId, password $password and Secure Key $master. Thanks From team . KCS TRADING COMPANY";
    $msg = urlencode($msg);
    $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $mobile . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';

    curl_get_contents($url);
//    echo $url;die;
    $date = date("d-M-Y");
    $subjectMail = "[$site]:Account Detail.";
    $htmlContent = "
	   <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
            <html xmlns='http://www.w3.org/1999/xhtml'>
            <head>
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
            <title>Welcome</title>
            <style>
            .container
            {
                    width:600px;
                    margin:0 auto;
            }
            .logo {
                    width: 100%;
                    float: left;
                    text-align: center;
                    margin-top: 30px;
            }
            .logo img {
                    width: 44%;
            }
            .main-div {
                    width: 100%;
                    float: left;
                    background: #f8f8f8;
                    padding: 27px;
                    margin-top: 20px;
                    margin-bottom: 20px;
            }
            td {
                    border: 1px #ccc solid;
                    padding: 10px;
            }
            .main-div h1 {
                    color: #f7931b;
            }
            </style>
            </head>
            <body>
            <div class='container'>
                <div class='logo'>
                </div>
                    <div class='main-div'>
                            <h1>Login <span style='color:#000;'>Detail</span></h1>
                        <p>Hello $name,</p>
                        <p>Your account logged in details.</p>

                        <table style='width:100%'>
              <tr>
                <td>Login ID</td>
                <td>$uidd</td>
              </tr>
              <tr>
                <td>Password</td>
                <td>$password</td>
              </tr>
              <tr>
                <td>Secure Key</td>
                <td>$master</td>
              </tr>

                <tr>
                <td>Date</td>
                <td>$date</td>
              </tr>
            </table>
            <p>If you did not perform this login, immediately <a href='#'>click here</a> to terminate access to your account and then a new generated password will be sent to your email. </p>
            <p>Once you get your new password, login and change it to something you can remember on <a href='#'>your account page.</a> </p>
            <p>Thank you,</p>
             <p>Please check more detail at <a href='$slink'>$wlink</a></p>
                    </div>
            </div>
            </body>
            </html>
            ";
    // Set content-type header for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // Additional headers
    $headers .= 'From: '.$site.'<info@'.$slink.'>' . "\r\n";
            emailsend($name, $email, $subjectMail, $htmlContent);

    //mail($email, $subjectMail, $htmlContent, $headers);
    echo "<script type='text/javascript'> document.location = '../thanks.php'; </script>";
    exit;
}

function curl_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    // print_r($data);die;
    return "";
}
