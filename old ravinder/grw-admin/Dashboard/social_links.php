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
        .control-group {
            margin-bottom: 8px;
        }
        
        .form-horizontal {
            margin:auto;
            padding:20px;
        }
    </style>

    <div class="page-header">
        <div class="pull-left">
            <h2>Social Links </h2>
        </div>

        <div class="clearfix"></div>
    </div>
    <div class="row-fluid">
        <div class="span6">
            <div class="widget">
                <!--                    <div class="widget-header">
                                        <div class="title">Deduct Money .</div>
                                    </div>-->
                <div class="widget-body">
                    <div class="form-horizontal no-margin">
                        <form action="controller/function.php" method="post" onsubnit='Are You sure!'>
                            <?php if (isset($_SESSION["send"])) if ($_SESSION["send"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['send']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["send"])) if ($_SESSION["send"]["status"] == 'true') echo "<p id='response-msg' class='true' >" . $_SESSION['send']['msg'] . "</p>";unset($_SESSION["send"]); ?>
                            <?php
                            $userQuery = mysqli_query($db, "SELECT * FROM  `social_links`");
                            $qresult = mysqli_fetch_assoc($userQuery);
                            $temp_data=array("facebook"=>"", "twitter"=>"", "telegram"=>"", "linkedin"=>"", "whatsapp"=>"", );
                            if (count($qresult) > 0) {
                                $temp_data=$qresult;
                            }
                            ?>
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label">Facebook </label>
                                    <div class="controls">
                                        <input class="span12" name="facebook" type="url" value="<?php echo $temp_data['facebook']; ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Twitter </label>
                                    <div class="controls">
                                        <input class="span12" name="twitter" type="url" value="<?php echo $temp_data['twitter']; ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Telegram </label>
                                    <div class="controls">
                                        <input class="span12" name="telegram" type="url" value="<?php echo $temp_data['telegram']; ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Linkedin </label>
                                    <div class="controls">
                                        <input class="span12" name="linkedin" type="url" value="<?php echo $temp_data['linkedin']; ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Whatsapp </label>
                                    <div class="controls">
                                        <input class="span12" name="whatsapp" type="url" value="<?php echo $temp_data['whatsapp']; ?>">
                                    </div>
                                </div>
                                <br/>
                                <div class="form-actions no-margin">
                                    <button  type="submit" name="social-link-save" class="btn btn-primary">Save Data</button>
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
<!-- dashboard-container -->
</div>
<!-- container-fluid -->


<!-- Custom Js -->


<script>
    function checkSponsor() {
        var uname = document.getElementById("uids").value;
        console.log(uname);
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