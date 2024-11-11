<?php //die (''); ?>

<?php
// if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
//     $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//     header('HTTP/1.1 301 Moved Permanently');
//     header('Location: ' . $redirect);
//     exit();
// } 
//
$guard = $this->session->userdata['guard'];

if (empty($guard)) {
    redirect('Admin/Management/logout');
}
$response['subAccess'] = $this->Main_model->get_single_record('tbl_admin', ['role' => $this->session->userdata['role'], 'user_id' => $this->session->userdata['admin_id']], '*');
$accesshead = json_decode($response['subAccess']['access'], true);
// pr($accesshead,true);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->

    <link href="<?php echo base_url('NewDashboard/') ?>assets/libs/chartist/chartist.min.css" rel="stylesheet">

    <!-- Bootstrap Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <style>
        .bg-primary {
            background: url('https://growmoney.me/uploads/admin-box-bg.jpeg');
            background-size: cover;
        }
    </style>
</head>
<style>
    body[data-sidebar=dark] .navbar-brand-box {
        background: #f8f8fa;
    }

    body[data-sidebar=dark] .vertical-menu {
        background: linear-gradient(45deg, #379f1d, blue);
    }

    body[data-sidebar=dark] #sidebar-menu ul li a {
        color: #fff;
    }

    body[data-sidebar=dark] #sidebar-menu ul li a i {
        color: #fff;
    }

    body[data-sidebar=dark] #sidebar-menu ul li ul.sub-menu li a {
        color: #fff;
        background: 0 0;
    }

    body[data-sidebar=dark] #sidebar-menu ul li ul.sub-menu li a:hover {
        color: #fff;
    }

    body[data-sidebar=dark] #sidebar-menu ul li a:hover {
        color: #fff;
    }

    body[data-sidebar=dark] #sidebar-menu ul li a:hover i {
        color: #fff;
    }
</style>

