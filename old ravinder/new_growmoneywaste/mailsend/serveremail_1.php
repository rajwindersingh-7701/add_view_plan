<?php

require 'PHPMailer/PHPMailerAutoload.php';
//Create a new PHPMailer instance
//require 'PHPMailer-master/PHPMailerAutoload.php';
//$mail = new PHPMailer;
//$mail->SMTPDebug = 3;                               // Enable verbose debug output
//$mail->isSMTP();                                      // Set mailer to use SMTP
//$mail->Host = 'jivoincome.com';  // Specify main and backup SMTP servers
//$mail->SMTPAuth = true;                               // Enable SMTP authentication
//$mail->Username = "info@jivoincome.com";
//$mail->Password = "K1SSLE3a@!213";                          // SMTP password
//$mail->Port = 587;                                    // TCP port to connect to
//$mail->From = 'info@jivoincome.com';
//$mail->FromName = 'Jivoincome';
//$mail->addAddress('babbar1322@gmail.com');               // Name is optional
//$mail->isHTML(true);                                  // Set email format to HTML
//$mail->Subject = 'Here is the subject';
//$mail->Body = 'This is the HTML message body <b>in bold!</b>';
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//if(!$mail->send()) {
//echo 'Message could not be sent.';
//echo 'Mailer Error: ' . $mail->ErrorInfo;
//} else {
//echo 'Message has been sent';
//}


email_send("ravidev573@gmail.com","Email", "hfasdfjkah");

function email_send($mailto, $subject, $body) {
//    $smtphost = 'cwp.linuxtechi.com';
$smtphost = 'smtp.gmail.com';
//$smtpsecure = 'ssl'; //ssl or tls
//$smtpport = 465;  // 465 or 587 or 25
$emailfrom = "positonworldinfo@gmail.com";
$replyto = "positonworldinfo@gmail.com";

$password = "ceuzlovgqmltnffj";
//$password = "ikyluwtbvrssdwdq";
$namefrom = "Jivoincome";

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
//$mail->isHTML(true);
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
        echo "Mailer Error: " . $mail->ErrorInfo;
return false;
} else {
        echo"Success";
        print_r($mail);
return true;
}
}

//
// echo emailsend('ravidnra','babbar1322@gmail.com','subject','this is test mail');
//function emailsend($name,$email,$subject,$body){
//$mail = new PHPMailer;
//$mail->isSMTP();
//$mail->SMTPDebug = 0;
//$mail->Debugoutput = 'html';
//$mail->Host = 'mail.jivoincome.com';
//$mail->Port = 587;
//$mail->SMTPSecure = 'tls';
//$mail->SMTPAuth = true;
//$mail->Username = "info@jivoincome.com";
//$mail->Password = "dYpey2dq";
//$mail->setFrom('info@jivoincome.com', 'Jivo');
//$mail->addReplyTo('info@jivoincome.com', 'Jivo');
//$mail->addAddress($email, $name);
//$mail->Subject = $subject;
// $mail->msgHTML($body);
//if (!$mail->send()) {
//    return "Mailer Error: " . $mail->ErrorInfo;
//} else {
//    return "Message sent!";
//}
//}