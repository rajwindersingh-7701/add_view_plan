<?php require 'header.php'; ?>
<!-- Middle Panel  -->

<div class="col-lg-9">
    <!--                    <div class="row">
                            <div class="col-lg-3">
                                 Available Balance 
                                <div class="bg-light shadow-sm text-center mb-3">
                                    <div class="d-flex admin-heading pr-3">
                                   
                                        <div class="mr-auto">
                                             <h3 class="text-9 font-weight-400"><?php echo $walletbtc . ''; ?></h3>
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
                <a class="nav-link active" href="profile.php">Profile</a>
            </li>
<!--            <li class="nav-item">
                <a class="nav-link" href="profile_bank.php">Bank Detail</a>
            </li>-->
<!--            <li class="nav-item">
                <a class="nav-link" href="profile_password.php">Password</a>
            </li>-->
        </ul>
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <form action="controller/function.php" method="post">
                    <h2 style="padding: 20px;"> <?php if (isset($_SESSION["btc_update"])) if ($_SESSION["btc_update"]["status"] == "false") echo "<p style='color:red' class='false' >" . $_SESSION['btc_update']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["btc_update"])) if ($_SESSION["btc_update"]["status"] == "true") echo "<p id='response-msg' class='true' >" . $_SESSION['btc_update']['msg'] . "</p>";unset($_SESSION["btc_update"]); ?> </h2>

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" value="<?php echo $userData['name']; ?>" class="form-control shadow form-control-lg mobilenumber" id="name" required placeholder="Enter Full Name">
                    </div>
                    <div class="form-group">
                        <label for="name">Mobile No.</label>
                        <input type="text" name="phone" value="<?php echo $userData['phone']; ?>" class="form-control shadow form-control-lg mobilenumber" id="name" required placeholder="Enter Mobile No.">
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="email" name="email" value="<?php echo $userData['email']; ?>" class="form-control shadow form-control-lg mobilenumber" id="name"  placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <button class=" btn btn-default2" type="submit" name='account2'><i class="far fa-save"></i> Update</button>
                    </div>

                    <ul class="pager my-5">
                        <li>&nbsp;</li>
                        <li><a href="#" class="btn btn-default "> Next <i class="fas fa-chevron-right"></i></a></li>
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