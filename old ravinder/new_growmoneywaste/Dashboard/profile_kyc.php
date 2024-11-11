<?php
require_once "header.php";
$mobile_number = $userData['phone'];
//$mobile_number = "8728023931";
$parameters = array(
    'mobile_number' => $mobile_number,
);
$url = 'https://api.pay2all.in/v1/money/verification';

$res = apihit($parameters, $url);
$resjson = json_decode($res);
//print_r($resjson->error);die;
$parameters = array(
    'mobile_number' => $mobile_number,
);
$url = 'https://api.pay2all.in/v1/money/beneficiary';

$res1 = apihit($parameters, $url);
$resjson1 = json_decode($res1);
$bankmsg = $resjson1;

$allbank = $resjson1->data;
//print_r($resjson1);
//print_r($resjson1);
//if(isset($resjson)){
//    if($resjson->status != "2"){
////    print_r($resjson->status);die;
//    }
////    if($resjson->message=="Success"){
////         echo "<script type='text/javascript'> document.location = 'verify_detail.php?bank=true'; </script>";
////    exit;
////    }
//}
//print_r($resjson->message);die;

function apihit($parameters, $url) {
    $key = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQxZWQwMzQyYmE0NWUyYTkwMmU1Y2IxZDIwYmZjNTM1OWFiMzEyN2FhYzdiMmVhNzZjZDljN2JhNTU1ZDQ5ZjAwZjk1OTNiZTQzYzQxZjBkIn0.eyJhdWQiOiIxIiwianRpIjoiZDFlZDAzNDJiYTQ1ZTJhOTAyZTVjYjFkMjBiZmM1MzU5YWIzMTI3YWFjN2IyZWE3NmNkOWM3YmE1NTVkNDlmMDBmOTU5M2JlNDNjNDFmMGQiLCJpYXQiOjE1ODk2MDQ4ODgsIm5iZiI6MTU4OTYwNDg4OCwiZXhwIjoxNjIxMTQwODg4LCJzdWIiOiIyMDgiLCJzY29wZXMiOltdfQ.vAhUKbAcvVt3GuF0dF69kd5iWxGoGUbd4LtYAa1OTwK_DNeDBJhSMLykJw1yY14EEnoyGVNsYubCbZQILxfu4MivXgEX30OmR4kn-lfN4m6D4Jxn10kXzB3N5VIEVe9UtFxKlqDysRhm3Z1UdEtP3nYAQlKVWUE8LR3YQ51TB_AVVuM5ng1Zq1CtN_aumGmEoCZ6X8f4Zxza7OlzdRZLGZErAHGdiPbIrPDmGdqAYxnRoVblmDzFmNptpkn0n1sPltwALeDmDv02sLaAsuHXMQKcDjoyddQy44900IQahUTDrCV9lr1CWizFffe_g2gu3nWx1KVUIu3mho1IJXODGitx9icT_8QpYz6toFHtNYhqLxED2mFb-2UPYe4XyrPFOayYDqzYKjYth_k1D5VoIVC7Cy6d28JhZDk8Eck7w4emGnlna5-3TDSTkhogsGgtdXP2ii9hPa0ffFuJ_8LVGAITcuVSydcLorRHeT4qcvUfcuJp-TR_osTT_X1VVfR4wSpy5Igi-Dpe5XBx-PuOLrz25uEVNHTe8BUkP4TMIXEfuJrJhvcwGHOUftmrNmhfqlBy3nGI0tUBhPweJJtyIcvcR3NAXd7EkNjsuha0w-qMVuJu09MYapyhrYhwD9cW1AvupUsJcKhBLwvmzdE2WTeIwas4rHSypWKbuNfxZ8w"; //you have to add personal access token 
    $header = ["Accept:application/json", "Authorization:Bearer " . $key];
    $method = 'POST';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $response = curl_exec($ch);
    return $response;
// //[JSON RESPONSE]
}
?>
<!-- Middle Panel  -->
<style>
    .tbl-ctnr{
        background: #FFFFFF;
        margin-top: -2%;
        width: 100% !important;
        overflow: scroll;
    }
</style>
<div class="col-lg-9 profile-area">
    <h3 class="admin-heading bg-offwhite">
        <a href="upgrade_detail.php" class="btn-link" ><i class="fas fa-edit mr-1"></i>View Detail</a>
        <p>Membership</p>
        <span>Become a gold member</span>
    </h3>
    <!-- Edit personal info  -->

    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
    <div id="edit-personal-details" style="display: block" class="accord bg-offwhite shadow">
        <div class="content-edit-area">
            <div class="edit-header">
                <!--<h5 class="title">For Withdraw Instant Request.</h5>-->
                <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="row">

                <?php if (isset($_REQUEST['add_user'])) { ?>
                    <div class="col-lg-6 profile-area">
                        <div class="edit-content">
                            <div class="box-body padding" style="background:#FFFFFF; margin-top:-4%">
                                <form action="controller/function.php" method="post" >
                                    <?php if (isset($_SESSION["user_info"])) if ($_SESSION["user_info"]["status"] == "false") echo "<p style='color:red' class='false' >" . $_SESSION['user_info']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["user_info"])) if ($_SESSION["user_info"]["status"] == true) echo "<p id='response-msg' class='true' >" . $_SESSION['user_info']['msg'] . "</p>";unset($_SESSION["user_info"]); ?> 

                                    <?php
