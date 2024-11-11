<?php

$tz = 'Asia/Kolkata';
date_default_timezone_set($tz);
require_once 'header.php'; ?>
<!-- Middle Panel -->
<div class="col-lg-9 profile-area">
    <h3 class="admin-heading bg-offwhite">
        <a href="#" class="btn-link pbtn" data-id="edit-personal-details"><i class="fas fa-edit mr-1"></i>Withdraw detail</a>
        <p>Withdraw Your amount</p>
        <span>You can withdraw working and non working bonus throw this.</span>
    </h3>
    <!-- Edit personal info End -->


    <!-- Edit personal info End -->
    <div class="infoItems shadow">
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#menu1" class="<?php
                                                            if (empty($_GET['type'])) {
                                                                echo "active";
                                                            };
                                                            ?>">Bonus</a></li>

            <!--            <li><a data-toggle="tab" href="#menu2" class="<?php
                                                                            if (isset($_GET['type'])) {
                                                                                echo "active";
                                                                            };
                                                                            ?>">Cashback</a></li>-->
        </ul>

        <div class="tab-content">
            <div id="menu1" class="tab-pane fade in <?php
                                                    if (empty($_GET['type'])) {
                                                        echo "active";
                                                    };
                                                    ?>">
                <form id="personaldetails" action="controller/paymentContrroller.php" method="post">
                    <?php if (isset($_SESSION["withdraw"])) if ($_SESSION["withdraw"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['withdraw']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["withdraw"])) if ($_SESSION["withdraw"]["status"] == 'true') echo "<p id='response-msg' class='true' >" . $_SESSION['withdraw']['msg'] . "</p>";; ?>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="row">
                                <?php


                                $activeright = mysqli_num_rows(mysqli_query($db, "select `id` from `user` where `sponser_by`='" . $userData['user_id'] . "' and `package`!='InActive'"));

                                $kyc = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `user_kyc` WHERE userId='" . $userData['id'] . "' and kyc_status=1"));


                                $d = date("H");
                                //echo $d;
                                // if ($kyc > 0) {
                                //     if ($activeright >= 2) {
                                //         if ($d == "07" || $d == "08" || $d == "09" || $d == "10") {
                                ?>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Total Current Amount: </label>
                                        <span id="ctl00_ContentPlaceHolder1_lblEwalletBalance"><?php echo $walletbtc; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="mobile">Amount</label>
                                        <input type="text" name="amount" placeholder="Enter Amount" class="form-control" data-pr-form="mobile" id="mobile" required placeholder="Mobile No.">
                                    </div>
                                    <input name="wallettype" type="hidden" value="INR">
                                    <div class="form-group">
                                        <label for="password">Tran. Password <span class="text-muted font-weight-500">(Personal)</span></label>
                                        <input type="password" name='password' class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="btn-link float-left mb-3"><button class=" btn btn-default" type="submit" name='withdraw'><i class="far fa-save"></i> Withdraw</button></div>
                            <a class="btn-link float-right mb-3" href="#"><span class="text-3 mr-1"><i class="fas fa-plus-circle"></i></span>Withdraw Detail</a>
                            <?php
                            // } else {
                            //                             echo "<h1>Withdraw activate only 7 to 11am.</h1>";
                            //                         }
                            //                     } else {
                            //                         echo "<h1>Withdraw activate after 2 direct user.</h1>";
                            //                     }
                            //                 } else {
                            //                     echo "<h1>Kyc not done please submit your kyc.</h1>";
                            //                 } 
                            ?>
                        </div>

                    </div>
                </form>
            </div>
            <!-- END First Tab -->
            <div id="menu2" class="tab-pane fade <?php
                                                    if (isset($_GET['type'])) {
                                                        echo "active";
                                                    };
                                                    ?>">

            </div>
        </div>


    </div>



</div>
<!-- Middle Panel End -->
</div>
</div>
</div>
<!-- Content end -->

<?php require 'footer.php'; ?>
<script>
    jQuery(".nav-item").removeClass("active");
    jQuery("#nav3").addClass("active");
</script>