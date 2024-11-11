<?php
require_once("include/header.php");
require_once("../../database/db.php");
if (isset($_POST['insertdata'])) {

    $checkData = mysqli_query($db, "SELECT * FROM `kyc_qr` WHERE id!= 0");
    $check = mysqli_fetch_array($checkData);
    $file = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    $file1 = time() . $file;
    print_r($file1);
    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    if (move_uploaded_file($temp, "../uploads/$file1")) {
        if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif') {
            $sql = "INSERT INTO `kyc_qr`(`upi`,`qr_code`) VALUES ('" . $_POST['upi'] . "','$file1')";
            //			echo $sql;die;
            mysqli_query($db, $sql);
            $_SESSION["invest"] = array("msg" => "Qr successfully Uploaded.", "status" => "true");
        } else {
            $_SESSION["invest"] = array("msg" => "File is not image", "status" => "false");
        }
        //			echo "done";	
    } else {
        $_SESSION["invest"] = array("msg" => "Qr upload error.", "status" => "false");
    }
}
?>
<!-- Profile bar -->
<!-- End Profile bar -->

<div class="main-container  mt-152">
    <div class="page-header">
        <div class="pull-left">
            <h2>QR AND UPI</h2>
        </div>
        <div class="clearfix"></div>
    </div>

    <style>
        .orangebuttion {
            background: #ff9800;
            padding: 10px 20px;
            color: #FFF;
            border: none;
            cursor: pointer;
        }

        ul.pagination li {

            padding: 5px 10px;
            background: #0e9048;

            margin-right: 3px;

            cursor: pointer;

            color: #FFF;

            font-size: 16px;



        }

        ul.pagination li a {

            color: #FFF;
        }

        .pull-left {
            float: left;
            width: 100%;
        }
    </style>

    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="page-header">
                    <div class="pull-left">
                        <div class="widget-header">
                            <div class="title">
                                
                            </div>
                        </div>

                        <div class="widget-body">
                            <!-- Edit personal info  -->
                            <div id="edit-personal-details" style="display: block" class="accord bg-offwhite shadow">
                                <div class="content-edit-area">
                                    <div class="edit-header">
                                        <!-- <h5 class="title">UPI Details</h5> -->
                                        <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="row">

                                        <div class="col-lg-12 profile-area">
                                            <div class="edit-content">
                                                <form id="" action="" method="POST" enctype="multipart/form-data">
                                                    <?php if (isset($_SESSION["invest"])) if ($_SESSION["invest"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['invest']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["invest"])) if ($_SESSION["invest"]["status"] == 'true') echo "<p id='response-msg' class='true' >" . $_SESSION['invest']['msg'] . "</p>";
                                                                                                                                                                                                                                unset($_SESSION["invest"]);
                                                                                                                                                                                                                                ?>
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <span class="control-label  col-lg-3">UPI </span>
                                                                        <div class="controls">
                                                                            <input type="text" class="span12 form-control" placeholder="Enter UPI" name="upi" type="text">
                                                                        </div>
                                                                    </div>
                                                                    <div id="" class="form-group">
                                                                        <span class="control-label  col-lg-3">Qr Code </span>
                                                                        <div class="col-lg-12">

                                                                            <input class="form-control" type="file" name="file" id="file" accept=".jpg,.jpeg,.png,.gif" required="true"><br><b>File size must be less than or equal to 2 MB </b>
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

                                                                </div>
                                                            </div>
                                                            <div class="btn-link float-left mb-3">
                                                                <button class=" btn btn-success" type="submit" name='insertdata'> Upload Qr Code</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
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