<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">


                        <a href="<?php echo base_url('Admin/Management/'); ?>" class="logo logo-light">
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

                </div>

                <div class="d-flex">
                    <!-- App Search-->
                    <!--  <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="fa fa-search"></span>
                            </div>
                        </form> -->
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!-- <img class="rounded-circle header-profile-user" src="<?php echo base_url(); ?>uploads/admin-img.jpeg" alt="Header Avatar"> -->
                            Admin
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <!-- <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle font-size-17 align-middle mr-1"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-wallet font-size-17 align-middle mr-1"></i> My Wallet</a>
                                <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings font-size-17 align-middle mr-1"></i> Settings</a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline font-size-17 align-middle mr-1"></i> Lock screen</a>
                                <div class="dropdown-divider"></div> -->
                            <a class="dropdown-item text-danger" href="<?php echo base_url('Admin/Management/logout'); ?>"><i class="bx bx-power-off font-size-17 align-middle mr-1 text-danger"></i> Logout</a>
                        </div>
                    </div>

                    <div class="dropdown d-none">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="mdi mdi-settings-outline"></i>
                        </button>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">
                <a href="<?php echo base_url('Admin/Management/'); ?>" class="brand-link" style=""></a>
                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Main</li>
                        <li>
                            <a href="<?php echo base_url('Admin/Management/'); ?>" class="waves-effect">
                                <i class="ti-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li style="display:<?php echo (in_array("Management/paidUsers", $accesshead)) || (in_array("Management/users", $accesshead)) || (in_array("Management/unpaidUsers", $accesshead)) || (in_array("Management/today_joinings", $accesshead)) || (in_array("Reports/activeUsers", $accesshead)) ? 'block' : 'none'; ?>">
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span> User Details</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li style="display:<?php echo (in_array('Management/users', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Management/users'); ?>">All Members</a></li>
                                <li style="display:<?php echo (in_array('Management/paidUsers', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Management/paidUsers'); ?>">Paid Members</a></li>
                                <li style="display:<?php echo (in_array('Management/unpaidUsers', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Management/unpaidUsers'); ?>">Unpaid Members</a></li>
                                <li style="display:<?php echo (in_array('Management/today_joinings', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Management/today_joinings'); ?>">View TodayJoinings</a></li>
                                <!-- <li style="display:<?php //echo (in_array('Management/today_joinings', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php //echo base_url('Admin/Reports/BoosterTimerHistory'); ?>">Booster Timer History</a></li> -->
                                <!-- <li style="display:<?php echo (in_array('Reports/activeUsers', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Reports/activeUsers'); ?>">Activate Members</a></li> -->
                                <!-- <li style="display:<?php echo (in_array('Reports/activeUsers', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Management/gmtpaidUsers'); ?>">GMT Coin Members</a></li> -->
                            </ul>
                        </li>

                        <!-- <li style="display:<?php //echo (in_array("Permissions/index", $accesshead)) ? 'block' : 'none'; ?>">
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span>Administrators</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li style="display:<?php //echo (in_array('Permissions/index', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php //echo base_url('Admin/Permissions/index'); ?>">Manage</a></li>
                            </ul>
                        </li> -->

                        <li style="display:<?php echo  (in_array("Settings/qrcode", $accesshead)) || (in_array("Settings/news", $accesshead)) || (in_array("Management/popup_upload", $accesshead)) ? 'block' : 'none'; ?>">

                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span> Settings</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                            <!-- <li style="display:<?php //echo (in_array('Settings/numberReport', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php //echo base_url('Admin/Settings/numberReport'); ?>">Site Number</a></li> -->
                            <li style="display:<?php echo (in_array('Settings/qrcode', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Settings/qrcode'); ?>">QR Code Update</a></li>
                            <!-- <li style="display:<?php //echo (in_array('Settings/ResetPassword', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php //echo base_url('Admin/Settings/ResetPassword'); ?>">Password Reset</a></li> -->
                            <li style="display:<?php echo (in_array('Settings/news', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Settings/news'); ?>">News</a></li>
                            <li style="display:<?php echo (in_array('Management/popup_upload', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Management/popup_upload'); ?>">Popup Upload</a></li>

                                <!-- <li> <a href="<?php echo base_url('Admin/Settings/numberReport'); ?>">Site Number</a>
                                <li> <a href="<?php echo base_url('Admin/Settings/qrcode'); ?>">QR Code Update</a></li>
                                <li> <a href="<?php echo base_url('Admin/Settings/ResetPassword'); ?>">Password Reset</a></li>
                                <li><a href="<?php echo base_url('Admin/Settings/news'); ?>">News</a></li>
                                <li><a href="<?php echo base_url('Admin/Management/popup_upload'); ?>"> Popup Upload</a></li> -->
                            </ul>
                        </li>


                        <?php
                        $display = 0;
                        if ($display == 1) :
                        ?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ti-package"></i>
                                    <span> ROI Details</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li> <a href="<?php echo base_url('Admin/Task/roiUser'); ?>">ROI Users</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ti-package"></i>
                                    <span>Ippo Pay Transaction</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="<?php echo base_url('Admin/Reports/ippopayTransaction') ?>">
                                            <p>Transaction History</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <li style="display:<?php echo (in_array("Task/create", $accesshead)) || (in_array('Task/index', $accesshead)) ? 'block' : 'none'; ?>">

                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span>Task</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                            <li style="display:<?php echo (in_array('Task/create', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Task/create'); ?>">Create Link</a></li>

                                <!-- <li>
                                    <a href="<?php echo base_url('Admin/Task/create') ?>">
                                        <p>Create Link</p>
                                    </a>
                                </li> -->
                                <li style="display:<?php echo (in_array('Task/index', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Task'); ?>">Task List</a></li>

                                <!-- <li>
                                    <a href="<?php echo base_url('Admin/Task/') ?>">
                                        <p>Task List</p>
                                    </a>
                                </li> -->

                            </ul>
                        </li>
                        <li style="display:<?php echo (in_array("Withdraw/income", $accesshead)) ? 'block' : 'none'; ?>">

                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span> Income Reports</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <?php
                                $incomes = $this->config->item('incomes'); //$incomes = incomes();
                                foreach ($incomes as $key => $income) {
                                    // pr($income);
                                    echo '<li style="display:  (in_array(Withdraw/income/ . $key, $accesshead)) ? block : none ">
                                    <a href="' . base_url('Admin/Withdraw/income/' . $income['type']) . '">

                                       <p>' . $income['name'] . '</p>
                                    </a>
                                 </li>';
                                }
                                ?>
                            <li style="display:<?php echo (in_array('Withdraw/incomeLedgar', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Withdraw/incomeLedgar'); ?>">Income Ledgar</a></li>
                           
                            <li style="display:<?php echo (in_array('Withdraw/incomeManagement', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Reports/incomeHistory'); ?>">Income History</a></li>

                                <!-- <li><a href="<?php echo base_url('Admin/Withdraw/incomeLedgar/'); ?>">Income Ledgar</a>
                                </li> -->
                                <!-- <li><a href="<?php echo base_url('Admin/Withdraw/payout_summary/'); ?>">Payout
                                        Summary</a></li> -->
                                <!-- <li><a href="<?php// echo base_url('Admin/Withdraw/incomeManagement/'); ?>">Income -->
                                        <!-- Management</a></li> -->

                            </ul>
                        </li>

                        <li style="display:<?php echo (in_array("Management/BankHIstory", $accesshead)) || (in_array("Withdraw/AddressRequests", $accesshead)) || (in_array("Withdraw/ApprovedAddressRequests", $accesshead)) || (in_array("Withdraw/RejectedAddressRequests", $accesshead))  ? 'block' : 'none'; ?>">

                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span>KYC</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                            <li style="display:<?php echo (in_array('Management/BankHIstory', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Management/BankHIstory'); ?>">Bank Detail</a></li>
                            <li style="display:<?php echo (in_array('Withdraw/AddressRequests', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Withdraw/AddressRequests'); ?>">Pending Kyc Requests</a></li>
                            <li style="display:<?php echo (in_array('Withdraw/ApprovedAddressRequests', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Withdraw/ApprovedAddressRequests'); ?>">Approved Kyc Request List</a></li>
                            <li style="display:<?php echo (in_array('Withdraw/RejectedAddressRequests', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Withdraw/RejectedAddressRequests'); ?>">Rejected Kyc Request List</a></li>

                                <!-- <li><a href="<?php echo base_url('Admin/Management/BankHIstory'); ?>">Bank Detail</a>
                                </li>
                                <li><a href="<?php echo base_url('Admin/Withdraw/AddressRequests') ?>">Kyc Requests</a>
                                </li>
                                <li><a href="<?php echo base_url('Admin/Withdraw/ApprovedAddressRequests') ?>">Approved
                                        Kyc Request List</a></li>
                                <li><a href="<?php echo base_url('Admin/Withdraw/RejectedAddressRequests') ?>">Rejected
                                        Kyc Request List</a></li> -->
                            </ul>
                        </li>

                        <!-- <li style="display:<?php //echo (in_array("Settings/index", $accesshead)) ? 'block' : 'none'; ?>">

                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span>Beneficiary</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                            <li style="display:<?php //echo (in_array('Settings/index', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Settings'); ?>">Beneficiary Update</a></li>

                            </ul>
                        </li> -->

                        <li style="display:<?php echo (in_array("Management/Fund_requests/0", $accesshead)) || (in_array("Management/Fund_requests/1", $accesshead)) || (in_array("Management/Fund_requests/2", $accesshead)) || (in_array("Management/Fund_requests", $accesshead)) || (in_array("Management/fund_history", $accesshead)) || (in_array("Management/SendWallet", $accesshead)) || (in_array("Management/admin_fund_history", $accesshead)) ? 'block' : 'none'; ?>">

                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span>Fund Management</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">

                            <li style="display:<?php echo (in_array('Management/Fund_requests/0', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Management/Fund_requests/0'); ?>">Pending FundRequest List</a></li>
                            <li style="display:<?php echo (in_array('Management/Fund_requests/1', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Management/Fund_requests/1'); ?>">Approved FundRequest List</a></li>
                            <li style="display:<?php echo (in_array('Management/Fund_requests/2', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Management/Fund_requests/2'); ?>">Rejected FundRequest List</a></li>
                            <li style="display:<?php echo (in_array('Management/Fund_requests/', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Management/Fund_requests/'); ?>">Fund Request List</a></li>
                            <li style="display:<?php echo (in_array('Management/fund_history', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Management/fund_history'); ?>">Fund History</a></li>
                            <li style="display:<?php echo (in_array('Management/SendWallet', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Management/SendWallet'); ?>">Send FundPersonally</a></li>
                            <li style="display:<?php echo (in_array('Management/admin_fund_history', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Management/admin_fund_history'); ?>">Admin FundHistory</a></li>

                                <!-- <li><a href="<?php echo base_url('Admin/Management/Fund_requests/0'); ?>">Pending FundRequest List</a></li>
                                <li><a href="<?php echo base_url('Admin/Management/Fund_requests/1'); ?>">Approved FundRequest List</a></li>
                                <li><a href="<?php echo base_url('Admin/Management/Fund_requests/2'); ?>">Rejected FundRequest List</a></li>
                                <li><a href="<?php echo base_url('Admin/Management/Fund_requests/'); ?>"> Fund Request List</a></li>
                                <li><a href="<?php echo base_url('Admin/Management/fund_history'); ?>">Fund History</a> </li>
                                <li><a href="<?php echo base_url('Admin/Management/SendWallet'); ?>">Send FundPersonally</a></li>
                                <li><a href="<?php echo base_url('Admin/Management/admin_fund_history'); ?>">Admin FundHistory</a></li> -->
                            </ul>
                        </li>

                        <li style="display:<?php echo (in_array("Withdraw/Pending", $accesshead)) || (in_array("Withdraw/index", $accesshead)) || (in_array("Withdraw/Approved", $accesshead)) || (in_array("Withdraw/Rejected", $accesshead)) ? 'block' : 'none'; ?>">

                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span>Withdraw Management</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                            <li style="display:<?php echo (in_array('Withdraw/Pending', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Withdraw/WithdrawHistory/Pending'); ?>">Pending WithdrawRequests</a></li>
                            <li style="display:<?php echo (in_array('Withdraw/index', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Withdraw/WithdrawHistory/allrequest'); ?>">Withdraw Requests</a></li>
                            <li style="display:<?php echo (in_array('Withdraw/Approved', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Withdraw/WithdrawHistory/Approved'); ?>">Approved WithdrawRequests</a></li>
                            <li style="display:<?php echo (in_array('Withdraw/Rejected', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Withdraw/WithdrawHistory/Rejected'); ?>">Rejected WithdrawRequests</a></li>
                            <!-- <li style="display:<?php echo (in_array('Withdraw/Pending', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Withdraw/Pending'); ?>">Pending WithdrawRequests</a></li>
                            <li style="display:<?php echo (in_array('Withdraw/index', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Withdraw'); ?>">Withdraw Requests</a></li>
                            <li style="display:<?php echo (in_array('Withdraw/Approved', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Withdraw/Approved'); ?>">Approved WithdrawRequests</a></li>
                            <li style="display:<?php echo (in_array('Withdraw/Rejected', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Withdraw/Rejected'); ?>">Rejected WithdrawRequests</a></li> -->

                                <!-- <li><a href="<?php echo base_url('Admin/Withdraw/Pending') ?>"> Pending WithdrawRequests</a></li>
                                <li><a href="<?php echo base_url('Admin/Withdraw/') ?>"> Withdraw Requests</a></li>
                                <li><a href="<?php echo base_url('Admin/Withdraw/Approved') ?>"> Approved WithdrawRequests</a></li>
                                <li><a href="<?php echo base_url('Admin/Withdraw/Rejected') ?>"> Rejected WithdrawRequests</a></li> -->
                            </ul>
                        </li>


                        <li style="display:<?php echo (in_array("Support/inbox", $accesshead)) || (in_array("Support/Compose", $accesshead)) || (in_array("Support/Outbox", $accesshead))  ? 'block' : 'none'; ?>">

                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-package"></i>
                                <span>Mail</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                            <li style="display:<?php echo (in_array('Support/inbox', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Support/inbox'); ?>">Inbox</a></li>
                            <li style="display:<?php echo (in_array('Support/Compose', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Support/Compose'); ?>">Compose Mail</a></li>
                            <li style="display:<?php echo (in_array('Support/Outbox', $accesshead)) ? 'block' : 'none'; ?>"><a href="<?php echo base_url('Admin/Support/Outbox'); ?>">Outbox</a></li>

                                <!-- <li><a href="<?php echo base_url('Admin/Support/inbox'); ?>">Inbox</a></li>
                                <li><a href="<?php echo base_url('Admin/Support/Compose'); ?>">Compose Mail</a></li>
                                <li><a href="<?php echo base_url('Admin/Support/Outbox'); ?>">Outbox</a></li> -->
                            </ul>
                        </li>

                        <li>
                             <?php if($this->session->userdata('role') != 'SA') {
                                ?>
                            <a href="<?php echo base_url('Admin/Management/logout'); ?>">
                               <?php
                             }else{
                                ?>
                            <a href="<?php echo base_url('Admin/Management/Sublogout'); ?>">
                                <?php
                             }
                             ?>
                                <i class="ti-more"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                       
                        <?php //endif; 
                        ?>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->