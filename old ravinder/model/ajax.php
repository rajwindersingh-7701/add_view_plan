<?php

require_once("../database/db.php");
include("userClass.php");

require_once '../mailsend/serveremail.php';

error_reporting(0);
session_start();
$starter = 1;
$user = new user();
$user_id = $_SESSION['user_id'];

if (isset($_REQUEST["request"])) {

    $request = $_REQUEST["request"];

    if ($request == "sponser") {
        $uname = $_POST['user_id'];

        //sql query to check whether the user name is exist or not
        $sql = "SELECT * FROM user where user_id = '$uname'";
        $rows = mysqli_query($db, $sql);
        //echo $uname;


        if (mysqli_num_rows($rows) == 0) {
            echo "<font color='red'>This is not a valid user.</font>";
        } else {
            $data = mysqli_fetch_assoc($rows);
            echo "User Name: <font >" . $data['name'] . "</font>";
        }
    }
    if ($request == "mobileCheck") {
        $mobile = $_POST['mobile'];

        //sql query to check whether the user name is exist or not
        $sql = "SELECT * FROM user where phone = '$mobile'";
        $rows = mysqli_query($db, $sql);
        if (mysqli_num_rows($rows) >= 3) {
            echo "<font color='red'>This mobile number already used.</font>";
        }
    }
    if ($request == "valid_sponsor") {
        $uname = $_GET['user_id'];
        $position = $_GET['position'];
        $data = $user->getvalidSponsor($db, $uname, $position);
        $userData = mysqli_fetch_array(mysqli_query($db, "SELECT name FROM user where user_id = '$data'"));
        // echo "Under place sponsor id: <font color='blue'>" . $data . "</font> and name:<font color='blue'>" . $userData['name'] . "</font>";
        if ($uname != '') {
            $response = array("id" => $data, "msg" => "Under place sponsor id: <font color='blue'>" . $data . "</font>");
            echo json_encode($response);
            exit();
        } else {
            echo '';
            exit();
        }
    }
    if ($request == "user_id_check") {

        $uname = $_POST['user_id'];
        $uname = trim($uname);

        //sql query to check whether the user name is exist or not
        $sql = "SELECT * FROM user where user_id = '$uname'";
        $rows = mysqli_query($db, $sql);
        //echo $uname;


        if ($uname == '') {
            //            echo "<font color='red'> <b>This user id is already exists.</b></font>";
        } else if (mysqli_num_rows($rows) > 0) {
            echo "<font color='red'> <b>This is already exists.</b></font>";
        } else {
            $data = mysqli_fetch_assoc($rows);
            if (strpos($uname, ' ') == true) {
                echo '<font color=red>Please remove space from Account ID</font>';
                exit;
            }
            echo "Name: <font color='blue'>This is valid phone.</font>";
            exit;
        }
    }
}

if (isset($_POST["verify-form"])) {

    $token = base64_decode($_POST["token"]);

    $code = $_POST["code"];
    $query = mysqli_query($db, "select * from `user` WHERE `id`='$token'");
    $hashData = mysqli_fetch_array($query);

    $hash = $hashData["hash"];
    $uid = $hashData['id'];
    $user_id = $hashData['user_id'];
    $email = $hashData['email'];
    $phone = $hashData['phone'];
    $name = $hashData['name'];
    $password = $hashData['password'];
    $master = $hashData['master_key'];
    if ($hash == $code) {

        $queryUpdate = mysqli_query($db, "UPDATE  `user` SET  `enable` =  '1',`hash`= ' ' WHERE `id`='$token'");
        if ($queryUpdate) {
            $_SESSION["login"] = array("msg" => "Your account detail sent in your email , Please login with given detail.", "status" => "true");
            $date = date("m/d/Y");
            $receipt_id = strtotime(date("Y/m/d H:i:s"));

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
                <img src='$link/images/logo.png   ' />
                </div>
                    <div class='main-div'>
                            <h1>Login <span style='color:#000;'>Detail</span></h1>
                        <p>Hello $name,</p>
                        <p>Your account logged in details.</p>

                        <table style='width:100%'>
              <tr>
                <td>Login ID</td>
                <td>$user_id</td>
              </tr>
              <tr>
                <td>Password</td>
                <td>$password</td>
              </tr>
              <tr>
                <td>Master Key</td>
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
             <p>Please check more detail at <a href='$link'>$wlink</a></p>
                    </div>
            </div>
            </body>
            </html>
            ";
            // Set content-type header for sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // Additional headers
            $headers .= 'From: ' . $site . '<info@' . $slink . '>' . "\r\n";

            mail($email, $subjectMail, $htmlContent, $headers);

            $msg = "Hi " . $name . ", Welcome You to $site. Your account detail user id:-$user_id, password:- $password, master key:-$master .";
            $msg = urlencode($msg);
            $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $phone . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';

            $user->curl_get_contents($url);

            header("location:../thanks.php?e=" . base64_encode($email));
            die;
            //send mail
        }
        $_SESSION["verify"] = array("msg" => "Somthing went wrong, Please try again.", "status" => "false");
        header("location:../email_verification.php?u=" . $_POST['token']);
        die;
    } else {
        $_SESSION["verify"] = array("msg" => "Your verification code is incorrect.", "status" => "false");
        header("location:../email_verification.php?u=" . $_POST['token']);
        die;
    }
}

