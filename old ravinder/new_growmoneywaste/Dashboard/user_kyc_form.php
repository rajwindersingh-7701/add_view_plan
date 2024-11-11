<?php
require 'header.php';
//echo "SELECT count(id) as kycs FROM  `user_kyc` where `userId`='" . $userData['id'] . "' and kyc_status=1 or kyc_status=0 ";
$userQuery = mysqli_query($db, "SELECT count(id) as kycs FROM  `user_kyc` where `userId`='" . $userData['id'] . "'");
$userKyc = mysqli_fetch_array($userQuery);
//print_r($userKyc['kycs']);

//$userQuery = mysqli_query($db, "SELECT * FROM  `user_kyc` where `userId`='" . $userData['id'] . "' ");
//$userQuery = mysqli_query($db, "SELECT count(id) as kid FROM  `user_kyc` where `userId`='" . $userData['id'] . "' and kyc_status=1 or kyc_status=0 ");
//$userKyc = mysqli_fetch_array($userQuery);
//print_r($userKyc['account_number']);
?>

<?php
if (isset($_POST['kyc'])) {
    //  die('ehdewd');
    // print_r($_POST);
    // die('poks');
    $checkData = mysqli_query($db, "SELECT * FROM `user_kyc` WHERE account_number='" . $_POST['account_number'] . "'");
    $check = mysqli_fetch_array($checkData);
    if (!empty($check)) {
        $_SESSION["invest"] = array("msg" => "Account No Already  Exists.", "status" => "false");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    } else {
        $sql = "INSERT INTO `user_kyc`(`userId`,`account_name`,`bank_name`,`bank_ifsc`, `account_number`, `pan`, `adhar`) VALUES ('" . $userData['id'] . "','" . $_POST['account_name'] . "','" . $_POST['bank_name'] . "','" . $_POST['bank_ifsc'] . "','" . $_POST['account_number'] . "','" . $_POST['pan'] . "','" . $_POST['adhar'] . "')";
        // echo $sql;die;
        mysqli_query($db, $sql);
        $_SESSION["invest"] = array("msg" => "Your request successfully submitted.", "status" => "true");
    }


    //			echo "done";	
    // header('Location:https://growmoney.me/Dashboard/user_kyc_form.php');
}

?>
<!-- Middle Panel  -->
<div class="col-lg-9">
    <div class="col-md-12 profile-content ">
        <!--        <ul class="nav nav-pills">

            <li class="nav-item">
                <a class="nav-link " href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="profile_bank.php">Bank Detail</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="profile_password.php">Password</a>
            </li>
        </ul>-->
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <?php if (isset($_SESSION["invest"])) if ($_SESSION["invest"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['invest']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["invest"])) if ($_SESSION["invest"]["status"] == 'true') echo "<p id='response-msg' class='true' >" . $_SESSION['invest']['msg'] . "</p>";
                                                                                                                                                                                            unset($_SESSION["invest"]); ?>

                <form action="user_kyc_form.php" method="post" enctype="multipart/form-data">
                    <?php // if (isset($_SESSION["bank_submit"])) if ($_SESSION["bank_submit"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['bank_submit']['msg'] . "</p>"; 
                    ?> <?php if (isset($_SESSION["bank_submit"])) if ($_SESSION["bank_submit"]["status"] == 'true') echo "<p id='response-msg' class='true' >" . $_SESSION['bank_submit']['msg'] . "</p>";
                                                                                                                                                                                                                unset($_SESSION["bank_submit"]); ?>
                    <?php

                    //echo $userKyc['kycs'];
                    if ($userKyc['kycs'] == 0) {


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
                        <!--                        <div class="form-group">
                            <label for="panimg">Pan Image.</label>
                            <input type="file" name="kyc_image" class="form-control shadow form-control-lg" required="" >
                        </div>
                        <div class="form-group">
                            <label for="panimg">Bank Image.</label>
                            <input type="file" name="bank_image" class="form-control shadow form-control-lg" required="" >
                        </div>
                        <div class="form-group">
                            <label for="panimg">Aadhar Image.</label>
                            <input type="file" name="adhar_image" class="form-control shadow form-control-lg" required="" >
                        </div>-->
                        <div class="form-group">
                            <button class=" btn btn-default" type="submit" name='kyc' value="kycsave"><i class="far fa-save"></i> Save</button>
                        </div>
                    <?php
                    } else {
                        $userQuery1 = mysqli_query($db, "SELECT * FROM  `user_kyc` where `userId`='" . $userData['id'] . "' order by id desc");
                        $userKyc1 = mysqli_fetch_array($userQuery1);

                        echo "<br><h2>Your KYC detail.</h2>";
                        echo "<p style='color:red'>You can submit your KYC detail only once.</p>";
                        echo "<p>Account Name:- " . $userKyc1['account_name'] . "</p>";
                        echo "<p>Bank Name:- " . $userKyc1['bank_name'] . "</p>";
                        echo "<p>Bank IFSC:- " . $userKyc1['bank_ifsc'] . "</p>";
                        echo "<p>Bank Account No.:- " . $userKyc1['account_number'] . "</p>";
                        echo "<p>Pan No.:- " . $userKyc1['pan'] . "</p>";
                        echo "<p>Adhar No.:- " . $userKyc1['adhar'] . "</p>";
                        if ($userKyc1['kyc_status'] == 1) {
                            echo "<p>Kyc Status.:- Accepted</p>";
                        } else if ($userKyc1['kyc_status'] == -1) {
                            echo "<p>Kyc Status.:- Rejected</p>";
                        } else {
                            echo "<p>Kyc Status.:- Pending</p>";
                        }
                    }
                    ?>

                    <!--                    <ul class="pager my-5">
                        <li>&nbsp;</li>
                        <li><a href="profile_password.php" class="btn btn-default "> Next <i class="fas fa-chevron-right"></i></a></li>
                    </ul>-->
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