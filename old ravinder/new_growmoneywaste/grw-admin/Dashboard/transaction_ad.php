<?php
require_once("include/header.php");

if (isset($_GET['select_type'])) {
    if ($_GET['select_type'] != "") {
        $column = $_GET['select_type'];
        $value = $_GET['v'];
        $q = "SELECT * FROM  `wallet` where $column='$value'";
        $totalResult = mysqli_num_rows(mysqli_query($db, $q));
    }

    if (isset($_GET['from'])) {
        if ($_GET['from'] != "") {
            $q = "SELECT * FROM  `wallet` where  walletType!='XBT' and transaction_type='ad' and datetime >= '" . $_GET['from'] . " 00:00:00'";
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
    $totalwalet = mysqli_fetch_array(mysqli_query($db, "SELECT count(*) as cnt, SUM(amount) as sm FROM `wallet` WHERE walletType!='XBT' and transaction_type='ad'"));
    $totalResult = $totalwalet['cnt'];
    $totalSum = $totalwalet['sm'];
}
?>
<div class="main-container mt-152">
    <div class="page-header">
        <div class="pull-left">
            <h2>Ad Transactions </h2>
        </div>

        <div class="clearfix"></div>
    </div>
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
                <option value="transaction_type" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "transaction_type") echo "selected"; ?>>Income type</option>

            </select>
            <input type="text" name="v" value="<?php if (isset($value)) echo $value; ?>" placeholder="Please enter your keyword" required>
            <input type="submit" class="orangebuttion" name="submit" value="Search">
            <a href="transaction_ad.php"><input class="orangebuttion" type="button" name="reset" value="Reset"> </a>
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
        <p><?php echo "Total Result:- " . $totalResult; ?></p>
        <p><?php echo "Total Amount:- " . $totalSum; ?></p>
        <?php

        $total_pages = ceil($totalResult / 100);
        if ($totalResult > 100) {

            if (isset($_GET["page"])) {
                $page  = $_GET["page"];
            } else {
                $page = 1;
            };
            echo "<ul class='pagination'>";
            echo "<li><a href='transaction_ad.php?page=" . ($page - 1) . "' class='button'>Previous</a></li>";

            for ($i = $page; $i <= ($page + 3); $i++) {
                echo "<li><a href='transaction_ad.php?page=" . $i . "'>" . $i . "</a></li>";
            };
            echo "<li><a href='transaction_ad.php?page=" . ($page + 1) . "' class='button'>NEXT</a></li>";
            echo "</ul>";
        ?>
            <span>
                <form action=''>
                    <input type='number' name='page' style='width:80px;padding: 3px;margin-right: 20px;margin-top: 2px;' value='<?php if (isset($_GET['page'])) {
                                                                                                                                    echo $_GET['page'];
                                                                                                                                } ?>'>
                    <input type='submit' value='GO TO PAGE' class='btn btn-flat'>
                </form>
            </span>
        <?php } ?>
    </div>

    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="widget-header">
                    <div class="title">
                        List of Transaction
                    </div>
                </div>
                <div class="widget-body">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>


                                    <th>Sr. No.</th>
                                    <th>User id</th>
                                    <th>Name</th>
                                    <th>Mobile No.</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <!--<th>Action</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //Search data query
                                $offset = 0;
                                $pageResult = 100;
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                    $offset = (($page - 1) * 100);
                                }
                                $q = "SELECT * FROM  `wallet` where walletType!='XBT' and transaction_type='ad'";

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
                                        <td><?php echo $userresult['phone']; ?> </td>
                                        <td><?php echo $dataQuery['description']; ?> </td>
                                        <td><?php echo $dataQuery['amount']; ?> </td>
                                        <td> <?php if ($dataQuery['type'] == 'debit') { ?> <p style="color: red;"> <?php echo $dataQuery['type']; ?></p> <?php } else { ?> <p style="color: green;"> <?php echo $dataQuery['type']; ?></p> <?php } ?> </td>
                                        <td><?php echo $dataQuery['datetime']; ?> </td>


                                    </tr>
                                <?php
                                    $i++;
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
<?php
include 'footer.php';
?>>