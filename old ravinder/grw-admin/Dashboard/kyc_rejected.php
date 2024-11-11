<?php
require_once("include/header.php");

if (isset($_GET['select_type'])) {
    if ($_GET['select_type'] != "") {
        $column = $_GET['select_type'];
        $value = $_GET['v'];
        $q = "SELECT * FROM  `user_kyc` where $column='$value'";
        $totalResult = mysqli_num_rows(mysqli_query($db, $q));
    }

    if (isset($_GET['from'])) {
        if ($_GET['from'] != "") {
            $q = "SELECT * FROM  `user_kyc` where date >= '" . $_GET['from'] . " 00:00:00'";

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
    $totalResult1 = mysqli_fetch_array(mysqli_query($db, "SELECT count(*) as count FROM `user_kyc` where kyc_status = '-1'"));
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
            <h2>Kyc Requests</h2>
        </div>
        <!--        <div class="pull-right" style="margin-right: 10px">
            <a href="printrequest.php" target='__blank'><input type='button' class='btn btn-success' value="Export All"></a>

        </div>
        <div class="pull-right" style="margin-right: 10px">
            <a href="export_withdraw_pending.php" target='__blank'><input type='button' class='btn btn-success' value="Export All In XL"></a>
        </div>-->
        <div class="pull-right" style="margin-right: 10px">

<a href="export_kyc_rejected.php" target='__blank'><input type='button' class='btn btn-success' value="Export All In XL"></a>

</div>
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
                        List of KYC Approved (Total:-<?php echo $totalResult; ?>)
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

                        <!-- <div class='span12'><button class="orangebuttion" style="" onclick='selectForm()'>Change Filter</button></div> -->

                        <form action="" method="get" class="form1" <?php if (isset($_GET['from'])) { ?> style="display:none;" <?php } ?>>

                            <label> Search From</label>

                            <select name="select_type" id="select_search" onchange="searchSelect()">
                                <option value="userId" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "userId") echo "selected"; ?>>User ID</option>
                                <option value="account_name" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "account_name") echo "selected"; ?>>AC Name</option>
                            </select>

                            <input type="text" name="v" value="<?php if (isset($value)) echo $value; ?>" placeholder="Please enter your keyword" required>

                            <input type="submit" class="orangebuttion" name="submit" value="Search">

                            <a href="pending_request.php"><input class="orangebuttion" type="button" name="reset" value="Reset"> </a>

                        </form>

                        <script>
                            function selectForm() {

                                jQuery(".form1").toggle();

                                jQuery(".form2").toggle();

                            }
                        </script>

                        <form action="" method="get" class="form2" <?php if (empty($_GET['from'])) { ?> style="display:none;" <?php } ?>>

                            <label> Search From Date</label>

                            <input type="hidden" name="select_type" value="">

                            <input type="hidden" name="v" id="date" value="">

                            <span> From<input type="date" name="from" id="datepicker"> </span>

                            <span> to <input type="date" name="to" id="datepicker1"> </span>

                            <input type="submit" name="submit" value="Search">

                            <a href="wallet_transaction.php"><input type="button" name="reset" value="Reset"> </a>

                        </form>

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
                            echo "<li><a href='kyc_rejected.php?page=" . ($page - 1) . "' class='button'>Previous</a></li>";

                            for ($i = $page; $i <= ($page + 2); $i++) {
                                echo "<li><a href='kyc_rejected.php?page=" . $i . "'>" . $i . "</a></li>";
                            };
                            echo "<li><a href='kyc_rejected.php?page=" . ($page + 1) . "' class='button'>NEXT</a></li>";
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
                                        <!--<th>Select</th>-->
                                        <!--                                        <th>Pan Image</th>
                                        <th>Bank Image</th>
                                        <th>Aadhaar Image</th>-->
                                        <th>ID</th>
                                        <th>User Id</th>
                                        <th>Name</th>
                                        <th>Bank Detail</th>
                                        <th>Phone</th>
                                        <th>Remarks</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Delete Request</th>
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
                                    $q = "SELECT * FROM  `user_kyc` Where kyc_status = '-1'";
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
                                        $userquery = mysqli_query($db, "SELECT name,phone, user_id FROM `user` where `id`= '" . $dataQuery['userId'] . "'");
                                        $userresult = mysqli_fetch_array($userquery);
                                    ?>

                                        <tr>
                                            <td><?php echo $m++; ?> </td>

                                            <!--<td><input type="checkbox" name='id[]' value='<?php echo $dataQuery['id']; ?>'>   </td>-->

                                            <td><?php echo $dataQuery['userId']; ?></td>
                                            <td><?php echo $userresult['user_id']; ?> </td>
                                            <td><?php echo $userresult['name']; ?> </td>
                                            <td>
                                                Bank Name:-<?php echo $dataQuery['bank_name']; ?><br>
                                                IFSC :-<?php echo $dataQuery['bank_ifsc']; ?><br>
                                                Ac. Name:-<?php echo $dataQuery['account_name']; ?><br>
                                                Ac No.:-<?php echo $dataQuery['account_number']; ?><br>
                                                Pan:-<?php echo $dataQuery['pan']; ?><br>
                                                Aadhar card:-<?php echo $dataQuery['adhar']; ?><br>

                                            </td>
                                            <td><?php echo $userresult['phone']; ?> </td>
                                            <td><?php echo $dataQuery['kyc_remarks']; ?> </td>
                                            <td>
                                                <?php if ($dataQuery['kyc_status'] == 1) { ?>
                                                    <p class="text-success">Accepted</p>
                                                <?php } else if ($dataQuery['kyc_status'] == -1) { ?>
                                                    <p class="text-danger">Rejected</p>
                                                <?php } else { ?>
                                                    <p class="text-primary">Pending</p>
                                                <?php } ?>
                                            </td>

                                            <td>
                                                <?php if ($dataQuery['kyc_status'] == 0) { ?>
                                                    <a class="btn btn-success" onclick="checkout(<?php echo $dataQuery['id']; ?>)">Accept</a>
                                                    <a class="btn btn-danger" onclick="RJcheckout(<?php echo $dataQuery['id']; ?>)">Reject</a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <div id="btnarea"><a class="btn btn-danger" href='controller/function.php?deleteroiwithdraw=<?php echo $dataQuery['id']; ?>' onclick="confirm('Delete withdraw <?php echo $userresult['name']; ?>')">Delete</a></div>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>



                                </tbody>

                            </table>

                            <div class="modal fade" id="overlay1">

                                <div class="modal-dialog">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                            <h4 class="modal-title" style='color:red'>Please Enter Selected Withdraw Remarks </h4>

                                        </div>

                                        <div class="modal-body">

                                            <!--<input type="hidden" name="userId" id='uid' value="">-->

                                            <div style="width:60%;margin: 0 auto;">

                                                <div class="control-group">

                                                    <!--<input type="text" onChange="checkUser()" id="user" onFocus="checkUser()" class="form-control" name="userId" placeholder="Enter User Id">-->

                                                    <textarea name='remarks' class="form-control"></textarea>
                                                    <input type="hidden" name='wallettype' value='INR'>
                                                    <div id="user_check_msg"></div>

                                                </div>

                                                <div class="control-group">

                                                    <input type="submit" class="btn btn-default" name="with_id_selected" value="submit">

                                                    <input type="Reset" value="Reset" class="btn btn-default">

                                                </div>

                                            </div>


                                        </div>

                                    </div>

                                </div>

                            </div>

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