<?php
require_once("include/header.php");

if (isset($_GET['select_type'])) {
    if ($_GET['select_type'] != "") {
        $column = $_GET['select_type'];
        $value = $_GET['v'];
        $q = "SELECT * FROM  `sub_admin` where $column='$value'";
        $totalResult = mysqli_num_rows(mysqli_query($db, $q));
    }

    if (isset($_GET['from'])) {
        if ($_GET['from'] != "") {
            $q = "SELECT * FROM  `sub_admin` where date >= '" . $_GET['from'] . " 00:00:00'";

            $totalResult = mysqli_num_rows(mysqli_query($db, $q));
        }
    }

    if (isset($_GET['to'])) {
        if ($_GET['to'] != "") {
            $q .= " and  date <= '" . $_GET['to'] . " 23:59:59 '";
            $totalResult = mysqli_num_rows(mysqli_query($db, $q));
        }
    }
} else {
    $totalResult1 = mysqli_fetch_array(mysqli_query($db, "SELECT count(*) as count FROM `sub_admin` where kyc_status = '1'"));
    $totalResult = $totalResult1['count'];
}
?>



<style>
    .pagination>li {

        display: inline;

    }

    body {
        color: darkgreen;
    }
</style>

<div class="main-container  mt-152">
    <div class="page-header">
        <div class="pull-left">
            <h2>Sub Admin List</h2>
        </div>
        <!-- <div class="pull-right" style="margin-right: 10px">
            <input type="text" id="fsdf" value="www.<?php echo $slink; ?>/register.php?sp=<?php echo $userData['user_id']; ?>" style="width:98%;     margin-right: 12px; padding:  4px;font-size:  16px;background: #ffffff;color:  #615b5b; border: 1px solid #ddd; font-weight:  800;" readonly="true">
            <a class="btn btn-secondary" onclick="copyToClipboard('#pr')" style="color:#fff">Copy</a>

        </div> -->
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
    </style>

    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="widget-header">
                    <div class="title">
                    </div>
                </div>

                <div class="widget-body">
                    <div>
                        <?php
                        if (isset($_GET['select_type'])) {
                            $column = $_GET['select_type'];
                            $value = $_GET['v'];
                        }
                        ?>


                        <script>
                            function selectForm() {

                                jQuery(".form1").toggle();

                                jQuery(".form2").toggle();

                            }
                        </script>

                    </div>

                    <div>
                        <?php

                        $total_pages = ceil($totalResult / 100);
                        if ($totalResult > 100) {

                            if (isset($_GET["page"])) {
                                $page  = $_GET["page"];
                            } else {
                                $page = 1;
                            };
                            echo "<ul class='pagination'>";
                            echo "<li><a href='view_admin.php?page=" . ($page - 1) . "' class='button'>Previous</a></li>";

                            for ($i = $page; $i <= ($page + 3); $i++) {
                                echo "<li><a href='view_admin.php?page=" . $i . "'>" . $i . "</a></li>";
                            };
                            echo "<li><a href='view_admin.php?page=" . ($page + 1) . "' class='button'>NEXT</a></li>";
                            echo "</ul>";
                        ?>
                        <?php } ?>
                    </div>

                    <div class="table-responsive">
                        <form action="controller/function.php" method='post'>
                            <div id="usernamechk"></div>
                            <table id="myTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>User Id</th>
                                        <th>Password</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    //Search data query
                                    $offset = 0;
                                    $pageResult = 50;
                                    if (isset($_GET['page'])) {
                                        $page = $_GET['page'];
                                        $offset = (($page - 1) * 50) + 1;
                                    }
                                    $q = "SELECT * FROM  `sub_admin`";
                                    if (isset($_GET['select_type'])) {
                                        $column = $_GET['select_type'];
                                        $value = $_GET['v'];
                                        if ($_GET['select_type'] != "") {
                                            $q .= " and  $column Like '%$value%' ";
                                        }
                                        if (isset($_GET['from'])) {
                                            $q .= " and Date >= '" . $_GET['from'] . " 00:00:00' ";
                                        }
                                        if (isset($_GET['to'])) {
                                            $q .= " and Date <= '" . $_GET['to'] . " 23:59:59' ";
                                        }
                                    }
                                    if (isset($value)) {
                                        $q .= "order by id asc limit $pageResult offset $offset";
                                    } else {

                                        $q .= "order by id desc limit $pageResult offset $offset";
                                    }

                                    $i = 1;
                                    $queryUser = mysqli_query($db, $q);
                                    $m = 1;
                                    while ($dataQuery = mysqli_fetch_array($queryUser)) {
                                    ?>

                                        <tr>
                                            <!-- <td><?php echo $m++; ?> </td> -->

                                            <td><?php echo $dataQuery['id']; ?></td>
                                            <td><?php echo $dataQuery['name']; ?></td>
                                            <td><?php echo $dataQuery['user_id']; ?></td>
                                            <td><?php echo $dataQuery['password']; ?> </td>
                                            <td>
                                                <?php if ($dataQuery['disable'] == 1) { ?>
                                                    <p class="text-success">Active</p>
                                                <?php } else { ?>
                                                    <p class="text-primary">Inactive</p>
                                                <?php } ?>
                                            <td><?php echo $dataQuery['datetime']; ?> </td>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>



                                </tbody>

                            </table>


                            <a class="btn btn-default btn-sm" onclick="checkout1(<?php echo $dataQuery['id']; ?>)"> Confirm Selected</a>

                        </form>
                    </div>

                    <div class="modal fade" id="overlay">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Please Enter KYC Remarks </h4>
                                </div>
                                <div class="modal-body">
                                    <form action="controller/kyc.php" method="POST">
                                        <input type="hidden" name="id" id='uid' value="">
                                        <div style="width:60%;margin: 0 auto;">
                                            <div class="control-group">
                                                <textarea name='remarks' class="form-control"></textarea>
                                                <div id="user_check_msg"></div>
                                            </div>
                                            <div class="control-group">
                                                <input type="submit" class="btn btn-default" name="kyc_id" value="submit">
                                                <input type="Reset" value="Reset" class="btn btn-default">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="overlay2">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Please Enter KYC Remarks </h4>
                                </div>
                                <div class="modal-body">
                                    <form action="controller/kyc.php" method="POST">
                                        <input type="hidden" name="id" id='uuid' value="">
                                        <div style="width:60%;margin: 0 auto;">
                                            <div class="control-group">
                                                <textarea name='remarks' class="form-control"></textarea>
                                                <div id="user_check_msg"></div>
                                            </div>
                                            <div class="control-group">
                                                <input type="submit" class="btn btn-default" name="kyc_rj" value="submit">
                                                <input type="Reset" value="Reset" class="btn btn-default">
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

    <script>
        $(document).ready(function() {

            $('#myTable').dataTable({

                "paging": false,

                "ordering": false,

            });

        });
    </script>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->



    <script type="text/javascript" src="../../js/script.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        function verywithdraw(withid) {
            document.getElementById("usernamechk").innerHTML = 'checking';
            document.getElementById("btnarea").innerHTML = "waiting";
            var params = "withid=" + withid;
            var url = "controller/function.php";
            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'html',
                data: params,
                beforeSend: function() {

                },
                complete: function() {},
                success: function(html) {
                    alert(html);
                    var a = html;
                    withid = '';
                    document.getElementById("usernamechk").innerHTML = "<font color='red'>" + html + "</font>";
                    document.getElementById("btnarea").innerHTML = "<a class='btn btn success'>Verified</a>";
                }
            });
        }

        function checkout(id) {
            $("#uid").val(id);
            $('#overlay').modal('show');
        }

        function RJcheckout(id) {
            $("#uuid").val(id);
            $('#overlay2').modal('show');
        }

        function checkout1(id) {
            $('#overlay1').modal('show');
        }

        jQuery(function() {



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











    <!-- container-fluid -->

</div>

<?php
include 'footer.php';
?>