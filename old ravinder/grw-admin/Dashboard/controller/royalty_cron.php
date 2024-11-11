<?php 
include_once("../../../database/db.php");
royalty_cron($db);
function royalty_cron($db){
    // die('here');
    $date = date('Y-m-d');
    $royalitycron = mysqli_query($db, "SELECT *  FROM  `tbl_cron` where `date`='$date' AND `cron_name` = 'roiCron'");
    $royalityresultcron = mysqli_fetch_array($royalitycron);
    // $cron = $this->Main_model->get_single_record('tbl_cron',['date' => $date,'cron_name' => 'roiCron'],'*');
    if(empty($royalityresultcron)){
        mysqli_query($db, "INSERT INTO `tbl_cron` (`cron_name`, `date`) VALUES ( 'roiCron','$date')");
        // $this->Main_model->add('tbl_cron',['cron_name' => 'roiCron','date' => $date]);
        $royalityuser = mysqli_query($db, "SELECT *  FROM  `tbl_roi` where `amount`>='0' AND `type` = 'booster_income' AND `days` >='0' AND `user_id`!=''");
        $royalityresultuser = mysqli_fetch_array($royalityuser);
        // $roi_users = $this->Main_model->get_records('tbl_roi', array('amount >' => 0 , 'type' => 'roi_income','days >' => 0,'user_id !=' => ''), '*');
        // $tokenValue = $this->Main_model->get_single_record('tbl_token_value',['id' => 1],'amount');
        // foreach($royalityresultuser as $key => $user){
        while($user = mysqli_fetch_array($royalityuser)){
            $date1 = date('Y-m-d H:i:s');
            $date2 = date('Y-m-d H:i:s',strtotime($user['creditDate'].'+ 30 days'));
            $diff = strtotime($date1) - strtotime($date2);
            echo $diff.' / '.$user['user_id'].'<br>';
            if($diff >= 0){
                $new_day = $user['days'] - 1;
                $days =($user['total_days']+1) - $user['days'];
                // $userinfo = mysqli_query($db, "SELECT *  FROM  `user` where `user_id`='".$user['user_id']."'");
                // $userinforesults = mysqli_fetch_array($userinfo);
                // $userinfo = $this->Main_model->get_single_record('tbl_users',['user_id' => $user['user_id']],'incomeLimit,receivedIncome');
                // if($userinfo['incomeLimit'] > $userinfo['receivedIncome']){
                //     $totalIncome =  $userinfo['receivedIncome'] + $user['coin'];
                //     if($userinfo['incomeLimit'] > $totalIncome){
                //         $mining_income = $user['coin'];
                //     } else {
                //         $mining_income = $userinfo['incomeLimit'] - $userinfo['receivedIncome'];
                //     }
                //     //$mining_income = $user['coin'];
                //     if($mining_income > 0){
                    $user_id = $user['user_id'];
                    $amount = $user['roi_amount'];
                    $type = 'royalty_income';
                    $description = 'Royalty Income';
                    $id = $user['id'];
                    $update_amount = ($user['amount'] - $user['roi_amount']);
                    mysqli_query($db, "INSERT INTO `tbl_income_wallet` (`user_id`, `amount`,`type`,`description`) VALUES ( '".$user['user_id']."','$amount','$type','$description')");
                    mysqli_query($db, "UPDATE `tbl_roi` SET `days`='$new_day',`amount`='$update_amount',`creditDate`=date('Y-m-d') WHERE `id`='$id'");
                    mysqli_query($db, "UPDATE `tbl_roi` SET `status`='1' WHERE `id`='$id'");
                    // $this->Main_model->update('tbl_roi', array('id' => $user['id']), array('days' => $new_day, 'amount' => ($user['amount'] - $user['roi_amount']),'creditDate' => date('Y-m-d')));
                    // $this->Main_model->update('tbl_roi', array('id' => $user['id']), array('status' => 1));
            }
        }
    } else {
        echo 'Today cron already run';
    }

}




/////// Reward status function //////
// function reward_status(){
//     $rewards = [
//         1 => ['rank' => 'Star','reward' => '500','directs'=>'10','capping'=>'1500','team'=>'0'],
//         2 => ['rank' => 'Silver','reward' => '1500','directs'=>'15','capping'=>'3000','team'=>'100'],
//         3 => ['rank' => 'Gold','reward' => '4500','directs'=>'20','capping'=>'5000','team'=>'500'],
//         4 => ['rank' => 'Platinum','reward' => '10000','directs'=>'25','capping'=>'10000','team'=>'1500'],
//         5 => ['rank' => 'Ruby','reward' => '30000','directs'=>'30','capping'=>'30000','team'=>'7500'],
//         6 => ['rank' => 'Diamond','reward' => '100000','directs'=>'50','capping'=>'100000','team'=>'30000'],
//         7 => ['rank' => 'Crown','reward' => '500000','directs'=>'75','capping'=>'500000','team'=>'60000'],
//         8 => ['rank' => 'Kohinoor','reward' => '1000000','directs'=>'100','capping'=>'1000000','team'=>'100000'],
//     ];

//     $i = 1;

//     $getuserQuery = mysqli_query($db, "SELECT *  FROM  `user` where package!='InActive'");
//     $userresultWith = mysqli_fetch_array($getuserQuery);
//     while($i <= count($rewards)){
//         foreach($userresultWith as $k => $user){
//             $userId = $user['user_id'];
//             $reward_amount = $rewards[$i]['reward'];
//             $teamwithQuery = mysqli_query($db, "SELECT id FROM `level_downline` where `sponser_by`='$userId'");//get team///
//             $teamresultWith = mysqli_num_rows($teamwithQuery);
//             $directwithQuery = mysqli_query($db, "SELECT id FROM `user` where `sponser_by`='$userId'");//get directs/////
//             $directresultWith = mysqli_num_rows($directwithQuery);
//             if($teamresultWith >= $rewards[$i]['team'] && $directresultWith >= $rewards[$i]['directs']){
//                 $rewarduserQuery = mysqli_query($db, "SELECT *  FROM  `tbl_rewards` where award_id='$i' AND 'user_id'='$userId'");//check reward////
//                 $rewardresultWith = mysqli_fetch_array($rewarduserQuery);
//                 if($rewardresultWith){
//                     mysqli_query($db, "INSERT INTO `tbl_rewards` (`user_id`, `amount`, `award_id `) VALUES ( '$userId','$reward_amount', '$i')");
//                     mysqli_query($db, "INSERT INTO `tbl_income_wallet` (`user_id`, `amount`,`type`,`description`) VALUES ( '$userId','$reward_amount', 'reward_income','Reward Income')");
//                 }
//             }
//         }
//         $i++
//     }
// }
/////// end Reward status function //////






?>