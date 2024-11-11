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
        $q = "SELECT * FROM  `rewards`";
    }
    if (isset($_GET['from'])) {
        $from = date("Y-m-d", strtotime($_GET['from']));
        $q = "SELECT * FROM `rewards`";
    }
    if (isset($_GET['to'])) {
        $to = date("Y-m-d", strtotime($_GET['to']));
        $q .= " and  datetime <= '" . $to . " 23:59:59 '";
    }
    echo $q;
    $totalResult = mysqli_num_rows(mysqli_query($db, $q));
} else {
    $totalResult = mysqli_num_rows(mysqli_query($db, "SELECT id FROM  `rewards`"));
}
?>

<!-- Container Panel  -->
<div class="col-lg-9">
    <h2 class="admin-heading bg-offwhite">List Of Rewards</h2>
    <!-- Filter -->
    <!-- Filter End -->
    <!-- All Transactions  -->
    <div class="profile-content">
        <!-- Admin Heading Title  -->
        <div class="transaction-title bg-offwhite">
            <div class="items">
                <div class="row">
                    <div class="col cs1"><span class="">Name</span></div>
                    <div class="col cs1">direct</div>
                     <div class="col cs1">level</div>
                       <div class="col cs1">Reward</div>
                          <div class="col cs1">Capping</div>
                          
                    <div class="col cs1">Status</div>
                </div>
            </div>
        </div>
        <!-- Admin Heading Title End -->

        <!-- Transaction List -->
        <div class="transaction-area">
            
                    <?php
                    $q = "SELECT * FROM `rank`";
                    $queryUser = mysqli_query($db, $q);
                    while ($dataQuery = mysqli_fetch_array($queryUser)) {
                        $rewardsdataQuery = mysqli_num_rows(mysqli_query($db, "SELECT id FROM  `rewards_acheiver` where `user_id`='".$userData['user_id']."' and `rewards`='".$dataQuery['id']."'"));
                        ?>
            <div class="items">
                <a href="#">
                        <div class="row">
                            <div class="col cs1" >
                                <span class=""><?php echo $dataQuery['name']; ?></span>
    <!--                                <span class="date">17</span>
                               <span class="pay-month">Jan</span>-->
                            </div>
                            <div class="col cs1">
                                <span class=""><?php echo $dataQuery['direct']; ?></span>
                            </div>
                            <div class="col cs1" >
                                <span class=""><?php echo $dataQuery['level']; ?></span>
                            </div>
                            <div class="col cs1" >
                                <span class=""><?php echo $dataQuery['reward']; ?></span>
                            </div>
                                 <div class="col cs1" >
                                <span class=""><?php echo $dataQuery['capping']; ?></span>
                            </div>
                            <div class="col cs1" >
                               
                                <?php
                                    if($rewardsdataQuery==0){
                                    ?>
                                <span class="name red" style="color:red" >Not Achived</span>
                                    <?php }else{ ?>
                                       <span class="name green" style="color:green" >Achived</span>
                                    <?php } ?>
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

<!-- Call to action section start -->
<!--<section class="callto-action">
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
</section>-->
<!-- Call to action section end -->
<?php require 'footer.php'; ?>
<script>
    jQuery(".nav-item").removeClass("active");
    jQuery("#nav1").addClass("active");
</script>