<?php

$lastmonth = date("Y-m-d H:i:s", strtotime("-1 month"));
date_default_timezone_set('Asia/Kolkata');
$db = mysqli_connect("localhost", "payadsf1_user", "5R1gGMTEQUP7", "payadsf1_ads") or die('Sorry, Site is Under maintenance !');

$query = mysqli_query($db, "SELECT * FROM  `user` WHERE `user_id`!='admin'");
$royalUSerDevide = mysqli_num_rows($query);

while ($data = mysqli_fetch_array($query)) {
    
    $resultData = mysqli_fetch_array(mysqli_query($db, "select sum(amount) as sumAMount from `wallet` where userId='" . $data['id'] . "'  and datetime > '$date' and transaction_type='royality' group by userId"));
    $description = "Fifth Level Royalty income.";
    
    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $data['id'] . "','" . $data['user_id'] . "', '$peruser', 'credit', '', '$description','20%', 'royality5','INR')");
    
}