//                                    print_r($resjson);
                                    $verified = "false";
                                    if (isset($resjson->errors)) {
                                        echo "<h3 style='color:red'>User Detail Not Varified. <br>";
                                        echo "Please enter otp here <a href='verify_detail.php?verify=true'>click here</a>. </h2>";
                                    } else if ($resjson->status == 2) {
                                        echo "<h4 style='color:red'>Note:- Please submit this detail first. </h4>";
                                    } else {
                                        $verified = "true";
                                        echo "<h2 style='color:green'>User Detail Varified. </h2>";
                                    }
                                    ?>

                                    <fieldset> 
                                        <div class="form-group" style="width:100%; float:left">

                                            <div class="controls controls-row">

                                                <div class="form-group">
                                                    <label class="control-label">Mobile Number
                                                    </label>
                                                    <!--<div class="controls">-->
                                                    <input class="form-control" style="text-transform:uppercase" name="mobile_number" id="" required type="text" value="<?php echo $userData["phone"] ?>" readonly="true"/>
                                                    <!--</div>-->
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">Full Name
                                                    </label>
                                                    <div class="controls">
                                                        <input class="form-control" name="first_name" id="" required type="text" value="<?php echo $userData["name"] ?>" />
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="control-label">Last Name
                                                    </label>
                                                    <div class="controls">
                                                        <input class="form-control" name="last_name" id="" required type="text" value="<?php echo $userData["lname"] ?>" />
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="control-label">Address 1
                                                    </label>
                                                    <div class="controls">
                                                        <input class="form-control" name="address1" id="txtZipCode" required type="text" value="<?php echo $userData["address"] ?>" />
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="control-label">Address 2
                                                    </label>
                                                    <div class="controls">
                                                        <input class="form-control" name="address2" id="txtZipCode" required type="text" value="<?php echo $userData["address2"] ?>" />
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="control-label">Pin Code
                                                    </label>
                                                    <div class="controls">
                                                        <input class="form-control" name="pin_code" id="txtState" required type="text"  value="<?php echo $userData["zip"] ?>"  />
                                                    </div>

                                                </div> 

                                                <div class="control-group">
                                                    <button type="submit" name="user_info" class="btn btn-primary">Submit
                                                    </button>
                                                    <input type="reset" class="btn" value="Reset" />   
                                                </div>
                                                </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                        </div>


                                        <?php
                                    } else if (isset($_REQUEST['verify'])) {
                                        if (isset($resjson->errors)) {
                                           
                                        } else if ($resjson->status == 2) {
                                           
                                        } else {
                                             echo "<script type='text/javascript'> document.location = 'profile_kyc.php?add_user=true'; </script>";
                                            exit;
                                        }
                                        ?>

                                        <div class="col-md-6">
                                            <div style="clear:both;height: 10px;"></div>
                                            <div class="box box-info">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Enter OTP
                                                    </h3>
                                                </div>
                                            </div>

                                            <div class="box-body padding" style="background:#FFFFFF; margin-top:-4%">
                                                <form action="controller/function.php" method="post" >
                                                    <?php if (isset($_SESSION["user_info"])) if ($_SESSION["user_info"]["status"] == "false") echo "<p style='color:red' class='false' >" . $_SESSION['user_info']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["user_info"])) if ($_SESSION["user_info"]["status"] == true) echo "<p id='response-msg' class='true' >" . $_SESSION['user_info']['msg'] . "</p>";unset($_SESSION["user_info"]); ?> 
                                                    <fieldset>


                                                        <div class="control-group">
                                                            <label class="control-label">OTP You receive on your register mobile number.
                                                            </label>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Enter OTP
                                                            </label>
                                                            <div class="controls">
                                                                <input class="form-control" name="otp" value="" required type="text"  id="txtName" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <button type="submit" name="otp_validate" class="btn btn-primary">Submit</button>
                                                            <input type="reset" class="btn" value="Reset">   
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>

                                    <?php } if (isset($_REQUEST['add_user'])) {
                                        ?>

                                        <div class="col-md-6">

                                            <div class="box-body padding" style="background:#FFFFFF; margin-top:-4%">
                                                <form action="controller/function.php" method="post" >
                                                    <?php if (isset($_SESSION["bankinfo"])) if ($_SESSION["bankinfo"]["status"] == "false") echo "<p style='color:red' class='false' >" . $_SESSION['bankinfo']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["bankinfo"])) if ($_SESSION["bankinfo"]["status"] == "true") echo "<p id='response-msg' class='true' >" . $_SESSION['bankinfo']['msg'] . "</p>";unset($_SESSION["bankinfo"]); ?> 
                                                    <?php
                                                    if ($bankmsg->message == "Success") {
                                                        echo "<h2 style='color:green'>Bank Detail Varified. </h2>";
                                                    } else {
                                                        echo "<h2 style='color:red'>Bank Detail Not Varified. </h2>";
                                                    }
                                                    ?>
                                                    <h2>Please verify your user detail.</h2>
                                                    <fieldset>
                                                        <div class="control-group">
                                                            <label class="control-label">Bank IFSC Code
                                                            </label>
                                                            <div class="controls">
                                                                <input class="form-control" name="bank_ifsc" value="<?php echo $userData["bank_ifsc"]; ?>" required type="text"  id="txtName" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">                                                    
                                                            <label class="control-label">Account Name
                                                            </label>
                                                            <div class="controls">
                                                                <input class="form-control" name="account_name" value="<?php echo $userData["account_name"]; ?>" required type="text"  id="txtName" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Account Number
                                                            </label>
                                                            <div class="controls">
                                                                <input class="form-control" name="account_number" value="<?php echo $userData["account_number"]; ?>" required type="text"  id="txtName"  />
                                                                <input type="hidden" name="userId" class="btn" value="<?php echo $userData["id"] ?>">  
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <button type="submit" name="account_bank" class="btn btn-primary"  >Submit
                                                            </button>
                                                            <input type="reset" class="btn" value="Reset">   
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Bank Beneficiary Detail
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="box-body padding tbl-ctnr" >
                                            <?php if (isset($_SESSION["bdelete"])) if ($_SESSION["bdelete"]["status"] == "false") echo "<p style='color:red' class='false' >" . $_SESSION['bdelete']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["bdelete"])) if ($_SESSION["bdelete"]["status"] == "true") echo "<p id='response-msg' class='true' >" . $_SESSION['bdelete']['msg'] . "</p>";unset($_SESSION["bdelete"]); ?> 
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                            <i class="fa fa-level-up user-profile-icon">
                                                            </i>Sr.
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-level-up user-profile-icon">
                                                            </i>Phone
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-level-up user-profile-icon">
                                                            </i>IFSC
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-user-circle-o user-profile-icon">
                                                            </i> Account Number
                                                        </th>

                                                        <th>
                                                            <i class="fa fa-user-circle-o user-profile-icon">
                                                            </i> Account Name
                                                        </th>

                                                        <th>
                                                            <i class="fa fa-retweet user-profile-icon">
                                                            </i> Beneficiary ID
                                                        </th>

                                                        <th>
                                                            <i class="fa fa-thumbs-up user-profile-icon">
                                                            </i> Status 
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-thumbs-up user-profile-icon">
                                                            </i> Withdraw 
                                                        </th>
                        <!--                                <th>
                                                            <i class="fa fa-thumbs-up user-profile-icon">
                                                            </i> Withdraw 
                                                        </th>-->
                                                    </tr>

                                                    <?php
                                                    $i = 0;
                                                    $query = "select * from bank_detial where userId='" . $userData['id'] . "'";
                                                    $res = mysqli_query($db, $query);
                                                    $prestatus = true;
                                                    $acived = 0;
//                               print_r($allbank);
                                                    $myArray = json_decode(json_encode($allbank), true);
                                                    foreach ($myArray as $udata) {
                                                        $i++;
                                                        ?>
                                                        <tr style="tr">
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $userData['phone']; ?></td>
                                                            <td><?php echo $udata['ifsc']; ?></td>
                                                            <td><?php echo $udata['account']; ?></td>
                                                            <td><?php echo $udata['recipient_name']; ?></td>
                                                            <td><?php echo $udata['beneficiary_id']; ?></td>
                                                            <td><a href="controller/function.php?bendel=<?php echo $udata['beneficiary_id']; ?>"><button class="btn-danger" >Delete</button></a></td>
                                                            <td><a href="withdraw.php"><button class="btn-info">Withdraw</button></a></td>

                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- /.row (main row) -->

                                    </div>
                                    </div>
                                    <!-- Middle Panel End -->
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    <!-- Content end -->

                                    <?php require 'footer.php'; ?>
                                    <script>
                                        jQuery(".nav-item").removeClass("active");
                                        jQuery("#nav21").addClass("active");
                                    </script>