if (isset($_POST["login_form"])) {
    $user = mysqli_real_escape_string($db, $_POST['user_id']);
    $pass = mysqli_real_escape_string($db, $_POST['password']);
    $query = mysqli_query($db, "select * from user where (email='$user' || user_id='$user')");
    // $check = "SELECT * FROM user where 'user_id' = '$user_id'";
    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_array($query);
        if ($user["password"] == $pass) {
            if ($user["role"] == "user") {
                if ($user["enable"] == 1) {
                    $_SESSION['user'] = $user;

                    //		$_SESSION["login"]=array('msg'=>'Login Suceess !','status'=>'true');
                    header("location:../Dashboard");
                    die;
                } else {
                    $_SESSION["login"] = array('msg' => 'Your ID blocked contact admin!', 'status' => 'false');
                    header("location:../login.php");
                    die;
                }
            }
        }
    }
    $_SESSION["login"] = array('msg' => 'Invalid Credential!', 'status' => 'false');
    header("location:../login.php");
    die;
    echo json_encode($_POST);
    die;
}
if (isset($_POST['forget'])) {
    $email = mysqli_real_escape_string($db, $_POST['user_id']);
    $query1 = mysqli_query($db, "select * from `user` where email='$email' or user_id='$email' and `user_id`!='admin'");
    $count = mysqli_num_rows($query1);
    $data1 = mysqli_fetch_array($query1);

    if ($count > 0) {
        $name = $data1["name"];
        $password = $data1["password"];
        $userId = $data1["user_id"];
        $master_key = $data1["master_key"];
        $phone = $data1["phone"];
        $emailto = $data1["email"];
        $subjectMail = "[$site]";
        $htmlContent = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
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
                                        <h1>Account <span style='color:#000;'>Detail from forget password</span></h1>
                                    <p>Hello ,</p>
                                    <p>Please activate your account.</p>

                                    <table style='width:100%'>
                          <tr>
                            <td>Name</td>
                            <td>$name</td>
                          </tr>
                          <tr>
                            <td>User Id</td>
                            <td>$userId</td>
                          </tr>
                          <tr>
                            <td>Password</td>
                            <td>$password</td>
                          </tr>
                          <tr>
                            <td>Master Key</td>
                            <td>$master_key</td>
                          </tr>
                        </table>
                        <p>Please check more detail at <a href='$link'>$link</a></p>
                        </div>
                        </div>
                        </body>
                        </html>
                        ";
        // Set content-type header for sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // Additional headers
        $headers .= 'From: <info@' . $slink . '>' . "\r\n";
        //        mail($email, $subjectMail, $htmlContent, $headers);
        emailsend($name, $emailto, $subjectMail, $htmlContent);

        //        $msg = "Hi ! $name, welcome You to $sitec. Your username $userId and password $password and master key $master. For Any query visit $link. KCS TRADING COMPANY";

        $msg = "Hi ! $name, welcome You to $sitec. Your username $userId and password $password and master key $master_key. For Any query visit $link. KCS TRADING COMPANY";

        //        $msg = "Hi ! $name, welcome You to $site. Your username $userId and password $password and master key $master_key. For Any query visit. KCS TRADING COMPANY";
        $msg = urlencode($msg);
        //        $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $phone . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
        //        curl_get_contents($url);

        $_SESSION["login"] = array('msg' => 'Your password has beeen sent in your email !', 'status' => 'true');
        header("location:../login.php");
    } else {
        $_SESSION["forget"] = array('msg' => 'Please enter valid user id!', 'status' => 'false');
        header("location:../forget.php");
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
