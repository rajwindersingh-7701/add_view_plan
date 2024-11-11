<?php
require_once("include/header.php");
require_once("../../database/db.php");
$radom = rand(1000000000, 10000000000);
$_SESSION['random'] = $radom;
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
            <h2>Add Fund </h2>
        </div>

        <div class="clearfix"></div>
    </div>
    <div class="row-fluid">


        <div class="row-fluid">

            <div class="span6">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">Leave add for link .</div>
                    </div>
                    <div class="widget-body">
                        <div class="form-horizontal no-margin">
                            <form action="controller/function.php" method="post" onsubnit='Are You sure!'>
                                <?php if (isset($_SESSION["send"])) if ($_SESSION["send"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['send']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["send"])) if ($_SESSION["send"]["status"] == 'true') echo "<p id='response-msg' class='true' >" . $_SESSION['send']['msg'] . "</p>";unset($_SESSION["send"]); ?> 
                                <fieldset>

                                    <?php
                                    $withdrawon = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `meta` WHERE type='withdraw'"));
                                    if ($withdrawon == 0) {
                                        echo '<p>Current status on</p>';
                                        ?>
                                        <p>Add Message here</p>
                                        <textarea name='msg'></textarea>
                                        
                                        <button  type="submit" name="withon" class="btn btn-danger loginpassword">Withdraw Off</button>

                                        <?php
                                    } else {
                                        echo '<p>Current status off</p>';
                                        ?>
                                        <p>Add Message here</p>
                                        <textarea name='msg'></textarea>
                                        <select name="w_type">
                                            <option value="manual">Manual</option>
                                            <option value="imps">Imps</option>
                                        </select>
                                        <button  type="submit" name="withoff" class="btn btn-primary loginpassword">Withdraw on</button>

                                    <?php } ?>

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

<!--Start of Tawk.to Script-->

<!--End of Tawk.to Script-->
</body> 
</html>
