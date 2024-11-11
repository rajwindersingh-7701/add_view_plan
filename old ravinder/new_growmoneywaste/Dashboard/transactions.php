<?php
require_once("header.php");
$user = $_SESSION["user"];
$userId = $user["id"];

require_once("controller/userClass.php");
$userClass = new userClass();

$_GET = $userClass->extract_post($db, $_GET);

if (isset($_GET['select_type'])) {
    if ($_GET['select_type'] != "") {
        $column = $_GET['select_type'];
        $value = $_GET['v'];
        $q = "SELECT * FROM  `wallet` where `userId`= '$userId' &&  $column='$value'";
    }
    if (isset($_GET['from'])) {
        $from = date("Y-m-d", strtotime($_GET['from']));
        $q = "SELECT * FROM `wallet` where `userId`= '$userId' && datetime >= '$from 00:00:00'";
    }
    if (isset($_GET['to'])) {
        $to = date("Y-m-d", strtotime($_GET['to']));
        $q .= " and  datetime <= '" . $to . " 23:59:59 '";
    }
    echo $q;
    $totalResult = mysqli_num_rows(mysqli_query($db, $q));
} else {
    $totalResult = mysqli_num_rows(mysqli_query($db, "SELECT id FROM  `wallet` where `userId`= '$userId'"));
}
?>

<!-- Container Panel  -->
<div class="col-lg-9">
    <h2 class="admin-heading bg-offwhite">All Transaction</h2>
    <!-- Filter -->
    <!-- Filter End -->
    <!-- All Transactions  -->
    <div class="profile-content">
        <!-- Admin Heading Title  -->
        <div class="transaction-title bg-offwhite">
            <div class="items">
                <div class="row">
                    <div class="col" style="max-width: 170px;"><span class="">Date</span></div>
                    <div class="col">Description</div>
                    <div class="col" style="max-width: 170px;">Wallet Type</div>
                    <div class="col" style="max-width: 170px;">From User</div>
                    <div class="col">Amount</div>
                </div>
            </div>
        </div>
        <!-- Admin Heading Title End -->

        <!-- Transaction List -->
        <div class="transaction-area">
            <div class="items">
                <a href="#">
                    <?php
                    $pagenum = $totalResult / 100;
                    //Search data query
                    $offset = 0;
                    $pageResult = 100;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        $offset = (($page - 1) * 100) + 1;
                    }
                    $q = "SELECT * FROM `wallet` where `userId`= '$userId' ";
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
//                                echo $q;die;
//$userId = $user["id"];
                    $i = 1;
                    $m = 1;
                    $queryUser = mysqli_query($db, $q);
                    while ($dataQuery = mysqli_fetch_array($queryUser)) {
                        $userFromID = $dataQuery['fromUserId'];
                        $userquery = mysqli_query($db, "SELECT * FROM `user` WHERE `user_id`= '$userFromID'");
                        $userresult = mysqli_fetch_array($userquery);
                        ?>
                        <div class="row">
                            <div class="col " style="max-width: 170px;">
                                <span class="name"><?php echo $dataQuery['datetime']; ?></span>
    <!--                                <span class="date">17</span>
                               <span class="pay-month">Jan</span>-->
                            </div>
                            <div class="col">
                                <span class="name"><?php echo $dataQuery['description']; ?></span>
                            </div>
                            <div class="col">
                                <span class="name">
                                    <?php 
                                    echo $dataQuery['walletType'];
                                    if($dataQuery['walletType']=="epin"){
                                        echo "KDC Wallet";
                                    }else if($dataQuery['walletType']=="INR"){
                                         echo "BONUS";
                                    }else if($dataQuery['walletType']=="ROI"){
                                        echo "CashBack";
                                    }
                                    
                                    ?>
                                </span>
                            </div>
                            <div class="col" style="max-width: 170px;">
                                <span class="name"><?php echo $userresult['name']; ?></span>
                            </div>

                            <div class="col">
                                <span class="payment-amaount"><?php echo $dataQuery['amount']; ?></span>
                            </div>
                        </div>
                    <?php } ?>
                </a>
            </div>


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

<!-- Call to action section start -->
<section class="callto-action">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3>Want To Become a Agent</h3>
                <p>Success And Spirit In Our Company</p>
            </div>
            <div class="col-md-4 text-md-right">
                <a href="../signup.php?sp=<?php echo $userData['user_id']; ?>" class="btn btn-default">Register Now</a>
            </div>
        </div>
    </div>
</section>
<!-- Call to action section end -->
<?php require 'footer.php'; ?>
<script>
    jQuery(".nav-item").removeClass("active");
    jQuery("#nav1").addClass("active");
</script>