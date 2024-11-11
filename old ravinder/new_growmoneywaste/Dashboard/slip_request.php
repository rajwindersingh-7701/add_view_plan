<?php
require_once("header.php");
if (isset($_POST['insertdata'])) {

    $checkData = mysqli_query($db, "SELECT * FROM `payment_invest` WHERE chequeNo='" . $_POST['chequeNo'] . "'");
    $check = mysqli_fetch_array($checkData);
    if (!empty($check)) {
        $_SESSION["invest"] = array("msg" => "UTR No Already Exists.", "status" => "false");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }

    $amount = mysqli_real_escape_string($db, $_POST['amount']);
    if ($_POST['amount'] == '') {
        $_SESSION["invest"] = array("msg" => "Please enter valid amount.", "status" => "false");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    if ($_POST['amount'] < 10) {
        $_SESSION["invest"] = array("msg" => "Please submit minimum $10 request.", "status" => "false");
        echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
        exit;
    }
    $file = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    $file1 = time() . $file;
    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    if (move_uploaded_file($temp, "uploads/$file1")) {
        if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif') {
            $sql = "INSERT INTO `payment_invest`(`user_id`,`payType`, `companyBankNam`, `amount`, `chequeNo`, `chequeOfBankNam`, `chequeDate`, `Slip`, `descriptions`) VALUES ('" . $userData['user_id'] . "','" . $_POST['tdradio'] . "','" . $_POST['companyBankName'] . "','" . $_POST['amount'] . "','" . $_POST['chequeNo'] . "','" . $_POST['bankname'] . "','" . $_POST['date'] . "','$file1','" . $_POST['descriptions'] . "')";
            //			echo $sql;die;
            mysqli_query($db, $sql);
            $_SESSION["invest"] = array("msg" => "Your request successfully submitted.", "status" => "true");
        } else {
            $_SESSION["invest"] = array("msg" => "File is not image", "status" => "false");
        }
        //			echo "done";	
    } else {
        $_SESSION["invest"] = array("msg" => "Slip upload error.", "status" => "false");
    }
}
?>
<!-- Profile bar -->
<!-- End Profile bar -->

<!-- Middle Panel -->
<div class="col-lg-9 profile-area">
    <h3 class="admin-heading bg-offwhite">
        <a href="slip_request_detail.php" class="btn-link"><i class="fas fa-edit mr-1"></i>View Detail</a>
        <p>Request for E-wallet</p>
        <span>Transfer Amount and submit this form with detail.</span>
    </h3>
    <!-- Edit personal info  -->
    <div id="edit-personal-details" style="display: block" class="accord bg-offwhite shadow">
        <div class="content-edit-area">
            <div class="edit-header">
                <h5 class="title">Activate Package</h5>
                <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="row">

                <div class="col-lg-12 profile-area">
                    <div class="edit-content">
                        <form id="personaldetails" action="" method="post" enctype="multipart/form-data">
                            <?php if (isset($_SESSION["invest"])) if ($_SESSION["invest"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['invest']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["invest"])) if ($_SESSION["invest"]["status"] == 'true') echo "<p id='response-msg' class='true' >" . $_SESSION['invest']['msg'] . "</p>";
                                                                                                                                                                                                        unset($_SESSION["invest"]); ?>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <?php
                                            $check = 'SELECT * FROM kyc_qr ORDER BY id DESC LIMIT 1';
                                            $result = $db->query($check);

                                            // output data of each row
                                            while ($row = $result->fetch_assoc()) {

                                            ?>
                                                <div class="form-group" id="CompanyBankName">
                                                    <span class="control-label  col-lg-3">Scan upi qr code and pay </span>

                                                    <!-- <img src='ing1.jpeg'> -->
                                                    <img src="../grw-admin/uploads/<?php echo $row['qr_code'] ?>" alt="QR">
                                                    <input type="text" class="form-control" value="<?php echo $row['upi'] ?>" id="myInput">
                                                    <button class='btn btn-default' onclick="myFunction()">Copy UPI ID</button>

                                                    <script>
                                                        function myFunction() {
                                                            // Get the text field
                                                            var copyText = document.getElementById("myInput");

                                                            // Select the text field
                                                            copyText.select();
                                                            copyText.setSelectionRange(0, 99999); // For mobile devices

                                                            // Copy the text inside the text field
                                                            navigator.clipboard.writeText(copyText.value);

                                                            // Alert the copied text
                                                            alert("Copied the text: " + copyText.value);
                                                        }
                                                    </script>

                                                <?php } ?>
                                                </div>
                                                <div class="form-group" id="CompanyBankName">
                                                    <span class="control-label  col-lg-3">Transfer Type :</span>
                                                    <div class="col-lg-12">
                                                        <select name="companyBankName" class="custom-select" required="true">
                                                            <option selected="selected" value="">-- Select --</option>
                                                            <option value="Bank">Bank Transfer</option>
                                                            <option value="Paytm">Paytm</option>
                                                            <option value="Phonepay">Phonepay</option>
                                                            <option value="GooglePay">GooglePay</option>
                                                            <option value="other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <span class="control-label  col-lg-3">Amount:</span>
                                                    <div class="col-lg-12">
                                                        <input name="amount" type="number" id="amount" class="form-control" autocomplete="off" required="true">
                                                    </div>
                                                </div>
                                                <div class="form-group" id="chequeNo">
                                                    <span class="control-label  col-lg-3">UTR Id:</span>
                                                    <div class="col-lg-12">
                                                        <input name="chequeNo" type="text" id="chequeNo" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group" id="chequeDate">
                                                    <span class="control-label  col-lg-3">Payment Date:</span>
                                                    <div class="col-lg-12">
                                                        <input name="date" type="date" maxlength="10" id="date" title="Input in format : DD/MM/YYYY" class="form-control padr" required="true">
                                                    </div>
                                                </div>
                                                <div id="" class="form-group">
                                                    <span class="control-label  col-lg-3">Slip/Receipt:</span>
                                                    <div class="col-lg-12">

                                                        <input type="file" name="file" id="file" accept=".jpg,.jpeg,.png,.gif" required="true"><br><b>File size must be less than or equal to 2 MB </b>
                                                        <script>
                                                            $('#file').bind('change', function() {
                                                                if (this.files[0].size > 2097152) {
                                                                    $(this).val('');
                                                                    alert("Max allowed file size is 2 MB");
                                                                }

                                                            });
                                                        </script>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <span class="control-label  col-lg-3">Descriptions(optional):</span>
                                                    <div class="col-lg-12">
                                                        <textarea name="descriptions" id="descriptions" class="form-control" style="height:50px;" required="false"></textarea><span id="" class="errText" style="display:none;">Value is mandatory</span>

                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                    <div class="btn-link float-left mb-3">
                                        <button class=" btn btn-default" type="submit" name='insertdata'><i class="far fa-save"></i> Request For E-wallet</button>
                                    </div>
                                    <a class="btn-link float-right mb-3" href="slip_request_detail.php"><span class="text-3 mr-1"><i class="fas fa-plus-circle"></i></span>Request Detail</a>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>

                <div class="col-lg-6 profile-area">
                    <div class="col-12 col-sm-12 col-lg-12 cardBox">

                    </div>
                </div>
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

<!-- Call to action section end -->

<?php require 'footer.php'; ?>
<script>
    jQuery(".nav-item").removeClass("active");
    jQuery("#nav7").addClass("active");
</script>
<script>
    jQuery(".sub-menu-drop3").show();
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