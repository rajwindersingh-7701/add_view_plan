<?php

$db = mysqli_connect("localhost", "growmon1_user", "DRzYS0h0CHHc", "growmon1_db") or die('Sorry, Site is Under maintenance !');

$date1 = date('H:i:s a');
$date1 = date('H:i:s a');
$dateCurrent = $date1 . '11rank';

mysqli_query($db, "INSERT INTO `cron_run`(`count`) VALUES ('$dateCurrent')");
$queryUSer = mysqli_query($db, "SELECT * FROM `user` where `package`!='InActive'");

while ($SponserId = mysqli_fetch_array($queryUSer)) {

    $rewards = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `rewards_acheiver` WHERE user_id='" . $SponserId['user_id'] . "' order by level desc limit 1"));
    $rv = 0;
    if (count($rewards) == 0) {
        $rv = 1;
    } else {
        $rv = $rewards['level'] + 1;
    }

    $rewardscondi = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `rank` WHERE id='$rv'"));

    $required = $rewardscondi['level'];
    $directrec = $rewardscondi['direct'];
    $rewardincome = $rewardscondi['reward'];
//echo "SELECT SUM(`package`) as sm FROM `level_downline` where `sponser_by`='" . $SponserId['user_id'] . "' and `package`!=0 and level=2";exit;
    $downline_countleft = mysqli_fetch_array(mysqli_query($db, "SELECT COUNT(*) as sm FROM `level_downline` where `sponser_by`='" . $SponserId['user_id'] . "' and `package`!=0 and level=2"));

//    echo $downline_countleft['cnt'] .'>='. $required .'and'. $downline_countright .'>='. $required.'<br>';
    $activeright = mysqli_num_rows(mysqli_query($db, "select `id` from `user` where `sponser_by`='" . $SponserId['user_id'] . "' and `package`!='InActive'"));

//    echo $downline_countleft['sm'] .'>='. $required .'and'. $activeright .'>='. $directrec;exit;
    if ($downline_countleft['sm'] >= $required and $activeright >= $directrec) {
//       echo "INSERT INTO `rewards_acheiver`(`user_id`,`rewards`,`level`) VALUES ('" . $SponserId['user_id'] . "','" . $rewardscondi['id'] . "','$rv')";
//             exit;
        mysqli_query($db, "UPDATE `user` SET `cap`='" . $rewardscondi['capping'] . "' WHERE `id`='" . $SponserId['id'] . "'");
        mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`) VALUES ( '" . $SponserId['id'] . "','" . $SponserId['user_id'] . "','$rewardincome', 'credit','$rv', 'Reward bonus from from level $rv','$rv', 'reward','INR')");
        mysqli_query($db, "INSERT INTO `rewards_acheiver`(`user_id`,`rewards`,`level`) VALUES ('" . $SponserId['user_id'] . "','" . $rewardscondi['id'] . "','$rv')");
    }
}


echo 'completed';
