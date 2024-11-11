<?php
require_once("../../database/db.php");
require_once("controller/functionalityClass.php");
date_default_timezone_set("Asia/Calcutta");

if (empty($_SESSION["admin"])) {
    echo "<script type='text/javascript'> document.location = '../'; </script>";
    exit;
}
$adminid = $_SESSION["admin"]['id'];
$adminquery = mysqli_query($db, "SELECT * FROM `user` WHERE id='$adminid'");
$adminData = mysqli_fetch_array($adminquery);
if ($adminData['password'] != $_SESSION["admin"]['password']) {
    echo "<script type='text/javascript'> document.location = 'controller/function.php?type=logout'; </script>";
    exit;
}
$fu = new functionalityClass();
if (count($_GET) > 0) {
    $_GET = $fu->extract_post($db, $_GET);
}
?>

<!DOCTYPE html>

<html>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="../../images/favicon.png" rel="shortcut icon">
    <title>Admin</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link href="./assets/node_modules/morrisjs/morris.css" rel="stylesheet">

    <link href="./assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">

    <link href="./assets/node_modules/c3-master/c3.min.css" rel="stylesheet">

    <link href="./dist/css/style.min.css" rel="stylesheet">

    <link href="./dist/css/pages/dashboard1.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        a.has-arrow.waves-effect.waves-dark {
            font-size: 12px;
        }

        ul.pagination>li {
            padding: 5px 10px;
            background: #000;
            color: #fff;
            margin: 2px;
        }

        ul.pagination>li {
            padding: 5px 10px;
            background: #000;
            color: #fff;
            margin: 2px;
            width: 39px;
            display: inherit;
        }

        .pagination {
            display: inline;
        }
    </style>

</head>

