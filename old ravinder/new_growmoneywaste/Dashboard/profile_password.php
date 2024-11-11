<?php require 'header.php'; ?>
<!-- Middle Panel  -->

<div class="col-lg-9">
    <div class="col-md-12 profile-content ">
        <ul class="nav nav-pills">

            <li class="nav-item">
                <a class="nav-link active" href="profile_password.php">Password</a>
            </li>
<!--            <li class="nav-item">
                <a class="nav-link " href="profile_bank.php">Bank Detail</a>
            </li>-->
            <li class="nav-item">
                <a class="nav-link" href="profile_tra_pass.php"> Tras. Password</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <form action="controller/function.php" method="POST" enctype="multipart/form-data">
                    <?php if (isset($_SESSION["pass"])) if ($_SESSION["pass"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['pass']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["pass"])) if ($_SESSION["pass"]["status"] == 'true') echo "<p id='response-msg' class='true' >" . $_SESSION['pass']['msg'] . "</p>";unset($_SESSION["pass"]); ?> 

                    <div class="form-group">
                        <label for="name">Current Password</label>
                        <input type="text" name="password" value="" class="form-control shadow form-control-lg mobilenumber" id="name" required placeholder="Current Password">
                    </div>
                    <div class="form-group">
                        <label for="name">New Password </label>
                        <input type="text" name="npassword" value="" class="form-control shadow form-control-lg mobilenumber" id="name" required placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="name">Confirm New Password</label>
                        <input type="text" name="cpassword" value="" class="form-control shadow form-control-lg mobilenumber" id="name" required placeholder="Confirm New Password">
                    </div>
                    <div class="form-group">
                        <button class=" btn btn-default" type="submit" name='account3'><i class="far fa-save"></i> Update</button>
                    </div>
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