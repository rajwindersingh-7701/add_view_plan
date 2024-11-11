<?php
require 'header.php';
//print_r($userData['id']);
?>
<style>
    .widget.admin-widget.sec {
        padding: 12px 10px;
        min-height: 135px;
    }

    .task-portion {
        width: 100%;
        padding: 13px;
        /*text-align: center;*/
    }

    .task-portion h2 {
        display: inline;
        font-size: 18px;
    }

    .join-btn {
        background: #0088cc;
        color: #fff;
        text-align: center;
        width: 90%;
        margin: auto;
        padding: 8px 0;
        font-size: 20px;
        font-weight: bold;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    @media screen and (max-width:575px) {
        .sidebar .admin-widget {

            padding: 20px 15px;

        }

        .widget.admin-widget h4 {
            font-size: 12px;
        }

        .widget.admin-widget h2 {
            font-size: 14px;
        }

        .btn {
            padding: 13px 22px;
        }

        .widget.admin-widget.sec h5 {
            font-size: 12px;
        }

        .widget.admin-widget.sec {
            min-height: auto;
        }

        .reffer-main-box {
            display: flex;
            justify-content: space-between;
            /* width: ; */
        }

        .reffer-box {
            width: 48%;
            /* display: inline-block; */
            /* margin: ; */
        }
    }
</style>
<!-- Middle Panel  -->
<div class="col-lg-9">



    <?php if ($userData['package'] != 'InActive') { ?>

        <?php
        $walletincome = mysqli_fetch_array(mysqli_query($db, "SELECT count(*) as cnt  FROM `wallet` WHERE `username`='" . $userData['user_id'] . "' and `datetime`>'$currentdate' and `transaction_type`='ad'"));
        if ($walletincome['cnt']) {
        ?>

            <div class='task-portion d-flex justify-content-between align-items-center'>
                <h2>Task Completed</h2>
                <a href="#" class="btn btn-default"><span>Complete</span></a>
            </div>


        <?php } else { ?>
            <div class='task-portion d-flex justify-content-between align-items-center'>
                <h2>Daily Task</h2>
                <a href="ad_task.php" class="btn btn-default"><span>View Ad</span></a>
            </div>

        <?php } ?>

        <div class="profile-content">
            <div class="row">
                <div class="col-lg-4 sidebar">
                    <div class="widget admin-widget" style="background:linear-gradient(89deg, #dd20edb5 0.1%, #f1c30f82 51.5%, #dd20ed 100.2%);">
                        <h4>
                            Subscription <i class="fa fa-inr" aria-hidden="true"></i><?php echo $userData['packageAmount']; ?>
                        </h4>


                        <h4><?php
                            //$walletincome = mysqli_fetch_array(mysqli_query($db, "SELECT count(*) as cnt  FROM `wallet` WHERE `username`='" . $userData['user_id'] . "' and `transaction_type`='ad'"));

                            date_default_timezone_set('Asia/Kolkata');
                            //                            $from = strtotime("'".$userData['paid_date']."'");
                            //                            echo $userData['paid_date'];
                            $newDate = date("d-m-Y", strtotime($userData['paid_date']));
                            $from = strtotime($newDate);
                            $today = strtotime(date('Y-m-d'));
                            $difference = $today - $from;
                            $dayss = floor($difference / 86400) . '<br>';  // (60 * 60 * 24)
                            echo 90 - ($dayss + 1);
                            ?> Days Left</h4>
                        <!--<a href="#" class="btn btn-default2 btn-center"><span>View Detail</span></a>-->
                        <!--<a href="#" class="btn-setting color-black btn-hvr-up btn-hvr-yellow link">View Detail</a>-->


                    </div>
                </div>
            <?php } else { ?>


                <div class="profile-content">
                    <div class="row">
                    <?php } ?>
                    <a href="https://telegram.me/growmoneyyofficial" class="join-btn" target="_blank">Join Telegram</a>
                    <div class="col-6 col-lg-4 sidebar">
                        <div class="widget admin-widget">
                            <h2 style="font-weight: 4; overflow-wrap: break-word;"><?php echo $walletbd2 ?></h2>
                            <h4>E-WALLET</h4>
                            <a href="slip_request.php" class="btn btn-default2 btn-center"><span>ADD FUND</span></a>
                            <!--<a href="#" class="btn-setting color-black btn-hvr-up btn-hvr-yellow link">View Detail</a>-->
                        </div>
                    </div>
                    <!--            <div class="col-lg-3 col-md-3 col-6 sidebar">
                                    <div class="widget admin-widget" style="background: #1f2d42">
                                        <h2 class="text-white" style="font-weight: 4"><?php echo $walletbd2; ?></h2>
                                        <h4 class="text-white">PAY WALLET</h4>
                                        <a href="#" class="btn btn-default btn-center"><span>View Detail</span></a>
                                    </div>
                                </div>-->
                    <div class="col-6 col-lg-4 sidebar">
                        <div class="widget admin-widget">
                            <!--<i class="fas fa-coins admin-overlay-icon"></i>-->
                            <h2 style="font-weight: 400"><i class="fa fa-inr" aria-hidden="true"></i><?php echo $walletbtc; ?></h2>
                            <h4>PAY WALLET</h4>
                            <a href="withdraw.php" class="btn btn-default2 btn-center"><span>Withdraw</span></a>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 sidebar">
                        <a href="trans_daily.php">
                            <div class="widget admin-widget sec">
                                <h2 style="font-weight: 4; overflow-wrap: break-word;">
                                    <i class="fa fa-inr" aria-hidden="true"></i><?php
                                                                                $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `wallet` WHERE `userId`='" . $userData['id'] . "' and `transaction_type`='ad'"));
                                                                                echo (isset($smw1['smant'])) ? $smw1['smant'] : 0;
                                                                                ?>
                                </h2>
                                <h5>Daily Ad View Bonus</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-4 sidebar">
                        <a href="trans_refer.php">
                            <div class="widget admin-widget sec">
                                <h2 style="font-weight: 4; overflow-wrap: break-word;">
                                    <i class="fa fa-inr" aria-hidden="true"></i><?php
                                                                                $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `wallet` WHERE `userId`='" . $userData['id'] . "' and `transaction_type`='level_ad'"));
                                                                                echo (isset($smw1['smant'])) ? $smw1['smant'] : 0;
                                                                                ?>
                                </h2>
                                <h5>Level Bonus</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-4 sidebar">
                        <a href="#">
                            <div class="widget admin-widget sec">
                                <h2 style="font-weight: 4; overflow-wrap: break-word;">
                                    <i class="fa fa-inr" aria-hidden="true"></i><?php
                                                                                $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `wallet` WHERE `userId`='" . $userData['id'] . "' and (`walletType`='INR' or `walletType`='ROI') and `datetime`>'$currentdate' and `type`='credit'"));
                                                                                echo (isset($smw1['smant'])) ? $smw1['smant'] : 0;
                                                                                ?>
                                </h2>
                                <h5>Today Income</h5>

                            </div>
                        </a>
                    </div>

                    <div class="col-6 col-lg-4 sidebar">
                        <a href="#S">
                            <div class="widget admin-widget sec">
                                <h2 style="font-weight: 4; overflow-wrap: break-word;">

                                    <i class="fa fa-inr" aria-hidden="true"></i><?php
                                                                                $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `wallet` WHERE `userId`='" . $userData['id'] . "' and (`walletType`='INR' or `walletType`='ROI') and type='credit' and `transaction_type`!='receive'"));
                                                                                echo (isset($smw1['smant'])) ? $smw1['smant'] : 0;
                                                                                ?>

                                </h2>
                                <h5>Total Income</h5>

                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-4 sidebar">
                        <a href="trans_rewards.php">
                            <div class="widget admin-widget sec">
                                <h2 style="font-weight: 4; overflow-wrap: break-word;">
                                    <i class="fa fa-inr" aria-hidden="true"></i><?php
                                                                                $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `wallet` WHERE `userId`='" . $userData['id'] . "' and `transaction_type`='reward'"));
                                                                                echo (isset($smw1['smant'])) ? $smw1['smant'] : 0;
                                                                                ?>
                                </h2>
                                <h5>Reward Bonus</h5>

                            </div>
                        </a>
                    </div>

                    <div class="col-6 col-lg-4 sidebar">
                        <a href="trans_daily_level.php">
                            <div class="widget admin-widget sec">
                                <h2 style="font-weight: 4; overflow-wrap: break-word;">
                                    <i class="fa fa-inr" aria-hidden="true"></i><?php
                                                                                $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `wallet` WHERE `userId`='" . $userData['id'] . "' and `transaction_type`='level_adddde'"));
                                                                                echo (isset($smw1['smant'])) ? $smw1['smant'] : 0;
                                                                                ?>
                                </h2>
                                <h5>Royalty Bonus</h5>

                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 sidebar">
                        <a href="withdraw.php">
                            <div class="widget admin-widget sec">
                                <h2 style="font-weight: 4; overflow-wrap: break-word;">
                                    <i class="fa fa-inr" aria-hidden="true"></i><?php
                                                                                $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `withdraw` WHERE `userId`='" . $userData['id'] . "' and (`type`='INR' or `type`='ROI')"));
                                                                                echo round((isset($smw1['smant'])) ? $smw1['smant'] : 0);
                                                                                ?>
                                </h2>
                                <h5>Total Withdraw</h5>
                            </div>
                        </a>
                    </div>


                    <!--            <div class="col-lg-4 sidebar">
                                    <div class="widget admin-widget">
                                        <h2 style="font-weight: 400; overflow-wrap: break-word;">
                    <?php
                    echo $walletroi;
                    ?>
                                        </h2>
                                        <h4>Daily Task</h4>
                                        <a href="#" class="btn btn-default btn-center"><span>View Detail</span></a>
                                    </div>
                                </div>-->
                    </div>
                    <div class="row">

                        <!--            <div class="col-lg-4 sidebar">
                                    <a href="trans_refer.php">
                                        <div class="widget admin-widget sec">
                                            <h2 style="font-weight: 4; overflow-wrap: break-word;">
                                                <i class="fa fa-inr" aria-hidden="true"></i><?php
                                                                                            $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `wallet` WHERE `userId`='" . $userData['id'] . "' and `transaction_type`='direct'"));
                                                                                            echo (isset($smw1['smant'])) ? $smw1['smant'] : 0;
                                                                                            ?>
                                            </h2>
                                            <h5>Refer Bonus</h5>
                                        </div>
                                    </a>
                                </div>-->

                        <!--            <div class="col-lg-3 sidebar">
                                    <a href="trans_refer_level.php">
                                        <div class="widget admin-widget sec">
                                            <h2 style="font-weight: 4">
                    <?php
                    $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `wallet` WHERE `userId`='" . $userData['id'] . "' and `transaction_type`='level'"));
                    echo (isset($smw1['smant'])) ? $smw1['smant'] : 0;
                    ?>
                                            </h2>
                                            <h5>Team Level Bonus</h5>
                                        </div>
                                    </a>
                                </div>-->



                        <!--            <div class="col-lg-3 sidebar">
                                    <a href="trans_daily_level.php">
                                        <div class="widget admin-widget sec">
                                            <h2 style="font-weight: 4">
                    <?php
                    $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `wallet` WHERE `userId`='" . $userData['id'] . "' and (`walletType`='INR' or `walletType`='ROI') and type='credit' and `datetime`>'$firstday' and `type`='credit'"));
                    echo (isset($smw1['smant'])) ? $smw1['smant'] : 0;
                    ?>
                                            </h2>
                                            <h5>Weekly Bonus</h5>
                    
                                        </div>
                                    </a>
                                </div>-->
                        <div class="col-lg-4 sidebar" style="display:none;">
                            <a href="#S">
                                <div class="widget admin-widget sec">
                                    <h2 style="font-weight: 4; overflow-wrap: break-word;">

                                        <i class="fa fa-inr" aria-hidden="true"></i><?php
                                                                                    $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `wallet` WHERE `userId`='" . $userData['id'] . "' and (`walletType`='INR' or `walletType`='ROI') and type='credit' and `transaction_type`!='receive'"));
                                                                                    echo (isset($smw1['smant'])) ? $smw1['smant'] : 0;
                                                                                    ?>

                                    </h2>
                                    <h5>Total Income</h5>

                                </div>
                            </a>
                        </div>

                        <!--            <div class="col-lg-4 sidebar">
                                    <a href="trans_daily_level.php">
                                        <div class="widget admin-widget sec">
                                            <h3 style="font-weight: 4; overflow-wrap: break-word;">
                    <?php
                    $pvleft = $userClass->pvCount($db, 'left', $id);
                    $pvRight = $userClass->pvCount($db, 'right', $id);
                    echo round($pvleft, 2) . '&nbsp;:&nbsp;' . round($pvRight, 2);
                    ?>
                                            </h3>
                                            <h5>Business Total</h5>
                                        </div>
                                    </a>
                                </div>-->
                        <!--            <div class="col-lg-4 sidebar">
                                    <a href="trans_daily_level.php">
                                        <div class="widget admin-widget sec">
                                            <h3 style="font-weight: 4; overflow-wrap: break-word;">
                    <?php
                    $pvleft = $userClass->pvCounttotal($db, 'left', $id);
                    $pvRight = $userClass->pvCounttotal($db, 'right', $id);
                    echo round($pvleft, 2) . '&nbsp;:&nbsp;' . round($pvRight, 2);
                    ?>
                                            </h3>
                                            <h5>Business Pending</h5>
                                        </div>
                                    </a>
                                </div>-->
                        <!--          <div class="col-lg-3 col-md-3 col-6 sidebar">
                                    <a href="#">
                                        <div class="widget admin-widget sec" style="background: #b53fad">
                                            <h2 class="text-white" style="font-weight: 4; overflow-wrap: break-word;">
                    <?php
                    $pvleft = $userClass->pvCounttotal($db, 'left', $id);
                    $pvRight = $userClass->pvCounttotal($db, 'right', $id);
                    echo round($pvleft, 2) . '&nbsp;:&nbsp;' . round($pvRight, 2);
                    ?>
                                            </h2>
                                            <h5 class="text-white">Business Pending</h5>
                                        </div>
                                    </a>
                                </div>-->
                    </div>
                </div>
            </div>

            <div class="col-lg-3 sidebar reffer-main-box">


                <div class="widget admin-widget reffer-box">
                    <i class="fas fa-coins admin-overlay-icon"></i>
                    <h4> <?php
                            $smwvdd1 = mysqli_num_rows(mysqli_query($db, "SELECT `id` FROM `user` WHERE `sponser_by`='" . $userData['user_id'] . "' and `package`!='InActive'"));
                            echo (isset($smwvdd1)) ? $smwvdd1 : 0;
                            ?></h4>
                    <h4>Referral</h4>

                    <a href="refer_direct.php" class="btn btn-default btn-center"><span>View Detail</span></a>
                </div>

                <div class="widget admin-widget reffer-box">
                    <i class="fas fa-comments admin-overlay-icon"></i>
                    <h4> <?php
                            $downline = mysqli_fetch_array(mysqli_query($db, "SELECT count(*) as cnt FROM `level_downline` where `sponser_by`='" . $userData['user_id'] . "'"));
                            echo (isset($downline['cnt'])) ? $downline['cnt'] : 0;
                            ?></h4>
                    <h4>Total Team</h4>

                    <a href="refer_team.php" class="btn btn-default btn-center"><span>View Detail</span></a>
                </div>

            </div>

            <div class="col-lg-9">
                <div class="profile-content">
                    <!-- ad -->

                    <h3 class="admin-heading bg-offwhite">
                        <p>Recent Activity </p>
                        <span><?php echo $userData['name']; ?> Activity</span>
                    </h3>

                    <!-- Admin Heading Title  -->
                    <div class="transaction-title bg-offwhite">
                        <div class="items">
                            <div class="row">
                                <div class="col cs1"><span class="">Date</span></div>
                                <div class="col cs1">Description</div>
                                <div class="col cs1 text-center">Wallet</div>
                                <div class="col cs1 text-center">Type</div>
                                <div class="col cs1">Amount</div>
                            </div>
                        </div>
                    </div>
                    <!-- Admin Heading Title End -->

                    <!-- Transaction List -->
                    <div class="transaction-area">


                        <?php
                        $tquery = mysqli_query($db, "SELECT * FROM `wallet` where `userId`= '$uiid' and walletType='INR' order by datetime desc limit 10");
                        while ($tdataQuery = mysqli_fetch_array($tquery)) {
                        ?>
                            <div class="items">
                                <a href="transactions.php">
                                    <div class="row">
                                        <div class="col c1">
                                            <span class="name"><?php echo $tdataQuery['datetime']; ?></span>
                                        </div>
                                        <div class="col cs1">
                                            <span class="name"><?php echo $tdataQuery['description']; ?></span>
                                        </div>
                                        <div class="col cs1 text-center">
                                            <span class="payments-status text-warning"><i class="fas fa-ellipsis-h" data-toggle="tooltip" data-original-title="In Progress"></i></span>
                                        </div>
                                        <div class="col cs1">
                                            <span class="payment-amaount"><?php echo $tdataQuery['type']; ?></span>
                                        </div>
                                        <div class="col cs1">
                                            <?php echo $tdataQuery['amount']; ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>




                    </div>
                </div>
                <!-- Transaction List End -->


                <div class="row mt-3 py-4">
                    <div class="col text-left">
                        <a href="transactions.php" class="btn btn-default2">View All
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>

                </div>
                <div class="row mt-3 py-4">
                    <div class="col text-left">
                        <?php
                        $check = 'SELECT * FROM news ORDER BY id DESC LIMIT 1';
                        $result = $db->query($check);

                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <marquee behavior="" direction="left"><?php echo $row['new_news'] ?></marquee>
                        <?php
                        }
                        ?>
                    </div>

                </div>
                <div class="col-lg-12">
                    <div class="profile-content">
                        <h2 class="admin-heading bg-offwhite">Royalty Bonus Chart</h2>
                        <!-- Filter -->
                        <!-- Filter End -->
                        <!-- All Transactions  -->
                        <div class="profile-content">
                            <!-- Admin Heading Title  -->
                            <div class="transaction-title bg-offwhite">
                                <div class="items">
                                    <div class="row">
                                        <div class="col cs1"><span class="">#</span></div>
                                        <div class="col cs1">Rank</div>
                                        <div class="col cs1">ID`s</div>
                                        <div class="col cs1">Bonus Monthly</div>
                                        <div class="col cs1">Time Period</div>
                                        <div class="col cs1">Status</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Admin Heading Title End -->

                            <!-- Transaction List -->
                            <div class="transaction-area">

                                <?php
                                $royalty = [
                                    1 => ['rank' => 'Diamond', 'ids' => '50', 'bonus' => '5000', 'period' => '12'],
                                    2 => ['rank' => 'Crown', 'ids' => '75', 'bonus' => '7500', 'period' => '12'],
                                    3 => ['rank' => 'Kohinoor', 'ids' => '100', 'bonus' => '10000', 'period' => '12'],
                                ];
                                $q = "SELECT * FROM `user`";
                                $royalUser = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` WHERE `user_id`='" . $userData['id'] . "'"));
                               
                                $royalUsers = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `tbl_roi` WHERE `user_id`='" . $userData['user_id'] . "'"));
                                ?>
                                <?php foreach ($royalty as $key => $rc) { ?>
                                    <div class="items">
                                        <a href="#">
                                            <div class="row">
                                                <div class="col cs1">
                                                    <span class=""><?php echo $key; ?></span>
                                                </div>
                                                <div class="col cs1">
                                                    <span class=""><?php echo $rc['rank']; ?></span>
                                                </div>
                                                <div class="col cs1">
                                                    <span class=""><?php echo $rc['ids']; ?></span>
                                                </div>
                                                <div class="col cs1">
                                                    <span class="">Rs. <?php echo $rc['bonus']; ?></span>
                                                </div>
                                                <div class="col cs1">
                                                    <span class=""><?php echo $rc['period']; ?> Month</span>
                                                </div>
                                                <!-- <div class="col cs1">
                                                    <span class=""><?php //echo $rc['period']; 
                                                                    ?>Wt</span>
                                                </div> -->
                                                <div class="col cs1 ">

                                                    <?php
                                                    if ($royalUsers['level'] == $key) {
                                                    ?>
                                                        <span class="name green" style="color:green">Achived</span>
                                                        <?php } else {
                                                            ?>
                                                            <span class="name red" style="color:red">Not Achived</span>
                                                    <?php }
                                                    ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php }
                                ?>
                            </div>
                        </div>
                        <!-- Transaction List End -->
                    </div>
                </div>
                <!-- Recent Activity End -->
            </div>
            <!-- Middle Panel End -->
        </div>
</div>

<!--End of Tawk.to Script-->
<?php require 'footer.php'; ?>
<script>
    jQuery(".nav-item").removeClass("active");
    jQuery("#nav1").addClass("active");
</script>