<?php

class user {

    public function totalProduct($db) {

        $product = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `product`"));
        return $product;
    }

    public function totalUser($db, $type) {

        $user = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `user` WHERE user_id!='admin' and role='$type'"));
        return $user;
        exit;
    }

    public function extract_post($db, $post) {
        $var = array();
        foreach ($post as $key => $val) {
            $var[$key] = mysqli_real_escape_string($db, $val);
        }
        return $var;
    }

    public function getUserIdForRegister($db) {
        $userId = 'GM' . rand(100000, 999999);
        $while1 = true;
        while ($while1 == true) {
            $query = mysqli_query($db, "select user_id from `user` where `user_id` = '$userId'") or die(mysqli_error($db));
            $userIdcheck = mysqli_num_rows($query);
            if ($userIdcheck == 0) {
                $while1 = false;
                continue;
            }
            $userId = 'GM' . rand(100000, 999999);
        }
        return $userId;
    }

    public function getvalidSponsor($db, $sponsor, $position_user) {
        $while = true;
        $spo = $sponsor;
        while ($while == true) {
            $query = mysqli_query($db, "select user_id from `user` where `sponser`='$spo' and `position`='$position_user'") or die(mysqli_error($db));
            $mobilecheck = mysqli_num_rows($query);
            if ($mobilecheck == 0) {
                $rightSponsor = $spo;
                $while = false;
                continue;
            }

            $spoData = mysqli_fetch_array($query);
            $spo = $spoData["user_id"];
        }
        return $rightSponsor;
    }

    function registerUser($email, $db) {

        $query = mysqli_query($db, "select email from user where email='$email' ");
        if (mysqli_num_rows($query) > 0) {
            return "false";
        }
        return "true";
    }

    function registerUserPhone($phone, $db) {

        $query = mysqli_query($db, "select email from user where phone='$phone' ");
        if (mysqli_num_rows($query) > 0) {
            return "false";
        }
        return "true";
    }

    function sponserCheck($userId = null, $db) {

        $queryUser = mysqli_query($db, "select id from user where user_id='$userId' ");

        if (mysqli_num_rows($queryUser) > 0) {
            return "false";
        }
        return "true";
    }

    function getUserId($db) {
        $user_id = null;
        while ($user_id == null) {
            $hash = SE . $this->incrementalHash();
            $response = $this->sponserCheck($hash, $db);
            if ($response == "true") {
                $user_id = $hash;
            }
        }

        return $user_id;
    }

    function incrementalHash($len = 5) {
        $seed = str_split('0123456789'
                . '0123456789'
                . '0123456789'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = '';
        foreach (array_rand($seed, 5) as $k)
            $rand .= $seed[$k];
        return $rand;
    }

    function numericHash($len = 5) {
        $seed = str_split('0123456789'
                . '9876543210'
                . '0123456789'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = '';
        foreach (array_rand($seed, 5) as $k)
            $rand .= $seed[$k];
        return $rand;
    }

    public function sms($phone, $hash) {

        $key = "d6d3c34e8cXX";
        $userkey = "gniweb2";
        $senderid = "LOCALTRD";
        $baseurl = "sms.gniwebsolutions.com/submitsms.jsp?";
        $msg = "Welcome You to oduwa. Your Verification Code  is $hash.";
        $msg = urlencode($msg);
        $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $phone . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';

        $this->curl_get_contents($url);
        return "";
    }

    public function curl_get_contents($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        // print_r($data);die;
        return "";
    }

    public function sendEmail($id, $email, $db) {
        $userQuery = mysqli_query($db, "select * from `user` where id='$id'");
        $userData = mysqli_fetch_array($userQuery);
        $name = $userData["name"];
        $phone = $userData["phone"];
        $hash = $this->numericHash();
        $data = mysqli_query($db, "UPDATE `user` SET  `hash`='$hash' WHERE  `id` ='$id'");
        // $this->sms($phone, $hash);
        $subjectMail = "[oduwa] :- Verification mail";
        $mail = base64_encode($id);
        $date = date("d-M-Y");
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
                            <img src='https://www.oduwa.io//images/logo.png' />
                            </div>
                                <div class='main-div'>
                                        <h1>Account <span style='color:#000;'>OTP</span></h1>
                                    <p>Hello ,</p>
                                    <p>Please activate your account.</p>
                        <table style='width:100%'>
                          <tr>
                            <td>OTP</td>
                            <td>$hash</td>
                          </tr>
                          <tr>
                            <td>Date</td>
                            <td>$date</td>
                          </tr>
                        </table>
                        <p>Please fill this code :- <a href='https://www.oduwa.io//email_verification.php?u=$mail'>https://www.oduwa.io//email_verification.php?u=$mail</a></p>
                        </div>
                        </div>
                        </body>
                        </html>
                        ";
        // Set content-type header for sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // Additional headers
        $headers .= 'From: oduwa<babbar1322@gmail.com>' . "\r\n";
        mail($email, $subjectMail, $htmlContent, $headers);
    }

}

?>