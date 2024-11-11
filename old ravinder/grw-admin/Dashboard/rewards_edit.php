<?php
    require_once("include/header.php");
    require_once("../../database/db.php");
    
    $rewardsadmin = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM  `rewards` where id='".$_GET['uid']."'"));
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
            <h2>Rewards Edit </h2>
        </div>

        <div class="clearfix"></div>
    </div>
    <div class="row-fluid">


        <div class="row-fluid">

            <div class="span6">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">Rewards Edit .</div>
                    </div>
                    <div class="widget-body">
                        <div class="form-horizontal no-margin">
                            <form action="controller/function.php" method="post" onsubnit='Are You sure!'>
                                <?php if (isset($_SESSION["send"])) if ($_SESSION["send"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['send']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["send"])) if ($_SESSION["send"]["status"] == 'true') echo "<p id='response-msg' class='true' >" . $_SESSION['send']['msg'] . "</p>";unset($_SESSION["send"]); ?> 
                                <fieldset>
                                    <div class="control-group">
                                        <label class="control-label">Reward </label>
                                        <div class="controls">
                                            <input class="span12 password" name="reward" type="text" value='<?php echo $rewardsadmin['reward']; ?>' required>
                                            <input name="rid" type="hidden" value='<?php echo $rewardsadmin['id']; ?>'>
                                        </div>
                                    </div>
                                    <div class="form-actions no-margin">
                                        <button  type="submit" name="rewarda-edit" class="btn btn-primary loginpassword">Transfer</button>
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
