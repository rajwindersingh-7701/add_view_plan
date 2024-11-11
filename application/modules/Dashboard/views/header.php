<?php
// if($this->session->userdata['role'] != 'A'){

//     die;
// }
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off") {
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}
$user_info = userinfo();
$bankinfo = bankinfo();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?php echo title; ?> " name="description" />
    <meta content="<?php echo title; ?>" name="author" />
    <!-- App favicon -->
    <link rel="icon" href="<?php echo base_url(logo); ?>">
    <link href="<?php echo base_url('NewDashboard/') ?>assets/libs/chartist/chartist.min.css" rel="stylesheet">

    <!-- Bootstrap Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body[data-sidebar=dark] .navbar-brand-box {
            background: #00587c;
        }

        .navbar-brand-box {
            padding: 0 2.3rem;

        }

        body[data-sidebar=dark] .vertical-menu {
            background: #00587c;
            border-right: 1px solid rgb(255 255 255 / 14%);
            box-shadow: none;
        }

        #page-topbar {
            background: #00587c;
            box-shadow: 0;
            border-bottom: 1px solid rgb(255 255 255 / 14%);
        }

        body[data-sidebar=dark] #sidebar-menu ul li a {
            color: #fff;
            font-size: 16px;
            font-family: 'Roboto', sans-serif;
        }

        #sidebar-menu {
            padding: 0px 0 30px 0;
        }

        ul#side-menu li.active {
            background: rgb(255 255 255 / 14%);
            color: rgb(255 255 255 / 90%);
        }

        body[data-sidebar=dark] #sidebar-menu ul li a i {
            color: rgb(255 255 255 / 100%);
        }

        ul.sub-menu.mm-collapse.mm-show li {
            padding: 5px 0;
        }

        body[data-sidebar=dark] #sidebar-menu ul li a {
            color: rgb(255 255 255 / 100%);
        }

        body[data-sidebar=dark] #sidebar-menu ul li ul.sub-menu li a {
            color: rgb(255 255 255 / 65%);
            background: 0 0;
            display: inline-block;
        }

        #sidebar-menu {
            background: #01587c;
        }

        ul.sub-menu.mm-collapse.mm-show i {
            margin-left: 30px;
        }

        #sidebar-menu ul li ul.sub-menu li a {
            padding: .4rem 1.5rem .4rem 0.5rem;
        }

        #sidebar-menu ul li ul.sub-menu {
            padding: 0;
            background: rgb(0 0 0 / 12%);
            border: 1px solid rgb(237 237 237 / 12%);
        }

        body[data-sidebar=dark] #sidebar-menu ul li ul.sub-menu li a:hover {
            color: #fff;

        }

        body[data-sidebar=dark] #sidebar-menu ul li a:hover {
            color: #fff;
            background: rgb(255 255 255 / 14%);
        }

        body[data-sidebar=dark] #sidebar-menu ul li a:hover i {
            color: #fff;
        }

        body[data-sidebar="dark"] .mm-active .active {
            color: #fff !important;
        }

        button#vertical-menu-btn {
            position: absolute;
            right: 2px;
            color: #fff;
            top: 0;
        }


        @media (max-width: 380px) {
            .navbar-brand-box {
                display: block !important;
            }

        }

        .img-user {
            position: absolute;
    right: 45px;
    top: 13px;
    height: 45px;
    border-radius: 50%;
    background: #a01ff0;
    width: 50px;
        }


        img.img-card {
            margin-left: 2px;
            margin-top: 10px;
            max-width: 45px;
        }
        span.admin-hit {
    position: absolute;
    right: 59px;
    top: 12px;
    color: #ffff;
}
        .d-grid {
            display: grid;
        }

        @media screen and (max-width: 767px) {
            .btn.btn-set {

                padding: 2px 7px;
                font-size: 12px;

            }

        }
    </style>
</head>

