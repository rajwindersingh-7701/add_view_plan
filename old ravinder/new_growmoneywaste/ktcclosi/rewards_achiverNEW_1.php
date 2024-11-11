<?php
die;
$db = mysqli_connect("localhost", "payadsf1_user", "5R1gGMTEQUP7", "payadsf1_ads") or die('Sorry, Site is Under maintenance !');

//$date1 = date('H:i:s a');
//
//$date1 = date('H:i:s a');
//
//$dateCurrent = $date1 . '11rank';

//mysqli_query($db, "INSERT INTO `cron_run`(`count`) VALUES ('$dateCurrent')");

$queryUSer = mysqli_query($db, "SELECT * FROM `user` where `binary`='2'");
$i=1;
while ($SponserId = mysqli_fetch_array($queryUSer)) {
    
    $querytt = mysqli_query($db, "SELECT SUM(amount) as sm FROM `wallet` WHERE userId='" . $SponserId['id'] . "' and `type`!='debit' and `walletType`='INR'");
    $addcehttts = mysqli_fetch_array($querytt);
    
    if ($addcehttts['sm'] < 3000) {
        $i++;
        echo $SponserId['user_id'].'<br>';
        echo $addcehttts['sm'].'<br>';
        mysqli_query($db, " UPDATE `user` SET `binary`='1',`cap`='3000' WHERE `id`='" . $SponserId['id'] . "'");
    }
    
}
echo $i;
echo 'completed';
