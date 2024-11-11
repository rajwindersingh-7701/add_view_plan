<?php
include_once("../../../database/db.php");
reward_status($db);


/////// Reward status function //////
function reward_status($db  ){
    $rewards = [
        1 => ['rank' => 'Star','reward' => '500','directs'=>'10','capping'=>'1500','team'=>'0'],
        2 => ['rank' => 'Silver','reward' => '1500','directs'=>'15','capping'=>'3000','team'=>'100'],
        3 => ['rank' => 'Gold','reward' => '4500','directs'=>'20','capping'=>'5000','team'=>'500'],
        4 => ['rank' => 'Platinum','reward' => '10000','directs'=>'25','capping'=>'10000','team'=>'1500'],
        5 => ['rank' => 'Ruby','reward' => '30000','directs'=>'30','capping'=>'30000','team'=>'7500'],
        6 => ['rank' => 'Diamond','reward' => '100000','directs'=>'50','capping'=>'100000','team'=>'30000'],
        7 => ['rank' => 'Crown','reward' => '500000','directs'=>'75','capping'=>'500000','team'=>'60000'],
        8 => ['rank' => 'Kohinoor','reward' => '1000000','directs'=>'100','capping'=>'1000000','team'=>'100000'],
    ];

    $i = 1;

    $getuserQuery = mysqli_query($db, "SELECT *  FROM  `user` where package!='InActive'");
    $userresultWith = mysqli_fetch_array($getuserQuery);
    while($i <= count($rewards)){
        // foreach($userresultWith as $k => $user){
        while($user = mysqli_fetch_array($getuserQuery)){

            $userId = $user['user_id'];
            $reward_amount = $rewards[$i]['reward'];
            $teamwithQuery = mysqli_query($db, "SELECT id FROM `level_downline` where `sponser_by`='$userId'");//get team///
            $teamresultWith = mysqli_num_rows($teamwithQuery);
            $directwithQuery = mysqli_query($db, "SELECT id FROM `user` where `sponser_by`='$userId'");//get directs/////
            $directresultWith = mysqli_num_rows($directwithQuery);
            if($teamresultWith >= $rewards[$i]['team'] && $directresultWith >= $rewards[$i]['directs']){
                $rewarduserQuery = mysqli_query($db, "SELECT *  FROM  `tbl_rewards` where award_id='$i' AND 'user_id'='$userId'");//check reward////
                $rewardresultWith = mysqli_fetch_array($rewarduserQuery);
                $rank = $rewards[$i]['rank'];
                $incomelimit = $rewards[$i]['capping'];
                if($rewardresultWith){
                    mysqli_query($db, "INSERT INTO `tbl_rewards` (`user_id`, `amount`, `award_id `) VALUES ( '$userId','$reward_amount', '$i')");
                    mysqli_query($db, "INSERT INTO `tbl_income_wallet` (`user_id`, `amount`,`type`,`description`) VALUES ( '$userId','$reward_amount', 'reward_income','Reward Income')");
                    mysqli_query($db, "UPDATE `user` SET `rank`='$rank',`incomelimit`= '$incomelimit' WHERE `user_id`='$userId'");
                   
                }
            }
        }
        $i++;
    }
}
/////// end Reward status function //////


?>