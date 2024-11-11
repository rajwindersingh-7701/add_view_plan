<?php
die;
date_default_timezone_set('Asia/Kolkata');

$db = mysqli_connect("localhost", "payadsf1_user", "5R1gGMTEQUP7", "payadsf1_ads") or die('Sorry, Site is Under maintenance !');

$ussserid = "AD665241";


$query = mysqli_query($db, "SELECT * FROM  `downline_count` WHERE `tag_sponsor`='$ussserid'");
$i = 1;
while ($data = mysqli_fetch_array($query)){
    
//    echo $data['user_id'];
//    echo "<br>";
//    $i++;
//    continue;
//    exit;
    
    $userdata = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM  `user` WHERE `user_id`='" . $data['user_id'] . "'"));
    $userIIID = $userdata['user_id'];

    extract($userdata);
    
    mysqli_query($db, "INSERT INTO `user_bk`(`name`, `lname`, `user_id`, `role`, `phone`, `bank_name`, `bank_ifsc`, `bank_img`, `account_name`, `account_number`, `email`, `gender`, `father_name`, `password`, `sponser`, `position`, `sponser_by`, `picture`, `dob`, `pan`, `paytm`, `googlepay`, `phonepay`, `adhar`, `address`, `address2`, `city`, `zip`, `state`, `country`, `master_key`, `bitcoin`, `perfect`, `package`, `totalinvestent`, `packageAmount`, `order`, `Date`, `paid_date`, `status`, `hash`, `enable`, `group`, `top_up_from`, `activation`, `royality1`, `wallet_type`, `royal_Status`, `bdc_userID`, `rank`, `reward`, `binary`, `upgrade`, `userRes`, `beneficiary_id`, `cap`) VALUES ('$name', '$lname', '$user_id', '$role', '$phone', '$bank_name', '$bank_ifsc', '$bank_img', '$account_name', '$account_number', '$email', '$gender', '$father_name', '$password', '$sponser', '$position', '$sponser_by', '$picture', '$dob', '$pan', '$paytm', '$googlepay', '$phonepay', '$adhar', '$address', '$address2', '$city', '$zip', '$state', '$country', '$master_key', '$bitcoin', '$perfect', '$package', '$totalinvestent', '$packageAmount', '$order', '$Date', '$paid_date', '$status', '$hash', '$enable', '$group', '$top_up_from', '$activation', '$royality1', '$wallet_type', '$royal_Status', '$bdc_userID', '$rank', '$reward', '$binary', '$upgrade', '$userRes', '$beneficiary_id', '$cap')");

    mysqli_query($db, "DELETE  FROM `wallet` WHERE `username` = '$userIIID'");
    mysqli_query($db, "DELETE FROM `user_green` WHERE `user_id`='$userIIID'");
    mysqli_query($db, "DELETE  FROM `withdraw` WHERE `username` = '$userIIID'");
    mysqli_query($db, "DELETE  FROM `point_matching` WHERE `userName` = '$userIIID'");
    mysqli_query($db, "DELETE FROM `order_pack` WHERE user_id='$userIIID'");
    mysqli_query($db, "DELETE  FROM `downline_count` WHERE `user_id` = '$userIIID'");
    mysqli_query($db, "DELETE FROM `down_count_total` WHERE `userId`='" . $userdata['id'] . "'");
    mysqli_query($db, "DELETE  FROM `user` WHERE `user_id` = '$userIIID'");
    
}

//echo $i;
//die;

mysqli_query($db, "DELETE  FROM `wallet` WHERE `username` = '$ussserid'");
mysqli_query($db, "DELETE FROM `user_green` WHERE `user_id`='$ussserid'");
mysqli_query($db, "DELETE  FROM `withdraw` WHERE `username` = '$ussserid'");
mysqli_query($db, "DELETE  FROM `point_matching` WHERE `userName` = '$ussserid'");
mysqli_query($db, "DELETE FROM `order_pack` WHERE user_id='$ussserid'");
mysqli_query($db, "DELETE  FROM `downline_count` WHERE `user_id` = '$ussserid'");

$userdata = mysqli_fetch_array(mysqli_query($db, "SELECT `id` FROM  `user` WHERE `user_id`='$ussserid'"));
$userIIID = $userdata['id'];

mysqli_query($db, "DELETE FROM `down_count_total` WHERE `userId`='$userIIID'");

mysqli_query($db, "DELETE  FROM `user` WHERE `user_id` = '$ussserid'");
exit;