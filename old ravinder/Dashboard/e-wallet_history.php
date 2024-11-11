<?php
require_once("header.php");
$user = $_SESSION["user"];
$userId = $user["id"];
//$userId = $user["user_id"];

require_once("controller/userClass.php");
$userClass = new userClass();

$_GET = $userClass->extract_post($db, $_GET);

if (isset($_GET['select_type'])) {
    if ($_GET['select_type'] != "") {
        $column = $_GET['select_type'];
        $value = $_GET['v'];
        $q = "SELECT * FROM  `recharge` where `userId`= '$userId' &&  $column='$value'";
    }
    if (isset($_GET['from'])) {
        $from = date("Y-m-d", strtotime($_GET['from']));
        $q = "SELECT * FROM  `withdraw` where `userId`= '$userId' && datetime >= '$from 00:00:00'";
    }
    if (isset($_GET['to'])) {
        $to = date("Y-m-d", strtotime($_GET['to']));
        $q .= " and  datetime <= '" . $to . " 23:59:59 '";
    }
    echo $q;
    $totalResult = mysqli_num_rows(mysqli_query($db, $q));
} else {
    // echo "SELECT * FROM `wallet` where `userId`= '$userId' AND `transaction_type`IN('receive,send')  AND `walletType` ='epin'";
    // $totalResult = mysqli_num_rows(mysqli_query($db, "SELECT id FROM  `withdraw` where `userId`= '$userId'"));
    $totalResult = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `wallet` where `userId`= '$userId' AND `walletType` ='epin'"));
}
?>
<style>
   
    .col25p {
        width: 25% !important;
        max-width: 25% !important;
        float: left;
    }
    .col20p {
        width: 20% !important;
        max-width: 20% !important;
        float: left;
    }
    .col10p {
        width: 10% !important;
        max-width: 10% !important;
        float: left;
    }
    .col15p {
        width: 15% !important;
        max-width: 15% !important;
        float: left;
    }
    .col30p {
        width: 30% !important;
        max-width: 30% !important;
        float: left;
    }
    /*@media only screen and (max-width: 765px) {*/

    /*}*/
</style>
<!-- Container Panel  -->
<div class="col-lg-9">
    <h2 class="admin-heading bg-offwhite">E-wallet Transfer Detail</h2>
    <!-- Filter -->
    <!-- Filter End -->
    <!-- All Transactions  -->
    <div class="profile-content">
        <!-- Admin Heading Title  -->
        <div class="transaction-title bg-offwhite">
            <div class="items">
                <div class="row">
                    <div class="col col15p" ><span class="">User Id</span></div>
                    <div class="col col15p" ><span class="">Amount</span></div>
                    <div class="col col15p">Type</div>
                    <div class="col col15p">Description</div>
                    <div class="col col15p">Transaction Type</div>
                    <div class="col col20p">Date Time</div>
                    <!--<div class="col col20p">Desc</div>-->
                </div>
            </div>
        </div>
        <!-- Admin Heading Title End -->

        <!-- Transaction List -->
        <div class="transaction-area">

            <?php
            $pagenum = $totalResult / 100;
            //Search data query
            $offset = 0;
            $pageResult = 100;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                $offset = (($page - 1) * 100) + 1;
            }
            // $q = "SELECT * FROM `wallet` where `userId`= '$userId' AND `transaction_type`IN('receive,send')  AND `walletType` ='epin'";
            $q = "SELECT * FROM `wallet` where `userId`= '$userId' AND `walletType` ='epin'";
            if (isset($_GET['select_type'])) {
                $column = $_GET['select_type'];
                $value = $_GET['v'];
                if ($_GET['select_type'] != "") {
                    $q .= " and  $column Like '%$value%' ";
                }
                if (isset($_GET['from'])) {
                    $q .= " and datetime >= '" . $from . " 00:00:00' ";
                }
                if (isset($_GET['to'])) {
                    $q .= " and datetime <= '" . $to . " 23:59:59' ";
                }
            }
            $q .= "order by id asc limit $pageResult offset $offset";
//                    echo $q;
//$userId = $user["id"];
            $i = 1;
            $m = 1;
            $queryUser = mysqli_query($db, $q);
            while ($dataQuery1 = mysqli_fetch_array($queryUser)) {
                ?>
                <div class="items">
                    <a href="#">
                        <div class="row">
                            <div class="col col15p" >
                                <span class="name"><?php echo $dataQuery1['username']; ?></span>
                            </div>
                            <div class="col col15p">
                                <span class="name"><?php echo $dataQuery1['amount']; ?></span>
                            </div>
                            <div class="col col15p">
                                <span class="name"><?php echo $dataQuery1['type']; ?></span>
                            </div>
                            <div class="col col15p" >
                                <span class="payment-amaount"> <?php echo $dataQuery1['description']; ?></span>
                            </div>
                            <div class="col col15p" >
                                <span class="payment-amaount"> <?php echo $dataQuery1['transaction_type']; ?></span>
                            </div>
                            <div class="col col15p" >
                                <span class="payment-amaount"> <?php echo $dataQuery1['datetime']; ?></span>
                            </div>
                           
                        </div>
                    </a>
                </div>
            <?php } ?>



        </div>
    </div>
    <!-- Transaction List End -->

    <!-- Transaction Details Modal  -->
    <!-- Transaction Modal End -->

    <!-- Pagination -->
    <!--    <ul class="pagination justify-content-left mt-4 pt-4 pl-0">
            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-left"></i></a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active"><a class="page-link" href="#">2 <span class="sr-only">(current)</span></a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item d-flex align-content-center text-muted mr-2">...</li>
            <li class="page-item"><a class="page-link" href="#">19</a></li>
            <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
            </li>
        </ul>-->
    <ul class="pagination justify-content-left mt-4 pt-4 pl-0">
        <li style="">Page 
        </li>
        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-left"></i></a></li>
        <?php
//Pagination 

        for ($i = 0; $i < $pagenum; $i++) {
            if (isset($_GET['select_type'])) {
//Query Parameter
                $parameter = $_SERVER['QUERY_STRING'];
//if page already send
                if (isset($_GET['page'])) {
                    parse_str($parameter, $get_array);
                    unset($get_array['page']);
                    $parameter = http_build_query($get_array);
                }
                ?> 
                <li class="page-item">
                    <a class="page-link" href="?<?php echo $parameter; ?>&page=<?php echo $i + 1; ?>">
                        <?php echo $i + 1; ?>
                    </a>
                </li>
            <?php } else { ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $i + 1; ?>">

                        <?php echo $i + 1; ?>
                    </a>
                </li>
                <?php
            }
        }
        ?> 
    </ul>

    <!-- Paginations end -->

</div>
<!-- All Transactions End -->
</div>
<!-- Middle End -->
</div>
</div>
</div>
<!-- Content end -->

<!-- Call to action section end -->
<?php require 'footer.php'; ?>
<script>
    jQuery(".nav-item").removeClass("active");
    jQuery("#nav1").addClass("active");
</script>