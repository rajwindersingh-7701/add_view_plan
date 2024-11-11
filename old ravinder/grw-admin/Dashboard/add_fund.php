<?php
require_once("include/header.php");
require_once("../../database/db.php");
?>
<div class="main-container mt-152">
    <style>
        .irs-page-title-field {
            padding: 20px 0 !important;

        }
        .loginarea {
            background: #ffffff;
            color: #fff !important;
            border-radius: 10px;
            padding: 20px;
            border: 3px #1b1b1b dotted;
        }
    </style>

    <div class="page-header">
        <div class="pull-left">
            <h2>Send Fund In E-wallet</h2>
        </div>

        <div class="clearfix"></div>
    </div>
    <div class="row-fluid">


        <div class="row-fluid">

            <div class="span6">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">Enter user id and amount for sending </div>
                    </div>
                    <div class="widget-body">
                        <div class="form-horizontal no-margin">
                            <form action="controller/function.php" method="post" onsubnit='Are You sure!'>
                                <?php if (isset($_SESSION["send"])) if ($_SESSION["send"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['send']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["send"])) if ($_SESSION["send"]["status"] == 'true') echo "<p id='response-msg' class='true' >" . $_SESSION['send']['msg'] . "</p>";unset($_SESSION["send"]); ?> 
                                <fieldset>
                                    <div class="control-group">

                                        <div class="controls">
                                            <!--<h4>Minimum amount for transfer $10</h4>-->
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">User id </label>
                                        <div class="controls">
                                            <input class="span12 password" id='uids' name="userIds" onChange="checkSponsor()" onFocus="checkSponsor()"  type="text" required>
                                           <p id='usernamechk'></p>
                                        </div>
                                     
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Amount </label>
                                        <div class="controls">
                                            <input class="span12 password" name="amount" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-actions no-margin">
                                        <button  type="submit" name="transfer-money" class="btn btn-primary loginpassword">Transfer</button>
                                        <button type="reset" class="btn">Cancel</button>
                                    </div>
                                </fieldset>

                            </form>

                        </div>
                    </div>
                </div>
            </div>



        </div>


    </div>





</div>
</div>
<!-- dashboard-container -->
</div>
<!-- container-fluid -->


<!-- Custom Js -->


<script>
    function checkSponsor() {
        var uname = document.getElementById("uids").value;console.log(uname);
        var params = "user_id=" + uname;
        var url = "controller/function.php?checksp=sponser";
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'html',
            data: params,
            beforeSend: function () {
                document.getElementById("usernamechk").innerHTML = 'checking';
                $('#pay_sponsor').val(uname);
            },
            complete: function () {

            },
            success: function (html) {

                document.getElementById("usernamechk").innerHTML = html;
                $('#pay_sponsor').val(uname);
            }
        });
    }
</script>
<!--Start of Tawk.to Script-->

<?php 
include 'footer.php';
?>