<body class="horizontal-nav skin-megna-dark fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!--    <div class="preloader">
                <div class="loader">
                    <div class="loader__figure"></div>
                    <p class="loader__label">Elegant admin</p>
                </div>
            </div>-->

    <div id="main-wrapper">

        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">

                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <b>

                            <i class="ti-eraser">GrowMoney</i><span></span>
                        </b>
                </div>

                <div class="navbar-collapse">

                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item d-md-none"> <a class="nav-link nav-toggler waves-effect waves-light" href="javascript:void(0)"><i class="ti-menu"></i></a></li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ti-email"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox animated bounceInDown">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <ul>
                                    <li>
                                        <div class="drop-title bg-primary text-white">
                                            <h4 class="m-b-0 m-t-5">4 New</h4>
                                            <span class="font-light">Notifications</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center">

                                            <a href="javascript:void(0)">
                                                <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span>
                                                </div>
                                            </a>

                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icon-note"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox animated bounceInDown" aria-labelledby="2">
                                <span class="with-arrow"><span class="bg-danger"></span></span>
                                <ul>
                                    <li>
                                        <div class="drop-title text-white bg-danger">
                                            <h4 class="m-b-0 m-t-5">5 New</h4>
                                            <span class="font-light">Messages</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center">

                                            <a href="javascript:void(0)">
                                                <div class="user-img"> <img src="./assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online float-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5></h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span>
                                                </div>
                                            </a>


                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </li>



                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- mega menu -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- End mega menu -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <!--<li><a class="btn btn-danger" href='../../coindes/singlelegclosig.php?test=ture'>Single leg closing</a></li>-->

                        <li class="nav-item dropdown mega-dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-lock pr-2"></i>Change Password
                                <h3 id="lblYeswallet">
                                </h3>
                            </a>
                            <div class="dropdown-menu animated bounceInDown m-auto">
                                <ul class="mega-dropdown-menu">


                                    <li class="m-auto">
                                        <h4 class="m-b-20">Password Manager</h4>
                                        <!-- Contact -->


                                        <?php
                                        if (isset($_SESSION['type'])) {
                                            if ($_SESSION['type'] == true) {
                                                echo "<h3><font color='green'>" . $_SESSION['msg'] . "</font></h3>";
                                            } else {
                                                echo "<h3><font color='red'>" . $_SESSION['msg'] . "</font></h3>";
                                            }
                                        }
                                        unset($_SESSION['msg']);
                                        unset($_SESSION['type']);
                                        ?>


                                        <div class="widget">

                                            <div class="widget-body">
                                                <div class="form-horizontal no-margin">
                                                    <form id="product" action="controller/function.php" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                                                        <div class="control-group">
                                                            <fieldset>

                                                                <div class="control-group">
                                                                    <label class="control-label">Current Password*</label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="current_pass" class="form-control" required>

                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label class="control-label">New Password*</label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="new_pass" class="form-control" required>
                                                                    </div>
                                                                </div>

                                                                <div class="control-group">
                                                                    <label class="col-md-3 control-label" for="inputReadOnly"></label>
                                                                    <div class="col-md-6">
                                                                        <button type="submit" name="change_pass" class="mb-xs mt-xs mr-xs btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>


                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </li>


                        <!-- List style -->

                    </ul>
                </div>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="./assets/images/users/1.jpg" alt="user" class="img-circle" width="30"></a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <span class="with-arrow"><span class="bg-primary"></span></span>
                        <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                            <div class=""><img src="./assets/images/users/1.jpg" alt="user" class="img-circle" width="60"></div>
                            <div class="m-l-10">
                                <h4 class="m-b-0">Steave Jobs</h4>
                                <p class=" m-b-0"><a href="https://www.wrappixel.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="14627566617a547379757d783a777b79">[email&#160;protected]</a></p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                        <div class="dropdown-divider"></div>
                        <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="controller/function.php?type=logout"><i class="fa fa-power-off"></i></a></li>

                </ul>
    </div>
    </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar">
        <div class="nav-text-box align-items-center d-md-none">
            <span style="color:#fff"><i class="ti-eraser">GrowMoney</i><span></span></span>
            <a class="nav-lock waves-effect waves-dark ml-auto hidden-md-down" href="javascript:void(0)"><i class="mdi mdi-toggle-switch"></i></a>
            <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i class="ti-close"></i></a>
        </div>
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li>
                        <a href="index.php"><i class="icon-speedometer"></i>Dashboard</a>

                    </li>
                    <!-- <li>
                                <a href="tree.php"><i class="icon-speedometer"></i>Tree</a>

                            </li> -->
                    <li>
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Users</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="Users.php">All User</a></li>
                            <li><a href="Users_paid.php">Paid Users</a></li>



                        </ul>
                    </li>
                    <!--                            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-palette"></i><span class="hide-menu">Rewards</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="add_reward.php">List of Rewards</a></li>
                                    <li><a href="rewards_ach.php"> Pending Achiever List</a></li>
                                    <li><a href="rewards_list.php"> Confirm Achiever List</a></li>


                                </ul>
                            </li>-->
                    <li class="nav-small-cap"></li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-media-right-alt"></i><span class="hide-menu">Working Withdraw</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="withdraw_work_pend.php">Pending Request</a></li>
                            <li><a href="withdraw_working_done.php">Withdraw Confirmed</a></li>

                        </ul>
                    </li>
                    <!--                            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-media-right-alt"></i><span class="hide-menu">ROI Withdraw</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="withdraw_roi_pend.php">ROI Pending Request</a></li>
                                    <li><a href="withdraw_roi_done.php">ROI Withdraw Confirmed</a></li>

                                </ul>
                            </li>-->
                    <!--                            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-media-right-alt"></i><span class="hide-menu">ROI Withdraw</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="withdraw_roi_pend.php">Pending Request</a></li>
                                    <li><a href="withdraw_roi_done.php">Withdraw Confirmed</a></li>
                                    <li><a href="withdraw_ew_pend.php">E-wallet Pending Request</a></li>
                                    <li><a href="withdraw_ew_done.php">E-wallet Confirmed</a></li>

                                </ul>
                            </li>-->
                    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-accordion-merged"></i><span class="hide-menu">Transactions
                            </span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="transaction.php">wallet transaction</a></li>
                            <!--<li><a href="transaction_recharge.php">Recharge transaction</a></li>-->
                            <li><a href="transaction_ad.php">ad transaction</a></li>

                            <!--                                <li><a href="table-editable-table.html">Editable Table</a></li>-->
                        </ul>
                    </li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Package</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <!--<li><a href="add_package.php">Add package</a></li>-->
                            <li><a href="view_package.php">View package</a></li>
                            <li><a href="add_package.php">Add package</a></li>

                            <!--<li><a href="view_package.php">View package</a></li>-->
                            <li><a href="add_level.php">Add Level Income</a></li>
                            <li><a href="#"></a></li>
                        </ul>
                    </li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Fund Request</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="invest_pending.php">Fund Request Pending</a></li>
                            <li><a href="invest_done.php">Fund Request Done</a></li>
                            <li><a href="invest_reject.php">Fund Request Reject</a></li>
                        </ul>
                    </li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Ad Manage</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="slip_request.php">Upload QR</a></li>
                            <li><a href="news_upload.php">News</a></li>
                            <li><a href="ad_submit.php">Ad Insert</a></li>
                            <li><a href="ad_view.php">Ad View</a></li>
                        </ul>
                    </li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Sub Admin</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="sub_admin.php">Create Sub Admin</a></li>
                            <li><a href="view_admin.php">Sub-Admin List</a></li>
                        </ul>
                    </li>

                    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-files"></i><span class="hide-menu">Other</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <!--<li><a href="add_payment_link.php">Payment Link</a></li>-->
                            <!--<li><a href="view_news.php">Latest news</a></li>-->
                            <!--<li><a href="view_testimonial.php">Testimonial</a></li>-->
                            <!--<li><a href="view_archivers.php">Latest Archivers</a></li>-->
                            <li><a href="deduct_fund.php">Fund Deduct</a></li>
                            <!-- <li><a href="addbinary.php">Add Binary</a></li> -->
                            <!--<li><a href="social_links.php">Social Links</a></li>-->
                            <li><a href="add_balance.php">Refund Amount</a></li>
                            <li><a href="deduct_fund_detail.php">Fund History</a></li>


                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-light-bulb"></i><span class="hide-menu">E Wallet</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="add_fund.php">E send </a></li>
                            <li><a href="BD2_detail.php">E Details </a></li>



                        </ul>
                    </li>
                    <!--                            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-align-left"></i><span class="hide-menu">Gallery</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="view_gallery.php">Images</a></li>
                                    <li><a href="view_videos.php">Videos</a></li>
                                </ul>
                            </li>-->
                    <li>
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-align-left"></i><span class="hide-menu">Support</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="query_list.php">Query pending </a></li>
                            <li><a href="query_list_done.php">Query Done</a></li>

                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">KYC</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="kyc_request.php">KYC pending </a></li>
                            <li><a href="kyc_approved.php">KYC Approved </a></li>
                            <li><a href="kyc_rejected.php">KYC Rejected </a></li>
                        </ul>
                    </li>

                    <li>
                    </li>

                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ================f============================================== -->