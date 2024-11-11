<?php require_once 'header.php';
// $query = mysqli_query($db, "SELECT * FROM `wallet` WHERE userId='$userId'");
// $userData = mysqli_fetch_array($query);
?>
<!-- Profile bar -->
<!-- End Profile bar -->

<!-- Middle Panel -->

<div class="col-lg-9 profile-area">
    <!--    <h3 class="admin-heading bg-offwhite">
            <a href="upgrade_detail.php" class="btn-link" ><i class="fas fa-edit mr-1"></i>View Detail</a>
            <p>Membership</p>
            <span>Become a gold member</span>
        </h3>-->


    <!-- Edit personal info  -->
    <div id="edit-personal-details" style="display: block" class="accord bg-offwhite shadow">
        <div class="content-edit-area">
            <div class="edit-header">
                <h4>E-wallet wallet to E-wallet</h4>
                <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="row">

                <div class="col-lg-6 profile-area">
                    <div class="edit-content">


                        <?php


                        $activeright = mysqli_num_rows(mysqli_query($db, "select `id` from `user` where `sponser_by`='" . $userData['user_id'] . "' and `package`!='InActive'"));
                        $Creditquery = mysqli_query($db, "SELECT SUM(amount) as totalCredit FROM  `wallet` where `userId`='" . $userData['user_id'] . "' && `type`='credit'");
                        // $addcehttts = mysqli_fetch_array($Creditquery);

                        // if ($activeright >= 2 or true) {

                        ?>
                        <form action="controller/paymentContrroller.php" method="post">

                            <?php if (isset($_SESSION["send"])) if ($_SESSION["send"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['send']['msg'] . "</p>"; ?> <?php
                                                                                                                                                                                                if (isset($_SESSION["send"]))
                                                                                                                                                                                                    if ($_SESSION["send"]["status"] == 'true')
                                                                                                                                                                                                        echo "<p id='response-msg' class='true' >" . $_SESSION['send']['msg'] . "</p>";
                                                                                                                                                                                                unset($_SESSION["send"]);
                                                                                                                                                                                                ?>
                            <fieldset>
                                <div class="control-group">
                                    <div class="controls">
                                        <?php
                                        // $sql = "SELECT SUM(amount) from wallet WHERE  `userId`='$id' and `type` = 'epin'";
                                        // $result = $db->query($sql);
                                        // //display data on web page
                                        // while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                            <!--<h4>Minimum LCB for transfer 10</h4>-->
                                            <!-- <h4>E-wallet balance <?php echo $row['SUM(amount)']; ?></h4> -->
                                        <?php
                                        // }
                                        ?>
                                        <h4>E-wallet balance <?php echo $walletbd2; ?></h4>
                                        <h4>User can transfer minimum 500.</h4>

                                    </div>
                                </div>
                                <?php
                                $days = '';
                                $dt = date('d');
                                if ($dt == '01') {
                                    $days = "notactive";
                                } else if ($dt == '16') {
                                } else if ($dt == '11') {
                                    $days = "notactive";
                                } else if ($dt == '21') {
                                } else if ($dt == '17') {
                                    $days = "notactive";
                                } else {
                                    $days = "active";
                                }
                                $days = "notactive";
                                ?>
                                <?php //if ($userData['onlybinary'] == 2) { 
                                ?>

                                <div class="form-group">
                                    <label class="control-label">User id </label>
                                    <div class="controls">
                                        <input class="span12 password col-10" name="uid" id='uids' onChange="checkSponsor()" onFocus="checkSponsor()" type="text" required>
                                        <p id='usernamechk'></p>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label class="control-label">Amount </label>
                                    <div class="controls">
                                        <input class="span12 password col-10 mer" name="amount" type="text" required>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="control-label">Password </label>
                                    <div class="controls">
                                        <input class="span12 password col-10" name="master_key" type="text" required>
                                    </div>
                                </div>
                                <div class="form-actions " style="margin-top:20px;">
                                    <button type="submit" name="transfer-money" class="btn btn-default loginpassword col-5">Transfer</button>
                                    <button type="reset" class="btn btn-default2 col-5">Cancel</button>
                                </div>
                                <?php //} else { 
                                ?>

                                <!-- <div class="controls">
                                            <h4 style="color:red">Transfer fund is activate after 2 direct referral. </h4>
                                        </div> -->

                                <?php //} 
                                ?>

                            </fieldset>
                        </form>

                        <?php
                        //  } else {

                        //     echo "Need to 2 direct for transfer fund.";
                        // } 
                        ?>

                    </div>
                </div>

                <!--                <div class="col-lg-6 profile-area mt-5">
                                    <div class="col-12 col-sm-12 col-lg-12 cardBox">
                                        <div class="account-card account-card-primary">
                                            <p class="pirotry text-right bg-warning">Upgrade</p>  
                                            <div class="row">
                                                <p class="card-number col-12" style="color: #fff;font-size: 16px" id="usernamechk">XXXX-XXXX-XXXX-2353</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <p class="valid-card">Valid</p>
                                                    <p class="expare ">600</p>  
                                                </div>
                                                <div class="col-6">
                
                                                </div>                                        
                                            </div>      
                                            <div class="row">
                                                <div class="col-6">
                                                    <p class="card-holder-name">Enjoy this amazing portal.</p> 
                                                </div>
                                                <div class="col-6">
                                                    <img class="ml-auto" src="https://plugins.yithemes.com/yith-woocommerce-membership/wp-content/uploads/sites/1410/2016/07/Membership-Gold.png" alt="visa" title="">
                                                </div>
                                            </div>
                                            <div class="account-card-overlay">                                        
                                                <a href="#">
                                                    Active with Gold
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
            </div>
        </div>
    </div>
    <!-- Edit personal info End -->


    <!-- Edit personal info End -->



</div>
<!-- Middle Panel End -->
</div>
</div>
</div>
<!-- Content end -->

<!-- Call to action section start -->
<!--<section class="callto-action">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3>Want To Become a Agent</h3>
                <p>Success And Spirit In Our Company</p>
            </div>
            <div class="col-md-4 text-md-right">
                <a href="signup.html" class="btn btn-default">Register Now</a>
            </div>
        </div>
    </div>
</section>-->
<!-- Call to action section end -->

<?php require 'footer.php'; ?>
<script>
    jQuery(".nav-item").removeClass("active");
    jQuery("#nav3").addClass("active");
</script>
<script>
    function checkSponsor() {
        var uname = document.getElementById("uids").value;
        console.log(uname);
        var params = "user_id=" + uname;
        var url = "../model/ajax.php?request=sponser";
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'html',
            data: params,
            beforeSend: function() {
                document.getElementById("usernamechk").innerHTML = 'checking';

                $('#pay_sponsor').val(uname);
            },
            complete: function() {},
            success: function(html) {
                document.getElementById("usernamechk").innerHTML = html;
                //                $('#pay_sponsor').val(uname);   
            }
        });
    }
</script>