<body data-sidebar="dark" style="background:#f5f5f5;">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="#" class="logo logo-dark">
                            <span class="logo-sm">

                                <img src="<?php echo base_url(logo); ?>" alt="" style="max-width:110px;">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url(logo); ?>" alt="" style="max-width:110px;">
                            </span>
                        </a>

                        <a href="#" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="<?php echo base_url(logo); ?>" alt="" style="max-width:110px;">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url(logo); ?>" alt="" style="max-width:110px;">
                            </span>
                        </a>
                    </div>


                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                        <i class="mdi mdi-menu"></i>
                    </button>

                    <div class="img-user" style="display:block;">
                     <span class="admin-hit">  <?php echo $user_info->user_id; ?></span> 

                        <?php if (!empty($bankinfo->profile_image)) { ?>
                            <img class="img-card" src="<?php echo base_url('uploads/' . $bankinfo->profile_image); ?>">
                        <?php } else { ?>
                            <img class="img-card" src="<?php echo base_url(logo); ?>" alt="user-logo" style="max-width:49px;">
                        <?php } ?>
                    </div>

                    <!-- <div class="d-flex">

                          <div class="dropdown d-none d-lg-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <i class="mdi mdi-fullscreen"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="<?php echo base_url('uploads/' . $bankinfo->profile_image); ?>"
                                    alt="User-Image">
                                    <?php echo $user_info->name; ?> (<?php echo $user_info->user_id; ?>)
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                 item
                                <a class="dropdown-item" href="<?php echo base_url('Dashboard/User/Profile'); ?>"><i class="mdi mdi-account-circle font-size-17 align-middle mr-1"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-wallet font-size-17 align-middle mr-1"></i> My Wallet</a>
                                <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings font-size-17 align-middle mr-1"></i> Settings</a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline font-size-17 align-middle mr-1"></i> Lock screen</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="<?php echo base_url('Dashboard/User/logout'); ?>"><i class="bx bx-power-off font-size-17 align-middle mr-1 text-danger"></i> Logout</a>
                            </div>
                        </div>

                        <div class="dropdown d-none">
                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                                <i class="mdi mdi-settings-outline"></i>
                            </button>
                        </div>

                    </div> -->
                </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">

                        <li class="active">
                            <a href="<?php echo base_url('Dashboard/User/'); ?>" class="waves-effect">
                                <i class="ti-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <!-- <li>
                            <a href="<?php //echo base_url('uploads/business_plan.pdf'); 
                                        ?>" class=" waves-effect" target="_blank">
                                <i class="ti-calendar"></i>
                                <span>Business Plan</span>
                            </a>
                        </li> -->


                        <!-- <li>
                                <a href="<?php // echo base_url('Dashboard/User/Profile'); 
                                            ?>" class=" waves-effect">
                                    <i class="ti-calendar"></i>
                                    <span>Edit Profile</span>
                                </a>
                            </li> -->



                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span>Profile</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <i class="fa fa-arrow-right"></i>
                                    <a href="<?php echo base_url('Dashboard/Profile'); ?>">Edit Profile</a>
                                </li>
                                <li>
                                    <i class="fa fa-arrow-right"></i>
                                    <a href="<?php echo base_url('Dashboard/Profile/accountDetails'); ?>">KYC Details</a>
                                </li>
                                <li>
                                    <i class="fa fa-arrow-right"></i>
                                    <a href="<?php echo base_url('Dashboard/Profile/changePassword'); ?>">Change Password</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="<?php echo base_url('Dashboard/Register/?sponser_id=' . $user_info->user_id); ?>" class=" waves-effect">
                                <i class="ti-calendar"></i>
                                <span>Register New</span>
                            </a>
                        </li>





                        <!-- <li class="menu-title">Components</li> -->

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span>Request Wallet</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <!-- <li><a href="<?php //echo base_url('Dashboard/User/addBalance'); 
                                                    ?>">Add Balance</a></li> -->
                                <li>
                                    <i class="fa fa-arrow-right"></i>
                                    <a href="<?php echo base_url('Dashboard/fund/Request_fund'); ?>">Fund Request</a>
                                    
                                </li>
                                <li>
                                    <i class="fa fa-arrow-right"></i>
                                    <a href="<?php echo base_url('Dashboard/fund/requests');
                                                ?>">Requests History</a>
                                </li>
                                <li>
                                    <i class="fa fa-arrow-right"></i>
                                    <a href="<?php echo base_url('Dashboard/fund/wallet_ledger'); ?>">Wallet Ledger</a>
                                </li>

                                <!-- <li>
                                    <i class="fa fa-arrow-right"></i>
                                    <a href="<?php //echo base_url('Dashboard/fund/growtogmt'); 
                                                ?>">Growmoey to GMT </a>
                                </li> -->
                                <!-- <li>
                                    <i class="fa fa-arrow-right"></i>
                                    <a href="<?php //echo base_url('Dashboard/fund/transferToGmtWallet'); 
                                                ?>">Walle to GMT Wallet </a>
                                </li> -->


                                <!-- <li><a href="<?php //echo base_url('Dashboard/User/addBalanceHistory'); 
                                                    ?>">Topup Wallet History</a></li> -->
                            </ul>
                        </li>

                        <li class="">
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-receipt"></i>

                                <span>Account Active</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <i class="fa fa-arrow-right"></i>
                                    <a href="<?php echo base_url('Dashboard/Activation'); ?>"> Active New Account</a>
                                </li>
                                <?php if ($user_info->paid_status == 1) : ?>
                                    <!-- <li><i class="fa fa-arrow-right"></i><a href="<?php //echo base_url('Dashboard/UpgradeAccount2'); 
                                                                                        ?>"> Upgrade Account</a></li> -->
                                <?php endif; ?>

                                <?php

                                // if($user_info->upgrade_package > 0){
                                //     $package_amount = $user_info->upgrade_package;
                                // }else{
                                //     $package_amount = $user_info->package_amount;
                                // }

                                // if($user_info->paid_status == 0 && $package_amount >= 1199):
                                ?>
                                <!-- <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/retopup_id'); ?>"> Retopup Account</a></li> -->
                                <?php //endif;
                                ?>

                                <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/Fund/activation_history'); ?>">Active Account History</a>
                                <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/Reports/activationHistory'); ?>">Active History</a>
                                </li>
                                <!-- <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/Fund/upgradeactivation_history'); ?>">Self Upgrade History</a></li> -->
                            </ul>
                        </li>

                        <!-- <li class="d-block">
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ti-receipt"></i>
                                    <span>E-Pin Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <i class="fa fa-arrow-right"></i>
                                        <a href="<?php echo base_url('Dashboard/Settings/epins/0'); ?>"> Unused Epins</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-arrow-right"></i>
                                        <a href="<?php echo base_url('Dashboard/Settings/epins/1'); ?>">Used Epins</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-arrow-right"></i>
                                        <a href="<?php echo base_url('Dashboard/Settings/epins/2'); ?>">Transferred Epins</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-arrow-right"></i>
                                        <a href="<?php echo base_url('Dashboard/Settings/transfer_epins'); ?>">Transfer Epins</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-arrow-right"></i>
                                        <a href="<?php echo base_url('Dashboard/Settings/epins/3'); ?>">Epins History</a>
                                    </li>
                                </ul>
                            </li> -->


                        <?php
                        $display = 0;
                        if ($display == 1) : ?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ti-receipt"></i>
                                    <span>Recharge Portal</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <i class="fa fa-arrow-right"></i>
                                        <a href="<?php echo base_url('Dashboard/Recharge'); ?>"> Recharge</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-arrow-right"></i>
                                        <a href="<?php echo base_url('Dashboard/Recharge/rechargeHistory'); ?>">Recharge History</a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-pie-chart"></i>
                                <span>My Team</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/User/Directs'); ?>">My Directs</a></li>
                                <!-- <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/User/Genelogy'); ?>">Team View</a></li> -->
                                <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/Fund/levelReport'); ?>">Level Report</a></li>
                                <!-- <li><i class="fa fa-arrow-right"></i><a href="<?php //echo base_url('Dashboard/User/Reward'); 
                                                                                    ?>">Royalty List</a></li> -->

                                <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/User/Tree/' . $user_info->user_id); ?>">My Direct Tree</a></li>
                                <!-- <li><a href="<?php //echo base_url('Dashboard/User/Downline'); 
                                                    ?>">My  Downline</a></li>
                                  <li><a href="<?php //echo base_url('Dashboard/User/Downline/L'); 
                                                ?>">Left Downline</a></li>
                                  <li><a href="<?php //echo base_url('Dashboard/User/Downline/R'); 
                                                ?>">Right Downline</a></li>
                                  <li><a href="<?php //echo base_url('Dashboard/User/GenelogyTree/' . $user_info->user_id); 
                                                ?>">Team Tree</a></li> -->
                                <?php for ($i = 1; $i <= 6; $i++) : ?>

                                <?php endfor; ?>
                            </ul>
                        </li>
                        <!-- <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ti-view-grid"></i>
                                    <span>Task</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?php // echo base_url('Dashboard/Task/') 
                                                    ?>">Task List</a></li>
                                </ul>
                            </li> -->


                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-view-grid"></i>
                                <span>Withdraw Money</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <!-- <li> -->
                                    <!-- <i class="fa fa-arrow-right"></i> -->
                                    <!-- <a href="<?php echo base_url('Dashboard/fund/incometoe_wallet'); ?>">Income to wallet</a> -->
                                    <!-- <a href="<?php echo base_url('Dashboard/fund/income_ledger'); ?>">Income Trasfer History</a> -->
                                <!-- </li> -->
                                <!-- <li>
                                    <i class="fa fa-arrow-right"></i> -->
                                    <!-- <a href="<?php echo base_url('Dashboard/fund/incometoe_wallet'); ?>">Income to wallet</a> -->
                                    <!-- <a href="<?php echo base_url('Dashboard/fund/income_ledger'); ?>">Pay Transfer History</a> -->
                                <!-- </li> -->
                                <!-- <li><a href="<?php //echo base_url('Dashboard/matchingWithdraw') 
                                                    ?>">Withdrawal</a></li> -->
                                <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/DirectIncomeWithdraw') ?>">Withdrawal</a></li>
                                <!-- <li><a href="<?php //echo base_url('Dashboard/IncomeTransfer') 
                                                    ?>"> Transfer to Another Account</a></li> -->
                                <!-- <li><a href="<?php //echo base_url('Dashboard/eWalletTransfer') 
                                                    ?>"> Transfer to E-Wallet</a></li> -->
                                <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/withdraw_history') ?>">Withdrawal History</a></li>


                                <!-- <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('/Dashboard/SecureWithdraw/addBeneficiary') ?>">Add Beneficiary</a></li>
                                   <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/SecureWithdraw/beneficiaryList') ?>">IMPS Transfer</a></li> -->
                                <!-- <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/withdraw_history') ?>">Withdrawal History</a></li>  -->
                                <!-- <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/bank_transfer_summary') ?>">Bank Transfer Summary</a></li> -->

                                <!-- <li><a href="<?php //echo base_url('Dashboard/Withdraw/ActivateBanking') 
                                                    ?>"> 1. Activate Banking</a></li>
                                    <li><a href="<?php //echo base_url('Dashboard/bank_transfer_summary') 
                                                    ?>">Bank Transfer Summary</a></li> -->
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-face-smile"></i>
                                <span>Account Statement</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <?php
                                //$incomes = incomes();
                                $incomes = $this->config->item('incomes');
                                foreach ($incomes as $key => $income) {
                                    echo ' <li>
                                            <i class="fa fa-arrow-right"></i>
                                            <a href="' . base_url('Dashboard/User/Income/' . $income['type']) . '">' . $income['name'] . '</a>
                                         </li>';
                                }
                                ?>

                                <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/User/income_ledgar'); ?>">Income Ledger</a></li>
                                <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/User/holding_income_ledgar'); ?>">Holding Income Ledger</a></li>
                                <!-- <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/Settings/payout_summary'); ?>">Datewise Income Summary</a></li> -->
                                <!-- <li><a href="<?php //echo base_url('Dashboard/Settings/week_payout_summary'); 
                                                    ?>">Weekwise Payout Summary</a></li> -->
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span>Support Ticket</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/Support/ComposeMail'); ?>">Create Ticket</a></li>
                                <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/Support/Inbox'); ?>">Inbox</a></li>
                                <li><i class="fa fa-arrow-right"></i><a href="<?php echo base_url('Dashboard/Support/Outbox'); ?>">OutBox</a></li>
                            </ul>
                        </li>


                        <li>
                            <a href="<?php echo base_url('Dashboard/User/logout'); ?>">
                                <i class="ti-power-off"></i>
                                <span>Logout</span>
                            </a>

                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->