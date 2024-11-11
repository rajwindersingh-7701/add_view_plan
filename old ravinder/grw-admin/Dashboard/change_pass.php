<?php
require_once("../../database/db.php");
require_once("include/header.php");


?>
<div class="main-container">
    <style>.irs-page-title-field {
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
            <h2>Password Manager</h2>
        </div>

        <div class="clearfix"></div>
    </div>

    <?php
    if (isset($_SESSION['type'])) {
        if ($_SESSION['type'] == true) {
            echo "<h3><font color='green'>" . $_SESSION['msg'] . "</font></h3>";
        } else {
            echo "<h3><font color='red'>" . $_SESSION['msg'] . "</font></h3>";
        }
    } unset($_SESSION['msg']);
    unset($_SESSION['type']);
    ?>


    <div class="page-header">



        <div class="clearfix"></div>
    </div>
    <div class="row-fluid">
        <div class="row-fluid">
            <div class="span6" style="float:none; margin: 0 auto;">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">Change password</div>
                    </div>
                    <div class="widget-body">
                        <div class="form-horizontal no-margin">
                            <form id="product" action="controller/function.php" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" >
                                <div class="control-group">
                                    <fieldset>

                                        <div class="control-group">
                                            <label class="control-label" >Current Password*</label>
                                            <div class="col-md-6">     
                                                <input type="text"  name="current_pass"   class="form-control"  required>

                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">New Password*</label>
                                            <div class="col-md-6">
                                                <input type="text"  name="new_pass" class="form-control"  required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="col-md-3 control-label" for="inputReadOnly"></label>
                                            <div class="col-md-6">
                                                <button type="submit" name="change_pass" class="mb-xs mt-xs mr-xs btn btn-primary">Submit</button>
                                            </div>
                                        </div>


                                        </form>

                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>
</div>
</body>
</html>