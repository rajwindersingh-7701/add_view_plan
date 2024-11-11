<?php
require_once("../../database/db.php");
$userData = $_GET["uid"];
$query = mysqli_query($db, "SELECT * FROM `user` WHERE id='$userData'");
if (mysqli_num_rows($query) < 1) {

    // header("location:Users.php");exit;
}

require_once("include/header.php");
$userData = mysqli_fetch_array($query);
?>
<div class="main-container mt-152">


    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Profile</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                     <form action="controller/function.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <center class="m-t-30"> 
                            <img src="../../Dashboard/<?php echo $userData["picture"]; ?>" onerror="this.src='assets/img/dummy.jpg';"  alt="300x200" id="ProfileImg"  class="img-circle" width="150" />
                            <h4 class="card-title m-t-10"><?php echo $userData["name"]; ?></h4>


                        </center>
                       
                            <input type="hidden" name="pimage" value="<?php if (isset($userData['id'])) echo $userData['id']; ?>">
                            <input id="fileToUpload" name="fileToUpload" accept="image/*" type="file" class="input-file" onchange="this.form.submit()" style="text-align: center; margin: 0px auto;" />
                       
                    </div>

                    <div class="card-body">
                        
                        <small class="text-muted">Email address </small>
                        <h6><?php echo $userData["email"]; ?></h6> 
                        <small class="text-muted p-t-30 db">Phone</small>
                        <h6><?php echo $userData["phone"]; ?></h6> 
                        <small class="text-muted p-t-30 db">Address</small>
                        <h6><?php echo $userData["address"] ?></h6>
                        <small class="text-muted p-t-30 db">Social Profile</small>
                        <br>
                        <button class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fa fa-twitter"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fa fa-youtube"></i></button>
                       
                    </div>
                            </form>
                </div>
            </div>
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-selected="true">Personal Details</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Enable user</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab" aria-selected="false">Account Detail</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings-2" role="tab" aria-selected="false">Export</a> </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <div class="card-body">

                                <form action="controller/function.php" method="post" >
                                    <?php //if(isset($_GET["master_key"])) echo "<div class='flse_msg'>Master Key Eror!</div>";  ?>
                                    <fieldset>
                                        <div class="control-group">
                                            <label class="control-label">Name</label>
                                            <div class="controls">
                                                <input class="form-control form-control-line" name="name" value="<?php echo $userData["name"]; ?>" required type="text"  id="txtName" />
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">User Id</label>
                                            <div class="controls">
                                                <input class="form-control form-control-line" value="<?php echo $userData["user_id"]; ?>" readonly type="text"  id="txtName" />
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Password</label>
                                            <div class="controls">
                                                <input class="form-control form-control-line" name="password" value="<?php echo $userData["password"]; ?>" required type="text"  id="txtName" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Father / Husband Name</label>
                                            <div class="controls">
                                                <input class="form-control form-control-line" name="fname" value="<?php echo $userData["father_name"]; ?>" required type="text"  id="txtName" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Email ID </label>
                                            <div class="controls">
                                                <input class="form-control form-control-line" name="email"  value="<?php echo $userData["email"]; ?>" required type="email" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Mobile No.</label>
                                            <div class="controls">
                                                <input class="form-control form-control-line" name="phone"  id="txtMobileNo" value="<?php echo $userData["phone"]; ?>" required type="tel"  />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="DateofBirthMonth">Date of birth </label>
                                            <div class="controls controls-row">
                                                <input class="form-control form-control-line" name="dob"  id="txtMobileNo" value="<?php echo $userData["dob"]; ?>" required type="tel"  />
                                                <input name="userId"  id="txtMobileNo" value="<?php echo $userData["id"]; ?>" required type="hidden"  />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Address </label>
                                            <div class="controls">
                                                <textarea id="txtAddress" name="address" class="input-block-level no-margin form-control form-control-line"><?php echo $userData["address"] ?></textarea>
                                            </div>
                                        </div>





                                        <div class="form-actions no-margin">

                                            <button type="submit" name="account1" class="btn btn-primary">Submit</button>
                                            <input type="reset" class="btn" value="Reset" />   
                                        </div>
                                    </fieldset>



                                </form>


                            </div>
                        </div>
                        <!--second tab-->
                        <div class="tab-pane" id="profile" role="tabpanel">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="title">User Status </div>
                                        <br>
                                    </div>

                                    <div class="widget-body">
                                        <div class="form-horizontal no-margin">
                                            <form action="controller/function.php" method="post" >
                                                <?php //if(isset($_GET["master_key"])) echo "<div class='flse_msg'>Master Key Eror!</div>";   ?>
                                                <fieldset>
                                                    <input type="hidden" name="userId" class="btn" value="<?php echo $userData["id"] ?>">  

                                                    <?php
                                                    if ($userData['enable'] == "0") {
                                                        ?>
                                                        <div class="form-actions no-margin">

                                                            <input type="submit" name="user_status" class="btn btn-primary" value="Unblock">

                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="form-actions no-margin">

                                                            <input type="submit" name="user_status" class="btn btn-primary" value="Block">

                                                        </div>
                                                    <?php } ?>
                                                </fieldset>



                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="settings" role="tabpanel">
                            <div class="card-body">
                              


                                        <form action="controller/function.php" method="post">
                                            <fieldset>
                                                <div class="control-group">
                                                    <label class="control-label">Bank Name</label>
                                                    <div class="controls">
                                                        <input class="span12" name="bank_name" value="<?php echo $userData["bank_name"] ?>"  type="text" id="txtName">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Bank IFSC Code</label>
                                                    <div class="controls">
                                                        <input class="span12" name="bank_ifsc" value="<?php echo $userData["bank_ifsc"] ?>"  type="text" id="txtName">
                                                    </div>
                                                </div>
                                                <div class="control-group">                                                    
                                                    <label class="control-label">Account Name</label>
                                                    <div class="controls">
                                                        <input class="span12" name="account_name" value="<?php echo $userData["account_name"] ?>"  type="text" id="txtName">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Account Number</label>
                                                    <div class="controls">
                                                        <input class="span12" name="account_number" value="<?php echo $userData["account_number"] ?>"  type="text" id="txtName">
                                                        <input type="hidden" name="uid" class="btn" value="<?php echo $_GET["uid"] ?>">  
                                                    </div>
                                                </div>
