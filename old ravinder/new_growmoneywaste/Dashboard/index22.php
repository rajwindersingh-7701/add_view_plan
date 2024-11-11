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
        padding: 20px;
        text-align: center;
    }


</style>
<!-- Middle Panel  -->
<div class="col-lg-9">
    <div class="profile-content">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-6 sidebar">
                <div class="widget admin-widget" style="background: #6e7abd;">
                    <h2 class="text-white" style="font-weight: 4"><?php echo $walletbd2 ?></h2>
                    <h4 class="text-white">E-WALLET</h4>
                    <a href="#" class="btn btn-default btn-center"><span>View Detail</span></a>
                </div>
            </div>
            <!--            <div class="col-lg-3 col-md-3 col-6 sidebar">
                            <div class="widget admin-widget" style="background: #1f2d42">
                                <h2 class="text-white" style="font-weight: 4"><?php echo $walletbd2; ?></h2>
                                <h4 class="text-white">PAY WALLET</h4>
                                <a href="#" class="btn btn-default btn-center"><span>View Detail</span></a>
                            </div>
                        </div>-->
            <div class="col-lg-3 col-md-3 col-6 sidebar">
                <div class="widget admin-widget" style="background: #e91e63">
                    <!--<i class="fas fa-coins admin-overlay-icon"></i>-->
                    <h2 class="text-white" style="font-weight: 400"><?php echo $walletbtc; ?></h2>
                    <h4 class="text-white">PAY WALLET</h4>
                    <a href="#" class="btn btn-default btn-center"><span>View Detail</span></a>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-6 sidebar">
                <div class="widget admin-widget" style="background: #ffc107">
                    <h2 class="text-white" style="font-weight: 400">
                        <?php
                        echo $walletroi;
                        ?>
                    </h2>
                    <h4 class="text-white">Daily Task</h4>
                    <a href="#" class="btn btn-default btn-center"><span>View Detail</span></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-6 sidebar">
                <a href="trans_refer.php">
                    <div class="widget admin-widget sec" style="background: #f44336">
                        <h2 class="text-white" style="font-weight: 4">
                            <?php
                            $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `wallet` WHERE `userId`='" . $userData['id'] . "' and `transaction_type`='direct'"));
                            echo (isset($smw1['smant'])) ? $smw1['smant'] : 0;
                            ?>
                        </h2>
                        <h5 class="text-white">Refer Bonus</h5>
                    </div>
                </a>
            </div>

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
            <div class="col-lg-3 col-md-3 col-6 sidebar">
                <a href="trans_daily.php">
                    <div class="widget admin-widget sec" style="background: #4caf50">
                        <h2 class="text-white" style="font-weight: 4">
                            <?php
                            $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `wallet` WHERE `userId`='" . $userData['id'] . "' and `transaction_type`='ad'"));
                            echo (isset($smw1['smant'])) ? $smw1['smant'] : 0;
                            ?>
                        </h2>
                        <h5 class="text-white">Daily Ad View Bonus</h5>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-6 sidebar">
                <a href="trans_daily.php">
                    <div class="widget admin-widget sec" style="background: #cddc39">
                        <h2 class="text-white" style="font-weight: 4">
                            <?php
                            $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `wallet` WHERE `userId`='" . $userData['id'] . "' and `transaction_type`='point_matching'"));
                            echo (isset($smw1['smant'])) ? $smw1['smant'] : 0;
                            ?>
                        </h2>
                        <h5 class="text-white">Binary Bonus</h5>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-6 sidebar">
                <a href="trans_daily_level.php">
                    <div class="widget admin-widget sec" style="background: #ff5722">
                        <h2 class="text-white" style="font-weight: 4">
                            <?php
                            $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `wallet` WHERE `userId`='" . $userData['id'] . "' and `transaction_type`='level_ad'"));
                            echo (isset($smw1['smant'])) ? $smw1['smant'] : 0;
                            ?>
                        </h2>
                        <h5 class="text-white">Royalty Bonus</h5>

                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-6 sidebar">
                <a href="trans_daily_level.php">
                    <div class="widget admin-widget sec" style="background: #00bcd4">
                        <h2 class="text-white" style="font-weight: 4">
                            <?php
                            $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `wallet` WHERE `userId`='" . $userData['id'] . "' and (`walletType`='INR' or `walletType`='ROI') and `datetime`>'$currentdate' and `type`='credit'"));
                            echo (isset($smw1['smant'])) ? $smw1['smant'] : 0;
                            ?>
                        </h2>
                        <h5 class="text-white">Today Income</h5>

                    </div>
                </a>
            </div>
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
            <div class="col-lg-3 col-md-3 col-6 sidebar">
                <a href="trans_daily_level.php">
                    <div class="widget admin-widget sec" style="background: #673ab7">
                        <h2 class="text-white" style="font-weight: 4">
                            <?php
                            $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `wallet` WHERE `userId`='" . $userData['id'] . "' and (`walletType`='INR' or `walletType`='ROI') and type='credit'"));
                            echo (isset($smw1['smant'])) ? $smw1['smant'] : 0;
                            ?>
                        </h2>
                        <h5 class="text-white">Total Income</h5>

                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-6 sidebar">
                <a href="trans_daily_level.php">
                    <div class="widget admin-widget sec" style="background: #b53fad">
                        <h2 class="text-white" style="font-weight: 4">
                            <?php
                            $smw1 = mysqli_fetch_array(mysqli_query($db, "SELECT sum(amount) as smant  FROM `withdraw` WHERE `userId`='" . $userData['id'] . "' and (`type`='INR' or `type`='ROI')"));
                            echo round((isset($smw1['smant'])) ? $smw1['smant'] : 0);
                            ?>
                        </h2>
                        <h5 class="text-white">Total Withdraw</h5>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-6 sidebar">
                <a href="trans_daily_level.php">
                    <div class="widget admin-widget sec" style="background: #b53fad">
                        <h2 class="text-white" style="font-weight: 4">
                            <?php
                            $pvleft = $userClass->pvCount($db, 'left', $id);
                            $pvRight = $userClass->pvCount($db, 'right', $id);
                            echo round($pvleft, 2) . '&nbsp;:&nbsp;' . round($pvRight, 2);
                            ?>
                        </h2>
                        <h5 class="text-white">Business Total</h5>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-6 sidebar">
                <a href="trans_daily_level.php">
                    <div class="widget admin-widget sec" style="background: #b53fad">
                        <h2 class="text-white" style="font-weight: 4">
                            <?php
                            $pvleft = $userClass->pvCounttotal($db, 'left', $id);
                            $pvRight = $userClass->pvCounttotal($db, 'right', $id);
                            echo round($pvleft, 2) . '&nbsp;:&nbsp;' . round($pvRight, 2);
                            ?>
                        </h2>
                        <h5 class="text-white">Business Pending</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-3 sidebar">


    <div class="widget admin-widget">
        <i class="fas fa-coins admin-overlay-icon"></i>
        <h4>  <?php
            $smwvdd1 = mysqli_num_rows(mysqli_query($db, "SELECT `id` FROM `user` WHERE `sponser_by`='" . $userData['user_id'] . "' and `package`!='InActive'"));
            echo (isset($smwvdd1)) ? $smwvdd1 : 0;
            ?></h4>
        <h4>Referral</h4>
        <p>Have questions or concerns regrading</p>
        <a href="#" class="btn btn-default btn-center"><span>View Detail</span></a>
    </div>

    <div class="widget admin-widget">
        <i class="fas fa-comments admin-overlay-icon"></i>
        <h4>  <?php
            $downline = mysqli_fetch_array(mysqli_query($db, "SELECT count(*) as cnt FROM `level_downline` where `sponser_by`='" . $userData['user_id'] . "'"));
            echo (isset($downline['cnt'])) ? $downline['cnt'] : 0;
            ?></h4>
        <h4>Total Team</h4>
        <p>Have questions or concerns regrading your account?<br>
            Our experts are here to help!.</p>
        <a href="#" class="btn btn-default btn-center"><span>View Detail</span></a>
    </div>

