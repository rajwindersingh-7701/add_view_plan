<?php
die;
require 'header.php';
//echo "<script type='text/javascript'> document.location = 'profile_kyc.php?add_user=true'; </script>";
//    exit;
?>
<!-- Middle Panel  -->

<div class="col-lg-9">
    <!--                    <div class="row">
                            <div class="col-lg-3">
                                 Available Balance 
                                <div class="bg-light shadow-sm text-center mb-3">
                                    <div class="d-flex admin-heading pr-3">
                                   
                                        <div class="mr-auto">
                                             <h3 class="text-9 font-weight-400"><?php // echo $walletbtc.'';    ?></h3>
                                            <h3 class="text-9 font-weight-400"><i class="fas fa-wallet"></i> Available Balance</h3>
                                        </div>
                                        
                                    </div>
                                </div>
                                 Available Balance End 
                            </div>
                        </div>-->
    <div class="col-md-12 profile-content ">
        <ul class="nav nav-pills">

            <li class="nav-item">
                <a class="nav-link " href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="profile_bank.php">Bank Detail</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="profile_password.php">Password</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <form id="personaldetails" action="controller/function.php" method="post" enctype="multipart/form-data">
                    <?php if (isset($_SESSION["bank_submit"])) if ($_SESSION["bank_submit"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['bank_submit']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["bank_submit"])) if ($_SESSION["bank_submit"]["status"] == 'true') echo "<p id='response-msg' class='true' >" . $_SESSION['bank_submit']['msg'] . "</p>";unset($_SESSION["bank_submit"]); ?> 
                    <?php
                    if ($userData['account_number'] == '') {
                        ?>
                        <!--<a href>-->
                        <div class="form-group">
                            <label for="name">Beneficial Name</label>
                            <input type="text" name="account_name" value="<?php echo $userData['account_name']; ?>" class="form-control shadow form-control-lg mobilenumber" id="name" required placeholder="Enter Account Name">
                        </div>
                        <div class="form-group">
                            <label for="name">Bank Name</label>
                            <input type="text" name="bank_name" value="<?php echo $userData['bank_name']; ?>" class="form-control shadow form-control-lg mobilenumber" id="name" required placeholder="Enter Bank Name">
                        </div>
                        <div class="form-group">
                            <label for="name">Bank IFSC</label>
                            <input type="text" name="bank_ifsc" value="<?php echo $userData['bank_ifsc']; ?>" class="form-control shadow form-control-lg mobilenumber" id="name" required placeholder="Enter Bank Ifsc">
                        </div>
                        <div class="form-group">
                            <label for="name">Bank Account No.</label>
                            <input type="text" name="account_number" value="<?php echo $userData['account_number']; ?>" class="form-control shadow form-control-lg mobilenumber" id="name" required placeholder="Enter Account Number">
                        </div>
                        <div class="form-group">
                            <label for="name">Pan No.</label>
                            <input type="text" name="pan" value="<?php echo $userData['pan']; ?>" class="form-control shadow form-control-lg mobilenumber" id="name" required placeholder="Enter Pan Number">
                        </div>
                        <div class="form-group">
                            <label for="name">Adhar No.</label>
                            <input type="text" name="adhar" value="<?php echo $userData['adhar']; ?>" class="form-control shadow form-control-lg mobilenumber" id="name" required placeholder="Enter Adhar Number">
                        </div>
                        <div class="form-group">
                            <label for="name">Upload.</label>
                            <input type="file" name="image" class="form-control shadow form-control-lg" >
                        </div>
                        <div class="form-group">
                            <button class=" btn btn-default" type="submit" name='account_bank_save'><i class="far fa-save"></i> Update</button>
                        </div>
                        <?php
                    } else {
                        echo "<br><h2>Your bank detail.</h2>";
                        echo "<p style='color:red'>You can submit your bank detail only once.</p>";
                        echo "<p>Beneficial Name:- " . $userData['account_name'] . "</p>";
                        echo "<p>Bank Name:- " . $userData['bank_name'] . "</p>";
                        echo "<p>Bank IFSC:- " . $userData['bank_ifsc'] . "</p>";
                        echo "<p>Bank Account No.:- " . $userData['account_number'] . "</p>";
                        echo "<p>Pan No.:- " . $userData['pan'] . "</p>";
                        echo "<p>Adhar No.:- " . $userData['adhar'] . "</p>";
                    }
                    ?>

                    <ul class="pager my-5">
                        <li>&nbsp;</li>
                        <li><a href="profile_password.php" class="btn btn-default "> Next <i class="fas fa-chevron-right"></i></a></li>
                    </ul>
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
    jQuery("#nav2").addClass("active");
</script>