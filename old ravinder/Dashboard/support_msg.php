<?php
require_once 'header.php';
if (empty($_GET["spi"])) {
    echo "<script type='text/javascript'> javascript:history.go(-1) </script>";
    exit;
}
$u_id = $userData["user_id"];
$spid = mysqli_real_escape_string($db, $_GET["spi"]);
$query = mysqli_query($db, "SELECT * FROM `support` WHERE `id`='$spid' and status='pending' ");
$data_support = mysqli_fetch_assoc($query);
?>
<style>


    .container1 {



        border: 2px solid #dedede;

        background-color: #f1f1f1;

        border-radius: 5px;

        padding: 10px;

        margin: 10px 0;

    }

    .time-right {
        float: right;

    }

    .time-left {
        float: left;

    }
    .right_a{ width: 55%;
              border: none;
              float:right;
              text-align: left;

    }
    .left_a{
        width: 55%;
        border: none;
        float:left;
        text-align: left;
    }
    .darker1{

        border-color: #ccc;

        background-color: #ddd;

    }



    .container1::after {

        content: "";

        clear: both;

        display: table;

    }

    p.time-right {
        color: blue;
    }
    p.time-left {
        color: blue;
    }
    .container1.darker1 {
        color: #000;
    }

</style>
<!-- Middle Panel -->
<div class="col-lg-9 profile-area">
    <!-- Edit personal info End -->
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border"><h3 class="box-title"><strong>Topic:- <?php echo $data_support['topic']; ?></strong></h3></div>
            <!--                    <button class="btn_checkstatus" style="float:right;">Resolved</button>-->
        </div>
        <div class="box-body padding" style="background:#FFFFFF; margin-top:-2%">
            <?php if ($data_support['status'] == "pending") { ?>
                <div class="main-container">
                    <center> <h2>Chat Messages</h2></center>
                    <div>
                        <form class="typind" style="">
                            <div class="form-group">
                                <textarea  type="text"class="mytext" style="width:80%; height: 67px; border-radius:10px; "></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-default" type="button" >Sent Message</button>
                                <a href="support.php"> <button class="btn btn-default" type="button">Back To Support</button></a>
                            </div>
                        </form>
                    </div>

                    <div id="chat">


                    </div>

                </div>
            <?php } else { ?>
                <div>
                    <center> <p style="font-size: 33px; font-style: oblique;">No More Chat Your Status is Resolved </p> </center>
                </div>
            <?php } ?>
        </div>
    </div>

</div>
<!-- Middle Panel End -->
</div>
</div>
</div>
<!-- Content end -->

<?php require 'footer.php'; ?>
<script>
    jQuery(".nav-item").removeClass("active");
    jQuery("#nav4").addClass("active");
</script>

<script>
//    alert('fsdafs');
    $(document).ready(function () {

        $.ajax({
            type: "POST",
            url: "controller/user_msgcontroller.php",
            data: "type=u_lod&user_id=<?php echo $u_id; ?>&spid=<?php echo $spid; ?>",
            success: function (result) {
                var obj = $.parseJSON(result);
                console.log(obj);
                for (i = 0; i < obj.length; i++) {
                    if (obj[i]['sender'] == "admin") {
                        $("#chat").append("<div class='container1 darker1 left_a'><div style='width:100%;'><div>" + obj[i]['sender'] + "</div><div>" + obj[i]['datetime'] + "</div></div><p class='time-left'>" + obj[i]['msg'] + "</p></div>");
                    } else {
                        $("#chat").append("<div class='container1 darker1 right_a'><div style='width:100%;'><div>" + obj[i]['sender'] + obj[0]['user_id'] + "</div><div>" + obj[i]['datetime'] + "</div></div><p class='time-right'>" + obj[i]['msg'] + "</p></div>");
                    }
                }
            }
        });
        $(".button").click(function () {
            console.log('fsd');
            var msg = $(".mytext").val();
            $.ajax({
                type: "POST",
                url: "controller/user_msgcontroller.php",
                data: "type=u_submit&msg=" + msg + "&user_id=<?php echo $u_id; ?>&spid=<?php echo $spid; ?>",
                success: function (result) {
                    // console.log(result);
                    var obj = $.parseJSON(result);
                    console.log(obj);
                    if (obj["status"] == 1) {

                        $("#chat").prepend("<div class='container1 darker1 right_a'><div><div>" + obj[0]['sender'] + "</div><div>" + obj[0]['datetime'] + "</div></div><p  class='time-right'>" + obj[0]['msg'] + "</p></div>");
                        $(".mytext").val("");
                    } else {
                        console.log(result);
                    }

                },
                fail: function (result) {
                    console.log("Error: " + result);
                }
            });
        });

    });

</script>