<!--                                                <div class="control-group">
                                                    <label class="control-label">Phone Pay/Google Pay/Paytm Any one</label>
                                                    <div class="controls">
                                                        <input class="span12" name="pay_number" value="<?php echo $userData["pay_number"] ?>"  type="text" id="txtName">
                                                    </div>
                                                </div>-->
                                                <div class="form-actions no-margin">

                                                    <button type="submit" name="account_bank" class="btn btn-primary">Submit</button>
                                                    <input type="reset" class="btn" value="Reset">   
                                                </div>

                                            </fieldset>



                                        </form>


                                    </fieldset>
                             
                            </div>
                        </div>



                        <div class="tab-pane" id="settings-2" role="tabpanel">
                            <div class="card-body">
                                 <fieldset>  
                                                    <div class="form-actions no-margin">
                                                       <a  href="export_downline.php?uid=<?php echo $userData["user_id"]; ?>" class="btn btn-warning " data-original-title=""><i class="fa fa-check-square-o" aria-hidden="true"></i> Export Downline</a>  
                                                    </div>
                                            </fieldset> 
                            </div>
                        </div>
                    </div>
                </div>


            </div>




        </div>


    </div>



    <!--
                    </form>-->


</div>



<!-- Custom Js -->
<script type="text/javascript">
    $("#wizard").bwizard();
    DisplayBalance();
    CheckSession();
    CheckInvoice();
</script>


<!-- jQuery Form Validation code -->
<script>

    // When the browser is ready...
    $(function () {
        // Setup form validation on the #register-form element
        $("#password").validate({
            // Specify the validation rules
            rules: {
                password: {
                    required: true
                },
                npassword: {
                    minlength: 5
                },
                rnpassword: {
                    equalTo: "#password_new"
                }
            },
            // Specify the validation error messages
            messages: {
                password: {
                    required: "Please enter old password"
                },
                npassword: {
                    minlength: "Password minimum length 5 digit"
                },
                rnpassword: {
                    rnpassword: "Confirm password incorrect"
                }
            },
            submitHandler: function (form) {

                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function (response) {
                        $("#response-msg").empty();
                        $("#response-msg").removeClass("false");

                        var myJSON = JSON.parse(response);
                        var msg = myJSON.msg;
                        var status = myJSON.status;

                        if (status == "false") {
                            $("#response-msg").append(msg);
                            $("#response-msg").addClass("false");
                        } else if (status == "true") {

                            $("#response-msg").append(msg);
                            $("#response-msg").addClass("true");


                        }
                    }
                });
                //  form.submit();
            }
        });

    });

</script>
<script>

    // When the browser is ready...
    $(function () {
        // Setup form validation on the #register-form element
        $("#mater_key").validate({
            // Specify the validation rules
            rules: {
                password: {
                    required: true
                },
                npassword: {
                    minlength: 5
                },
                rnpassword: {
                    equalTo: "#password_new"
                }
            },
            // Specify the validation error messages
            messages: {
                password: {
                    required: "Please enter old password"
                },
                npassword: {
                    minlength: "Password minimum length 5 digit"
                },
                rnpassword: {
                    rnpassword: "Confirm password incorrect"
                }
            },
            submitHandler: function (form) {

                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function (response) {
                        $("#response-msg1").empty();
                        $("#response-msg1").removeClass("false");

                        var myJSON = JSON.parse(response);
                        var msg = myJSON.msg;
                        var status = myJSON.status;

                        if (status == "false") {
                            $("#response-msg1").append(msg);
                            $("#response-msg1").addClass("false");
                        } else if (status == "true") {

                            $("#response-msg1").append(msg);
                            $("#response-msg1").addClass("true");


                        }
                    }
                });
                //  form.submit();
            }
        });

    });

</script>
<script>

    // When the browser is ready...
    $(function () {
        // Setup form validation on the #register-form element
        $("#bitcoin").validate({
            // Specify the validation rules
            rules: {
                bitcoin: {
                    required: true
                },
                master_key: {
                    required: true
                }
            },
            // Specify the validation error messages
            messages: {
                bitcoin: {
                    required: "Please enter bitcoin detail"
                },
                master_key: {
                    required: "Please enter master key"
                }
            },
            submitHandler: function (form) {

                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function (response) {
                        $("#response-msg-bitcoin").empty();
                        $("#response-msg-bitcoin").removeClass("false");

                        var myJSON = JSON.parse(response);
                        var msg = myJSON.msg;
                        var status = myJSON.status;

                        if (status == "false") {
                            $("#response-msg-bitcoin").append(msg);
                            $("#response-msg-bitcoin").addClass("false");
                        } else if (status == "true") {
                            $("#response-msg-bitcoin").append(msg);
                            $("#response-msg-bitcoin").addClass("true");


                        }
                    }
                });
                //  form.submit();
            }
        });

    });

</script>
<?php
include 'footer.php';
?>