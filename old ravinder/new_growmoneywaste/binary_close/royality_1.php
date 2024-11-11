<?php

date_default_timezone_set('Asia/Kolkata');
$db = mysqli_connect("localhost", "dukanwal_dukanus", "r6KnZEQrWA", "dukanwal_dukanti") or die('Sorry, Site is Under maintenance!');

//echo "SELECT * FROM  `user` WHERE `royal1`='1' and `royal2`='0' and `royal3`='0' and `royal4`='0' and `royal5`='0' and `royaldate`<'$lastmonth'";die;
echo 'royal5';
$query = mysqli_query($db, "SELECT * FROM  `user` WHERE `royal5`='1' and `royal5date`<'$lastmonth'");
while ($data = mysqli_fetch_array($query)) {
    $resultData = mysqli_fetch_array(mysqli_query($db, "select sum(amount) as sumAMount from `wallet` where userId='" . $data['id'] . "'  and datetime > '$date' and transaction_type='royality' group by userId"));
    $description = "Fifth Level Royalty income.";
    mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $data['id'] . "','" . $data['user_id'] . "', '$peruser', 'credit', '', '$description','20%', 'royality5','INR')");
}
