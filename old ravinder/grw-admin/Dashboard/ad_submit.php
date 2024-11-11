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
            <h2>Ad Insert</h2>
        </div>

        <div class="clearfix"></div>
    </div>
    <div class="row-fluid">


        <div class="row-fluid">

            <div class="span6">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">Ad Your ad for user</div>
                    </div>
                    <div class="widget-body">
                        <div class="form-horizontal no-margin">
                            <form action="controller/submit.php" method="post" enctype="multipart/form-data" id="form">
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <h4></h4>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label"><input type="radio" name="radio_link" value="Disable" id="disable" checked></label>
                                        <div class="controls">
                                            Choose Image:-
                                            <input type="file" name="file" id="file">
                                            
                                        </div>
                                        <div class="controls">
                                            Enter Link:-
                                            <input type="url" class="span12" name="mlink" id="text-box">

                                        </div>
                                    </div>  
                                    <div class="control-group">
                                        <label class="control-label"><input type="radio" name="radio_link" value="Enable" id="enable" ></label>
                                        <div class="controls">
                                            <input type="url" class="span12" name="link" id="text-box">
                                        </div>
                                    </div>       
                                    <br>
                                    Enter open link 
                                    <div class="control-group">
                                        <label class="control-label"><input type="radio" name="radio_link" value="button" id="enable" ></label>
                                        <div class="controls">
                                            <input type="url" class="span12" name="button" id="text-box">
                                        </div>
                                    </div>                                                  
                                     <div class="control-group">
                                        <button  type="submit" name="googleAdd" class="btn btn-primary loginpassword">Submit</button>
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
