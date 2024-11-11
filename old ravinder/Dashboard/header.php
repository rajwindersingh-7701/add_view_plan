<?php
require_once("../database/db.php");

require_once("controller/userClass.php");
if (empty($_SESSION["user"])) {
    echo "<script type='text/javascript'> document.location = '../'; </script>";
    exit;
}
date_default_timezone_set("Asia/Calcutta");


//echo $_SERVER['REQUEST_URI'];die;


$userClass = new userClass();
// $getRewardsAchive = new getRewardsAchive();
$id = $_SESSION["user"]["id"];
$ref = urlencode($_SESSION['user']['user_id']);
$uiid = $_SESSION["user"]["id"];

//print_r($_SESSION["user"]);die;
$query = mysqli_query($db, "SELECT * FROM `user` WHERE id='$id'");
$userData = mysqli_fetch_array($query);

$packQuery = mysqli_query($db, "SELECT * FROM `package` WHERE id='" . $userData['package'] . "'");
$packData = mysqli_fetch_array($packQuery);
$spQury = mysqli_query($db, "SELECT `name` FROM `user` WHERE `user_id`='" . $userData['sponser_by'] . "'");
$spData = mysqli_num_rows($spQury);
$user_id = $_SESSION["user"]["user_id"];
//if($userData['package']=='InActive' and strpos($_SERVER['REQUEST_URI'], 'RenewwalPack.php') == false){
//    echo "<script type='text/javascript'> document.location = 'RenewwalPack.php'; </script>";
//    exit;
//}
$walletbd2 = $userClass->getWallet($db, 'epin', $uiid);
$walletroi = $userClass->getWallet($db, 'ROI', $uiid);
$walletbtc = $userClass->getWallet($db, 'INR', $uiid);

if (count($_GET) > 0) {
    $_GET = $userClass->extract_post($db, $_GET);
}


$firstday = date('Y-m-d', strtotime("this week")) . " 00:00:00";
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--Title -->
    <title><?php echo $site; ?></title>
    <!-- Favicon icons -->
    <link href="images/favicon.png" rel="shortcut icon">
    <!-- All CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="css/daterangepicker.css">
    <link rel="stylesheet" href="css/coreNavigation-1.1.3.min.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        a.nav-link.sub {
            background: linear-gradient(89deg, #0a2665 0.1%, #176fa9 51.5%, #06679c 100.2%) !important;
        }

        p#response-msg {
            background: #62ad62;
            color: #fff;
            padding: 10px;
            font-size: 16px;
            font-weight: 800;
        }

        .nav-container {
            width: 100% !important;
        }

        .col.cs1 {
            width: 16% !important;
            text-align: center !important;
        }
    </style>
</head>

