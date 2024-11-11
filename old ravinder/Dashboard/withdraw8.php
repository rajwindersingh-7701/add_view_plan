<?php require_once 'header.php'; ?>
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
            <li><a data-toggle="tab" href="#menu1"  class="<?php
                if (empty($_GET['type'])) {
                    echo "active";
                };
                ?>">Bonus</a></li>

            <li><a data-toggle="tab" href="#menu2" class="<?php
                if (isset($_GET['type'])) {
                    echo "active";
                };
                ?>">Cashback</a></li>
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
<?php if (true) { ?>
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
                                            <label for="password">Password <span class="text-muted font-weight-500">(Personal)</span></label>
                                            <input type="password" name='password'  class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-link float-left mb-3"><button class=" btn btn-default" type="submit" name='withdraw'><i class="far fa-save"></i> Withdraw</button></div>
                                <a class="btn-link float-right mb-3" href="#"><span class="text-3 mr-1"><i class="fas fa-plus-circle"></i></span>Withdraw Detail</a>
<?php } ?>
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
                <form id="personaldetails" action="controller/paymentContrroller.php" method="post">
                                    <?php if (isset($_SESSION["withdraw"])) if ($_SESSION["withdraw"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['withdraw']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["withdraw"])) if ($_SESSION["withdraw"]["status"] == 'true') echo "<p id='response-msg' class='true' >" . $_SESSION['withdraw']['msg'] . "</p>";unset($_SESSION["withdraw"]); ?> 
                    <div class="row">

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-12">
                                    <h6>Withdraw request minimum 200</h6>
<?php
$d = date("d");
if ($d == 07 or $d == 14 or $d == 21 or $d == 28) {
    ?>
                                        <div class="form-group">
                                            <label>Total Current Amount: </label>
                                            <span id="ctl00_ContentPlaceHolder1_lblEwalletBalance"><?php echo $walletroi; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="mobile">Amount</label>
                                            <input type="text" name="amount" placeholder="Enter Amount" class="form-control" data-pr-form="mobile" id="mobile" required placeholder="Mobile No.">
                                        </div>
                                        <input name="wallettype" type="hidden" value="ROI"> 
                                        <div class="form-group">
                                            <label for="password">Password <span class="text-muted font-weight-500">(Personal)</span></label>
                                            <input type="password" name='password'  class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <div class="btn-link float-left mb-3"><button class=" btn btn-default" type="submit" name='withdraw'><i class="far fa-save"></i> Withdraw</button></div>
                                <a class="btn-link float-right mb-3" href="#"><span class="text-3 mr-1"><i class="fas fa-plus-circle"></i></span>Withdraw Detail</a>
    <?php
} else {
    echo "<h1>Withdraw ativate 7th, 14th, 21st and 28th of the month.</h1>";
}
?>
                        </div>

                    </div>
                </form>
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