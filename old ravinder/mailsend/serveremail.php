<?php

require 'PHPMailer/PHPMailerAutoload.php';
//Create a new PHPMailer instance
//die('fsdffds11');
function emailsend($name,$mailto, $subject, $body) {
//    $smtphost = 'cwp.linuxtechi.com';
$smtphost = 'smtp.gmail.com';
//$smtpsecure = 'ssl'; //ssl or tls
//$smtpport = 465;  // 465 or 587 or 25
$emailfrom = "growmoney.me@gmail.com";
$replyto = "growmoney.me@gmail.com";

$password = "bzbrvbiuybedcueq";
//$password = "ikyluwtbvrssdwdq";
$namefrom = "Grow Money";


$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0; //2 for all log, 0 for nothing
$mail->CharSet = "UTF-8";
$mail->Debugoutput = 'html';
$mail->Host = $smtphost;
$mail->SMTPSecure = $smtpsecure; //ssl or tls
$mail->Port = $smtpport;  // 465 or 587
$mail->SMTPAuth = true;
$mail->SMTPOptions = array('ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
));
$mail->Username = $emailfrom;
$mail->Password = $password;
$mail->setFrom($emailfrom, $namefrom);
$mail->addReplyTo($replyto, $namefrom);

$mail->Subject = $subject;
$mail->msgHTML($body);

if (is_array($mailto)) {
foreach ($mailto as $email => $name) {
$name = $name != '' ? $name : "User";
$mail->addAddress($email, $name);
}
} else {
$mail->addAddress($mailto, "User");
}

if (!$mail->send()) {
//     echo $mailto;
//   print_r($mail);die;
      // echo "Mailer Error: " . $mail->ErrorInfo; die;
return false;
} else {
//        echo $mailto;
//    print_r($mail);die;
return true;
}
}

function emailsend11($name,$email,$subject,$body){
 
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.hostinger.in';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = "info@jivoincome.com";
$mail->Password = "K1SSLE3a@!213";                          // SMTP password
$mail->Port = 587;                                    // TCP port to connect to
$mail->SMTPSecure = 'tls';
$mail->setFrom('info@jivoincome.com', 'Jivo Income');
$mail->addAddress($email, $name);
$mail->Subject = $subject;
 $mail->msgHTML($body);
if (!$mail->send()) {
    return "Mailer Error: " . $mail->ErrorInfo;
} else {
    return "Message sent!";
}
}