<body>

    <!-- Preloader -->
    <div id="preloader">
        <div id="status"></div>
    </div>

    <div class="header-top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-info">
                        <!--<p><i class="ti-mobile"></i><a href="tel:+91 9817280779">+91 0123456789</a></p>-->
                        <p><i class="ti-email"></i> <a href="mailto:india1team@gmail.com">growmoney.me@gmail.com</a></p>

                    </div>
                </div>
                <div class="col-md-6 text-md-right">

                    <!-- HEADER-LANGUAGE -->
                    <!--                    <div class="header-language">
                                                <a href="#" class="langbtn">
                                                    <span>EN</span>
                                                    <i class="ti-angle-down"></i>
                                                </a>
                                                <ul class="list-unstyled dropdown-menu" style="display: none;">
                                                    <li class="active"><a href="#">EN</a></li>
                                                    <li><a href="#">FR</a></li>
                                                    <li><a href="#">PT</a></li>
                                                    <li><a href="#">IT</a></li>
                                                </ul>
                                            </div>  END HEADER-LANGUAGE -->
                    <ul class="login-area">
                        <?php if (empty($_SESSION['user'])) { ?>
                            <li><a href="login.php" class="login"><i class="ti-power-off"></i> Login</a></li>
                            <li><a href="signup.php" class="rsgiter"><i class="ti-plus"></i> Register</a></li>
                        <?php } else { ?>
                            <li><a href="../model/function.php?type=logout" class="login"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div><!-- END .CONTAINER -->
    </div>
    <!-- Header strat -->
    <header class="header">
        <!-- Start Navigation -->
        <div class="row">
            <div class="logo-ds col-2">
                <a href="index.php" class="brand">
                    <img class="res" src="../img/gm.png" width="40%"></a>
            </div>
            <div class="col-10">
                <nav>
                    <div class="nav-header ">
                        <button class="toggle-bar"><span class="fa fa-bars"></span></button>


                    </div>
                    <div class='nav-bar-c'>
                        <ul class="menu">
                            <li><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="dropdown">
                                <a class="nav-link dropdown-menu-click1"> <i class="fas fa-list-ul"></i>Profile <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a class="" href="profile.php"><i class="fa fa-chevron-right" aria-hidden="true"></i> Profile</a></li>
                                    <li><a class="" href="profile_password.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>change password</a></li>

                                </ul>
                            </li>
                            <!--<li><a class="nav-link" href="profile.php"><i class="fab fa-autoprefixer"></i> Profile</a></li>-->
                            <!--<li><a class="nav-link" href="upgrade.php"><i class="fab fa-uikit"></i> Membership</a></li>-->
                            <li class="dropdown">
                                <a class="nav-link dropdown-menu-click1"> <i class="fas fa-list-ul"></i>Membership <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a class="" href="upgrade.php"><i class="fa fa-chevron-right" aria-hidden="true"></i> Membership</a></li>
                                    <li><a class="" href="activation_detail.php"><i class="fa fa-chevron-right" aria-hidden="true"></i> Membership History</a></li>
                                    <!--<li><a class=""  href="reupgrade.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Retop up</a></li>-->

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="nav-link dropdown-menu-click1"> <i class="fas fa-list-ul"></i>Affiliation Detail <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a class="" href="refer_direct.php"><i class="fa fa-chevron-right" aria-hidden="true"></i> Referral</a></li>
                                    <!--<li><a class=""  href="tree.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Team Tree</a></li>-->
                                    <li><a class="" href="refer_team.php"><i class="fa fa-chevron-right" aria-hidden="true"></i> Total Team</a></li>
                                    <li><a href="level_view.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Level chart</a></li>
                                    <!--<li><a class=""  href="downline.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Downline</a></li>-->
                                    <!--<li><a class=""  href="downline_right.php"><i class="fa fa-chevron-right" aria-hidden="true"></i> Right Downline</a></li>-->
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="nav-link dropdown-menu-click2"> <i class="fas fa-list-ul"></i>Transaction <span class="caret"></span></a>
                                <ul class="dropdown-menu">

                                    <li><a href="trans_daily.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Daily Ad View Bonus</a></li>
                                    <li><a href="trans_refer.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>level Bonus</a></li>
                                    <li><a href="level_view.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Level chart</a></li>
                                    <li><a href="trans_daily_level.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Royalty Bonus Bonus</a></li>
                                    <li><a href="trans_rewards.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Rewards</a></li>
                                </ul>
                            </li>
                            <!--<li><a class="nav-link" href="profile_kyc.php?add_user=true"><i class="fas fa-list-ul"></i>Payout Detail</a></li>-->
                            <li class="dropdown">
                                <a class="nav-link dropdown-menu-click12"> <i class="fas fa-list-ul"></i>Withdraw <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="transfer-wallet.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>E-Wallet Transfer</a></li>
                                    <li><a href="e-wallet_history.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>E-Wallet Transfer History</a></li>
                                    <li><a href="pay-transfer-wallet.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Pay-Wallet Transfer</a></li>
                                    <li><a href="pay-wallet_history.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Pay-Wallet Transfer History</a></li>
                                    <li><a href="withdraw.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Withdraw</a></li>
                                    <li><a href="withdraw_summarry.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Withdraw Detail</a></li>
                                </ul>
                            </li>
                            <!--                                <li>
                                                                    <a  class="nav-link dropdown-menu-click121" > <i class="fas fa-list-ul"></i>Recharge <span class="caret"></span></a>
                                                                    <ul class="sub-menu-drop121" style="display: none;">
                                                                        <li><a class="nav-link sub"  href="../index.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Recharge</a></li>
                                                                        <li><a class="nav-link sub"  href="recharge_detail.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Recharge Detail</a></li>
                                                                    </ul>
                                                                </li>-->
                            <li class="dropdown">
                                <a class="nav-link" href="support.php"><i class="fas fa-university"></i>Support</a>
                                <ul class="dropdown-menu">
                                
                                    <li id="nav7"><a href="https://wa.me/9456189033"><i class="fa fa-phone" aria-hidden="true"></i>Watsapp</a></li>
                                   
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a class="nav-link dropdown-menu-click3"> <i class="fas fa-list-ul"></i>Request E-wallet <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li id="nav7"><a href="slip_request.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>E-wallet Request</a></li>
                                    <li id="nav8"><a href="slip_request_detail.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Request Detail</a></li>
                                    <li id="nav7"><a href="ewallet_detail.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>E-wallet History</a></li>


                                </ul>
                            </li>

                            <li class="dropdown">
                                <a class="nav-link dropdown-menu-click3"> <i class="fas fa-university"></i>Request Kyc <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li id="nav7"><a href="user_kyc_form.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Kyc Request</a></li>
                                    <li id="nav8"><a href="reject_kyc.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Reject Request Detail</a></li>

                                </ul>
                            </li>

                            <li class='logout-nav'><a class="nav-link" href="../model/function.php?type=logout"><i class="fas fa-university"></i>LOGOUT</a></li>


                        </ul>
                    </div>


                </nav>
            </div>



        </div>
        <!-- End Navigation -->
    </header>
    <!-- Header End -->


    <!-- Profile bar -->
    <div class="profilebar shadow mt-2 border-2">
        <div class="container">
            <div class="row">
                <div class="col-6 cs">
                    <div class="local-time">
                        <p class="hdt"><b>User Name:</b> <?php echo $userData['name']; ?></p>
                    </div>
                    <div class="local-time">
                        <p class="hdt"><b>User ID:</b> <?php echo $userData['user_id']; ?></p>
                    </div>
                    <div class="local-time">
                        <p class="hdt"><b>Package:</b>

                            <?php
                            if ($userData['package'] == 'InActive') {
                                echo "<span class='ntact'>Not active<span>";
                            } else {
                                echo "<span class='act'>Active</span>";
                            }

                            ?></p>
                    </div>
                    <!--<div class="notify-btn"><a href="profile-notifications.html"><i class="far fa-bell"></i></a></div>-->
                    <div class="notify-btn"><a href="#" class="btn btn-default" data-toggle="modal" data-target="#step" style="font-size:16px"><i class="fa fa-share-alt" aria-hidden="true"></i> Invite</a></div>
                </div>



                <div class="col-6">
                    <div class="local-time">
                        <p class="hdt"><b>Sponser ID:</b> <?php echo $userData['sponser']; ?></p>
                    </div>
                    <div class="local-time">
                        <?php
                        $rewardsdataQuery = mysqli_query($db, "SELECT * FROM rewards_acheiver WHERE `user_id` ='" . $userData['user_id'] . "'");
                        $userDataRewa = mysqli_fetch_array($rewardsdataQuery);
                        ?>
                        <?php
                        if ($userDataRewa['level'] == 8) {
                            $rank = "Kohinur";
                        } elseif ($userDataRewa['level'] == 7) {
                            $rank = "Crown";
                        } elseif ($userDataRewa['level'] == 6) {
                            $rank = "Daimond";
                        } elseif ($userDataRewa['level'] == 5) {
                            $rank = "Ruby";
                        } elseif ($userDataRewa['level'] == 4) {
                            $rank = "Platinum";
                        } elseif ($userDataRewa['level'] == 3) {
                            $rank = "Gold";
                        } elseif ($userDataRewa['level'] == 2) {
                            $rank = "Silver";
                        } elseif ($userDataRewa['level'] == 1) {
                            $rank = "Star";
                        } else {
                            $rank = "No Rank";
                        }
                        ?>
                        <p class="hdt"><b>Rank :</b> <?php echo $rank; ?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Profile bar -->



    <!-- Refer Link Modal -->
    <div class="modal fade step-secourity" id="step" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <p>Share Refer Link</p>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="custom-control custom-switch">
                        <p class="links" style="color:#000; font-size:18px">Sponsor Link
                            <input type="text" id="fsdf" value="www.<?php echo $slink; ?>/register.php?sp=<?php echo $userData['user_id']; ?>" style="width:98%;     margin-right: 12px; padding:  4px;font-size:  16px;background: #ffffff;color:  #615b5b; border: 1px solid #ddd; font-weight:  800;" readonly="true">

                        </p>

                        <a href="whatsapp://send?text=https://<?php echo $slink; ?>/register.php?sp=<?php echo $userData['user_id']; ?>" data-action="share/whatsapp/share"><img src="images/wa.png" style="width: 50px;"></a>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" onclick="copyToClipboard('#pr')" style="color:#fff">Copy</a>
                    <a target="__blank" href="https://<?php echo $slink; ?>/register.php?sp=<?php echo $userData['user_id']; ?>" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>
    </div>
    <p id="pr" style="display:none">https://<?php echo $slink; ?>/signup.php?sp=<?php echo $userData['user_id']; ?></p>

    <!-- Admin Content Section  -->
    <div id="content" class="py-4">
        <div class="container">
            <div class="row">
                <!-- Left sidebar -->
                <!--                    <aside class="col-lg-3 sidebar">
                        <div class="widget admin-widget p-0">
                            <div class="Profile-menu">
                                <ul class="nav secondary-nav">
                                    <li class="nav-item" id="nav1"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                    <li class="nav-item" id="nav2"><a class="nav-link" href="profile.php"><i class="fab fa-autoprefixer"></i> Account</a></li>
                                    <li class="nav-item" id="nav3"><a class="nav-link" href="upgrade.php"><i class="fab fa-uikit"></i> Membership</a></li>
                                    <li class="nav-item ">
                                        <a  class="nav-link dropdown-menu-click1" > <i class="fas fa-list-ul"></i>Affiliation Detail <span class="caret"></span></a>
                                        <ul class="sub-menu-drop1" style="display: none;">
                                            <li><a  class="nav-link sub" href="refer_direct.php"><i class="fa fa-chevron-right" aria-hidden="true"></i> Referral</a></li>
                                            <li><a class="nav-link sub"  href="refer_team.php"><i class="fa fa-chevron-right" aria-hidden="true"></i> Total Team</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item ">
                                        <a  class="nav-link dropdown-menu-click2" > <i class="fas fa-list-ul"></i>Transaction <span class="caret"></span></a>
                                        <ul class="sub-menu-drop2" style="display: none;">
                                            <li><a class="nav-link sub"  href="trans_refer.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Refer Bonus</a></li>
                                            <li><a class="nav-link sub"  href="trans_refer_level.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Team Level Bonus</a></li>
                                            <li><a  class="nav-link sub" href="trans_daily.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Daily Cash Back</a></li>
                                            <li><a class="nav-link sub"  href="trans_daily_level.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Cash Back Level</a></li>
                                            <li><a class="nav-link sub"  href="trans_rewards.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Rewards</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item active" id="nav21"><a class="nav-link" href="profile_kyc.php?add_user=true"><i class="fas fa-list-ul"></i>Payout Detail</a></li>
                                    <li class="nav-item ">
                                        <a  class="nav-link dropdown-menu-click12" > <i class="fas fa-list-ul"></i>Withdraw <span class="caret"></span></a>
                                        <ul class="sub-menu-drop12" style="display: none;">
                                            <li><a class="nav-link sub"  href="withdraw.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Withdraw</a></li>
                                            <li><a class="nav-link sub"  href="withdraw_summarry.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Withdraw Detail</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item ">
                                        <a  class="nav-link dropdown-menu-click121" > <i class="fas fa-list-ul"></i>Recharge <span class="caret"></span></a>
                                        <ul class="sub-menu-drop121" style="display: none;">
                                            <li><a class="nav-link sub"  href="../index.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Recharge</a></li>
                                            <li><a class="nav-link sub"  href="recharge_detail.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Recharge Detail</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item" id="nav4"><a class="nav-link" href="support.php"><i class="fas fa-university"></i>Support</a></li>

                                    <li class="nav-item ">
                                        <a  class="nav-link dropdown-menu-click3" > <i class="fas fa-list-ul"></i>Request E-wallet <span class="caret"></span></a>
                                        <ul class="sub-menu-drop3" style="display: none;">
                                            <li id="nav7"><a class="nav-link sub"  href="slip_request.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>E-wallet Request</a></li>
                                            <li id="nav8"><a class="nav-link sub"  href="slip_request_detail.php"><i class="fa fa-chevron-right" aria-hidden="true"></i>Request Detail</a></li>

                                        </ul>
                                    </li>

                                </ul>


                            </div>



                        </div>
                    </aside>-->
                <!-- Left Panel End -->