</div>

<div class="col-lg-9">
    <div class="profile-content">
        <!-- ad -->
        <div class='task-portion'>
            <a href="ad_task.php" class="btn btn-default"><span>View Ad</span></a>
        </div>
        <h3 class="admin-heading bg-offwhite">
            <p>Recent Activity </p>
            <span><?php echo $userData[name]; ?> Activity</span>
        </h3>

        <!-- Admin Heading Title  -->
        <div class="transaction-title bg-offwhite">
            <div class="items">
                <div class="row">
                    <div class="col"><span class="">Date</span></div>
                    <div class="col">Description</div>
                    <div class="col text-center">Wallet</div>
                    <div class="col text-center">Type</div>
                    <div class="col">Amount</div>
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
                            <div class="col " style="max-width: 170px;">
                                <span class="name"><?php echo $tdataQuery['datetime']; ?></span>
                            </div>
                            <div class="col">
                                <span class="name"><?php echo $tdataQuery['description']; ?></span>
                            </div>
                            <div class="col text-center">
                                <span class="payments-status text-warning" ><i class="fas fa-ellipsis-h" data-toggle="tooltip" data-original-title="In Progress"></i></span>
                            </div>
                            <div class="col">
                                <span class="payment-amaount"><?php echo $tdataQuery['type']; ?></span>
                            </div>
                            <div class="col">
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
        <div class="col text-left" >
            <a href="transactions.php" class="btn btn-default">View All
                <i class="fas fa-chevron-right"></i>
            </a>    
        </div>

    </div>
</div>
<!-- Recent Activity End -->
</div>
<!-- Middle Panel End -->
</div>
</div>
</div>
<!-- Content end -->


<?php require 'footer.php'; ?>
<script>
    jQuery(".nav-item").removeClass("active");
    jQuery("#nav1").addClass("active");
</script>