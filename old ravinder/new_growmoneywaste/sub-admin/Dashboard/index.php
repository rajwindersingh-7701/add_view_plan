<?php
require_once("include/header.php");
if (isset($_GET['from'])) {
    if ($_GET['from'] != "") {
        $from = $_GET['from'] . " 00:00:00";
    }
}
if (isset($_GET['to'])) {
    if ($_GET['to'] != "") {
        $to = $_GET['to'] . " 23:59:59";
    }
}
$currentdate = date('Y-m-d') . " 00:00:00";
$none = 1;
if ($none == 0) {
?>

    <div class="page-wrapper" style="min-height: 352px;">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-12 text-center">
                        <h4 class="text-themecolor">Search From Date</h4>
                        <br>

                        <?php
                        if (isset($_GET['select_type'])) {

                            $column = $_GET['select_type'];

                            $value = $_GET['v'];
                        }
                        ?>



                        <form action="" method="get" class="form1 main-fomr ">

                            <div class="row">

                                <div class="col-md-12 mb-2">
                                    <input type="hidden" name="select_type" value="">

                                    <input type="hidden" name="v" id="date" value="">

                                    <span class="text-size sm-d-flex"> From<input type="text" name="from" id="datepicker"> </span>

                                    <span class="text-size"> to <input type="text" name="to" id="datepicker1"> </span>
                                </div>

                                <div class="col-md-12">
                                    <input type="submit" class="button-searh bg-danger p-1 text-white" name="submit" value="Search">

                                    <a href="index.php"><input type="button" class="button-searh bg-success p-1 text-white" name="reset" value="Reset"> </a>
                                </div>
                            </div>






                        </form>




                    </div>

                </div>



                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="d-flex text-center">
                                    <div>
                                        <h5 class="card-title text-white">Total <br> Id </h5>

                                        <?php
                                        $qu = "SELECT id FROM  `user` where role!='admin'";
                                        if (isset($from)) {
                                            $qu .= " and Date  >= '$from'";
                                        }
                                        if (isset($to)) {
                                            $qu .= " and Date  <= '$to'";
                                        }

                                        $usennum = mysqli_query($db, $qu);

                                        echo '<h2 class="text-white">' . $userrs = mysqli_num_rows($usennum) . '</h2>';
                                        ?>
                                    </div>

                                </div>
                                <div id="spark4"><canvas style="display: inline-block; width: 272.25px; height: 50px; vertical-align: top;" width="272" height="50"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-info">
                            <div class="card-body">
                                <div class="d-flex text-center">
                                    <div>
                                        <h5 class="card-title text-white">Total <br> Paid Id</h5>
                                        <?php
                                        $qu = "SELECT id FROM  `user` where role!='admin' and `package`!='InActive'";
                                        if (isset($from)) {
                                            $qu .= " and Date  >= '$from'";
                                        }
                                        if (isset($to)) {
                                            $qu .= " and Date  <= '$to'";
                                        }

                                        $usennum = mysqli_query($db, $qu);

                                        echo '<h2 class="card-subtitle text-white">' . $userrs = mysqli_num_rows($usennum) . '</h2>';
                                        ?>


                                    </div>

                                </div>
                                <div id="spark5"><canvas width="272" height="50" style="display: inline-block; width: 272.25px; height: 50px; vertical-align: top;"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-success">
                            <div class="card-body">
                                <div class="d-flex text-center">
                                    <div>
                                        <h5 class="card-title text-white">Total pending withdraw Main Wallet</h5>
                                        <?php
                                        $quwith = "SELECT sum(amount) as sumwith FROM  `withdraw` where `type`='INR' and `status`='pending'";
                                        if (isset($from)) {
                                            $quwith .= " and datetime  >= '$from'";
                                        }
                                        if (isset($to)) {
                                            $quwith .= " and datetime  <= '$to'";
                                        }

                                        $sumwith = mysqli_fetch_array(mysqli_query($db, $quwith));
                                        $dollarWith = (isset($sumwith['sumwith'])) ? $sumwith['sumwith'] : 0;
                                        echo '<h2 class="card-title text-white">' . round($dollarWith) . '</h2>';
                                        ?>
                                    </div>

                                </div>
                                <div id="spark6"><canvas width="272" height="50" style="display: inline-block; width: 272.25px; height: 50px; vertical-align: top;"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-warning">
                            <div class="card-body">
                                <div class="d-flex text-center">
                                    <div>
                                        <h5 class="card-title text-white">Total Confirm withdraw Main Wallet</h5>
                                        <?php
                                        $quwith = "SELECT sum(amount) as sumwith FROM  `withdraw` where `type`='INR' and `status`='done'";
                                        if (isset($from)) {
                                            $quwith .= " and datetime  >= '$from'";
                                        }
                                        if (isset($to)) {
                                            $quwith .= " and datetime  <= '$to'";
                                        }

                                        $sumwith = mysqli_fetch_array(mysqli_query($db, $quwith));
                                        $dollarWith = (isset($sumwith['sumwith'])) ? $sumwith['sumwith'] : 0;
                                        echo '<h2 class="card-title text-white">' . round($dollarWith) . '</h2>';
                                        ?>
                                    </div>

                                </div>
                                <div id="spark7"><canvas width="272" height="50" style="display: inline-block; width: 272.25px; height: 50px; vertical-align: top;"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <div class="d-flex text-center">
                                    <div>
                                        <h5 class="card-title text-white">Total Add Fund</h5>
                                        <?php
                                        $smw = mysqli_fetch_array(mysqli_query($db, "SELECT sum(`amount`) as smamnt FROM `wallet` WHERE `transaction_type`='transfer' and walletType='epin'"));
                                        echo $smw['smamnt'];
                                        ?>
                                    </div>

                                </div>
                                <div id="spark7"><canvas width="272" height="50" style="display: inline-block; width: 272.25px; height: 50px; vertical-align: top;"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <div class="d-flex text-center">
                                    <div>
                                        <h5 class="card-title text-white">Today Joining</h5>
                                        <?php
                                        $smw = mysqli_fetch_array(mysqli_query($db, "SELECT COUNT(*) as cnt FROM `user` WHERE `Date`>'$currentdate'"));
                                        echo "<h6>" . (isset($smw['cnt'])) ? $smw['cnt'] : (0) . "<h6>";
                                        ?>
                                    </div>

                                </div>
                                <div id="spark7"><canvas width="272" height="50" style="display: inline-block; width: 272.25px; height: 50px; vertical-align: top;"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <div class="d-flex text-center">
                                    <div>
                                        <h5 class="card-title text-white">Today income</h5>
                                        <?php
                                        //                                    echo "SELECT sum(`amount`) as smamnt FROM `wallet` WHERE `type`='credit' and walletType='INR' datetime>'$currentdate'";
                                        $smw = mysqli_fetch_array(mysqli_query($db, "SELECT sum(`amount`) as smamnt FROM `wallet` WHERE `type`='credit' and walletType='INR' and datetime>'$currentdate'"));

                                        echo '<h2 class="card-title text-white" style="color:#fff;">' . (isset($smw['smamnt'])) ? $smw['smamnt'] : (0) . '</h2>';

                                        ?>
                                    </div>

                                </div>
                                <div id="spark7"><canvas width="272" height="50" style="display: inline-block; width: 272.25px; height: 50px; vertical-align: top;"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <div class="d-flex text-center">
                                    <div>
                                        <h5 class="card-title text-white">Today Active</h5>
                                        <?php

                                        $smw = mysqli_fetch_array(mysqli_query($db, "SELECT COUNT(*) as cnt FROM `user` WHERE `paid_date`>'$currentdate'"));
                                        echo "<h6>" . (isset($smw['cnt'])) ? $smw['cnt'] : (0) . "<h6>";
                                        ?>
                                    </div>

                                </div>
                                <div id="spark7"><canvas width="272" height="50" style="display: inline-block; width: 272.25px; height: 50px; vertical-align: top;"></canvas></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <div class="d-flex text-center">
                                    <div>
                                        <h5 class="card-title text-white">Today Fund confirmed</h5>
                                        <?php
                                        $totalResult = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(amount) as cnt FROM `payment_invest` where status='done' and datetime>'$currentdate'"));

                                        echo "<h6>" . (isset($totalResult['cnt'])) ? $totalResult['cnt'] : (0) . "<h6>";
                                        ?>
                                    </div>

                                </div>
                                <div id="spark7"><canvas width="272" height="50" style="display: inline-block; width: 272.25px; height: 50px; vertical-align: top;"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <div class="d-flex text-center">
                                    <div>
                                        <h5 class="card-title text-white">All fund confirmed</h5>
                                        <?php
                                        $totalResult = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(amount) as cnt FROM `payment_invest` where status='done'"));

                                        echo "<h6>" . (isset($totalResult['cnt'])) ? $totalResult['cnt'] : (0) . "<h6>";
                                        ?>
                                    </div>

                                </div>
                                <div id="spark7"><canvas width="272" height="50" style="display: inline-block; width: 272.25px; height: 50px; vertical-align: top;"></canvas></div>
                            </div>
                        </div>
                    </div>

                    <!-- Column -->
                </div>
                <!-- Row -->
                <!--                <footer class="footer">
                        � 2019 Elegent Admin by wrappixel.com
                    </footer>
                        </div>-->
            <?php
        }
        include 'footer.php';
            ?>