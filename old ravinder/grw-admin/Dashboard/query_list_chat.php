<?php
require_once("include/header.php");

if (isset($_GET['select_type'])) {
    if ($_GET['select_type'] != "") {
        $column = $_GET['select_type'];
        $value = $_GET['v'];
        $q = "SELECT * FROM  `support` where status='pending'";
    }
    if (isset($_GET['from'])) {
        $q = "SELECT * FROM  `support` where status='pending' and  datetime >= '" . $_GET['from'] . " 00:00:00'";
    }
    if (isset($_GET['to'])) {
        $q .= " and  datetime <= '" . $_GET['to'] . " 23:59:59 '";
    }
    $totalResult = mysqli_num_rows(mysqli_query($db, $q));
} else {
    $totalResult = mysqli_num_rows(mysqli_query($db, "SELECT * FROM  `support` where status='pending'"));
}
$uid = $_GET['uid'];
?>

<style>
    .pagination>li{
        display: inline;
    }

</style>
<div class="main-container mt-152">
    <div class="page-header">
        <div class="pull-left">
            <h2>Users </h2>
        </div>

        <div class="clearfix"></div>
    </div>


    <style>

        .orangebuttion
        {
            background:#ff9800; padding:10px 20px; color:#FFF; border:none; cursor:pointer;
        }
        ul.pagination li
        {
            padding:5px 10px; background:#0e9048;
            margin-right:3px;
            cursor:pointer;
            color:#FFF;
            font-size:16px;

        }
        ul.pagination li a
        {
            color:#FFF;
        }
    </style>
    <style>



        .container1 {



            border: 2px solid #dedede;

            background-color: #f1f1f1;

            border-radius: 5px;

            padding: 10px;

            margin: 10px 0;

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





        .time-right {

            float: right;



        }



        .time-left {

            float: left;



        }

        .right_a{ width: 51%;

                  border: none;

                  float:right;}

        .left_a{

            width: 51%;

            border: none;

            float:left;

        }

        @media only screen and (min-width: 765px) {
            .main-container {

                max-width: 50vw;
            }
        }
        .main-container {

            /* margin-left: 22%; */

            margin: auto;


            overflow-y: auto;

        }





    </style>

    <div class="row-fluid">

        <div class="span12">

            <div class="widget">

                <div class="widget-header">

                    <div class="title">

                        Chat Messages

                    </div>

                </div>

                <div class="widget-body">



                    <div>

                        <form class="typind" style="">

                            <textarea  type="text" class="textarea" style="width:80%; min-height: 69px; border-radius:10px; "></textarea>

                            <input type='hidden' name='uid' value='<?php echo $uid; ?>'>

                            <button  type="button" class="bt btn-success">Sent</button>

                        </form>

                    </div>



                    <div id="chat">





                    </div>



                </div>

            </div>

        </div>

    </div>

    <?php
    $uid = $_GET['uid'];

    $data = mysqli_query($db, "SELECT * FROM `support` WHERE `user_id`='$uid' and  `status`='pending'");

    $row = mysqli_fetch_assoc($data);



    $support_id = $row['id'];
    ?>
    <script>
        $(document).ready(function () {
            $('#myTable').dataTable({
                "paging": false,
                "ordering": false,
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--
        <script type="text/javascript" src="js/script.js"></script>
        
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
    <script>
        jQuery(function () {

            jQuery("#datepicker").datepicker({
                changeYear: true,
                changeMonth: true,
                maxDate: new Date(),
                dateFormat: "yy-mm-dd "
//        yearRange: "2017:2020"
            });
            jQuery("#datepicker1").datepicker({
                changeYear: true,
                changeMonth: true,
                maxDate: new Date(),
                dateFormat: "yy-mm-dd "
//        yearRange: "2017:2020"
            });
            //jQuery( "#datepicker" ).datepicker();
        });
    </script>


    <script>

        $(document).ready(function () {

            //jQuery('#chat').css("overflow-y", "scroll");



            $.ajax({

                type: "POST",

                url: "controller/msgcontroller.php",

                data: "type=lod&support_id=<?php echo $support_id; ?>",

                success: function (result) {



                    var obj = $.parseJSON(result);

                    console.log(obj);

                    for (i = 0; i < obj.length; i++) {

                        if (obj[i]['sender'] == "admin") {

                            $("#chat").append("<div class='container1 darker1 right_a'><div style='width:100%;'><div>" + obj[i]['sender'] + "</div><div>" + obj[i]['datetime'] + "</div></div><p class='time-right'>" + obj[i]['msg'] + "</p></div>");

                        } else {

                            $("#chat").append("<div class='container1 darker1 left_a'><div style='width:100%;'><div>" + obj[i]['sender'] + obj[i]['user_id'] + "</div><div>" + obj[i]['datetime'] + "</div></div><p class='time-left'>" + obj[i]['msg'] + "</p></div>");

                        }



                    }

                }

            });



            $(".button").click(function () {



                var msg = $(".textarea").val();

                $.ajax({

                    type: "POST",

                    url: "controller/msgcontroller.php",

                    data: "type=submit&support_id=<?php echo $support_id; ?>&msg=" + msg,

                    success: function (result) {

                        console.log(result);

                        var obj = $.parseJSON(result);

                        console.log(obj);

                        if (obj["status"] == 1) {



                            $("#chat").prepend("<div class='container darker right_a'><div><div>" + obj[0]['sender'] + obj[0]['user_id'] + "</div><div>" + obj[0]['datetime'] + "</div></div><p  class='time-right'>" + msg + "</p></div>");

                            $(".textarea").val("")

                        } else {

                            console.log(result);

                        }

                    }

                });

            });





        });



    </script>


    <!-- container-fluid -->
</div>
<?php
include 'footer.php';
?>

