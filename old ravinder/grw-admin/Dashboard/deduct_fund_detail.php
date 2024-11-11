<?php
require_once("include/header.php");
if (isset($_GET['select_type'])) {
    if ($_GET['select_type'] != "") {
        $column = $_GET['select_type'];
        $value = $_GET['v'];
        // $q = "SELECT * FROM  `wallet` where walletType='epin' and fromUserId='admin' and $column='$value'";
        $q = "SELECT * FROM  `wallet` where walletType='epin' $column='$value'";
        $totalResult = mysqli_num_rows(mysqli_query($db, $q));
    }

    if (isset($_GET['from'])) {
        if ($_GET['from'] != "") {
            // $q = "SELECT * FROM  `wallet` where walletType='epin' and fromUserId='admin' and  datetime >= '" . $_GET['from'] . " 00:00:00'";
            $q = "SELECT * FROM  `wallet` where walletType='epin' datetime >= '" . $_GET['from'] . " 00:00:00'";
            $totalResult = mysqli_num_rows(mysqli_query($db, $q));
        }
    }
    if (isset($_GET['to'])) {
        if ($_GET['to'] != "") {
            $q .= " and  datetime <= '" . $_GET['to'] . " 23:59:59 '";
            $totalResult = mysqli_num_rows(mysqli_query($db, $q));
        }
    }
} else {
    // $totalResult = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `wallet` WHERE walletType='epin' and fromUserId='admin'"));
    $totalResult = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `wallet` WHERE walletType='epin'"));
    $totalSum = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(amount) as sm FROM `wallet` WHERE walletType='epin'"));
    // $totalSum = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(amount) as sm FROM `wallet` WHERE walletType='epin' and fromUserId='admin'"));
}
?>

<style>
    .pagination>li {
        display: inline;
    }
</style>
<div class="main-container mt-152">

    <div class="page-header mt-15">
        <div class="pull-left">
            <h2>Fund Transaction </h2>
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
                        List of Fund Transaction (Total:-<?php echo $totalResult; ?>)
                    </div>
                    <div class="title">
                        Amount of Fund Transaction (Total:-<?php echo $totalSum['sm']; ?>)
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
                        <div class='span12'><button class="orangebuttion" style="" onclick='selectForm()'>Change Filter</button></div>
                        <form action="" method="get" class="form1" <?php if (isset($_GET['from'])) { ?> style="display:none;" <?php } ?>>
                            <label> Search From</label>
                            <select name="select_type" id="select_search" onchange="searchSelect()">
                                <option value="username" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "user_id") echo "selected"; ?>>User Id</option>
                                <option value="transaction_type" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "transaction_type") echo "selected"; ?>>Transaction Type</option>
                            </select>
                            <input type="text" name="v" value="<?php if (isset($value)) echo $value; ?>" placeholder="Please enter your keyword" required>
                            <input type="submit" class="orangebuttion" name="submit" value="Search">
                            <a href="deduct_fund_detail.php"><input class="orangebuttion" type="button" name="reset" value="Reset"> </a>
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
                            <span> From<input type="text" name="from" id="datepicker"> </span>
                            <span> to <input type="text" name="to" id="datepicker1"> </span>
                            <input type="submit" name="submit" value="Search">
                            <a href="deduct_fund_detail.php.php"><input type="button" name="reset" value="Reset"> </a>
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
                            echo "<li><a href='deduct_fund_detail.php.php?page=" . ($page - 1) . "' class='button'>Previous</a></li>";

                            for ($i = $page; $i <= ($page + 2); $i++) {
                                echo "<li><a href='deduct_fund_detail.php.php?page=" . $i . "'>" . $i . "</a></li>";
                            };
                            echo "<li><a href='deduct_fund_detail.php?page=" . ($page + 1) . "' class='button'>NEXT</a></li>";
                            echo "</ul>";
                        ?>
                        <?php } ?>
                    </div>


                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>

                                    <th>#</th>
                                    <th>User id</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Transaction Type</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //Search data query
                                $offset = 0;
                                $pageResult = 100;
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                    $offset = (($page - 1) * 100) + 1;
                                }
                                $q = "SELECT * FROM  `wallet` where walletType='epin'";
                                // $q = "SELECT * FROM  `wallet` where walletType='epin' and fromUserId='admin'";

                                if (isset($_GET['select_type'])) {
                                    $column = $_GET['select_type'];
                                    $value = $_GET['v'];
                                    if ($_GET['select_type'] != "") {
                                        $q .= " and  $column='$value' ";
                                    }
                                    if (isset($_GET['from'])) {
                                        $q .= " and datetime >= '" . $_GET['from'] . " 00:00:00' ";
                                    }
                                    if (isset($_GET['to'])) {
                                        $q .= " and datetime <= '" . $_GET['to'] . " 23:59:59' ";
                                    }
                                }

                                $q .= "order by id desc limit $pageResult offset $offset";

                                //                                echo $q;die;
                                //$userId = $user["id"];
                                $i = 1;
                                $queryUser = mysqli_query($db, $q);
                                while ($dataQuery = mysqli_fetch_array($queryUser)) {
                                    $userquery = mysqli_query($db, "SELECT * FROM `user` where `id`= '" . $dataQuery['userId'] . "'");
                                    $userresult = mysqli_fetch_array($userquery);

                                ?>
                                    <tr>

                                        <td><?php echo $i; ?> </td>
                                        <td><?php echo $dataQuery['username']; ?> </td>
                                        <td><?php echo $userresult['name']; ?> </td>
                                        <td><?php echo $dataQuery['amount']; ?> </td>
                                        <td><?php echo $dataQuery['type']; ?> </td>
                                        <td><?php echo $dataQuery['description']; ?> </td>
                                        <td><?php echo $dataQuery['transaction_type']; ?> </td>
                                        <td><?php echo $dataQuery['datetime']; ?> </td>

                                    </tr>
                                <?php $i++;
                                }
                                ?>


                            </tbody>
                        </table>
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

    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
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


    <script>
        function login(val) {
            $.ajax({
                url: "controller/function.php",
                type: "GET",
                data: {
                    ido: val
                },
                success: function(response) {

                    if (response == "true") {
                        window.open('../../Dashboard');
                    }
                }
            });
        }
    </script>


    <!-- container-fluid -->
</div>
<!--End of Tawk.to Script-->
</body>

</html>