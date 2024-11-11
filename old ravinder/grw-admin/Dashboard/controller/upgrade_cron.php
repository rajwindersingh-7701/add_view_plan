<?php 
include_once("../../../database/db.php");
upgrade_cron($db);
function upgrade_cron($db){
    $date = date('Y-m-d');
    $get_users = mysqli_query($db, "SELECT *  FROM  `user` where `package`='1'");
    $usersresult = mysqli_fetch_array($get_users);
    while($user = mysqli_fetch_array($get_users)){
        $date1 = date('Y-m-d H:i:s');
        $date2 = date('Y-m-d H:i:s',strtotime($user['paid_date'].'+90 days'));
        $diff = strtotime($date1) - strtotime($date2);
        // echo $diff.' / '.$user['user_id'].'<br>';
        if($diff >= 0){
            echo $user['user_id'];
            mysqli_query($db, "UPDATE `user` SET `package`='InActive' WHERE `id`='".$user['id']."'");

        }
    }
}

?>