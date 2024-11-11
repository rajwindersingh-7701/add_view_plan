<?php require_once 'header.php'; ?>
<!-- Profile bar -->
<!-- End Profile bar -->

<!-- Middle Panel -->

<div class="col-lg-9 profile-area">
    <h3 class="admin-heading bg-offwhite">
        <a href="upgrade_detail.php" class="btn-link"><i class="fas fa-edit mr-1"></i>View Detail</a>
        <p>Membership</p>
        <span>Become a premium member</span>
    </h3>
    <!-- Edit personal info  -->
    <div id="edit-personal-details" style="display: block" class="accord bg-offwhite shadow">
        <div class="content-edit-area">
            <div class="edit-header">
                <h5 class="title">Activate Package</h5>
                <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="row">

                <div class="col-lg-6 profile-area">
                    <div class="edit-content">
                        <form id="personaldetails" action="controller/paymentContrroller.php" method="post">
                            <?php if (isset($_SESSION["upgrade"])) if ($_SESSION["upgrade"]["status"] == false) echo "<p style='color:red' class='false' >" . $_SESSION['upgrade']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["upgrade"])) if ($_SESSION["upgrade"]["status"] == true) echo "<p id='response-msg' class='true' >" . $_SESSION['upgrade']['msg'] . "</p>";
                                                                                                                                                                                                        unset($_SESSION["upgrade"]); ?>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Select Package </label>

                                                <select name="pack" id="" class="form-control">
                                                    <?php
                                                    $i = 0;

                                                    if ($userData['package'] != 'InActive') {
                                                        $i = $userData['package'];
                                                    }
                                                    if ($userData['user_id'] === 'Ad220334') {

                                                        $pquery = mysqli_query($db, "SELECT * FROM  `package`");
                                                    } else {

                                                        $pquery = mysqli_query($db, "SELECT * FROM  `package` where `status`=1 limit 1");
                                                    }

                                                    while ($packQuery = mysqli_fetch_array($pquery)) {
                                                    ?>
                                                        <option value="<?php echo $packQuery['id']; ?>"><?php echo $packQuery['title'] . ' ' . $packQuery['price']; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile">Enter User Id.</label>
                                                <input type="text" name="other_user_id" placeholder="User id" class="form-control" data-pr-form="mobile" id="uids" onChange="checkSponsor()" onFocus="checkSponsor()" required placeholder="Mobile No.">
                                                <div id="usernamechk">



                                                    <p></p>



                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Tran. Password <span class="text-muted font-weight-500">(Personal)</span></label>
                                                <input type="password" name='master_key' class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-link float-left mb-3"><button class=" btn btn-default" type="submit" name='pay-with-wallet-other'><i class="far fa-save"></i> BUY NOW</button></div>
                                    <a class="btn-link float-right mb-3" href="upgrade_detail.php"><span class="text-3 mr-1"><i class="fas fa-plus-circle"></i></span>Upgrade Detail</a>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>

                <!--                <div class="col-lg-6 profile-area">
                    <div class="col-12 col-sm-12 col-lg-12 cardBox">
                        <div class="account-card account-card-primary">
                            <p class="pirotry text-right bg-warning">Upgrade</p>  
                            <div class="row">
                                <p class="card-number col-12" style="color: #fff;font-size: 16px" id="usernamechk">XXXX-XXXX-XXXX-2353</p>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p class="valid-card">Valid</p>
                                    <p class="expare ">1000</p>  
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
                                    Active with Advertiser
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